<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_create_surveys extends CI_Model 
{    
    public function create_survey($name, $password)
    {
        $data = array(
            'name' => $this->db->escape_str($name),
            'password' => $this->db->escape_str($password)
        );
        
        $this->db->insert('tbl_survey', $data);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    } 
}