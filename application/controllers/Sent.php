<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sent extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_portfolio');
    }

	public function index()
	{
        $data['setting'] = $this->Model_common->all_setting();
        $data['page_contact'] = $this->Model_common->all_page_contact();
        $data['comment'] = $this->Model_common->all_comment();
        $data['social'] = $this->Model_common->all_social();
        $data['all_news'] = $this->Model_common->all_news();
        $data['portfolio_footer'] = $this->Model_portfolio->get_portfolio_data();
        $this->load->view('view_header',$data);
        $this->load->view('view_sent');
        $this->load->view('view_footer',$data);
	}

}

?>