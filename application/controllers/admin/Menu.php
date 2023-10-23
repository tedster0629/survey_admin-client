<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_menu');
    }

	public function index()
	{       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';

		if(isset($_POST['form1']))
		{

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}
			
			$arr1 = array();
			$arr2 = array();

			foreach($_POST['menu_id'] as $val) {
				$arr1[] = $val;
			}

			foreach($_POST['menu_status'] as $val) {
				$arr2[] = $val;
			}

			// Update the menu
			for($i=0;$i<count($arr1);$i++) {
				$form_data = array(
					'menu_status' => $arr2[$i]
	            );
	            $this->Model_menu->update($arr1[$i],$form_data);
			}
		
			$success = 'Menu is updated successfully';
		    
			$this->session->set_flashdata('success',$success);
			redirect(base_url().'admin/menu');
           
		} else {
			$data['all_menus'] = $this->Model_menu->show();
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_menu',$data);
			$this->load->view('admin/view_footer');
		}

	}


}