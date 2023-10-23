<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_questions');
    }
	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_questions');
		$this->load->view('admin/view_footer');
	}
	
	public function add_question()
	{

		if(strlen($this->input->post('new-question')) !== 0)
		{
			$question = strip_tags($this->input->post('new-question'));
			$survey_id = $this->input->post('survey_id');
			$question_type = $this->input->post('question-type');
			$requeriment = $this->input->post('requeriment');
			$order = $this->Model_questions->get_last_question_order($survey_id);

			if($order == 'no_results')
			{
				$new_order = 1;
			}
			elseif($order == false)
			{
				$new_order = '0';
			}
			else
			{
				$new_order = (int)$order + 1;    
			}

			switch($question_type)
			{
				case "single_text":
				case "comment_box":
					$answer = serialize("");
					$add_question = $this->Model_questions->add_question($question, $survey_id, $new_order, $question_type, $requeriment);
					$add_answer = $this->Model_questions->add_answer($answer, '', 'vertical', $question_type, $add_question);
					break;
				default:
					$add_question = $this->Model_questions->add_question($question, $survey_id, $new_order, $question_type, $requeriment);
					break;
			}

			if(is_int($add_question))
			{
				redirect(base_url().'admin/questions?id='.$survey_id);
				$this->output->set_output('true');
			}
			else
			{
				$this->output->set_output('There are same name you will create question');
			}
		}
		else
		{
			$this->output->set_output('TRIGGER_INFO');
		}
	}


	public function edit_question()
	{
		if (strlen($this->input->post('new-question')) !== 0)
		{
			$new_question = strip_tags($this->input->post('new-question'));
			
			$survey_id = $this->input->post('survey_id');
			
			$id = $this->input->post('id');
			
			$question_type = $this->input->post('question-type');
			
			$requeriment = $this->input->post('requeriment');


			$edit_question = $this->Model_questions->edit_question($new_question, $question_type, $requeriment, $id, $survey_id);
			
			echo $edit_question;
			if ($edit_question == true)
            {
                redirect(base_url().'admin/questions?id=' . $survey_id);
                echo true;    
            } else {
                echo false;   
            }
		} else {
			
			$new_question = ''; // was not modified
			
			$survey_id = $this->input->post('survey_id');
			
			$id = $this->input->post('id');
			
			$question_type = $this->input->post('question-type');
			
			$requeriment = $this->input->post('requeriment');
			
			$edit_question = $this->Model_questions->edit_question($new_question, $question_type, $requeriment, $id, $survey_id);
			redirect(base_url().'admin/questions?id=' . $survey_id);
			echo $edit_question;    
		}
	}

	public function delete_question()
	{
		$id = $this->input->post('id');
		if ($id)
		{
			$survey_id = $this->input->post('survey_id');
			$delete_question = $this->Model_questions->delete_question($id);
			
			if ($delete_question == true)
            {
				redirect(base_url().'admin/questions?id=' . $survey_id);
                echo true;    
            } else {
                echo false;   
            }
			
		} else {
			echo 'TRIGGER_INFO';    
		}
	}


	public function updateRecordsListings() {
		log_message('info', '------------------here-------------');
        $action = $this->input->post('action');
        $updateRecordsArray = $this->input->post('recordsArray');
        
        if ($action == "updateRecordsListings") {
            $this->Model_questions->update_order($updateRecordsArray); // Call the model method to update records
        }
    }
	
}
