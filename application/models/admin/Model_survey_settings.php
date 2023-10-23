<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_survey_settings extends CI_Model
{
    public function settings_notice($id, $message)
    {
        $this->db->select('value');
        $this->db->where('id', $id);
        $result = $this->db->get('tbl_survey_settings');
        
        if ($this->db->affected_rows() == 1)
        {
            $rows = $result->row_array();
            if (strlen($rows['value']) !== 0)
            {
                return $rows['value'];    
            } else {
                return $message;
            }
        } else {
            return $message;
        }
    }

    public function update_settings($post) {
        $data = array(
            'value' => $this->db->escape_str(htmlentities($post['succes_notice'], ENT_QUOTES, 'UTF-8'))
        );
        $this->db->where('id', 2);
        $this->db->update('tbl_survey_settings', $data);

        $data = array(
            'value' => $this->db->escape_str(htmlentities($post['took_survey'], ENT_QUOTES, 'UTF-8'))
        );
        $this->db->where('id', 3);
        $this->db->update('tbl_survey_settings', $data);

        $data = array(
            'value' => $this->db->escape_str(htmlentities($post['per_page'], ENT_QUOTES, 'UTF-8'))
        );
        $this->db->where('id', 4);
        $this->db->update('tbl_survey_settings', $data);

        $data = array(
            'value' => $this->db->escape_str(htmlentities($post['took_page'], ENT_QUOTES, 'UTF-8'))
        );
        $this->db->where('id', 5);
        $this->db->update('tbl_survey_settings', $data);

        $data = array(
            'value' => $this->db->escape_str(htmlentities($post['next_button'], ENT_QUOTES, 'UTF-8'))
        );
        $this->db->where('id', 6);
        $this->db->update('tbl_survey_settings', $data);

        $data = array(
            'value' => $this->db->escape_str(htmlentities($post['submit_button'], ENT_QUOTES, 'UTF-8'))
        );
        $this->db->where('id', 7);
        $this->db->update('tbl_survey_settings', $data);

        $data = array(
            'value' => $this->db->escape_str(htmlentities($post['choices_hint'], ENT_QUOTES, 'UTF-8'))
        );
        $this->db->where('id', 8);
        $this->db->update('tbl_survey_settings', $data);

        return true;
    }
}