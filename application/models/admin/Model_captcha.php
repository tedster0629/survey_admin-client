<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_captcha extends CI_Model 
{
    function show() {
        $sql = "SELECT * FROM tbl_setting_captcha WHERE id=?";
        $query = $this->db->query($sql,[1]);
        return $query->first_row('array');
    }

    function show_all() {
        $sql = "SELECT * FROM tbl_captcha";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add($data) {
        $this->db->insert('tbl_captcha',$data);
        return $this->db->insert_id();
    }

    function update($data) {
        $this->db->where('id',1);
        $this->db->update('tbl_setting_captcha',$data);
    }

    function captcha_check($id) {
        $sql = 'SELECT * FROM tbl_captcha WHERE captcha_id=?';
        $query = $this->db->query($sql,array($id));
        return $query->first_row('array');
    }

    function delete($id) {
        $this->db->where('captcha_id',$id);
        $this->db->delete('tbl_captcha');
    }
    
}