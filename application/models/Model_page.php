<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_page extends CI_Model 
{
    public function page_check($slug)
    {
        $this->db->select('*');
        $this->db->from('tbl_page_dynamic');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function dynamic_page_by_slug($slug)
    {
        $this->db->select('*');
        $this->db->from('tbl_page_dynamic');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->first_row('array');
    }
}