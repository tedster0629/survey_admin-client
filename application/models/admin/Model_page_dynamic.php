
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_page_dynamic extends CI_Model 
{
	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_page_dynamic'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function show() 
    {
        $sql = "SELECT * 
                FROM tbl_page_dynamic t1
                JOIN tbl_lang t2
                ON t1.lang_id=t2.lang_id
                ORDER BY t1.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data) 
    {
        $this->db->insert('tbl_page_dynamic',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) 
    {
        $this->db->where('id',$id);
        $this->db->update('tbl_page_dynamic',$data);
    }

    function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('tbl_page_dynamic');
    }

    function getData($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_page_dynamic');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    function page_dynamic_check($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_page_dynamic');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    function slug_duplication_check($slug)
    {
        $sql = 'SELECT * FROM tbl_page_dynamic WHERE slug=?';
        $query = $this->db->query($sql,array($slug));
        return $query->num_rows();
    }

    function slug_duplication_check_edit($slug,$slug2)
    {
        $sql = 'SELECT * FROM tbl_page_dynamic WHERE slug=? AND slug!=?';
        $query = $this->db->query($sql,array($slug,$slug2));
        return $query->num_rows();
    }
}