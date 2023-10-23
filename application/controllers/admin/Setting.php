<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_setting');
    }
	public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_setting',$data);
		$this->load->view('admin/view_footer');
		
	}
	public function update()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();

		if(isset($_POST['form_logo'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo_logo']['name'];
		    $path_tmp = $_FILES['photo_logo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	// removing the existing photo
		    	unlink('./public/uploads/'.$data['setting']['logo']);

		    	// updating the data
		    	$final_name = 'logo'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'logo' => $final_name
	            );
	        	$this->Model_setting->update($form_data);

	        	$success = 'Logo is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_favicon'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo_favicon']['name'];
		    $path_tmp = $_FILES['photo_favicon']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	// removing the existing photo
		    	unlink('./public/uploads/'.$data['setting']['favicon']);

		    	// updating the data
		    	$final_name = 'favicon'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'favicon' => $final_name
	            );
	        	$this->Model_setting->update($form_data);

	        	$success = 'Favicon is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_top_bar'])) {
			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'top_bar_email'    => $_POST['top_bar_email'],
				'top_bar_phone'    => $_POST['top_bar_phone']
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Top Bar Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/setting');
		}


		if(isset($_POST['form_email'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$send_email_from  = $this->input->post('send_email_from', true);
			$receive_email_to = $this->input->post('receive_email_to', true);
			$smtp_host        = $this->input->post('smtp_host', true);
			$smtp_port        = $this->input->post('smtp_port', true);
			$smtp_username    = $this->input->post('smtp_username', true);
			$smtp_password    = $this->input->post('smtp_password', true);

        	$form_data = array(
				'send_email_from'  => $send_email_from,
				'receive_email_to' => $receive_email_to,
				'smtp_host'        => $smtp_host,
				'smtp_port'        => $smtp_port,
				'smtp_username'    => $smtp_username,
				'smtp_password'    => $smtp_password
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Email Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/setting');
		}

		if(isset($_POST['form_sidebar'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'sidebar_total_recent_post'    => $_POST['sidebar_total_recent_post'],
				'sidebar_total_upcoming_event' => $_POST['sidebar_total_upcoming_event'],
				'sidebar_total_past_event'     => $_POST['sidebar_total_past_event']
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Sidebar Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/setting');
		}

		if(isset($_POST['form_color'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'front_end_color' => $_POST['front_end_color']
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Front End Color Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/setting');
		}


		if(isset($_POST['form_language'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'language_status' => $_POST['language_status']
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Language Status Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/setting');
		}


		if(isset($_POST['form_other'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'website_name' => $_POST['website_name'],
				'preloader_status' => $_POST['preloader_status'],
				'tawk_live_chat_code' => $_POST['tawk_live_chat_code'],
				'tawk_live_chat_status' => $_POST['tawk_live_chat_status']
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Other Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/setting');
		}

		if(isset($_POST['form_banner_about'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_about']);
		    	$final_name = 'banner_about'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_about' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'About Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}

		if(isset($_POST['form_banner_faq'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_faq']);
		    	$final_name = 'banner_faq'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_faq' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'FAQ Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_service'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_service']);
		    	$final_name = 'banner_service'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_service' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Service Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_testimonial'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_testimonial']);
		    	$final_name = 'banner_testimonial'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_testimonial' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Testimonial Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_news'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_news']);
		    	$final_name = 'banner_news'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_news' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'News Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_event'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_event']);
		    	$final_name = 'banner_event'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_event' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Event Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_contact'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_contact']);
		    	$final_name = 'banner_contact'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_contact' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Contact Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_search'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_search']);
		    	$final_name = 'banner_search'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_search' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Search Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}



		if(isset($_POST['form_banner_terms'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_terms']);
		    	$final_name = 'banner_terms'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_terms' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Terms and Conditions Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}

		if(isset($_POST['form_banner_privacy'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_privacy']);
		    	$final_name = 'banner_privacy'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_privacy' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Privacy Policy Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}

		

		if(isset($_POST['form_banner_team'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_team']);
		    	$final_name = 'banner_team'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_team' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Team Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_portfolio'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_portfolio']);
		    	$final_name = 'banner_portfolio'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_portfolio' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Portfolio Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}
		

		if(isset($_POST['form_banner_verify_subscriber'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_verify_subscriber']);
		    	$final_name = 'banner_verify_subscriber'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_verify_subscriber' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Verify Subscriber Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_pricing'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_pricing']);
		    	$final_name = 'banner_pricing'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_pricing' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Pricing Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_banner_photo_gallery'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];
		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error = 'You must have to upload jpg, jpeg, gif or png file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error = 'You must have to select a photo<br>';
		    }
		    if($valid == 1) {
		    	unlink('./public/uploads/'.$data['setting']['banner_photo_gallery']);
		    	$final_name = 'banner_photo_gallery'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );		    			        
				$form_data = array(
					'banner_photo_gallery' => $final_name
	            );
	        	$this->Model_setting->update($form_data);
	        	$success = 'Photo Gallery Page Banner is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/setting');
		    }
		}


		if(isset($_POST['form_payment'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}
			
        	$form_data = array(
				'paypal_email'      => $_POST['paypal_email'],
				'stripe_public_key' => $_POST['stripe_public_key'],
				'stripe_secret_key' => $_POST['stripe_secret_key'],
				'bank_detail'       => $_POST['bank_detail']
            );
        	$this->Model_setting->update($form_data);   	
        	$success = 'Payment Setting is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/setting');
		}


		$data['setting'] = $this->Model_common->get_setting_data();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_setting',$data);
		$this->load->view('admin/view_footer');
	}
	
}
