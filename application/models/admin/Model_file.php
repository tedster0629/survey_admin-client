<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_file extends CI_Model 
{

	function get_auto_increment_id()
    {
        $sql = "SHOW TABLE STATUS LIKE 'tbl_file'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
    function show() {
        $sql = "SELECT * FROM tbl_file ORDER BY file_id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data) {
        $this->db->insert('tbl_file',$data);
        return $this->db->insert_id();
    }

    function update($id,$data) {
        $this->db->where('file_id',$id);
        $this->db->update('tbl_file',$data);
    }

    function delete($id)
    {
        $this->db->where('file_id',$id);
        $this->db->delete('tbl_file');
    }

    function get_file($id)
    {
        $sql = 'SELECT * FROM tbl_file WHERE file_id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }

    function file_check($id)
    {
        $sql = 'SELECT * FROM tbl_file WHERE file_id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }
    
}