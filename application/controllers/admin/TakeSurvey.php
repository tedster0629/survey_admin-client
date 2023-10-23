<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TakeSurvey extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_common');
        // $this->load->model('admin/Model_surveys_statistics');
        // $this->load->model('admin/Model_takeSurvey');
    }

    public function index()
    {        
        // $data['setting'] = $this->Model_common->get_setting_data();
        // $data['survey'] = $this->Model_manage_surveys->listSurveys();

		// $this->load->view('admin/view_header',$data);
        // $this->load->view('admin/view_takeSurvey', $data);
		// $this->load->view('admin/view_footer');
    }
}