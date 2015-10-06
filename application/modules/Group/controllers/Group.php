<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - User Controller
 */

class Group extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(9)) {
        	show_error('You do not have access to view this resource', '403');
        }
    }

    /**
     * [index description]
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index($page = 1) {

        $em = $this->doctrine->em;
        $where = array();

        if ($this->input->get()) {
            foreach ($this->input->get() as $key => $params) {
                if (!in_array($key, array('submit')) 
                    && !in_array($params, array('-1'))
                    && !empty($params)) {
                    $where[$key] = $params;
                } 
            }
        }


        $this->load->library('pagination');
        $config = $this->config->load('pagination', TRUE);

        $view['groups'] = $em->getRepository('Entity\Groups')->findBy($where, array('title' => 'ASC'), $config['per_page'], ($page - 1) * $config['per_page']);

        $groups = $em->getRepository('Entity\Groups')->findBy($where, array('title' => 'ASC'));

        $config['base_url'] = base_url('admin/groups');
        $config['total_rows'] = count($groups);
        $config['first_url'] = base_url('admin/groups') . '?'. http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);

    	$data['title'] = 'Manage Groups';
    	
    	$data['content'] = $this->load->view('admin/index_groups', $view, TRUE);
    	return $this->load->view('html', $data);
    }


    /**
     * [add description]
     */
    public function add() {
    	$data['title']  = 'Add Group';

        //Validations
        $this->form_validation->set_rules('title', 'Group name', 'trim|required');
        $this->form_validation->set_rules('visibility', 'Group visibility', 'required');
        $this->form_validation->set_rules('type', 'Group type', 'required');

        if (!$this->form_validation->run()) {
    		$data['content'] = $this->load->view('admin/add_group', $view, TRUE);
        }
        else {
            //Save categories
            $group = new Entity\Groups();

            $group->setTitle($this->input->post('title'));
            $group->setDescription($this->input->post('description'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $group->setStatus($status);
            $group->setType($this->input->post('type'));
            $group->setVisibility($this->input->post('visibility'));

        	$user = $this->doctrine->em->getRepository('Entity\Users')
        		->findOneBy(array('userId' => $this->auth_user_id));

            $now = date_create(date('Y-m-d H:i:s'));
            $group->setCreatedBy($user);
            $group->setCreatedOn($now);
            $group->setUpdatedOn($now);

            //Get weights
            $dql = "SELECT MAX(g.weight) AS weight FROM Entity\Groups g " .
                   "WHERE g.type = ?1";

            $weight = $this->doctrine->em->createQuery($dql)
                           ->setParameter(1, 'organic')
                           ->getSingleScalarResult();

            if (!$weight)
            	$weight = 1;
            
            $group->setWeight($weight  + 1);


            try {
                //save to database
                $this->doctrine->em->persist($group);

                //For public groups assign all users in the group
                if ($group->getVisibility() == 'public') {
                    //All active users
                    $users = $this->doctrine->em->getRepository('Entity\Users')->findAll();

                    foreach ($users as $user) {
                        $subscription = new Entity\Subscription();
                        $subscription->setGroup($group);
                        $subscription->setUser($user);
                        $subscription->setCreatedOn($now);

                        $this->doctrine->em->persist($subscription);
                    }
                }

                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'Group has been successfully added.');
                redirect('admin/groups');

            }
            catch(Exception $err) {
                $this->session->set_flashdata('warning', $err->getMessage());
                redirect('admin/groups');
            }
        }
    	return $this->load->view('html', $data);
    }


    /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id) {
        try {
            $entity = $this->doctrine->em->getReference('Entity\Groups', $id);
            $this->doctrine->em->remove($entity);
            $this->doctrine->em->flush();
            $this->session->set_flashdata('success', 'Group has been successfully deleted');

            redirect($_SERVER['HTTP_REFERER']);
        }
        catch (Exception $err) {
            $this->session->set_flashdata('warning', 'Error removing group, try again later.<br/>'.$err->getMessage());
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * [edit description]
     * @param  [type] $gid [description]
     * @return [type]      [description]
     */
    public function edit($gid) {
        $view['group'] = $group = $this->doctrine->em->getRepository('Entity\Groups')
            ->findOneBy(array('id' => $gid));

        //Validations
        $this->form_validation->set_rules('title', 'Group name', 'trim|required');
        $this->form_validation->set_rules('visibility', 'Group visibility', 'required');
        $this->form_validation->set_rules('type', 'Group type', 'required');

        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/edit_group', $view, TRUE);
        }
        else {
            $now = date_create(date('Y-m-d H:i:s'));

            //Update subscriptions, if the group visibility is being changed
            //@TODO - Take into account user profile settings.
            if ($group->getVisibility() == 'public' 
                && $this->input->post('visibility') == 'private') {
                //From public to private
                $subscriptions = $this->doctrine->em->getRepository('Entity\Subscription')->findBy(array(
                        'group' => $group
                    ));
                foreach ($subscriptions as $subscription) {
                    $this->doctrine->em->remove($subscription);
                }
                $this->session->set_flashdata('warning', 'Group subscription has been revoked');
            }

            if ($group->getVisibility() == 'private' 
                && $this->input->post('visibility') == 'public') {
              //From private to public
              $users = $this->doctrine->em->getRepository('Entity\Users')->findAll();

                foreach ($users as $user) {
                    $subscription = new Entity\Subscription();
                    $subscription->setGroup($group);
                    $subscription->setUser($user);
                    $subscription->setCreatedOn($now);

                    $this->doctrine->em->persist($subscription);
                }
                $this->session->set_flashdata('warning', 'Group subscription has been updated');
            }

            //Update Groups
            $group->setTitle($this->input->post('title'));
            $group->setDescription($this->input->post('description'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $group->setStatus($status);
            $group->setType($this->input->post('type'));
            $group->setVisibility($this->input->post('visibility'));
            $group->setUpdatedOn($now);


            try {
                $this->doctrine->em->persist($group);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'Group has been successfully updated.');
                redirect('admin/groups');
            }
            catch(Exception $err) {
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/groups');
            }
        }

        $data['title'] = 'Edit Terms';
        return $this->load->view('html', $data);
    }

    /**
     * [members description]
     * @param  [type] $gid [description]
     * @return [type]      [description]
     */
    public function members($gid) {
        $data['title'] = 'Manage Subscription';
        
        $em = $this->doctrine->em;
        $groups = $em->find('Entity\Groups', $gid);

        $view['subscriptions'] = $em->getRepository('Entity\Subscription')->findBy(array('group' => $groups));
        $view['title'] = "Manage subscription for <b>" . $groups->getTitle() . "</b>";
        $view['members'] = $em->getRepository('Entity\Users')->findAll();
        
        //$view['members'] = modules::run('User/get_user_boxes', array($members));

        $data['content'] = $this->load->view('admin/groups_member', $view, TRUE);
        return $this->load->view('html', $data);
    }


}