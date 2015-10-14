<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - Estimations Controller
 */

class Doi extends MY_Controller {

    /**
     * [__construct description]
     */
    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(1)) {
        	show_error('You do not have access to view this resource', '403');
        }
        $this->load->model('user_model');
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

    /**
     * [add description]
     */
    public function add() {
        $em = $this->doctrine->em;

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

        if ($this->input->post('selfestimated')) {
            $view['show_estimation_block'] = $selfestimation = true;
            $view['estimation_rows'] = count($this->input->post('department[]'));
            $this->form_validation->set_rules('leadsource', 'Leadsource', 'trim|required|is_natural',
                array('is_natural' => 'You must select leadsource field'));
            $this->form_validation->set_rules('department[]', 'Tasks', 'trim|required', 
                array('required' => 'All the tasks fields are required'));
            $this->form_validation->set_rules('effort[]', 'Effort', 'trim|required|is_natural', 
                array('required' => 'All effort fields required'));

        }
        else {
            $view['show_estimation_block'] = $selfestimation = false;
            $this->form_validation->set_rules('EstimationRefernce', 'Estimation reference', 'trim|required|is_natural', 
                array('is_natural' => 'You must select an estimation refernce')); 
        }


        if ($projectTechs = $this->input->post('projectTech[]')) {
            $view['show_label'] = true;

            foreach ($projectTechs as $projectTech) {
                $view['show_'.$projectTech] = true;
                $this->form_validation->set_rules("distribution[$projectTech]", 'Domain distribution', 'trim|required|is_natural');
            }

        }
        else {
            $view['show_label'] = false;
        }


        if ($this->input->post('existingclient')) {
            $view['show_existing'] = $existingclient =  true;
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
            $date  = date_create(date('Y-m-d H:i:s'));
            $actingUser = $this->doctrine->em->getReference('Entity\Users', $this->auth_user_id);

            //Estimation
            if (!$selfestimation) {
                $estimation = new Entity\Estimations;
                $estimation->setTitle($this->input->post('title'));
                $estimation->setDescription('SELF ESTIMATION');
                $leadsource = $this->doctrine->em->getReference('Entity\Terms', $this->input->post('leadsource'));
                $estimation->setSchduledOn($date);
                $estimation->setAssignedBy($actingUser);
                $estimation->setMarketplace($leadsource);
                $estimation->setCreatedOn($date);
                $estimation->setUpdatedOn($date);
                $this->doctrine->em->persist($estimation);

                //Save Estimation Users
                $assign_estimation = new Entity\EstimationsUsers;
                $assign_estimation->setStatus('completed');
                $assign_estimation->setAssignedTo($actingUser);
                $assign_estimation->setEstimation($estimation); 
                $assign_estimation->setData();
                $assign_estimation->setStartedOn($date);
                $assign_estimation->setCompletedOn($date); 
                $this->doctrine->em->persist($assign_estimation);  
            }
            else {
                $estimation = $em->getReference('Entity\Estimations', $this->input->post('EstimationRefernce'));
            }

            //Clients
            if (!$existingclient) {
                $client = new Entity\Clients;
                $client->setName($this->input->post('clientName'));
                $client->setEmail($this->input->post('clientEmail'));
                $client->setContact($this->input->post('clientPhone'));
                $client->setIm($this->input->post('clientIm'));
                $client->setAddress($this->input->post('address'));
                $client->setTimezone($this->input->post('clientTimezone'));
                $client->setCreatedOn($date);
                $client->setUpdatedOn($date);
                $client->setCreatedBy($actingUser);
                $this->doctrine->em->persist($client);  

            }
            else {
                $client = $em->getReference('Entity\Clients', $this->input->post('clientId'));
            }

            //Projects
            $project = new Entity\Projects;
            $project->setName($this->input->post('title'));
            $project->setTimeline($this->input->post('title'));
            $project->setValue($this->input->post('title'));
            $project->setCreatedOn($date);
            $project->setUpdatedOn($date);
            $project->setClient($client);
            
            $project->setType();
            $project->setCurrency();
            $project->setStage();
            $project->setCodebase();

            $project->setCreatedBy($actingUser);
            $this->doctrine->em->persist($project);  

            //Project Distribution
            $projectDist = new Entity\ProjectDistribution;


            //Project payments
            $projectPayment = new Entity\ProjectPayment;
            
            //Project Risks           
            $projectRisk = new Entity\ProjectRisks;

            //DOI
            $doi = new Entity\Dois;
            $doi->setSelf();
            $doi->setStatus();
            $doi->setCreatedOn();
            $doi->setUpdatedOn();
            $doi->setCreatedBy();
            $doi->setSource();
            $doi->setEstimation();
            $doi->setProject();
            $this->doctrine->em->persist($doi);  

            //Send Email


            redirect('admin/bdms/doi');
        }

    	$data['title'] = 'Create DOI';
    	return $this->load->view('html', $data);
    }

}