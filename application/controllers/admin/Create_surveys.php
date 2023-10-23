<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_surveys extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_create_surveys');
    }

    public function index()
    {

        $data['setting'] = $this->Model_common->get_setting_data();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_create_surveys');
		$this->load->view('admin/view_footer');
    }

    public function create_survey() {
		
		$name = $this->input->post('survey-name');
		if ($name) {
			$password = $this->input->post('survey-password');
			if ($password == '') {
				$password = NULL;
			}
			
			$create_survey = $this->Model_create_surveys->create_survey($name, $password);
			
			if ($create_survey) {
                redirect(base_url().'admin/manage_surveys');
			} else {
				echo false;
			}
		} else {
			echo 'TRIGGER_INFO';
		}
    }

}
