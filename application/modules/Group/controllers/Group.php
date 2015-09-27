<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - User Controller
 */

class Category extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }


    public function manage() {
    	$data['title'] = 'Manage Categories';
    	
    	return $this->load->view('html', $data);
    }
}