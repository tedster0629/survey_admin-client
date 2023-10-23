<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_menu extends CI_Model 
{
    function show() {
        $sql = "SELECT * FROM tbl_menu";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function update($menu_id,$data) {
        $this->db->where('menu_id',$menu_id);
        $this->db->update('tbl_menu',$data);
    }
    
}