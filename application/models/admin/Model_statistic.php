<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_statistic extends CI_Model 
{
    public function chart_data($qid, $qtype)
    {
        $query = $this->db->query("SELECT answer, COUNT(*) as qtd FROM tbl_results WHERE question_type = ? AND question_id = ? GROUP BY answer", array($qtype, $qid));
        $rows = $query->result_array();
        return $rows;
    }
    public function find_question_type($qid)
    {

        $query = $this->db->query("SELECT question_type FROM tbl_results WHERE question_id = ?", array($qid));
        $row = $query->row_array();
        $len = is_null($row) ? 0 : (is_array($row['question_type']) ? count($row['question_type']) : 0);
        return $len;
    }

    public function array_values_recursive($ary)
    {
        $lst = array();
        foreach (array_keys($ary) as $k) 
        {
            $v = $ary[$k];
            if (is_scalar($v)) 
            {
                $lst[] = $v;
            } elseif (is_array($v)) {
                $lst = array_merge($lst, $this->array_values_recursive($v));
            }
        }
        return $lst;
    }

    public function get_questions_info($id, $info)
    {
        $sanitized_id = $this->db->escape_str($id);
        
        if ($sanitized_id !== false)
        {
            $query = $this->db->query("SELECT survey_id, questions, question_type FROM tbl_questions WHERE id = ?", array($sanitized_id));
            
            if ($query->num_rows() !== 0)
            {
                $survey = $query->row_array();
                if ($info == 'questions')
                {
                    return $survey['questions'];
                } elseif ($info == 'question_type') {
                    return $survey['question_type'];    
                } elseif ($info == 'survey_id') {
                    return $survey['survey_id'];
                }                       
            } else {
                return false;    
            }
        } else {
            return false;    
        }   
    }

    public function get_number_of_answers($id)
    {
        $sanitized_id = $this->db->escape_str($this->sanitize_integer($id));
        $query = $this->db->query("SELECT question_id FROM tbl_results WHERE question_id = ?", array($sanitized_id));
        return $query->num_rows();
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
    public function get_most_user_location($qid)
    {
        $query = $this->db->query("SELECT IP, COUNT(*) as couted FROM tbl_results WHERE question_id = ? GROUP BY IP DESC LIMIT 1", array($qid));
        $rows = $query->row_array();
        return $rows['IP'];
    }

    public function get_answer_rate($qid)
    {
        $query = $this->db->query("SELECT COUNT(question_id) AS cnt FROM tbl_results WHERE question_id = ? GROUP BY question_id HAVING(cnt>1)", array($qid));
        $rows = $query->row_array();

        if ($query->num_rows() == 1)
        {
            $answers = $this->counts('All_Answers');
            $rate_count = (int)$rows['cnt'];
            $rate = $rate_count / $answers;
            $rate = round($rate, 2)*100;

            if ($rate == 0)
            {
                return 0;
            } else {
                return $rate.'%';    
            }   
        } else {
            return 0;   
        }
    }
    public function render_pie_chart($qid, $qtype) {
        $rows = $this->chart_data($qid, $qtype);
        switch($qtype) {
            case "yes_no":
            case "radio":
            case "multiple_choice":
            case "dropdown_menu":
            case "matrix_single":
            case "matrix_multi_select":
                $res = '';
                foreach($rows as $v) {
                    $res .= '{ label: "'.$v['answer'].'", data: '.$v['qtd'].'},';
                }
                return rtrim($res,',');
                break;
        }
    }

    public function counts($what, $id = '')
{
    $id = $this->db->escape_str($this->sanitize_integer($id));
    switch ($what) {
        case "Surveys":
            $query = $this->db->get('tbl_survey');
            return $query->num_rows();
            break;
        case "Took_Survey":
            $query = $this->db->query("SELECT id FROM took_survey WHERE survey_id = ? GROUP BY IP", array($id));
            return $query->num_rows();
            break;
        case "Questions":
            $query = $this->db->get('tbl_questions');
            return $query->num_rows();
            break;
        case "Answers":
            $query = $this->db->query("SELECT id FROM tbl_results WHERE survey_id = ?", array($id));
            return $query->num_rows();
            break;
        case "All_Answers":
            $query = $this->db->get('tbl_results');
            return $query->num_rows();
            break;
    }
}
}