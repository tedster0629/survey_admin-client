<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_questions extends CI_Model 
{
    public function get_survey_info($id, $info)
    {
        $sanitized_id = $this->sanitize_integer($id);
    
        if ($sanitized_id !== false) {
            $query = $this->db->select('name, password')
                ->from('tbl_survey')
                ->where('id', $sanitized_id)
                ->get();
    
            if ($query->num_rows() !== 0) {
                $survey = $query->row_array();
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
        $ip = $this->get_client_ip();

        $query = $this->db->select('IP')
            ->from('tbl_took_survey')
            ->where('survey_id', $id)
            ->where('IP', $ip)
            ->get();

        if ($query->num_rows() > 0) {
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
    public function listQuestions($id)
    {
        $query = $this->db->select('tbl_questions.id as question_ID, tbl_questions.survey_id, tbl_questions.questions, tbl_questions.order, tbl_questions.question_type, tbl_questions.requeriment')
            ->from('tbl_questions')
            ->where('survey_id', $id)
            ->order_by('tbl_questions.id', 'DESC')
            ->get();
        // log_message('info', '--------------------------------------'. print_r($query->result(), true));
        return $query->result();
    }

    public function answer_exists($id)
    {
        $query = $this->db->select('question_id')
            ->from('tbl_answers')
            ->where('question_id', $id)
            ->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function render_question_requeriment($id, $text_a, $text_b)
    {
        $id = $this->db->escape_str($this->sanitize_integer($id));

        $query = $this->db->query("SELECT requeriment FROM tbl_questions WHERE survey_id = $id");
        $row = $query->row();
        $result_set = $row->requeriment;

        if ($result_set == 0 || $result_set == '0') {
            $render = '
                <label class="radio inline" style = "margin-right : 30px">
                <input type="radio" name="requeriment" checked="checked" value="0"> '.$text_a.'
                </label>
                <label class="radio inline">
                <input type="radio" name="requeriment" value="1"> '.$text_b.'
                </label>
                ';
        } else {
            $render = '
                <label class="radio inline">
                <input type="radio" name="requeriment" value="0"> '.$text_a.'
                </label>
                <label class="radio inline">
                <input type="radio" name="requeriment" checked="checked" value="1"> '.$text_b.'
                </label>
                ';
        }

        return $render;
    }
    public function render_question_types_selects()
    {
        $buffer = '';
        foreach ($this->question_types as $qk => $qn) {
            $buffer .= '<option value="' . $qk . '">' . $qn . '</option>';
        }
        return $buffer;
    }

    public function listSortableQuestions($id)
    {
        $this->db->select('tbl_questions.id as question_ID, tbl_questions.survey_id, tbl_questions.questions, tbl_questions.order, tbl_questions.question_type');
        $this->db->from('tbl_questions');
        $this->db->where('survey_id', $id);
        $this->db->order_by('tbl_questions.order', 'ASC');
        $result = $this->db->get();
        return $result->result();
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

    public function get_last_question_order($survey_id)
    {
        $sanitized_id = $this->sanitize_integer($survey_id);

        if($sanitized_id !== false)
        {
            $this->db->select('tbl_questions.order');
            $this->db->from('tbl_questions');
            $this->db->where('survey_id', $sanitized_id);
            $this->db->order_by('tbl_questions.order', 'DESC');
            $this->db->limit(1);
            $result = $this->db->get();

            if($result->num_rows() !== 0)
            {
                $res = $result->row_array();
                return $res['order']; // last question added with order x
            }
            else
            {
                return 'no_results'; // first question of the survey with order 1
            }
        }
        else
        {
            return false;
        }
    }

    public function add_question($question, $survey_id, $torder, $question_type, $requeriment)
	{
		// Avoid duplicated questions
		$check_query = $this->db->get_where('tbl_questions', array(
			'questions' => $question,
			'question_type' => $question_type,
			'survey_id' => $survey_id
		));

		if($check_query->num_rows() == 1)
		{
			return false; // Possible duplication
		}

		$data = array(
			'survey_id' => $survey_id,
			'questions' => htmlentities($question, ENT_QUOTES, 'UTF-8'),
			'order' => $torder,
			'question_type' => htmlentities($question_type, ENT_QUOTES, 'UTF-8'),
			'requeriment' => $requeriment
		);

		$this->db->insert('tbl_questions', $data);

		if($this->db->affected_rows() == 1)
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	public function add_answer($answer, $css_class, $position, $question_type, $question_id)
	{
		$data = array(
			'answer' => $answer,
			'question_id' => $question_id,
			'question_type' => $question_type,
			'css' => htmlentities($css_class, ENT_QUOTES, 'UTF-8'),
			'position' => $position
		);

		$this->db->insert('tbl_answers', $data);

		if($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

    function yesNo($bool)
	{
		if($bool)
		{
			return 'Yes';
		} else {
			return 'No';
		}
	}

    public function edit_question($new_question, $question_type, $requeriment, $id, $survey_id)
    { 
        if (strlen($new_question) !== 0 && !empty($new_question))
        {
            $query = "UPDATE tbl_questions
                        SET 
                            survey_id = ?,
                            questions = ?,
                            question_type = ?,
                            requeriment = ?
                        WHERE
                            id = ?";
            
            $params = array(
                $survey_id,
                html_escape($new_question),
                $question_type,
                $requeriment,
                $id
            );
        } else {
            $query = "UPDATE tbl_questions
                        SET 
                            survey_id = ?,
                            question_type = ?,
                            requeriment = ?
                        WHERE
                            id = ?";
            
            $params = array(
                $survey_id,
                $question_type,
                $requeriment,
                $id
            );
        }
        
        $this->db->query($query, $params);
        
        if ($this->db->affected_rows() == 1)
        {
            return true;
        } else {
            return false;
        }
    }

    public function delete_question($id)
    {
        // Before deleting results and answers find the questions related to results and answers
        $query_s = sprintf("SELECT id FROM tbl_questions 
                    WHERE 
                        id = '%d'
        ",
                        $id
        );
        
        $res = $this->db->query($query_s);
        
        // Process $res
        $result_set = $res->result_array();
        
        if ($res->num_rows() !== 0)
        {
            foreach ($result_set as $r)
            {   
                $query_1 = $this->db->query(sprintf("DELETE FROM tbl_results WHERE question_id = '%d'", $r['id']));
                $query_2 = $this->db->query(sprintf("DELETE FROM tbl_answers WHERE question_id = '%d'", $r['id']));
                $query_3 = $this->db->query(sprintf("DELETE FROM tbl_answers_add WHERE question_id = '$id'"));
            }
            
        }
        
        // Delete Questions of the survey
        $query = sprintf("DELETE FROM tbl_questions
                                WHERE
                                    id = '%d'
                ",
                                $id
                );
        
        $this->db->query($query);
        
        return true;
    }

    public function update_order($updateRecordsArray) {
        $listingCounter = 1;
        foreach ($updateRecordsArray as $recordIDValue) {
            $data = array(
                'order' => $listingCounter
            );
            $this->db->where('id', $recordIDValue);
            $this->db->update('tbl_questions', $data);
            $listingCounter++;
        }
    }
}