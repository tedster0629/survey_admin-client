<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_home extends CI_Model 
{
    public function all_slider()
    {
        $query = $this->db->query("SELECT * FROM tbl_slider WHERE lang_id=? ORDER BY id ASC", [$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_service()
    {
        $query = $this->db->query("SELECT * FROM tbl_service WHERE lang_id=? ORDER BY id ASC", [$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_feature()
    {
        $query = $this->db->query("SELECT * FROM tbl_feature WHERE lang_id=? ORDER BY id ASC", [$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_why_choose()
    {
        $query = $this->db->query("SELECT * FROM tbl_why_choose WHERE lang_id=? ORDER BY id ASC", [$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_team_member()
    {
        $query = $this->db->query("SELECT * FROM tbl_team_member WHERE lang_id=? ORDER BY id ASC", [$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_testimonial()
    {
        $query = $this->db->query("SELECT * FROM tbl_testimonial WHERE lang_id=? ORDER BY id ASC", [$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_client()
    {
        $query = $this->db->query("SELECT * FROM tbl_client ORDER BY id ASC");
        return $query->result_array();
    }
    public function all_pricing_table()
    {
        $query = $this->db->query("SELECT * FROM tbl_pricing_table WHERE lang_id=? ORDER BY id ASC", [$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_faq_home()
    {
        $query = $this->db->query("SELECT * FROM tbl_faq WHERE show_on_home=? AND lang_id=?", array('Yes', $_SESSION['sess_lang_id']));
        return $query->result_array();
    }
}