<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_statistics');
    }
	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_statistics');
		$this->load->view('admin/view_footer');
	}
	
}