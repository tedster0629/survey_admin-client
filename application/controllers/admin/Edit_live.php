<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_live extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_edit_live');
    }
	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
        // $data['setting'] = $this->Model_edit_live->get_setting_data();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_edit_live');
		$this->load->view('admin/view_footer');
	}

	public function edit_liveSurvey() {

        if(strlen($this->input->post('title')) !== 0) {
            $save_it = $this->Model_edit_live->edit_liveSurvey($this->input->post());
            echo true;
			redirect(base_url().'admin/launch_survey');
        } else {
            echo 'TRIGGER_INFO';
        }
    }
}
