<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_contact extends CI_Model 
{
    public function all_testimonial()
    {
        $query = $this->db->query("SELECT * FROM tbl_testimonial ORDER BY id ASC");
        return $query->result_array();
    }

    public function check_captcha()
    {
    	$query = $this->db->query("SELECT * FROM tbl_setting_captcha WHERE id=?",[1]);
        return $query->first_row('array');
    }

    public function total_captcha()
    {
    	$query = $this->db->query("SELECT * FROM tbl_captcha");
        return $query->num_rows();
    }

    public function get_particular_captcha($id)
    {
    	$query = $this->db->query("SELECT * FROM tbl_captcha WHERE captcha_id=?",[$id]);
        return $query->first_row('array');
    }
    public function listSurveysLaunch()
    {
        $this->db->distinct();
        $this->db->select('name, tbl_survey.id AS survey_ID');
        $this->db->from('tbl_survey');
        $this->db->join('tbl_questions', 'tbl_survey.id = tbl_questions.survey_id');
        $this->db->order_by('tbl_survey.id', 'DESC');
        $result = $this->db->get();
        
        return $result->result_array();
    }

    public function check_template_survey($select, $from_id, $id)
    {
        $this->db->select($select);
        $this->db->from('tbl_templating');
        $this->db->where($from_id, $id);
        $this->db->limit(1);
        $result = $this->db->get();
        
        $row = $result->row_array();
        return $row[$select];
    }

    public function publish_survey($post)
    {
        $data = array(
            'survey_id' => $post['survey'],
            'title' => htmlentities($post['title'], ENT_QUOTES, 'UTF-8'),
            'heading' => htmlentities($post['heading'], ENT_QUOTES, 'UTF-8'),
            'sub_heading' => htmlentities($post['sub-heading'], ENT_QUOTES, 'UTF-8'),
            'intro' => htmlentities($post['intro'], ENT_QUOTES, 'UTF-8'),
            'description' => htmlentities($post['description'], ENT_QUOTES, 'UTF-8'),
            'note' => htmlentities($post['note'], ENT_QUOTES, 'UTF-8'),
            'footer' => htmlentities($post['footer'], ENT_QUOTES, 'UTF-8'),
            'template_rule' => $post['template_rule'],
            'sessions' => $post['sessions'],
            'theme' => $post['theme']
        );
        
        $result = $this->db->insert('tbl_templating', $data);
        
        if ($this->db->affected_rows() == 1)
        {
            return true;
        } else {
            return false;
        }
    }

    public function listQuestions($id)
    {
        $this->db->select('tbl_questions.id as question_ID, tbl_questions.survey_id, tbl_questions.questions, tbl_questions.order, tbl_questions.question_type, tbl_questions.requeriment');
        $this->db->from('tbl_questions');
        $this->db->where('survey_id', $id);
        $this->db->order_by('tbl_questions.id', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }

    public function listLiveSurveys()
    {
        $this->db->select('tbl_survey.id as survey_ID, tbl_templating.id as TID, tbl_survey.name');
        $this->db->from('tbl_templating');
        $this->db->join('tbl_survey', 'tbl_survey.id = tbl_templating.survey_id');
        $this->db->order_by('TID', 'DESC');
        $result = $this->db->get();
        
        if ($result->num_rows() !== 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function delete_liveSurvey($id) {
        $this->db->where('id', $id);
        $this->db->delete('tbl_templating');

        return true;
    }

    public function is_survey_published($id) {
        $idx = $this->sanitize_integer($id);
        if($idx) {
            $query = $this->db->query("SELECT survey_id FROM tbl_templating WHERE survey_id = ?", array($idx));
            if($query->num_rows() == 1) {
                return true;
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

    public function settings_notice($id, $message)
    {
        $query = $this->db->get_where('tbl_survey_settings', array('id' => $id));

        if ($query->num_rows() == 1) {
            $row = $query->row();
            if (strlen($row->value) !== 0) {
                return $row->value;
            } else {
                return $message;
            }
        } else {
            return $message;
        }
    }

    public function user_already_took_survey($survey_id, $ip)
    {
        $sanitized_id = $this->sanitize_integer($survey_id);
        $to_replace = array('+', '%3A');
        $replaces = array(' ', ':');
        $date = '';

        if (isset($_COOKIE['took_survey_time'])) {
            $date = str_replace($to_replace, $replaces, $_COOKIE['took_survey_time']);
        }

        if ($sanitized_id !== false) {
            if (isset($date) && strlen($date) !== 0) {
                $this->db->where('survey_id', $sanitized_id);
                $this->db->where('date', $this->db->escape_str($date));
                $this->db->order_by('survey_id', 'DESC');
                $this->db->limit(1);
                $query = $this->db->get('tbl_took_survey');
            } else {
                $this->db->where('survey_id', $sanitized_id);
                $this->db->where('IP', $this->db->escape_str($ip));
                $this->db->order_by('survey_id', 'DESC');
                $this->db->limit(1);
                $query = $this->db->get('tbl_took_survey');
            }

            if ($query->num_rows() == 0) {
                return 'no_results';
            } else {
                $res = $query->row_array();
                if ($res['page'] == 0) {
                    return false;
                } else {
                    return $res['id'];
                }
            }
        } else {
            return false;
        }
    }

    function get_client_ip()
    {
        $CI = &get_instance();
        $ip_address = $CI->input->ip_address();
        return $ip_address;
    }

    public function user_already_answered_page($survey_id, $ip, $id)
    {
        $survey_id_id = $this->sanitize_integer($survey_id);
        $id_id = $this->sanitize_integer($id);
        $to_replace = array('+', '%3A');
        $replaces = array(' ', ':');
        $date = '';

        if (isset($_COOKIE['took_survey_time'])) {
            $date = str_replace($to_replace, $replaces, $_COOKIE['took_survey_time']);
        }

        if ($survey_id_id !== false && $id_id !== false) {
            if (isset($date) && strlen($date) !== 0) {
                $this->db->select('page');
                $this->db->where('survey_id', $survey_id_id);
                $this->db->where('date', $date);
                $this->db->where('id', $id_id);
                $this->db->limit(1);
                $query = $this->db->get('tbl_took_survey');
            } else {
                $this->db->select('page');
                $this->db->where('survey_id', $survey_id_id);
                $this->db->where('IP', $ip);
                $this->db->where('id', $id_id);
                $this->db->where('page', 0);
                $this->db->limit(1);
                $query = $this->db->get('tbl_took_survey');
            }

            if ($query->num_rows() == 0) {
                return false;
            } else {
                $res = $query->row_array();
                return $res['page'];
            }
        } else {
            return false;
        }
    }

    public function get_survey_info($id, $info)
    {
        $sanitized_id = $this->sanitize_integer($id);
        if ($sanitized_id !== false) {
            $this->db->select('name, password');
            $this->db->where('id', $sanitized_id);
            $query = $this->db->get('tbl_survey');

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

    public function get_question($id, $return)
    {
        $this->db->select('tbl_questions.id as question_ID, tbl_questions.survey_id, tbl_questions.questions, tbl_questions.order, tbl_questions.question_type, tbl_questions.requeriment, tbl_answers.answer, tbl_answers.css, tbl_answers.position');
        $this->db->from('tbl_questions');
        $this->db->join('tbl_answers', 'tbl_questions.id = tbl_answers.question_id');
        $this->db->where('tbl_questions.id', $id);
        $this->db->order_by('tbl_questions.order', 'ASC');
        $query = $this->db->get();

        $rows = $query->row_array();

        if ($rows) {
            return $rows[$return];
        } else {
            return false;
        }
    }

    public function add_result($survey_id, $question_id, $answer, $question_type, $IP, $page)
    {
        $data = array(
            'survey_id' => $survey_id,
            'question_id' => $question_id,
            'answer' => htmlentities($answer, ENT_QUOTES, 'UTF-8'),
            'question_type' => $question_type,
            'IP' => $IP
        );

        $this->db->insert('tbl_results', $data);

        if ($this->db->affected_rows() == 1) {
            // update current user taking survey status (same IP and survey)
            if ($page !== 0) {
                if ($this->user_already_took_survey($survey_id, $IP) == 'no_results') {
                    // insert it one time to after update its progress
                    $this->insert_user_took_survey($survey_id, $IP, $page);
                } else {
                    // just update its progress
                    $this->update_user_took_survey($survey_id, $IP, $page);
                }
            } elseif ($page == 0 && $this->user_already_took_survey($survey_id, $IP) == 'no_results') {
                // insert it
                $this->insert_user_took_survey($survey_id, $IP, $page);
            } else {
                $this->update_user_took_survey($survey_id, $IP, $page);
            }
            return true;
        } else {
            return false;
        }
    }
    public function insert_user_took_survey($survey_id, $IP, $page)
    {
        $date = date('Y-m-d H:i:s', time());
        setcookie('took_survey_time', $date, time()+60*60*24*30);

        $query = $this->db->get_where('tbl_took_survey', array('IP' => $IP));
        if ($query->num_rows() > 1) {
            // found so do not insert to avoid duplication
        } else {
            $data = array(
                'survey_id' => $survey_id,
                'IP' => $IP,
                'date' => $date,
                'page' => $page
            );

            $this->db->insert('tbl_took_survey', $data);
        }
    }

    public function update_user_took_survey($survey_id, $IP, $page)
    {
        $date = date('Y-m-d H:i:s', time());
        setcookie('took_survey_time', $date, time()+60*60*24*30);

        $data = array(
            'survey_id' => $survey_id,
            'IP' => $IP,
            'date' => $date,
            'page' => $page
        );

        $this->db->where('id', $this->user_already_took_survey($survey_id, $IP));
        $this->db->update('tbl_took_survey', $data);
    }
}