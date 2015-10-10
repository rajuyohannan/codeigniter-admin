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
         $this->load->model('user_model');
    }


    public function index() {

    	$data['title'] = "Master Categories";


        if ($this->input->post('categoryId')) {
            //Save Value
            $master = new Entity\MasterCategories;

            $master->setTitle($this->input->post('category'));
            $master->setCategory(
                    $this->doctrine->em->getReference(
                        'Entity\Categories', 
                        $this->input->post('categoryId')
                    )
                );

            $this->doctrine->em->persist($master);
            $this->doctrine->em->flush();


        }


        $savedValues = $this->user_model->getMasterCategories();

        //Required settings for the select options
        $masterCategories = array(
            'department' => array(
                'name' => 'Department', 
                'icon' => 'building'
            ), 
            'leadsource' => array(
                'name' => 'Lead Source', 
                'icon' => 'calculator'
            ),
            'projecttype' => array(
                'name' => 'Project Type', 
                'icon' => 'list'
            ),
            'technologies' => array(
                'name' => 'Technologies', 
                'icon' => 'cogs'
            ),
            'project stage' => array(
                'name' => 'Project Stage', 
                'icon' => 'check-square'
            ),
            'codebase' => array(
                'name' => 'Codebase', 
                'icon' => 'code'
            ),
            'currency' => array(
                'name' => 'Currency', 
                'icon' => 'money'
            ),
        );
        $view['categories'] = array_merge_recursive($masterCategories, $savedValues);
        
        $view['categoryList'] = $this->user_model->loadCategories();
        $view['title'] = "Manage Site Categories";
    	$data['content'] = $this->load->view('admin/index', $view, TRUE);
    	return $this->load->view('html', $data);
    }

}