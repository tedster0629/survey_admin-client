<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_manage_surveys extends CI_Model
{
    public function listSurveys()
    {
        $this->db->select('tbl_survey.id as survey_ID, tbl_survey.name, tbl_survey.password');
        $this->db->from('tbl_survey');
        $this->db->order_by('tbl_survey.id', 'DESC');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_number_of_questions($id)
    {
        $this->db->select('survey_id');
        $this->db->from('tbl_questions');
        $this->db->where('survey_id', $id);
        $result = $this->db->get();
        return $result->num_rows();
    }

    
    public function editSurvey($name, $password, $id)
    {
        $name = $this->input->post('new-survey-name');
        $password = $this->input->post('new-survey-password');
        $survey_ID = $this->input->post('survey_ID');

        if ($password == 'DO_NOT_UPDATE')
        {
            $data = array(
                'name' => $name
            );

            $this->db->where('id', $id);
            $this->db->update('tbl_survey', $data);
        }
        elseif (strlen($name) == 0 && strlen($password) !== 0)
        {
            $data = array(
                'password' => $password
            );

            $this->db->where('id', $id);
            $this->db->update('tbl_survey', $data);
        }
        else
        {
            $data = array(
                'name' => $name,
                'password' => $password
            );

            $this->db->where('id', $id);
            $this->db->update('tbl_survey', $data);
        }

        if ($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function delete_survey($id)
    {
        // Before deleting results and answers find the questions related to results and answers
        $query_s = sprintf("SELECT id FROM tbl_questions 
                    WHERE 
                        survey_id = '%d'
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
                $query_3 = $this->db->query(sprintf("DELETE FROM tbl_answers_add WHERE question_id = '%d'", $r['id']));
                
            }
            
        }
        
        // Delete Survey Name
        $query = sprintf("DELETE FROM tbl_survey
                                WHERE
                                    id = '%d'
                ",
                            $id
                );
        
        $this->db->query($query);   
        
        // Delete Questions of the survey
        $query = sprintf("DELETE FROM tbl_questions
                                WHERE
                                    survey_id = '%d'
                ",
                                $id
                );
        
        $this->db->query($query);
        
        // remove published surveys as well
        $this->delete_liveSurvey_withSurvey($id);
                    
        return true;
    }

    public function delete_liveSurvey_withSurvey($sid)
    {
        $query = sprintf("DELETE FROM tbl_templating
                    WHERE 
                        survey_id = '%d'
        ",
                        $sid
        );
        
        $this->db->query($query);
        
        return true;
    }
}