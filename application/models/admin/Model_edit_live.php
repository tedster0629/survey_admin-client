<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_edit_live extends CI_Model 
{
    public function get_live_survey($from, $id)
    {
        $query = $this->db->query("SELECT $from, tbl_survey.id as survey_ID, tbl_templating.id as TID FROM tbl_templating INNER JOIN tbl_survey ON tbl_survey.id = tbl_templating.survey_id WHERE tbl_templating.id = ?", array($id));
        $result = $query->row_array();
        return $result[$from];
    }

    public function edit_liveSurvey($post) {
        $data = array(
            'title' => $this->db->escape_str(htmlentities($post['title'], ENT_QUOTES, 'UTF-8')),
            'heading' => $this->db->escape_str(htmlentities($post['heading'], ENT_QUOTES, 'UTF-8')),
            'sub_heading' => $this->db->escape_str(htmlentities($post['sub-heading'], ENT_QUOTES, 'UTF-8')),
            'intro' => $this->db->escape_str(htmlentities($post['intro'], ENT_QUOTES, 'UTF-8')),
            'description' => $this->db->escape_str(htmlentities($post['description'], ENT_QUOTES, 'UTF-8')),
            'note' => $this->db->escape_str(htmlentities($post['note'], ENT_QUOTES, 'UTF-8')),
            'footer' => $this->db->escape_str(htmlentities($post['footer'], ENT_QUOTES, 'UTF-8'))
        );

        $this->db->where('id', $post['id']);
        $this->db->update('tbl_templating', $data);

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
}