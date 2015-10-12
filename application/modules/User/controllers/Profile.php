<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - User Controller
 */

class Profile extends MY_Controller {
    
    /**
     * [__construct description]
     */
    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(1)) {
        	show_error('You are not authorized to access this page.', '403');
        }

        $this->load->model('user_model');
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index($id = null) {

        $this->load->helper('smiley');
        $this->load->library('table');

        if (!$id)
             $id = $this->auth_user_id;

        $image_array = get_clickable_smileys(base_url('assets/plugins/emojione/'), 'comments');
        $view['smiley_table'] = $this->table->make_columns($image_array, 12);
        $view['user_profile'] = $this->user_model->getUserProfile($id);
        $view['skills'] = $this->user_model->loadTermsByCategory('skills');
        $view['userSkills'] = array_flip($this->user_model->getUserSkills($this->auth_user_id));

    	$data['title']   = "My Profile";
    	$data['content'] = $this->load->view('user_profile', $view, true);
    	$this->load->view('html', $data);
    }

    /**
     * [update description]
     * @return [type] [description]
     */
    public function update($id = null) {

        if (!$id)
             $id = $this->auth_user_id;

        //Validations
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('skills[]', 'Skills', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('error', validation_errors());           
        }
        else {

            $profile = $this->doctrine->em->getRepository('Entity\Profiles')->findOneBy(array('user' => $id));

            $actingUser = $this->doctrine->em->getReference('Entity\Users', $this->auth_user_id);

            if (!$profile) {
                //Add a new profile for user   
                $profile = new Entity\Profiles();
            }

            $now = date_create(date('Y-m-d H:i:s'));

            $profile->setName(preg_replace('/\_/', '', $this->input->post('name')));
            $profile->setDob(date_create(date('Y-m-d H:i:s', strtotime($this->input->post('dob')))));
            $profile->setContactNumber($this->input->post('contact'));
            $profile->setAddress($this->input->post('address'));
            $profile->setCreatedOn($now);

            $this->doctrine->em->persist($profile);

            //Add Skills
            if ($skills = $this->input->post("skills")) {
                foreach ($skills as $skill) {
                    if (!is_numeric($skill)) {
                       //Save new tags
                        $terms = new Entity\Terms();
                        $terms->setTitle($skill);
                        $terms->setStatus(1);
                        $terms->setDescription('');

                        $category = $this->doctrine->em->getReference('Entity\Categories', 9);
                        
                        $weight = $this->user_model->getMaxWeight($category->getId());

                        $terms->setWeight($weight + 1);
                        $terms->setCategory($category);
                        $terms->setCreatedBy($actingUser);
                        $terms->setCreatedOn(date_create(date('Y-m-d H:i:s')));
                        $this->doctrine->em->persist($terms);

                    }
                    else {
                        $terms = $this->doctrine->em->getRepository('Entity\Terms')->find($skill);
                    }

                    $exist = $this->doctrine->em->getRepository('Entity\UserSkills')->findBy(array('term' => $terms->getId(), 'user' => $id));

                    if (!$exist) {
                        //Add Terms in user skills
                        $userSkills = new Entity\UserSkills();
                        $userSkills->setTerm($terms);
                        $userSkills->setUser($actingUser);
                        $this->doctrine->em->persist($userSkills);
                    }
                }
            }


            $this->doctrine->em->flush();

        }

        redirect('user/profile#profile');
    }


    /**
     * [updatePassword description]
     * @return [type] [description]
     */
    public function password() {

        //Validations
        $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|callback__password_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|external_callbacks[model,formval_callbacks,_check_password_strength,TRUE]');
        $this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'trim|required|matches[password]');
        

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('error', validation_errors());           
        }
        else {
            //Save values
        }

        redirect('user/profile#password');
    }

    /**
     * [_password_check description]
     * @return [type] [description]
     */
    public function _password_check() {

        $auth_data = $this->auth_model->get_auth_data($this->auth_user_name);
        
        $wrong_password = ( ! $this->authentication->check_passwd( $auth_data->user_pass, $auth_data->user_salt, $this->input->post('password') ) );
        if ($wrong_password) {
            $this->form_validation->set_message('_password_check', "Current password doesn't matches with our record");
            return FALSE;
        }
        else {
            return TRUE;
        }
    }





    /**
     * [upload description]
     * @return [type] [description]
     */
    public function upload() {
        echo "Success";
    }
}