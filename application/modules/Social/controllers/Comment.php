<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - User Controller
 */

class Comment extends MY_Controller {

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

        $view['comment'] = $em->getRepository('Entity\Comments')->findBy($where, array('body' => 'ASC'), $config['per_page'], ($page - 1) * $config['per_page']);

        $comment = $em->getRepository('Entity\Comments')->findBy($where, array('body' => 'ASC'));

        $config['base_url'] = base_url('admin/comments/manage');
        $config['total_rows'] = count($comment);
        $config['first_url'] = base_url('admin/comments/manage') . '?'. http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);

    	$data['body'] = 'Manage comment';
    	
    	$data['content'] = $this->load->view('admin/manage_comment', $view, TRUE);
    	return $this->load->view('html', $data);
    }

    /**
     * [add description]
     */
          public function add() {
    	$data['body'] = 'Add Comment';
       //Validations
        $this->form_validation->set_rules('body', 'Body', 'trim|required');
        
        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/add_comment', NULL, TRUE);
        }
        else {
            //Save Articles
            $comment = new Entity\Comments();
            $comment->setBody($this->input->post('body'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $comment->setStatus($status);
            $createdBy = $this->doctrine->em->getReference('Entity\Users', $this->auth_user_id);
            $comment->setCreatedBy($createdBy);
            $comment->setCreatedOn(date_create(date('Y-m-d H:i:s')));
			
            try {
                //save to database
                $this->doctrine->em->persist($comment);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'comment has been successfully added.');
                redirect('admin/comments');

            }
            catch(Exception $err) {
                die($err->getMessage());
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/comments');
            }
        }
    	return $this->load->view('html', $data);
    }


    public function edit($cid) {

        $view['comment'] = $comment = $this->doctrine->em->getRepository('Entity\Comments')
            ->findOneBy(array('id' => $cid));

        //Validations
        $this->form_validation->set_rules('body', 'Body', 'trim|required');
        
        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/edit_comment', $view, TRUE);
        }
        else {
            //Update Comments
           // $comment->setTitle($this->input->post('title'));
            $comment->setBody($this->input->post('body'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $comment->setStatus($status);

            try {
                $this->doctrine->em->persist($comment);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'Comment has been successfully updated.');
                redirect('admin/comments');
            }
            catch(Exception $err) {
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/comments');
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
            $entity = $this->doctrine->em->getReference('Entity\Comments', $id);
            $this->doctrine->em->remove($entity);
            $this->doctrine->em->flush();
			
            $this->session->set_flashdata('success', 'comments has been successfully deleted');

            redirect($_SERVER['HTTP_REFERER']);
        }
        catch (Exception $err) {
            $this->session->set_flashdata('warning', 'Error removing comments, try again later.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    



}