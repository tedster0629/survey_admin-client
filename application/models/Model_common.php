<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_common extends CI_Model 
{
    public function all_setting()
    {
        $query = $this->db->query("SELECT * from tbl_settings WHERE id=1");
        return $query->first_row('array');
    }
    public function all_page_home()
    {
        $query = $this->db->query("SELECT * from tbl_page_home WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_home_lang_independent()
    {
        $query = $this->db->query("SELECT * from tbl_page_home_lang_independent WHERE id=?", [1]);
        return $query->first_row('array');
    }
    public function all_footer_setting()
    {
        $query = $this->db->query("SELECT * from tbl_footer WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_footer_setting_lang_independent()
    {
        $query = $this->db->query("SELECT * from tbl_footer_lang_independent WHERE id=?", [1]);
        return $query->first_row('array');
    }
    public function all_page_about()
    {
        $query = $this->db->query("SELECT * from tbl_page_about WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_faq()
    {
        $query = $this->db->query("SELECT * from tbl_page_faq WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_service()
    {
        $query = $this->db->query("SELECT * from tbl_page_service WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_testimonial()
    {
        $query = $this->db->query("SELECT * from tbl_page_testimonial WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_news()
    {
        $query = $this->db->query("SELECT * from tbl_page_news WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_event()
    {
        $query = $this->db->query("SELECT * from tbl_page_event WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_contact()
    {
        $query = $this->db->query("SELECT * from tbl_page_contact WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_search()
    {
        $query = $this->db->query("SELECT * from tbl_page_search WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_term()
    {
        $query = $this->db->query("SELECT * from tbl_page_term WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_privacy()
    {
        $query = $this->db->query("SELECT * from tbl_page_privacy WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_pricing()
    {
        $query = $this->db->query("SELECT * from tbl_page_pricing WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_photo_gallery()
    {
        $query = $this->db->query("SELECT * from tbl_page_photo_gallery WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_team()
    {
        $query = $this->db->query("SELECT * from tbl_page_team WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_page_portfolio()
    {
        $query = $this->db->query("SELECT * from tbl_page_portfolio WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->first_row('array');
    }
    public function all_comment()
    {
        $query = $this->db->query("SELECT * from tbl_comment WHERE id=1");
        return $query->first_row('array');
    }
    public function all_social()
    {
        $query = $this->db->query("SELECT * from tbl_social");
        return $query->result_array();
    }
    public function all_news()
    {
        $query = $this->db->query("SELECT * FROM tbl_news WHERE lang_id=? ORDER BY news_id DESC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_news_category()
    {
        $query = $this->db->query("SELECT * 
                                FROM tbl_news t1
                                JOIN tbl_category t2
                                ON t1.category_id = t2.category_id
                                WHERE t1.lang_id=?
                                ORDER BY t1.news_id DESC",[$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function all_event()
    {
        $query = $this->db->query("SELECT * FROM tbl_event ORDER BY event_id DESC");
        return $query->result_array();
    }
    public function all_categories()
    {
        $query = $this->db->query("SELECT * FROM tbl_category WHERE lang_id=? ORDER BY category_name ASC", [$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }
    public function extension_check_photo($ext) {
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' && $ext!='JPG' && $ext!='PNG' && $ext!='JPEG' && $ext!='GIF' ) {
            return false;
        } else {
            return true;
        }
    }

    public function all_dynamic_pages()
    {
        $query = $this->db->query("SELECT * from tbl_page_dynamic WHERE lang_id=?", [$_SESSION['sess_lang_id']]);
        return $query->result_array();
    }

}