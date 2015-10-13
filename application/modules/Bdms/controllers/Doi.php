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
        $this->load->model('user_model');
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

        $view['estimations'] = $em->getRepository('Entity\Dois')->findBy($where, array('project' => 'ASC'), $config['per_page'], ($page - 1) * $config['per_page']);

        $estimations = $em->getRepository('Entity\Dois')->findBy($where, array('project' => 'ASC'));

        $config['base_url'] = base_url('admin/bdms/estimations');
        $config['total_rows'] = count($estimations);
        $config['first_url'] = base_url('admin/bdms/estimations') . '?'. http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);

    	$data['title'] = 'Manage DOIs';
    	
    	$data['content'] = $this->load->view('admin/index_dois', $view, TRUE);
    	return $this->load->view('html', $data);
    }


    public function add() {
        
        $masterCategory  = $this->user_model->getMasterCategories();
        $view['options'] = $this->user_model->getMasterTerms(array_keys($masterCategory));
        
        //Validation
        $this->form_validation->set_rules('title', 'Project name', 'trim|required');
        $this->form_validation->set_rules('orderValue', 'Order Value', 'trim|required');
        $this->form_validation->set_rules('advanceAmount', 'Advance Amount', 'trim|required|decimal');
        $this->form_validation->set_rules('projectType', 'Type', 'trim|required|is_natural', 
            array('is_natural' => 'Project type field is required'));
        $this->form_validation->set_rules('projectTech[]', 'Technologies', 'trim|required|is_natural', 
            array('is_natural' => 'Technologies field is required'));
        $this->form_validation->set_rules('projectStage', 'Stage', 'trim|required|is_natural', 
            array('is_natural' => 'Project stage field is required'));
        $this->form_validation->set_rules('projectCodebase', 'Codebase', 'trim|required|is_natural', 
            array('is_natural' => 'Codebase field is required'));
        $this->form_validation->set_rules('projectCurrency', 'Codebase', 'trim|required|is_natural', 
            array('is_natural' => 'Currency field is required'));

        if ($this->input->post('existingclient')) {
            $view['show_existing'] = true;
            $this->form_validation->set_rules('clientId', 'Existing client', 'trim|required|is_natural', 
                array('is_natural' => 'You must select an existing client'));
        }
        else {
            $view['show_existing'] = false;
            $this->form_validation->set_rules('clientName', 'Client name', 'trim|required');
            $this->form_validation->set_rules('clientEmail', 'Client Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('clientPhone', 'Client Phone', 'trim|required|min_length[8]|max_length[10]');
        }

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