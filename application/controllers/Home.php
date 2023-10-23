<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_home');
        $this->load->model('Model_portfolio');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->all_setting();
		$data['page_home'] = $this->Model_common->all_page_home();
		$data['page_home_lang_independent'] = $this->Model_common->all_page_home_lang_independent();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_news'] = $this->Model_common->all_news();
		$data['all_news_category'] = $this->Model_common->all_news_category();

		$data['sliders'] = $this->Model_home->all_slider();
		$data['services'] = $this->Model_home->all_service();
		$data['features'] = $this->Model_home->all_feature();
		$data['why_choose'] = $this->Model_home->all_why_choose();
		$data['team_members'] = $this->Model_home->all_team_member();
		$data['testimonials'] = $this->Model_home->all_testimonial();		
		$data['clients'] = $this->Model_home->all_client();
		$data['pricing_table'] = $this->Model_home->all_pricing_table();
		$data['home_faq'] = $this->Model_home->all_faq_home();

		$data['portfolio_category'] = $this->Model_portfolio->get_portfolio_category();
		$data['portfolio'] = $this->Model_portfolio->get_portfolio_data();

		$data['portfolio_footer'] = $this->Model_portfolio->get_portfolio_data();

		$this->load->view('view_header',$data);
		$this->load->view('view_home',$data);
		$this->load->view('view_footer',$data);
	}

	public function send_email() 
	{

		$data['setting'] = $this->Model_common->all_setting();

		$error = '';

		if(isset($_POST['form_quick_contact'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$first_name = $this->input->post('first_name', true);
			$last_name = $this->input->post('last_name', true);
			$phone = $this->input->post('phone', true);
			$email = $this->input->post('email', true);
			$subject = $this->input->post('subject', true);
			$message = $this->input->post('message', true);

			if(empty($first_name))
		    {
		        $valid = 0;
		        $error .= ERROR_EMPTY_FIRST_NAME.'<br>';
		    }

		    if(empty($last_name))
		    {
		        $valid = 0;
		        $error .= ERROR_EMPTY_LAST_NAME.'<br>';
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

		    if(empty($subject))
		    {
		        $valid = 0;
		        $error .= ERROR_EMPTY_SUBJECT.'<br>';
		    }

		    if(empty($message))
		    {
		        $valid = 0;
		        $error .= ERROR_EMPTY_MESSAGE.'<br>';
		    }

		    if($valid == 1)
		    {
				$msg = '
				<html><head><title>Email Sending</title></head><body>
            		<h3>Sender Information</h3>
					<b>First Name: </b> '.$first_name.'<br><br>
					<b>Last Name: </b> '.$last_name.'<br><br>
					<b>Phone: </b> '.$phone.'<br><br>
					<b>Email: </b> '.$email.'<br><br>
					<b>Subject: </b> '.$subject.'<br><br>
					<b>Message: </b> '.$message.'</body></html>';

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
				$this->email->reply_to($email);

				$this->email->subject($subject);
				$this->email->message($msg);

				$this->email->send();

		        $success = 'Thank you for sending the email. We will contact you shortly.';
        		$this->session->set_flashdata('success',$success);

		    } 
		    else
		    {
        		$this->session->set_flashdata('error',$error);
		    }

			redirect(base_url());
            
        } else {
            
            redirect(base_url());
        }
	}

	
}
