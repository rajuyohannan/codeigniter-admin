<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - Estimations Controller
 */

class File extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(1)) {
        	show_error('You do not have access to view this resource', '403');
        }
         $this->load->model('user_model');
    }


    public function index() {

        $data['title'] = "Manage Files";
        $data['content'] = $this->load->view('admin/index', null, true);
    	return $this->load->view('html', $data);
    }


    public function upload() {

        $config['upload_path']   = './uploads/estimations/uploads';
        $config['allowed_types'] = '*';


        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                echo json_encode(array('error' => $error));
        }
        else {
                $data = array('upload_data' => $this->upload->data());

                //Save file entity
                $file = new Entity\Files;
                $file->setFilename($data['upload_data']['file_name']);
                $file->setEntityType('estimations');
                $file->setFilepath($data['upload_data']['file_path']);
                $file->setFilemime($data['upload_data']['file_type']);
                $file->setCreatedOn(date_create(date('Y-m-d H:i:s')));
                $user = $this->doctrine->em->getReference('Entity\Users', $this->auth_user_id);
                $file->setUploadedBy($user);

                $this->doctrine->em->persist($file);
                $this->doctrine->em->flush();

                echo $file->getId();
        }        
    }

}