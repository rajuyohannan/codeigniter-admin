<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - User Controller
 */

class Errors extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->require_min_level(1);
    }


    /**
     * [error_404 description]
     * @return [type] [description]
     */
    
    public function error_404() {

        $this->output->set_status_header('404');        
        $data['check_login'] = $loggedin = $this->authentication->check_login( 1 );

        $data['content'] = $this->load->view('errors/page_not_found', $data, TRUE);

    	if (!$loggedin->user_id) {
            $this->load->view('html_anon', $data);
    	}
    	else {
            $this->load->view('html', $data);
    	}

    }
}