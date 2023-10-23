<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_answers extends CI_Model 
{
    public function get_questions_info($id, $info)
    {
        $sanitized_id = intval($id);

        if ($sanitized_id !== 0)
        {
            $result = $this->db->query(sprintf("SELECT survey_id, questions, question_type FROM tbl_questions WHERE id = '%d'", $sanitized_id));

            if ($result->num_rows() !== 0)
            {
                $survey = $result->row_array();
                if ($info == 'questions')
                {
                    return $survey['questions'];
                }
                elseif ($info == 'question_type')
                {
                    return $survey['question_type'];
                }
                elseif ($info == 'survey_id')
                {
                    return $survey['survey_id'];
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function answer_exists($id)
    {
        $query = sprintf("SELECT question_id FROM tbl_answers WHERE question_id = '%d'", $this->db->escape_str($id));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function listAnswer($id, $select)
    {
        $this->db->select($select);
        $this->db->from('tbl_answers');
        $this->db->where('question_id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function add_answer($answer, $css_class, $position, $question_type, $question_id) {
        $data = array(
            'answer' => $answer,
            'question_id' => $question_id,
            'question_type' => $question_type,
            'css' => htmlentities($css_class, ENT_QUOTES, 'UTF-8'),
            'position' => $position
        );

        $u = $this->db->insert('tbl_answers', $data);
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function add_answer_add($question_id, $question_type, $radio, $rule, $n_err_message, $val_number, $sid) {
        $data = array(
            'question_id' => $question_id,
            'question_type' => $question_type,
            'radio' => $radio,
            'rule' => $rule,
            'condition' => $val_number,
            'message' => $n_err_message, 
            'survey_id' => $sid
        );

        $u = $this->db->insert('tbl_answers_add', $data);
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function add_answer_add_update($question_id, $question_type, $radio, $rule, $n_err_message, $val_number, $sid) {
        $data = array(
            'question_id' => $question_id,
            'question_type' => $question_type,
            'radio' => $radio,
            'rule' => $rule,
            'condition' => $val_number,
            'message' => $n_err_message, 
            'survey_id' => $sid
        );
        $this->db->where('question_id', $question_id);
        $this->db->update('tbl_answers_add', $data);
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function update_answer($answer, $css_class, $position, $question_type, $question_id) {
        $data = array(
            'answer' => $answer,
            'question_type' => $question_type,
            'css' => htmlentities($css_class, ENT_QUOTES, 'UTF-8'),
            'position' => $position
        );
        $this->db->where('question_id', $question_id);
        $this->db->update('tbl_answers', $data);
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_survey_id($id)
    {
        $result = $this->db->query("SELECT survey_id FROM tbl_questions WHERE id = '$id'");
        return $result->result_array();
    }
}