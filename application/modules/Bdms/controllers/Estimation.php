<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - Estimations Controller
 */

class Estimation extends MY_Controller {

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

        $view['estimations'] = $em->getRepository('Entity\Estimations')->findBy($where, array('title' => 'ASC'), $config['per_page'], ($page - 1) * $config['per_page']);
        
        $estimation_users = array();
        foreach ($view['estimations'] as $estimation) {
            $users = $em->createQuery("SELECT IDENTITY(eu.assignedTo) as assignedTo, eu.status as status FROM Entity\EstimationsUsers eu WHERE eu.estimation = ?1")
            ->setParameter(1, $estimation->getId())->getArrayResult();
            
            $assign_to = array();
            foreach ($users as $user) {
                $assign_to[$user['assignedTo']]['user'] = $this->user_model->getUserName($user['assignedTo']);
                $assign_to[$user['assignedTo']]['status'] = $user['status'];
            }
            
            $estimation_users[$estimation->getId()]['estimation_users'] = $assign_to;
        }

        $view['estimation_users'] = $estimation_users;

        $estimations = $em->getRepository('Entity\Estimations')->findBy($where);

        $config['base_url'] = base_url('admin/bdms/estimations');
        $config['total_rows'] = count($estimations);
        $config['first_url'] = base_url('admin/bdms/estimations') . '?'. http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);

    	$data['title'] = 'Manage Estimations';

        $view['assignedby']  = $this->user_model->getAssignedBy('Entity\Estimations', 'assignedBy');
        $view['marketplace'] = $this->user_model->getMasterTerms(array('leadsource'))['leadsource'];

    	$data['content'] = $this->load->view('admin/index_estimations', $view, TRUE);
    	return $this->load->view('html', $data);
    }


    public function add() {
        
        $this->load->model('user_model');

        //Validations
        $this->form_validation->set_rules('leadsource', 'Lead Source', 'greater_than[0]', 
            array('greater_than' => 'You must select a valid lead source.'));
        $this->form_validation->set_rules('title', 'Estimation title', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('assignTo[]', 'Assignee', 'trim|required');
        $this->form_validation->set_rules('scheduledOn', 'Estimation Schedule', 'trim|required');

        $lead_source = $this->user_model->getMasterTerms(array('leadsource'));
        
        $view['leadsource'] = array(0 => '- SELECT -') + $lead_source['leadsource'];
        
        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/add_estimations', $view, TRUE);
        }
        else {
            //Save Values
            $estimation = new Entity\Estimations;

            $estimation->setTitle($this->input->post('title'));
            $estimation->setDescription($this->input->post('description'));

            $scheduledDate = date_create(date('Y-m-d H:i:s', strtotime($this->input->post('scheduledOn'))));
            $date          = date_create(date('Y-m-d H:i:s'));
            $actingUser = $this->doctrine->em->getReference('Entity\Users', $this->auth_user_id);
            $leadsource = $this->doctrine->em->getReference('Entity\Terms', $this->input->post('leadsource'));

            $estimation->setSchduledOn($scheduledDate);
            $estimation->setAssignedBy($actingUser);
            $estimation->setMarketplace($leadsource);
            $estimation->setCreatedOn($date);
            $estimation->setUpdatedOn($date);

            $this->doctrine->em->persist($estimation);

            $assignto = $this->input->post('assignTo');

            foreach ($assignto as $assign) {
                $assignTo = $this->doctrine->em->getReference('Entity\Users', $assign);
                //Save Estimation users
                $assign_estimation = new Entity\EstimationsUsers;
                $assign_estimation->setStatus('pending');
                $assign_estimation->setAssignedTo($assignTo);
                $assign_estimation->setEstimation($estimation);  
                $this->doctrine->em->persist($assign_estimation);               
            }

            $this->doctrine->em->flush();

            //Update file reference
            $files = preg_split('/\,/', $this->input->post('fileIds'), -1, PREG_SPLIT_NO_EMPTY);


            foreach ($files as $file) {
                $fileEntity = $this->doctrine->em->getReference('Entity\Files', $file);
                $fileEntity->getEntityId($estimation->getId());
                $this->doctrine->em->persist($fileEntity);
                echo "<pre>";
                    print_r($estimation->getId());

            }
            exit;


            $this->doctrine->em->flush();
            $this->session->set_flashdata('success', 'Estimation has been successfully assigned.');
            redirect('admin/bdms/estimations');
        }

    	$data['title'] = 'Assign Estimation';
        return $this->load->view('html', $data);
    }

}