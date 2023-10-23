<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_testimonial extends CI_Model 
{

	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_testimonial'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
    function show() {
        $sql = "SELECT * 
                FROM tbl_testimonial t1
                JOIN tbl_lang t2
                ON t1.lang_id = t2.lang_id
                ORDER BY t1.id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data) {
        $this->db->insert('tbl_testimonial',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) {
        $this->db->where('id',$id);
        $this->db->update('tbl_testimonial',$data);
    }

    function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('tbl_testimonial');
    }

    function get_testimonial($id)
    {
        $sql = 'SELECT * FROM tbl_testimonial WHERE id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }

    function testimonial_check($id)
    {
        $sql = 'SELECT * FROM tbl_testimonial WHERE id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }
    
}