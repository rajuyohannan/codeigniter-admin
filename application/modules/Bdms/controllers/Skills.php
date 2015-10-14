<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - Estimations Controller
 */

class Skills extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(1)) {
        	show_error('You do not have access to view this resource', '403');
        }
        $this->load->model('user_model');
    }


    public function index() {
    	$data['title'] = "Skill Pool";
        $data['content'] = $this->load->view('admin/index_resource', $view, true);
    	return $this->load->view('html', $data);
    }

}