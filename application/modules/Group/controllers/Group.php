<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - User Controller
 */

class Group extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(9)) {
        	show_error('You do not have access to view this resource', '403');
        }
    }


    public function index($page = 1) {

        $em = $this->doctrine->em;
        $where = array();

        if ($this->input->get('title')) {
            $where['title'] = $this->input->get('title');
        }

        $this->load->library('pagination');
        $config = $this->config->load('pagination', TRUE);

        $view['groups'] = $em->getRepository('Entity\Groups')->findBy($where, array('title' => 'ASC'), $config['per_page'], ($page - 1) * $config['per_page']);

        $groups = $em->getRepository('Entity\Groups')->findBy($where, array('title' => 'ASC'));

        $config['base_url'] = base_url('admin/groups');
        $config['total_rows'] = count($groups);
        $config['first_url'] = base_url('admin/groups') . '?'. http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);

    	$data['title'] = 'Manage Groups';
    	
    	$data['content'] = $this->load->view('admin/index_groups', $view, TRUE);
    	return $this->load->view('html', $data);
    }

    public function add() {
    	$data['title']  = 'Add Group';

        //Validations
        $this->form_validation->set_rules('title', 'Group name', 'trim|required');
        $this->form_validation->set_rules('visibility', 'Group visibility', 'required');
        $this->form_validation->set_rules('type', 'Group type', 'required');

        if (!$this->form_validation->run()) {
    		$data['content'] = $this->load->view('admin/add_group', $view, TRUE);
        }
        else {
            //Save categories
            $group = new Entity\Groups();

            $group->setTitle($this->input->post('title'));
            $group->setDescription($this->input->post('description'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $group->setStatus($status);
            $group->setType($this->input->post('type'));
            $group->setVisibility($this->input->post('visibility'));

        	$user = $this->doctrine->em->getRepository('Entity\Users')
        		->findOneBy(array('userId' => $this->auth_user_id));

            $group->setCreatedBy($user);
            $group->setCreatedOn(date_create(date('Y-m-d H:i:s')));
            $group->setUpdatedOn(date_create(date('Y-m-d H:i:s')));

            //Get weights
            $dql = "SELECT MAX(g.weight) AS weight FROM Entity\Groups g " .
                   "WHERE g.type = ?1";

            $weight = $this->doctrine->em->createQuery($dql)
                           ->setParameter(1, 'organic')
                           ->getSingleScalarResult();

            if (!$weight)
            	$weight = 1;
            
            $group->setWeight($weight);


            try {
                //save to database
                $this->doctrine->em->persist($group);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'Group has been successfully added.');
                redirect('admin/groups');

            }
            catch(Exception $err) {
                die($err->getMessage());
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/groups');
            }
        }
    	return $this->load->view('html', $data);

    }

}