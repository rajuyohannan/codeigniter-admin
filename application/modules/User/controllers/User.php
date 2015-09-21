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
        if (!$this->require_min_level(1)) {

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
            //show_403();
            redirect('dashboard');
        }
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
        	$content = "Welcome " . $this->auth_user_name . ",";

        	$content .= secure_anchor( 
	                            'user/logout', 
	                            'Logout'
	                        );

            echo $content .=  "<br/><br/>".$this->auth_role . ' logged in!<br />
                User ID is ' . $this->auth_user_id . '<br />
                Auth level is ' . $this->auth_level . '<br />
                Username is ' . $this->auth_user_name;
        }
        
    }

 }