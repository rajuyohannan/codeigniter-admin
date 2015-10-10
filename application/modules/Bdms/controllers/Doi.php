<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - Estimations Controller
 */

class Doi extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(1)) {
        	show_error('You do not have access to view this resource', '403');
        }
    }


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

        $view['estimations'] = $em->getRepository('Entity\Estimations')->findBy($where, array('title' => 'ASC'), $config['per_page'], ($page - 1) * $config['per_page']);

        $estimations = $em->getRepository('Entity\Estimations')->findBy($where, array('title' => 'ASC'));

        $config['base_url'] = base_url('admin/bdms/estimations');
        $config['total_rows'] = count($estimations);
        $config['first_url'] = base_url('admin/bdms/estimations') . '?'. http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);

    	$data['title'] = 'Manage DOIs';
    	
    	$data['content'] = $this->load->view('admin/index_dois', $view, TRUE);
    	return $this->load->view('html', $data);
    }


    public function add() {
        
        //Validation
        $this->form_validation->set_rules('title', 'Project name', 'trim|required');

        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/add_dois', $view, TRUE);            
        }
        else {
            //Save values
            redirect('admin/bdms/doi');
        }

    	$data['title'] = 'Create DOI';
    	return $this->load->view('html', $data);
    }

}