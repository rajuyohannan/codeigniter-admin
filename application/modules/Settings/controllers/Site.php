<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - Estimations Controller
 */

class Site extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(1)) {
        	show_error('You do not have access to view this resource', '403');
        }
    }


    public function index() {
    	$data['title'] = "Site Settings";




    	$data['content'] = $this->load->view('admin/index', $view, TRUE);
    	return $this->load->view('html', $data);
    }

}