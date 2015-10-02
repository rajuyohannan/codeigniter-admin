<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - User Controller
 */

class Term extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(9)) {
        	show_error('You do not have access to view this resource', '403');
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
            $createdBy = $this->doctrine->em->getReference('Entity\Users', $this->auth_user_id);
            $terms->setCreatedBy($createdBy);
            $terms->setCreatedOn(date_create(date('Y-m-d H:i:s')));

            try {
                //save to database
                $this->doctrine->em->persist($terms);
                $this->doctrine->em->flush();

                $this->session->set_flashdata('success', 'Term has been successfully added.');
                redirect('admin/terms/'.$cid);

            }
            catch(Exception $err) {
                die($err->getMessage());
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/terms/'.$cid);
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
                redirect('admin/terms/'.$term->getCategory()->getId());
            }
            catch(Exception $err) {
                $this->session->set_flashdata('warning', 'Some error occured while saving the values, please try again later.');
                redirect('admin/terms/'.$term->getCategory()->getId());
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