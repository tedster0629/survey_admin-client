<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_settings extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_survey_settings');
    }

    public function index()
    {
        $data['setting'] = $this->Model_common->get_setting_data();
        $data['setting1'] = $this->Model_survey_settings->settings_notice(2,'');
        $data['setting2'] = $this->Model_survey_settings->settings_notice(3,'');
        $data['setting3'] = $this->Model_survey_settings->settings_notice(5,'');
        $data['setting4'] = $this->Model_survey_settings->settings_notice(6,'');
        $data['setting5'] = $this->Model_survey_settings->settings_notice(7,'');
        $data['setting6'] = $this->Model_survey_settings->settings_notice(8,'');
        $data['setting7'] = $this->Model_survey_settings->settings_notice(4, 4);

        log_message('info', '---------value---------' . printf($data['setting5'], true));
        
		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_survey_settings', $data);
		$this->load->view('admin/view_footer');
    }

    public function updateSettings() {

        if (!empty($this->input->post())) {
            $update = $this->Model_survey_settings->update_settings($this->input->post());
            if ($update) {
                echo true;
                redirect(base_url().'admin/survey_settings');
            } else {
                echo false;
            }
        } else {
            echo 'TRIGGER_INFO';
        }
    }

}