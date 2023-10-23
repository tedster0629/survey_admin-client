<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_surveys extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_manage_surveys');
    }

    public function index()
    {        
        
        $data['setting'] = $this->Model_common->get_setting_data();
        $data['survey'] = $this->Model_manage_surveys->listSurveys();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_manage_surveys', $data);
		$this->load->view('admin/view_footer');
    }

    public function get_number_questions($id){
        $data['setting'] = $this->Model_common->get_setting_data();
        $data['survey'] = $this->Model_manage_surveys->listSurveys();
        $data['survey'] = $this->Model_manage_surveys->get_number_of_questions($id);

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_manage_surveys', $data);
		$this->load->view('admin/view_footer');
    }

    public function editSurvey()
    {
        $newSurveyName = $this->input->post('new-survey-name');
        $id = $this->input->post('survey_ID');
        $newSurveyPassword = $this->input->post('new-survey-password');
        if (strlen($newSurveyName) !== 0 || (strlen($newSurveyName) == 0 && strlen($newSurveyPassword) !== 0))
        {
            if (strlen($newSurveyPassword) == 0)
            {
                $newSurveyPassword = 'NULL';
            }

            $editSurvey = $this->Model_manage_surveys->editSurvey($newSurveyName, $newSurveyPassword, $id);

            if ($editSurvey)
            {
                redirect(base_url().'admin/manage_surveys');
                echo true;
            }
            else
            {
                
                echo "false";
                redirect(base_url().'admin/survey_dashboard');
            }
        }
        else
        {
            echo 'You have to input correctly';
        }
    }

    public function delete_survey()
    {
        $id = $this->input->post('survey_ID');
        if ($id)
        {

            $delete_survey = $this->Model_manage_surveys->delete_survey($id);
            
            if ($delete_survey == true)
            {
                redirect(base_url().'admin/manage_surveys');
                echo true;    
            } else {
                echo false;   
            }
            
        } else {
            echo 'TRIGGER_INFO';    
        }
    }
}
