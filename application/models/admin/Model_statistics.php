<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_statistics extends CI_Model 
{
    public function get_survey_info($id, $info)
    {
        $sanitized_id = $this->sanitize_integer($id);

        if ($sanitized_id !== false) {
            $this->db->select('name, password');
            $this->db->from('tbl_survey');
            $this->db->where('id', $sanitized_id);
            $result = $this->db->get();

            if ($result->num_rows() !== 0) {
                $survey = $result->row_array();
                if ($info == 'name') {
                    return $survey['name'];
                } elseif ($info == 'password') {
                    return $survey['password'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function sanitize_integer($get_id)
    {
        // clean it
        $sanitize = strip_tags($get_id);
        $sanitize = str_replace("'","", $sanitize);
        $sanitize = str_replace('"', "", $sanitize);
        
        $sanitize = (int) $sanitize;
        
        if(is_int($sanitize))
        {
            return $sanitize;
        }
        
        // return all data before a space
        $sanitize = substr($sanitize, 0, strpos($sanitize, ' '));
        
        // get only the numbers
        preg_match("/^\d+$/", $sanitize, $matches);	
        
        if(!empty($matches['0']))
        {
            return $matches['0'];	
        }
    }
    public function check_reset_admin_IP($id)
    {
        $id = $this->sanitize_integer($id);
        $this->db->select('IP');
        $this->db->from('tbl_took_survey');
        $this->db->where('survey_id', $id);
        $this->db->where('IP', $this->get_client_ip());
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_client_ip()
    {
        $ip_address = '';

        if ($this->input->server('HTTP_CLIENT_IP')) {
            $ip_address = $this->input->server('HTTP_CLIENT_IP');
        } elseif ($this->input->server('HTTP_X_FORWARDED_FOR')) {
            $ip_address = $this->input->server('HTTP_X_FORWARDED_FOR');
        } elseif ($this->input->server('HTTP_X_FORWARDED')) {
            $ip_address = $this->input->server('HTTP_X_FORWARDED');
        } else {
            $ip_address = $this->input->server('REMOTE_ADDR');
        }

        return $ip_address;
    }
    public function counts($what, $id = '')
    {
        $id = $this->sanitize_integer($id);

        switch ($what) {
            case "Surveys":
                $this->db->select('id');
                $this->db->from('tbl_survey');
                $result = $this->db->get();
                return $result->num_rows();
                break;

            case "Took_Survey":
                $this->db->select('id');
                $this->db->from('tbl_took_survey');
                $this->db->where('survey_id', $id);
                $this->db->group_by('IP');
                $result = $this->db->get();
                return $result->num_rows();
                break;

            case "Questions":
                $this->db->select('id');
                $this->db->from('tbl_questions');
                $result = $this->db->get();
                return $result->num_rows();
                break;

            case "Answers":
                $this->db->select('id');
                $this->db->from('tbl_results');
                $this->db->where('survey_id', $id);
                $result = $this->db->get();
                return $result->num_rows();
                break;

            case "All_Answers":
                $this->db->select('id');
                $this->db->from('tbl_results');
                $result = $this->db->get();
                return $result->num_rows();
                break;
        }
    }

    public function get_number_of_questions($id)
    {
        $id = $this->sanitize_integer($id);

        $this->db->select('survey_id');
        $this->db->from('tbl_questions');
        $this->db->where('survey_id', $id);
        $result = $this->db->get();

        return $result->num_rows();
    }

    public function listQuestions($id)
    {
        $id = $this->sanitize_integer($id);

        $this->db->select('tbl_questions.id as question_ID, tbl_questions.survey_id, tbl_questions.questions, tbl_questions.order, tbl_questions.question_type, tbl_questions.requeriment');
        $this->db->from('tbl_questions');
        $this->db->where('survey_id', $id);
        $this->db->order_by('tbl_questions.id', 'DESC');
        $result = $this->db->get();

        return $result->result_array();
    }

    public function results_exists($id)
    {
        $id = $this->sanitize_integer($id);
        $this->db->select('question_id');
        $this->db->from('tbl_results');
        $this->db->where('question_id', $id);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public $question_types = array(
        'yes_no' => 'Yes / No',
        'radio' => 'Radio',
        'multiple_choice' => 'Multiple Choice',
        'dropdown_menu' => 'Drop Down Menu',
        'matrix_single' => 'Matrix Single',
        'matrix_multi_select' => 'Matrix Multi Select',
        'single_text' => 'Single Text',
        'comment_box' => 'Comment Box',
        'short_answer' => 'Short answer',
        'paragraph' => 'Paragraph',
        'file_upload' => 'File upload',
        'date' => 'Date',
        'rating' => 'Rating',
    );
}