<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_captcha');
    }

	public function setting()
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

			$form_data = array(
				'captcha_contact'  => $_POST['captcha_contact'],
				'captcha_service_detail'=> $_POST['captcha_service_detail'],
				'captcha_portfolio_detail' => $_POST['captcha_portfolio_detail']
			);
			$this->Model_captcha->update($form_data);
		
			$success = 'Captcha Setting is updated successfully';
		    
			$this->session->set_flashdata('success',$success);
			redirect(base_url().'admin/captcha/setting');
           
		} else {
			$data['captcha'] = $this->Model_captcha->show();
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_captcha_setting',$data);
			$this->load->view('admin/view_footer');
		}

	}

	public function index() {
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['captcha'] = $this->Model_captcha->show_all();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_captcha',$data);
		$this->load->view('admin/view_footer');
	}

	public function add() {

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['captcha'] = $this->Model_captcha->show_all();

		$error = '';
		$success = '';

		if(isset($_POST['form1'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$captcha_value1 = $_POST['captcha_value1'];
			$captcha_value2 = $_POST['captcha_value2'];
			$captcha_result = $_POST['captcha_result'];
			$captcha_symbol = $_POST['captcha_symbol'];

			if($captcha_value1 == '')
			{
				$valid = 0;
				$error .= 'Value 1 can not be empty<br>';
			}
			if($captcha_value2 == '')
			{
				$valid = 0;
				$error .= 'Value 2 can not be empty<br>';
			}
			if($captcha_result == '')
			{
				$valid = 0;
				$error .= 'Result can not be empty<br>';
			}

	   		if($valid == 1)
		    {
		        $form_data = array(
					'captcha_value1' => $_POST['captcha_value1'],
					'captcha_value2' => $_POST['captcha_value2'],
					'captcha_result' => $_POST['captcha_result'],
					'captcha_symbol' => $_POST['captcha_symbol']
	            );
	            $this->Model_captcha->add($form_data);

		        $success = 'Captcha is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/captcha');		        
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/captcha/add');
		    }
            
        } else {
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_captcha',$data);
			$this->load->view('admin/view_footer');
        }
	}

	public function delete($id) {
    	$tot = $this->Model_captcha->captcha_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/captcha');
        	exit;
    	}

		if(PROJECT_MODE == 0) {
			$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
			redirect($_SERVER['HTTP_REFERER']);
		}

        $this->Model_captcha->delete($id);
        $success = 'Captcha is deleted successfully';
		$this->session->set_flashdata('success',$success);
		redirect(base_url().'admin/captcha');
	}

}