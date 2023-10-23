<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_dashboard extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_survey_dashboard');
    }

    public function index()
    {
        $userID = $this->session->userdata("mySurvey_userid");
        $data['fullName'] = $this->Model_survey_dashboard->getFullName($userID);
        $data['setting'] = $this->Model_common->get_setting_data();
		$data['chart_data'] = $this->Model_survey_dashboard->render_dashboard_chart_data();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_survey_dashboard',$data);
		$this->load->view('admin/view_footer');
    }

}
