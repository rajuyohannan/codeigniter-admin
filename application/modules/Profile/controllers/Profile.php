<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * PMS - User Controller
 */

class Profile extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        if (!$this->require_min_level(1)) {
        	show_error('You are not authorized to access this page.', '403');
        }
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    function index($id = null) {

        $this->load->helper('smiley');
        $this->load->library('table');

        $image_array = get_clickable_smileys(base_url('assets/plugins/emojione/'), 'comments');
        $smileys['smiley_table'] = $this->table->make_columns($image_array, 12);

    	$data['title']   = "My Profile";
    	$data['content'] = $this->load->view('profile', $smileys, true);
    	$this->load->view('html', $data);
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    function create() {

    }

    /**
     * [store description]
     * @return [type] [description]
     */
    function store() {

    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function show($id) {

    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function edit($id) {

    }

    /**
     * [update description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function update($id) {

    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function destroy($id) {

    }

    function upload() {
        echo "Success";
    }
}