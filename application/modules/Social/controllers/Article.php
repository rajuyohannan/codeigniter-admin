<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 * PMS - User Controller
 */

class Article extends MY_Controller 
{

    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(9)) {
        	show_error('You do not have access to view this resource', '403');
        }
        $this->load->model('user_model');
    }

    public function index($page = 1) 
	{
	

		$em = $this->doctrine->em;
        $where = array();

        if ($this->input->get('title')) {
            $where['title'] = $this->input->get('title');
        }

        $this->load->library('pagination');
        $config = $this->config->load('pagination', TRUE);

        $view['article'] = $em->getRepository('Entity\Articles')->findBy($where, array('title' => 'ASC'), $config['per_page'], ($page - 1) * $config['per_page']);

        $article = $em->getRepository('Entity\Articles')->findBy($where, array('title' => 'ASC'));

        $config['base_url'] = base_url('admin/articles/manage');
        $config['total_rows'] = count($article);
        $config['first_url'] = base_url('admin/articles/manage') . '?'. http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);

    	$data['title'] = 'Manage article';
    	
    	$data['content'] = $this->load->view('admin/manage_article', $view, TRUE);
    	return $this->load->view('html', $data);
    }

    /**
     * [add description]
     */
     public function add() {
    	$data['title'] = 'Add Article';
     
        $view['groups'] = $this->user_model->getContentReference('Entity\Groups');


       //Validations Title
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        
		//Validations description
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('groupRef', 'Groups', 'trim|required|is_natural', array('is_natural' => 'Group reference field is required'));
		$this->form_validation->set_rules('type', 'Status', 'trim|required');
		
		
        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/add_article', $view, TRUE);
        }
		
		
        
        
		
	
		
        else {
            //Save Articles
            $article = new Entity\Articles();
			
            $article->setTitle($this->input->post('title'));
            $article->setBody($this->input->post('description'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $article->setStatus($status);
            $createdBy = $this->doctrine->em->getReference('Entity\Users', $this->auth_user_id);
            $article->setCreatedBy($createdBy);
            $article->setCreatedOn(date_create(date('Y-m-d H:i:s')));
			$article->setUpdatedOn(date_create(date('Y-m-d H:i:s')));
			
            try {
                //save to database
                $this->doctrine->em->persist($article);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'article has been successfully added.');
                redirect('admin/articles');

            }
            catch(Exception $err) {
                die($err->getMessage());
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/articles');
            }
        }
    	return $this->load->view('html', $data);
    }


    public function edit($cid) {

        $view['article'] = $article = $this->doctrine->em->getRepository('Entity\Articles')
            ->findOneBy(array('id' => $cid));

        //Validations
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        
        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/edit_article', $view, TRUE);
        }
        else {
            //Update category
            $article->setTitle($this->input->post('title'));
            $article->setBody($this->input->post('description'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $article->setStatus($status);

            try {
                $this->doctrine->em->persist($article);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'Article has been successfully updated.');
                redirect('admin/articles');
            }
            catch(Exception $err) {
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/articles');
            }
        }

        return $this->load->view('html', $data);
    }

    /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id) {

        try {
            $entity = $this->doctrine->em->getReference('Entity\Articles', $id);
            $this->doctrine->em->remove($entity);
            $this->doctrine->em->flush();
            $this->session->set_flashdata('success', 'Category has been successfully deleted');

            redirect($_SERVER['HTTP_REFERER']);
        }
        catch (Exception $err) {
            $this->session->set_flashdata('warning', 'Error removing category, try again later.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}