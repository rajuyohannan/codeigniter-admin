<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - User Controller
 */

class Category extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(9)) {
        	show_error('You do not have access to view this resource', '403');
        }
    }

    /**
     * [manage description]
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function manage($page = 1) {


        $em = $this->doctrine->em;
        $where = array();

        if ($this->input->get('title')) {
            $where['title'] = $this->input->get('title');
        }

        $this->load->library('pagination');
        $config = $this->config->load('pagination', TRUE);

        $view['categories'] = $em->getRepository('Entity\Categories')->findBy($where, array('title' => 'ASC'), $config['per_page'], ($page - 1) * $config['per_page']);

        $categories = $em->getRepository('Entity\Categories')->findBy($where, array('title' => 'ASC'));

        $config['base_url'] = base_url('admin/categories/manage');
        $config['total_rows'] = count($categories);
        $config['first_url'] = base_url('admin/categories/manage') . '?'. http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);

    	$data['title'] = 'Manage Categories';
    	
    	$data['content'] = $this->load->view('admin/manage_categories', $view, TRUE);
    	return $this->load->view('html', $data);
    }

    /**
     * [add description]
     */
    public function add() {
    	$data['title'] = 'Add Category';

        //Validations
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        
        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/add_category', NULL, TRUE);
        }
        else {
            //Save categories
            $category = new Entity\Categories();

            $category->setTitle($this->input->post('title'));
            $category->setDescription($this->input->post('description'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $category->setStatus($status);
            $category->setCreatedBy($this->auth_user_id);
            $category->setCreatedOn(date_create(date('Y-m-d H:i:s')));

            try {
                //save to database
                $this->doctrine->em->persist($category);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'Category has been successfully added.');
                redirect('admin/categories/manage');

            }
            catch(Exception $err) {
                die($err->getMessage());
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/categories/manage');
            }
        }
    	return $this->load->view('html', $data);
    }


    public function edit($cid) {

        $view['category'] = $category = $this->doctrine->em->getRepository('Entity\Categories')
            ->findOneBy(array('id' => $cid));

        //Validations
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        
        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/edit_category', $view, TRUE);
        }
        else {
            //Update category
            $category->setTitle($this->input->post('title'));
            $category->setDescription($this->input->post('description'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $category->setStatus($status);

            try {
                $this->doctrine->em->persist($category);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'Category has been successfully updated.');
                redirect('admin/categories/manage');
            }
            catch(Exception $err) {
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/categories/manage');
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
            $entity = $this->doctrine->em->getReference('Entity\Categories', $id);
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

    /**
     * [terms description]
     * @param  [type] $cid [description]
     * @return [type]      [description]
     */
    public function terms($cid) {

        $category = $this->doctrine->em->getRepository('Entity\Categories')
            ->findOneBy(array('id' => $cid));

        $view['terms'] = $this->doctrine->em->getRepository('Entity\Terms')
            ->findBy(array('category' => $cid), array('weight' => 'ASC'));


        $data['title'] = "Manage Terms";
        $view['title'] = $category->getTitle();
        $view['cid']   = $category->getId();
        $data['content'] = $this->load->view('admin/manage_terms', $view, TRUE);
        return $this->load->view('html', $data);
    }

    /**
     * [add_term description]
     * @param [type] $cid [description]
     */
    public function add_term($cid) {

        $category = $this->doctrine->em->getRepository('Entity\Categories')
            ->findOneBy(array('id' => $cid));


        //validations
        $this->form_validation->set_rules('title', 'Term name', 'trim|required');
        
        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/add_term', NULL, TRUE);
        }
        else {
            //Save Terms
            $terms = new Entity\Terms();

            $terms->setTitle($this->input->post('title'));
            $terms->setDescription($this->input->post('description'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $terms->setStatus($status);
            
            //Get weights
            $dql = "SELECT MAX(t.weight) AS weight FROM Entity\Terms t " .
                   "WHERE t.category = ?1";

            $weight = $this->doctrine->em->createQuery($dql)
                           ->setParameter(1, $cid)
                           ->getSingleScalarResult();

            $terms->setWeight($weight + 1);
            $terms->setCategory($category);
            $terms->setCreatedBy($this->auth_user_id);
            $terms->setCreatedOn(date_create(date('Y-m-d H:i:s')));

            try {
                //save to database
                $this->doctrine->em->persist($terms);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'Term has been successfully added.');
                redirect('admin/categories/terms/'.$cid);

            }
            catch(Exception $err) {
                die($err->getMessage());
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/categories/terms/'.$cid);
            }
        }

        $data['title'] = "Add Term";
        $view['title'] = $category->getTitle();
        $view['cid']   = $category->getId();
        $data['content'] = $this->load->view('admin/add_term', $view, TRUE);
        return $this->load->view('html', $data);
    }

    /**
     * [edit_term description]
     * @param  [type] $tid [description]
     * @return [type]      [description]
     */
    public function edit_term($tid) {
        
        $view['term'] = $term = $this->doctrine->em->getRepository('Entity\Terms')
            ->findOneBy(array('id' => $tid));

        //Validations
        $this->form_validation->set_rules('title', 'Term name', 'trim|required');
        
        if (!$this->form_validation->run()) {
            $data['content'] = $this->load->view('admin/edit_term', $view, TRUE);
        }
        else {
            //Update terms
            $term->setTitle($this->input->post('title'));
            $term->setDescription($this->input->post('description'));
            $status = $this->input->post('status') ? $this->input->post('status') : '0';
            $term->setStatus($status);

            try {
                $this->doctrine->em->persist($term);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'Term has been successfully updated.');
                redirect('admin/categories/terms/'.$term->getCategory()->getId());
            }
            catch(Exception $err) {
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/categories/terms/'.$term->getCategory()->getId());
            }
        }

        $data['title'] = 'Edit Terms';
        return $this->load->view('html', $data);
    }
    
    /**
     * [delete_term description]
     * @param  [type] $tid [description]
     * @return [type]      [description]
     */
    public function delete_term($tid) {
        try {
            $entity = $this->doctrine->em->getReference('Entity\Terms', $tid);


            $this->doctrine->em->remove($entity);
            $this->doctrine->em->flush();
            $this->session->set_flashdata('success', 'Term has been successfully deleted');

            redirect($_SERVER['HTTP_REFERER']);
        }
        catch (Exception $err) {
            //echo "<pre>";
            //print_r($err);
            $this->session->set_flashdata('warning', 'Error removing term, try again later.<br/>'.$err->getMessage());
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

}