<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Answers extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_answers');
    }

	public function index() {
		$data['setting'] = $this->Model_common->get_setting_data();
		// $data['survey'] = $this->Model_answers->get_questions_info();
		// $data['survey'] = $this->Model_answers->answer_exists();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_answers');
		$this->load->view('admin/view_footer');
	}

	public function add_answer() {

        $css_class = $this->input->post('css_class');
        $position = $this->input->post('position');
        $question_id = $this->input->post('q_id');
        $question_type = $this->input->post('question_type');
        $radio = $this->input->post('group');
        $sid = $this->Model_answers->get_survey_id($question_id);
        $sid = $sid[0]["survey_id"];

        switch ($question_type) {
            // Case Yes / No
            case "yes_no":
                $yes = ($this->input->post('answer_yes') !== '') ? $this->input->post('answer_yes') : 'Yes';
                $no = ($this->input->post('answer_no') !== '') ? $this->input->post('answer_no') : 'No';
                $answer_ = $yes . ',' . $no;
                $answer = serialize($answer_);
                $add_answer = $this->Model_answers->add_answer($answer, $css_class, $position, $question_type, $question_id);
                
                if ($add_answer) {
					// redirect(base_url().'admin/manage_surveys');
                    echo true;
                } else {
                    echo false;
                }
                break;
            // Case Radio/Multi-choice/Dropdown_menu
            case "radio":
            case "multiple_choice":
            case "dropdown_menu":
                $answer_box = $this->input->post('answer_box');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->add_answer($answer, $css_class, $position, $question_type, $question_id);
                    if ($add_answer) {
                        // redirect(base_url().'admin/manage_surveys');
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;
            // Case Matrix Single/Matrix Multi Select
            case "matrix_single":
            case "matrix_multi_select":
                $matrix_rows = $this->input->post('matrix_rows');
                $matrix_headers = $this->input->post('matrix_headers');
                if ($matrix_rows !== '' && $matrix_headers !== '') {
                    $answer = array('rows' => $matrix_rows, 'headers' => $matrix_headers);
                    $answer = serialize($answer);
                    $add_answer = $this->Model_answers->add_answer($answer, $css_class, $position, $question_type, $question_id);
                    if ($add_answer) {
                        // redirect(base_url().'admin/manage_surveys');
                        echo true;
                    } else {
                        
                        echo false;
                    }
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;
            // Case Input and Textarea
            case "single_text":
            case "comment_box":
                $answer = serialize("");
                $add_answer = $this->Model_answers->add_answer($answer, $css_class, $position, $question_type, $question_id);
                if ($add_answer) {
                    // redirect(base_url().'admin/manage_surveys');
                    echo true;
                } else {
                    echo false;
                }
                break;

            case "short_answer":
                $answer_box = $this->input->post('short_answer');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->add_answer($answer, $css_class, $position, $question_type, $question_id);
                    if ($add_answer) {
                        // redirect(base_url().'admin/manage_surveys');
                        if(isset($radio)){
                            switch($radio){
                                case "number" :
                                    $rule = $this->input->post('n_rule');
                                    $val_number = $this->input->post('val_number');
                                    $n_err_message = $this->input->post('n_err_message');
                                    $this->Model_answers->add_answer_add($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                    break;
                                case "text" : 
                                    $rule = $this->input->post('t_rule');
                                    $val_number = $this->input->post('val_text');
                                    $n_err_message = $this->input->post('t_err_message');
                                    $this->Model_answers->add_answer_add($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                    break;
                                case "length" : 
                                    $rule = $this->input->post('l_rule');
                                    $val_number = $this->input->post('val_l_number');
                                    $n_err_message = $this->input->post('l_err_message');
                                    $this->Model_answers->add_answer_add($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                    break;
                                case "regular_expression" :
                                    $rule = $this->input->post('r_rule');
                                    $val_number = $this->input->post('pattern');
                                    $n_err_message = $this->input->post('r_err_message');
                                    $this->Model_answers->add_answer_add($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                    break;
                            }
                        }
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;
            case "paragraph":
                $answer_box = $this->input->post('paragraph');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->add_answer($answer, $css_class, $position, $question_type, $question_id);
                    if ($add_answer) {
                        // redirect(base_url().'admin/manage_surveys');
                        if(isset($radio)){
                            switch($radio){
                                case "length" : 
                                    $rule = $this->input->post('l_rule');
                                    $val_number = $this->input->post('val_l_number');
                                    $n_err_message = $this->input->post('l_err_message');
                                    $this->Model_answers->add_answer_add($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                    break;
                                case "regular_expression" :
                                    $rule = $this->input->post('r_rule');
                                    $val_number = $this->input->post('pattern');
                                    $n_err_message = $this->input->post('r_err_message');
                                    $this->Model_answers->add_answer_add($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                    break;
                            }
                        }
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;

            case "date":
                $answer_box = $this->input->post('date');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->add_answer($answer, $css_class, $position, $question_type, $question_id);
                    if ($add_answer) {
                        // redirect(base_url().'admin/manage_surveys');
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;

            case "file_upload":
                $answer_box = $this->input->post('file_upload');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->add_answer($answer, $css_class, $position, $question_type, $question_id);
                    if ($add_answer) {
                        // redirect(base_url().'admin/manage_surveys');
                        $radio = "";
                        $rule = $this->input->post('rule');
                        $val_number = "";
                        $n_err_message = "";
                        $this->Model_answers->add_answer_add($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;

            case "rating":
                $answer_box = $this->input->post('rating');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->add_answer($answer, $css_class, $position, $question_type, $question_id);
                    if ($add_answer) {
                        // redirect(base_url().'admin/manage_surveys');
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;


            default:
                echo false;
                break;

                
        }
    }

    public function update_answer() {

        $css_class = $this->input->post('css_class');
        $position = $this->input->post('position');
        $question_id = $this->input->post('q_id');
        $question_type = $this->input->post('question_type');
        $radio = $this->input->post('group');
        $sid = $this->Model_answers->get_survey_id($question_id);
        $sid = $sid[0]["survey_id"];
        switch ($question_type) {
            case "yes_no":
                $yes = $this->input->post('answer_yes') ?: 'Yes';
                $no = $this->input->post('answer_no') ?: 'No';
                $answer_ = $yes . ',' . $no;
                $answer = serialize($answer_);
                $update_answer = $this->Model_answers->update_answer($answer, $css_class, $position, $question_type, $question_id);
                echo $update_answer ? 'true' : 'false';
                break;
            case "radio":
            case "multiple_choice":
            case "dropdown_menu":
                $answer_box = $this->input->post('answer_box');
                if (strlen($answer_box) !== 0) {
                    $answer = serialize($answer_box);
                    $update_answer = $this->Model_answers->update_answer($answer, $css_class, $position, $question_type, $question_id);
                    echo $update_answer ? 'true' : 'false';
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;
            case "matrix_single":
            case "matrix_multi_select":
                $matrix_rows = $this->input->post('matrix_rows');
                $matrix_headers = $this->input->post('matrix_headers');
                if (strlen($matrix_rows) !== 0 && strlen($matrix_headers) !== 0) {
                    $answer = serialize(array('rows' => $matrix_rows, 'headers' => $matrix_headers));
                    $update_answer = $this->Model_answers->update_answer($answer, $css_class, $position, $question_type, $question_id);
                    echo $update_answer ? 'true' : 'false';
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;
            case "single_text":
            case "comment_box":
                $answer = serialize("");
                $update_answer = $this->Model_answers->update_answer($answer, $css_class, $position, $question_type, $question_id);
                echo $update_answer ? 'true' : 'false';
                break;
            default:
                echo 'false';
                break;

            case "short_answer":
                $answer_box = $this->input->post('short_answer');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->update_answer($answer, $css_class, $position, $question_type, $question_id);
                        // redirect(base_url().'admin/manage_surveys');
                    if(isset($radio)){
                        switch($radio){
                            case "number" :
                                $rule = $this->input->post('n_rule');
                                $val_number = $this->input->post('val_number');
                                $n_err_message = $this->input->post('n_err_message');
                                $this->Model_answers->add_answer_add_update($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                break;
                            case "text" : 
                                $rule = $this->input->post('t_rule');
                                $val_number = $this->input->post('val_text');
                                $n_err_message = $this->input->post('t_err_message');
                                $this->Model_answers->add_answer_add_update($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                break;
                            case "length" : 
                                $rule = $this->input->post('l_rule');
                                $val_number = $this->input->post('val_l_number');
                                $n_err_message = $this->input->post('l_err_message');
                                $this->Model_answers->add_answer_add_update($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                break;
                            case "regular_expression" :
                                $rule = $this->input->post('r_rule');
                                $val_number = $this->input->post('pattern');
                                $n_err_message = $this->input->post('r_err_message');
                                $this->Model_answers->add_answer_add_update($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                break;
                        }
                    }
                    echo true;

                } else {
                    echo 'TRIGGER_INFO';
                }
                break;
            case "paragraph":
                $answer_box = $this->input->post('paragraph');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->update_answer($answer, $css_class, $position, $question_type, $question_id);
                        // redirect(base_url().'admin/manage_surveys');
                    if(isset($radio)){
                        switch($radio){
                            case "length" : 
                                $rule = $this->input->post('l_rule');
                                $val_number = $this->input->post('val_l_number');
                                $n_err_message = $this->input->post('l_err_message');
                                $this->Model_answers->add_answer_add_update($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                break;
                            case "regular_expression" :
                                $rule = $this->input->post('r_rule');
                                $val_number = $this->input->post('pattern');
                                $n_err_message = $this->input->post('r_err_message');
                                $this->Model_answers->add_answer_add_update($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                                break;
                        }
                    }
                    echo true;

                } else {
                    echo 'TRIGGER_INFO';
                }
                break;

            case "date":
                $answer_box = $this->input->post('date');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->update_answer($answer, $css_class, $position, $question_type, $question_id);
                    if ($add_answer) {
                        // redirect(base_url().'admin/manage_surveys');
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;

            case "file_upload":
                $answer_box = $this->input->post('file_upload');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->update_answer($answer, $css_class, $position, $question_type, $question_id);
                    $radio = "";
                    $rule = $this->input->post('rule');
                    $val_number = "";
                    $n_err_message = "";
                    $this->Model_answers->add_answer_add_update($question_id, $answer_box, $radio, $rule, $n_err_message, $val_number, $sid);
                    if ($add_answer) {
                        // redirect(base_url().'admin/manage_surveys');
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;

            case "rating":
                $answer_box = $this->input->post('rating');
                if ($answer_box !== '') {
                    $answer = serialize($answer_box);
                    $add_answer = $this->Model_answers->update_answer($answer, $css_class, $position, $question_type, $question_id);
                    if ($add_answer) {
                        // redirect(base_url().'admin/manage_surveys');
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'TRIGGER_INFO';
                }
                break;
        }
    }
	
}