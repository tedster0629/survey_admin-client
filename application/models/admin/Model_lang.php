<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_lang extends CI_Model 
{
    function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_lang'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function check_category_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_category WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_event_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_event WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_faq_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_faq WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_feature_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_feature WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_news_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_news WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }


    function check_portfolio_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_portfolio WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_portfolio_category_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_portfolio_category WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_pricing_table_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_pricing_table WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_service_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_service WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_slider_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_slider WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_team_member_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_team_member WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_testimonial_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_testimonial WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }

    function check_why_choose_for_lang_id($id) {
        $sql = "SELECT * FROM tbl_why_choose WHERE lang_id=?";
        $query = $this->db->query($sql,[$id]);
        return $query->num_rows();
    }


    function delete_from_footer($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_footer');
    }

    function delete_from_page_about($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_about');
    }

    function delete_from_page_contact($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_contact');
    }

    function delete_from_page_event($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_event');
    }

    function delete_from_page_faq($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_faq');
    }

    function delete_from_page_home($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_home');
    }

    function delete_from_page_news($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_news');
    }

    function delete_from_page_photo_gallery($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_photo_gallery');
    }

    function delete_from_page_portfolio($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_portfolio');
    }

    function delete_from_page_pricing($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_pricing');
    }

    function delete_from_page_privacy($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_privacy');
    }

    function delete_from_page_search($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_search');
    }

    function delete_from_page_service($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_service');
    }

    function delete_from_page_team($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_team');
    }

    function delete_from_page_term($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_term');
    }

    function delete_from_page_testimonial($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_page_testimonial');
    }


    
    
    function show() {
        $sql = "SELECT * FROM tbl_lang ORDER BY lang_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function make_all_empty($data)
    {
        $this->db->update('tbl_lang',$data);
    }

    function add($data) {
        $this->db->insert('tbl_lang',$data);
        return $this->db->insert_id();
    }

    function add_detail($data) {
        $this->db->insert('tbl_lang_detail',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) {
        $this->db->where('lang_id',$id);
        $this->db->update('tbl_lang',$data);
    }

    function delete($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_lang');
    }
    function delete_detail($id)
    {
        $this->db->where('lang_id',$id);
        $this->db->delete('tbl_lang_detail');
    }

    function getData($id)
    {
        $sql = 'SELECT * FROM tbl_lang WHERE lang_id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }

    function lang_check($id)
    {
        $sql = 'SELECT * FROM tbl_lang WHERE lang_id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }

    function detail($id) {
        $sql = "SELECT * FROM tbl_lang_detail WHERE lang_id=?";
        $query = $this->db->query($sql,array($id));
        return $query->result_array();
    }

    function update_detail($id,$data) {
        $this->db->where('lang_detail_id',$id);
        $this->db->update('tbl_lang_detail',$data);
    }

    function add_page_home($data) {
        $this->db->insert('tbl_page_home',$data);
        return $this->db->insert_id();
    }

    function add_page_about($data) {
        $this->db->insert('tbl_page_about',$data);
        return $this->db->insert_id();
    }

    function add_page_faq($data) {
        $this->db->insert('tbl_page_faq',$data);
        return $this->db->insert_id();
    }

    function add_page_service($data) {
        $this->db->insert('tbl_page_service',$data);
        return $this->db->insert_id();
    }

    function add_page_testimonial($data) {
        $this->db->insert('tbl_page_testimonial',$data);
        return $this->db->insert_id();
    }

    function add_page_news($data) {
        $this->db->insert('tbl_page_news',$data);
        return $this->db->insert_id();
    }

    function add_page_event($data) {
        $this->db->insert('tbl_page_event',$data);
        return $this->db->insert_id();
    }

    function add_page_search($data) {
        $this->db->insert('tbl_page_search',$data);
        return $this->db->insert_id();
    }

    function add_page_term($data) {
        $this->db->insert('tbl_page_term',$data);
        return $this->db->insert_id();
    }

    function add_page_privacy($data) {
        $this->db->insert('tbl_page_privacy',$data);
        return $this->db->insert_id();
    }

    function add_page_team($data) {
        $this->db->insert('tbl_page_team',$data);
        return $this->db->insert_id();
    }

    function add_page_portfolio($data) {
        $this->db->insert('tbl_page_portfolio',$data);
        return $this->db->insert_id();
    }

    function add_page_photo_gallery($data) {
        $this->db->insert('tbl_page_photo_gallery',$data);
        return $this->db->insert_id();
    }

    function add_page_pricing($data) {
        $this->db->insert('tbl_page_pricing',$data);
        return $this->db->insert_id();
    }

    function add_page_contact($data) {
        $this->db->insert('tbl_page_contact',$data);
        return $this->db->insert_id();
    }

    function add_footer_setting($data) {
        $this->db->insert('tbl_footer',$data);
        return $this->db->insert_id();
    }

}