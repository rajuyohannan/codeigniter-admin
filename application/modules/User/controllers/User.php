<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - User Controller
 */

class User extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        if(!$this->require_min_level(1)) {
            redirect('user/login');
        }
        else {
            redirect('dashboard');
        }
        
    }

    /**
     * [login description]
     * @return [type] [description]
     */
    public function login() {
        if (!$this->require_min_level(1)) {
            if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
            {
                $this->require_min_level(1);
            }

            $this->setup_login_form();

            $data['title'] = 'Login';

            $data['content'] = $this->load->view('login', NULL, TRUE);
            $this->load->view('html_anon', $data);


        }
        else {
            //Render access denied page
            redirect('dashboard');
            //show_403();
        }
    }


    /**
     * Log out
     */
    public function logout()
    {
        $this->authentication->logout();
        redirect( secure_site_url( LOGIN_PAGE . '?logout=1') );
    }

    /**
     * Reset password
     * @return [type] [description]
     */
    
    public function password() {
        if (!$this->auth_role) {

            // Load resources
            $this->load->model('examples_model');

            /// If IP or posted email is on hold, display message
            if( $on_hold = $this->authentication->current_hold_status( TRUE ) )
            {
                $view_data['disabled'] = 1;
            }
            else
            {
                // If the form post looks good
                if( $this->tokens->match && $this->input->post('user_email') )
                {
                    if( $user_data = $this->examples_model->get_recovery_data( $this->input->post('user_email') ) )
                    {
                        // Check if user is banned
                        if( $user_data->user_banned == '1' )
                        {
                            // Log an error if banned
                            $this->authentication->log_error( $this->input->post('user_email', TRUE ) );

                            // Show special message for banned user
                            $view_data['user_banned'] = 1;
                        }
                        else
                        {
                            /**
                             * Use the string generator to create a random string
                             * that will be hashed and stored as the password recovery key.
                             */
                            $this->load->library('generate_string');
                            $recovery_code = $this->generate_string->set_options( 
                                array( 'exclude' => array( 'char' ) ) 
                            )->random_string(64)->show();

                            $hashed_recovery_code = $this->_hash_recovery_code( $user_data->user_salt, $recovery_code );

                            // Update user record with recovery code and time
                            $this->examples_model->update_user_raw_data(
                                $user_data->user_id,
                                array(
                                    'passwd_recovery_code' => $hashed_recovery_code,
                                    'passwd_recovery_date' => date('Y-m-d H:i:s')
                                )
                            );

                            $view_data['special_link'] = secure_anchor( 
                                'user/verification/' . $user_data->user_id . '/' . $recovery_code, 
                                secure_site_url( 'user/verification/' . $user_data->user_id . '/' . $recovery_code ), 
                                'target ="_blank"' 
                            );

                            $view_data['confirmation'] = 1;
                        }
                    }

                    // There was no match, log an error, and display a message
                    else
                    {
                        // Log the error
                        $this->authentication->log_error( $this->input->post('user_email', TRUE ) );

                        $view_data['no_match'] = 1;
                    }
                }
            }



            $data['title'] = "Forgot Password";

            $data['content'] = $this->load->view('forgot', ( isset( $view_data ) ) ? $view_data : NULL, TRUE);
            $this->load->view('html_anon', $data);
        }
        else {
            //Render access denied page
            show_error('You are not authorized to view this page', '403');
            
        }
    }


    public function verification($user_id, $recovery_code) {
        
        /// If IP is on hold, display message
        if( $on_hold = $this->authentication->current_hold_status( TRUE ) )
        {
            $view_data['disabled'] = 1;
        }
        else
        {
            // Load resources
            $this->load->model('examples_model');

            if( 
                /**
                 * Make sure that $user_id is a number and less 
                 * than or equal to 10 characters long
                 */
                is_numeric( $user_id ) && strlen( $user_id ) <= 10 &&

                /**
                 * Make sure that $recovery code is exactly 64 characters long
                 */
                strlen( $recovery_code ) == 64 &&

                /**
                 * Try to get a hashed password recovery 
                 * code and user salt for the user.
                 */
                $recovery_data = $this->examples_model->get_recovery_verification_data( $user_id ) )
            {
                /**
                 * Check that the recovery code from the 
                 * email matches the hashed recovery code.
                 */
                if( $recovery_data->passwd_recovery_code == $this->_hash_recovery_code( $recovery_data->user_salt, $recovery_code ) )
                {
                    $view_data['user_id']       = $user_id;
                    $view_data['user_name']     = $recovery_data->user_name;
                    $view_data['recovery_code'] = $recovery_data->passwd_recovery_code;
                }

                // Link is bad so show message
                else
                {
                    $view_data['recovery_error'] = 1;

                    // Log an error
                    $this->authentication->log_error('');
                }
            }

            // Link is bad so show message
            else
            {
                $view_data['recovery_error'] = 1;

                // Log an error
                $this->authentication->log_error('');
            }

            /**
             * If form submission is attempting to change password 
             */
            if( $this->tokens->match )
            {
                $this->examples_model->recovery_password_change();
            }
        }

        $data['title'] = "Recover Password";

        $data['content'] = $this->load->view('verfication', ( isset( $view_data ) ) ? $view_data : NULL, TRUE);
        $this->load->view('html_anon', $data);

    }

    /**
     * Hash the password recovery code (uses the authentication library's hash_passwd method)
     */
    private function _hash_recovery_code( $user_salt, $recovery_code )
    {
        return $this->authentication->hash_passwd( $recovery_code, $user_salt );
    }

    /**
     * [dashboard description]
     * @return [type] [description]
     */
    public function dashboard() 
    {

        if (!$this->require_min_level(1)) {
            redirect('user/login');
        }
        else {

                $data['title'] = "Dashboard";
                $data['description'] = "My Dashboard";
                $data['content'] = $this->load->view('dashboard', NULL, TRUE);
                $this->load->view('html', $data);

        }
        
    }

    /**
     * [role description]
     * @return [type] [description]
     */
    public function role() {
        if (!$this->require_min_level(9)) {
            show_error('You are not authorized to access this page', 403);
        }

        $data['title'] = 'View Roles';
        $data['description'] = 'This page lists all the available roles on the website';

        $view['roles'] = $this->config->item('levels_and_roles');

        $data['content'] = $this->load->view('admin/roles_page', $view, TRUE);
        return $this->load->view('html', $data);
    }

    /**
     * [permission description]
     * @return [type] [description]
     */
    public function permission($rid = null) {

        if (!$this->require_min_level(9)) {
            show_error('You are not authorized to access this page', 403);
        }

        $data['title'] = 'Manage Permission';
        $data['description'] = 'Manage permissions on the website';
        $view['roles'] = $this->config->item('levels_and_roles');

        $data['content'] = $this->load->view('admin/permissions_page', $view, TRUE);
        return $this->load->view('html', $data);

        return $this->load->view('html', $data);
    }

    /**
     * [users description]
     * @return [type] [description]
     */
     public function users($page = 1) {

        if (!$this->require_min_level(9)) {
            show_error('You are not authorized to access this page', '403');
        }


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
            //For the status
            if ($this->input->get('userBanned') == 0)
                $where['userBanned'] = 0;
        }
        $this->load->library('pagination');
        $config = $this->config->load('pagination', TRUE);


        $view['users'] = $em->getRepository('Entity\Users')->findBy($where, array('userLastLogin' => 'DESC'), $config['per_page'], ($page - 1) * $config['per_page']);

        $users = $em->getRepository('Entity\Users')->findBy($where, array('userLastLogin' => 'DESC'));

        $config['base_url'] = base_url('admin/users');
        $config['total_rows'] = count($users);
        $config['first_url'] = base_url('admin/users/1') . '?'. http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);

        $view['roles'] = $this->config->item('levels_and_roles');
        $data['title'] = 'Manage Users';
        $data['description'] = 'Manage website users';        
        $data['content'] = $this->load->view('admin/manage_user', $view, TRUE);
        return $this->load->view('html', $data);
    }   


    /**
     * [add description]
     */
    public function add() {
        $this->is_logged_in();
        
        if (!$this->require_min_level(9)) {
            show_error("You are not authorized to access this page", '403');
        }

        $data['title'] = 'Add User';
        $em = $this->doctrine->em;


        $view['department'] = $em->getReference('\Entity\Categories', 1)->loadTermsByCategory($em);

        //Validate
        $this->form_validation->set_rules('username', 'Username', 'required|callback__username_check');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback__email_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|external_callbacks[model,formval_callbacks,_check_password_strength,TRUE]');
        $this->form_validation->set_rules('confirm_pass', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('department', 'Department', 'required');

        
        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/add_user', $view, TRUE);
        }
        else {
            //Save user
            $user = new Entity\Users();

            $user->setUserName($this->input->post('username'));
            $user->setUserEmail($this->input->post('email'));
            $user->setUserLevel($this->input->post('role'));

            $salt = $this->authentication->random_salt();
            $pass = $this->authentication->hash_passwd(
                $this->input->post('password'), 
                $salt
            );

            $now = date_create(date('Y-m-d H:i:s'));

            $user->setUserPass($pass);
            $user->setUserSalt($salt);
            $user->setUserDate($now);
            $user->setUserModified($now);
            $user->setUserBanned(0);

            try {
                //save to database
                $em->persist($user);

                //Add user department
                $profile = new Entity\Profiles();
                $department = $em->getReference('Entity\Terms', $this->input->post('department'));
                $profile->setUser($user);
                $profile->setDepartment($department);
                $profile->setCreatedOn($now);
                $em->persist($profile);

                //Subscribe user to the public groups
                $groups = $em->getRepository('Entity\Groups')->findBy(array('type' => 'organic', 'visibility' => 'public'));

                foreach ($groups as $group) {
                    $subscription = new Entity\Subscription();
                    $subscription->setGroup($group);
                    $subscription->setUser($user);
                    $subscription->setCreatedOn($now);

                    $em->persist($subscription);
                }

                $em->flush();


                if ($this->input->post('notify')) {
                    //Notify user of account creation
                  $this->email->from('no-reply@mobiloitte.com', 'No Reply');
                  $this->email->subject('['.$this->config->item('site_name').'] - Account created');

                  $this->email->to($this->input->post('email'));

                  $data['name'] = $this->input->post('username');
                  $data['header'] = 'User account created on portal';

                  //Send mail to the assigned users
                  $data['text'] = sprintf('A user account has been created for you on the portal. You can now login using the login credentials created for you. It is advisable to update your password on your first login, you can find the password update page in your profile page.<br/><br/><b>Username:</b>%s<br/><b>Password:</b> %s', $this->input->post('username'), $this->input->post('password'));

                  $data['cta_url'] = base_url(); 
                  $data['call_to_action'] = "Login Now"; 

                  $message = $this->load->view('emails/mail', $data, TRUE);
                  $this->email->message($message);
                  $this->email->send();
                  $this->email->clear();
                }


                $this->session->set_flashdata('success', 'User account has been successfully created.');
                redirect('admin/users');
            }
            catch(Exception $err){
                 
                die($err->getMessage());
            }
            
        }
        return $this->load->view('html', $data);

    }

    /**
     * [edit description]
     * @param  [type] $uid [description]
     * @return [type]      [description]
     */
    public function edit($uid) {
        if (!$this->require_min_level(9)) {
            return show_error('You are not authorized to view this page', '403');
        }

        $view['user'] = $user = $this->doctrine->em->getRepository('Entity\Users')
            ->findOneBy(array('userId' => $uid));


        //Validate
        $this->form_validation->set_rules('username', 'Username', 
            array(
                'required',
                array(
                    'validate_username',
                    function ($value) {
                        $validateUser = $this->doctrine->em->getRepository('Entity\Users')
                            ->findOneBy(array('userName' => $value));

                        $uid = $this->uri->segment(5, 0);

                        if ($validateUser && $validateUser->getUserId() != $uid) {
                            $this->form_validation->set_message('validate_username', "Username <b>$value</b> is already taken");
                            return FALSE;
                        }
                        else {
                            return TRUE;
                        }
                    }
                ),
        ));
        $this->form_validation->set_rules('email', 'Email', 
            array(
                'required',
                'valid_email',
                array(
                    'validate_email',
                    function ($value) {
                        $validateUser = $this->doctrine->em->getRepository('Entity\Users')
                            ->findOneBy(array('userEmail' => $value));

                        $uid = $this->uri->segment(5, 0);

                        if ($validateUser && $validateUser->getUserId() != $uid) {
                            $this->form_validation->set_message('validate_email', "Username <b>$value</b> is already taken");
                            return FALSE;
                        }
                        else {
                            return TRUE;
                        }
                    }
                ),
        ));
        
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'trim|external_callbacks[model,formval_callbacks,_check_password_strength,TRUE]');
            $this->form_validation->set_rules('confirm_pass', 'Password Confirmation', 'required|matches[password]');
        }

        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/edit_user', $view, TRUE);
        }
        else {
            //Update user data
            $user = $this->doctrine->em->getReference('Entity\Users', $uid);
            
            $user->setUserName($this->input->post('username'));
            $user->setUserEmail($this->input->post('email'));
            $user->setUserLevel($this->input->post('role'));

            if ($this->input->post('password')) {
                $salt = $this->authentication->random_salt();
                $pass = $this->authentication->hash_passwd(
                    $this->input->post('password'), 
                    $salt
                );
                $user->setUserPass($pass);
                $user->setUserSalt($salt);
            }

            $user->setUserModified(date_create(date('Y-m-d H:i:s')));

            try {
                //save to database
                $this->doctrine->em->persist($user);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'User account has been successfully updated.');
                redirect('admin/users');
            }
            catch(Exception $err){
                die($err->getMessage());
            }
        }

        $data['title'] = 'Edit User';
        return $this->load->view('html', $data);
    }

    /**
     * [delete description]
     * @param  [type] $uid [description]
     * @return [type]      [description]
     */
    public function delete($uid) {

        try {
            $entity = $this->doctrine->em->getReference('Entity\Users', $uid);
            $this->doctrine->em->remove($entity);
            $this->doctrine->em->flush();
            $this->session->set_flashdata('success', 'User account has been successfully deleted');

            redirect($_SERVER['HTTP_REFERER']);
        }
        catch (Exception $err) {
            $this->session->set_flashdata('warning', $err->getMessage());
            redirect($_SERVER['HTTP_REFERER']);

        }
    }

    /**
     * [status_change description]
     * @param  [type]  $uid           [description]
     * @param  integer $status_change [description]
     * @return [type]                 [description]
     */
    public function status_change($uid, $status_change = 1) {

        try {
            $entity = $this->doctrine->em->getReference('Entity\Users', $uid);
            $entity->setUserBanned($status_change);

            $this->doctrine->em->persist($entity);
            $this->doctrine->em->flush();
            $this->session->set_flashdata('success', 'User account status has been successfully updated');

            redirect($_SERVER['HTTP_REFERER']);
        }
        catch (Exception $err) {
            return FALSE;
        }
    }

    /**
     * [_username_check description]
     * @param  [type] $uname [description]
     * @return [type]        [description]
     */
    public function _username_check($uname) {
        
        $user = $this->doctrine->em->getRepository('Entity\Users')
            ->findOneBy(array('userName' => $uname));

        if ($user) {
            $this->form_validation->set_message('_username_check', "Username <b>$uname</b> is already taken");
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    /**
     * [_email_check description]
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public function _email_check($email) {
        $user = $this->doctrine->em->getRepository('Entity\Users')
            ->findOneBy(array('userEmail' => $email));


        if ($user) {
            $this->form_validation->set_message('_email_check', "Email <b>$email</b> is already taken");
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    /**
     * [get_user_boxes description]
     * @param  [type] $users [description]
     * @return [type]        [description]
     */
    public function get_user_boxes($users) {
        $data['users'] = $users;
        return $this->load->view('user_boxes', $data, TRUE);
    }


    public function get() {
        $search = $this->input->get('q');

        $query = "SELECT p, u.userId FROM Entity\Profiles p JOIN p.user u WHERE p.name LIKE :word ";
        $result = $this->doctrine->em->createQuery($query)->setParameter(':word', '%'.$search.'%')->getArrayResult();

        $data = array();

        foreach ($result as $user) {
            $data[] = array(
                'id' => $user[0]['id'], 
                'name' => $user[0]['name']
            );
        }

        echo json_encode($data);
    }



 }
