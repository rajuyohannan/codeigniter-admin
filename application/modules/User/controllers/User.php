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
            show_403();
            //redirect('dashboard');
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

 }