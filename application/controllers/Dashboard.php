<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $is_logged = $this->session->userdata('is_logged');
        if (!(isset($is_logged) && $is_logged == TRUE))
        {
            redirect('login/index');
        }
    }

    public function index()
    {   
        $data['dynamic_view'] = 'admin/dashboard_view';
        $this->load->view('admin/main_template', $data);
    }

}