<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_service');
        $this->load->model('Model_portfolio');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['page_service'] = $this->Model_common->all_page_service();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_news'] = $this->Model_common->all_news();

		$data['services'] = $this->Model_service->all_service();
		$data['portfolio_footer'] = $this->Model_portfolio->get_portfolio_data();

		$data['check_captcha'] = $this->Model_service->check_captcha();
		$data['total_captcha'] = $this->Model_service->total_captcha();

		$this->load->view('view_header',$data);
		$this->load->view('view_service',$data);
		$this->load->view('view_footer',$data);
	}

	public function view($id=0)
	{
		if( !isset($id) || !is_numeric($id) ) {
			redirect(base_url());
		}

		$tot = $this->Model_service->service_check($id);
		if(!$tot) {
			redirect(base_url());
		}

		$data['setting'] = $this->Model_common->all_setting();
		$data['page_service'] = $this->Model_common->all_page_service();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_news'] = $this->Model_common->all_news();

		$data['services'] = $this->Model_service->all_service();
		$data['service'] = $this->Model_service->service_detail($id);

		$data['portfolio_footer'] = $this->Model_portfolio->get_portfolio_data();

		$data['id'] = $id;

		$data['check_captcha'] = $this->Model_service->check_captcha();
		$data['total_captcha'] = $this->Model_service->total_captcha();

		$this->load->view('view_header',$data);
		$this->load->view('view_service_detail',$data);
		$this->load->view('view_footer');
	}

	public function send_email() 
	{

		$data['setting'] = $this->Model_common->all_setting();
		$check_captcha = $this->Model_service->check_captcha();

		$error = '';

		if(isset($_POST['form_service'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$name = $this->input->post('name', true);
			$phone = $this->input->post('phone', true);
			$email = $this->input->post('email', true);
			$message = $this->input->post('message', true);

			if(empty($name))
		    {
		        $valid = 0;
		        $error .= ERROR_EMPTY_NAME.'<br>';
		    }

		    if(empty($phone))
		    {
		        $valid = 0;
		        $error .= ERROR_EMPTY_PHONE.'<br>';
		    }


		    if(empty($email))
		    {
		        $valid = 0;
		        $error .= ERROR_EMPTY_EMAIL.'<br>';
		    }
		    else
		    {
		    	// Email validation check
		        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		        {
		            $valid = 0;
		            $error .= ERROR_INVALID_EMAIL.'<br>';
		        }
		    }

		    if(empty($message))
		    {
		        $valid = 0;
		        $error .= ERROR_EMPTY_MESSAGE.'<br>';
		    }

            if($check_captcha['captcha_service_detail'] == 'Show')
		    {
		    	$r_serial = $this->input->post('r_serial', true);
			    $captcha_input = $this->input->post('captcha_input', true);

			    if($captcha_input == '')
			    {
			    	$valid = 0;
			    	$error .= ERROR_EMPTY_CAPTCHA.'<br>';
			    }
			    else
			    {
			    	$aa = $this->Model_service->get_particular_captcha($r_serial);
			    	if($captcha_input != $aa['captcha_result'])
			    	{
			    		$valid = 0;
			    		$error .= ERROR_INCORRECT_CAPTCHA.'<br>';
			    	}
			    }
		    }

		    if($valid == 1)
		    {
				$msg = '
				<html><head><title>Email Sending</title></head><body>
            		<h3>Sender Information</h3>
					<b>Name: </b> '.$_POST['name'].'<br><br>
					<b>Phone: </b> '.$_POST['phone'].'<br><br>
					<b>Email: </b> '.$_POST['email'].'<br><br>
					<b>Service Name: </b> '.$_POST['service'].'<br><br>
					<b>Message: </b> '.$_POST['message'].'</body></html>
				';
            	

            	$config = [
					'protocol' => 'smtp',
					'smtp_host' => $data['setting']['smtp_host'],
					'smtp_port' => $data['setting']['smtp_port'],
					'smtp_user' => $data['setting']['smtp_username'],
					'smtp_pass' => $data['setting']['smtp_password'],
					'crlf' => "\r\n",
					'newline' => "\r\n",
					'mailtype'  => 'html',
					'charset'   => 'utf-8'
				];

				$this->load->library('email', $config);

				$this->email->from($data['setting']['send_email_from']);
				$this->email->to($data['setting']['receive_email_to']);
				$this->email->reply_to($_POST['email'], $_POST['name']);

				$this->email->subject('Service Page Email');
				$this->email->message($msg);

				$this->email->send();

		        $success = SUCCESS_SERVICE_PAGE_FORM;
        		$this->session->set_flashdata('success',$success);

		    } 
		    else
		    {
        		$this->session->set_flashdata('error',$error);
		    }

			redirect($this->agent->referrer());
            
        } else {
            
            redirect($this->agent->referrer());
        }
	}
}