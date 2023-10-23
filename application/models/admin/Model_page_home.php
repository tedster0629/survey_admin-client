<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_page_home extends CI_Model 
{
    function show()
    {
        $sql = "SELECT * 
                FROM tbl_page_home t1
                JOIN tbl_lang t2
                ON t1.lang_id = t2.lang_id
                ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show_lang_independent()
    {
        $sql = "SELECT * FROM tbl_page_home_lang_independent WHERE id=?";
        $query = $this->db->query($sql,[1]);
        return $query->first_row('array');
    }

    function update($id,$data) 
    {
        $this->db->where('id',$id);
        $this->db->update('tbl_page_home',$data);
    }

    function get_page_home($id)
    {
        $query = $this->db->query("SELECT * 
                FROM tbl_page_home t1 
                JOIN tbl_lang t2 
                ON t1.lang_id = t2.lang_id 
                WHERE t1.id=?",
                [$id]
            );
        return $query->first_row('array');
    }

    function page_home_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_page_home');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    public function update_home($data)
    {
        $this->db->where('id',1);
        $this->db->update('tbl_page_home_lang_independent',$data);
    }
}