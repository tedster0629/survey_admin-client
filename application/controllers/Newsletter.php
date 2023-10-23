<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends MY_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_newsletter');
    }

	public function send() {

		$data['setting'] = $this->Model_common->all_setting();

		
		$error = '';

		if(isset($_POST['form_subscribe'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			if(empty($_POST['email_subscribe'])) {
		        $valid = 0;
		        $error .= ERROR_EMPTY_EMAIL;
		    }
		    else
		    {
		    	if (filter_var($_POST['email_subscribe'], FILTER_VALIDATE_EMAIL) === false)
			    {
			        $valid = 0;
			        $error .= ERROR_INVALID_EMAIL;
			    }
			    else
			    {
			    	$total = $this->Model_newsletter->total_subscriber_by_email($_POST['email_subscribe']);
	            	if($total) {
	            		$valid = 0;
	                	$error .= ERROR_EXIST_EMAIL;
	            	}
			    }
			}

		    if($valid == 1)
		    {

		    	$key = md5(uniqid(rand(), true));
	    		$current_date = date('Y-m-d');
	    		$current_date_time = date('Y-m-d H:i:s');

		    	$form_data = array(
					'subs_email' => $_POST['email_subscribe'],
					'subs_date' => $current_date,
					'subs_date_time' => $current_date_time,
					'subs_hash' => $key,
					'subs_active' => 0
	            );
	            $this->Model_newsletter->add($form_data);

	            $verification_url = base_url().'newsletter/verify/'.$_POST['email_subscribe'].'/'.$key;

				$msg = 'Thanks for your interest to subscribe our newsletter!<br><br>Please click this link to confirm your subscription: <br>'.$verification_url;


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
				$this->email->to($_POST['email_subscribe']);

				$this->email->subject('Confirm Email Subscription');
				$this->email->message($msg);

				$this->email->send();

		        $success = SUCCESS_SUBSCRIPTION_FORM;
        		$this->session->set_flashdata('success',$success);
        		redirect($this->agent->referrer());
		    } 
		    else
		    {
        		$this->session->set_flashdata('error',$error);
        		redirect($this->agent->referrer());
		    }
            
        } else {            
            redirect(base_url());
        }
	}

	function verify($email=0,$hash=0) {

		if(!$email || !$hash ) {
			redirect(base_url());
		}

		$tot = $this->Model_newsletter->check_url($email,$hash);
		if(!$tot) {
			redirect(base_url());
		}

		$data['setting'] = $this->Model_common->all_setting();
		$data['page_home'] = $this->Model_common->all_page_home();
		$data['comment'] = $this->Model_common->all_comment();
		$data['social'] = $this->Model_common->all_social();
		$data['all_news'] = $this->Model_common->all_news();

		$form_data = array(
			'subs_hash' => '',
			'subs_active' => 1
        );
        $this->Model_newsletter->update($email,$hash,$form_data);

		$this->load->view('view_header',$data);
		$this->load->view('view_thankyou_subscribe',$data);
		$this->load->view('view_footer',$data);
	}
}