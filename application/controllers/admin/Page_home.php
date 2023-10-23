<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_home extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_home');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_home'] = $this->Model_page_home->show();
		$data['page_home_lang_independent'] = $this->Model_page_home->show_lang_independent();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_home',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_home->page_home_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-home');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
		$error = '';
		$success = '';


		if(isset($_POST['form1'])) 
		{
			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$title = $this->input->post('title', true);
			$meta_keyword = $this->input->post('meta_keyword', true);
			$meta_description = $this->input->post('meta_description', true);
			$home_welcome_title = $this->input->post('home_welcome_title', true);
			$home_welcome_subtitle = $this->input->post('home_welcome_subtitle', true);
			$home_welcome_text = $this->input->post('home_welcome_text', true);
			$home_welcome_pbar1_text = $this->input->post('home_welcome_pbar1_text', true);
			$home_welcome_pbar1_value = $this->input->post('home_welcome_pbar1_value', true);
			$home_welcome_pbar2_text = $this->input->post('home_welcome_pbar2_text', true);
			$home_welcome_pbar2_value = $this->input->post('home_welcome_pbar2_value', true);
			$home_welcome_pbar3_text = $this->input->post('home_welcome_pbar3_text', true);
			$home_welcome_pbar3_value = $this->input->post('home_welcome_pbar3_value', true);
			$home_welcome_pbar4_text = $this->input->post('home_welcome_pbar4_text', true);
			$home_welcome_pbar4_value = $this->input->post('home_welcome_pbar4_value', true);
			$home_welcome_pbar5_text = $this->input->post('home_welcome_pbar5_text', true);
			$home_welcome_pbar5_value = $this->input->post('home_welcome_pbar5_value', true);
			$home_why_choose_title = $this->input->post('home_why_choose_title', true);
			$home_why_choose_subtitle = $this->input->post('home_why_choose_subtitle', true);
			$home_feature_title = $this->input->post('home_feature_title', true);
			$home_feature_subtitle = $this->input->post('home_feature_subtitle', true);
			$home_service_title = $this->input->post('home_service_title', true);
			$home_service_subtitle = $this->input->post('home_service_subtitle', true);
			$counter_1_title = $this->input->post('counter_1_title', true);
			$counter_1_value = $this->input->post('counter_1_value', true);
			$counter_1_icon = $this->input->post('counter_1_icon', true);
			$counter_2_title = $this->input->post('counter_2_title', true);
			$counter_2_value = $this->input->post('counter_2_value', true);
			$counter_2_icon = $this->input->post('counter_2_icon', true);
			$counter_3_title = $this->input->post('counter_3_title', true);
			$counter_3_value = $this->input->post('counter_3_value', true);
			$counter_3_icon = $this->input->post('counter_3_icon', true);
			$counter_4_title = $this->input->post('counter_4_title', true);
			$counter_4_value = $this->input->post('counter_4_value', true);
			$counter_4_icon = $this->input->post('counter_4_icon', true);
			$home_portfolio_title = $this->input->post('home_portfolio_title', true);
			$home_portfolio_subtitle = $this->input->post('home_portfolio_subtitle', true);
			$home_booking_form_title = $this->input->post('home_booking_form_title', true);
			$home_booking_faq_title = $this->input->post('home_booking_faq_title', true);
			$home_team_title = $this->input->post('home_team_title', true);
			$home_team_subtitle = $this->input->post('home_team_subtitle', true);
			$home_ptable_title = $this->input->post('home_ptable_title', true);
			$home_ptable_subtitle = $this->input->post('home_ptable_subtitle', true);
			$home_testimonial_title = $this->input->post('home_testimonial_title', true);
			$home_testimonial_subtitle = $this->input->post('home_testimonial_subtitle', true);
			$home_blog_title = $this->input->post('home_blog_title', true);
			$home_blog_subtitle = $this->input->post('home_blog_subtitle', true);

			$this->form_validation->set_rules('title', 'Title', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'title' => $title,
					'meta_keyword' => $meta_keyword,
					'meta_description' => $meta_description,
					'home_welcome_title' => $home_welcome_title,
					'home_welcome_subtitle' => $home_welcome_subtitle,
					'home_welcome_text' => $home_welcome_text,
					'home_welcome_pbar1_text' => $home_welcome_pbar1_text,
					'home_welcome_pbar1_value' => $home_welcome_pbar1_value,
					'home_welcome_pbar2_text' => $home_welcome_pbar2_text,
					'home_welcome_pbar2_value' => $home_welcome_pbar2_value,
					'home_welcome_pbar3_text' => $home_welcome_pbar3_text,
					'home_welcome_pbar3_value' => $home_welcome_pbar3_value,
					'home_welcome_pbar4_text' => $home_welcome_pbar4_text,
					'home_welcome_pbar4_value' => $home_welcome_pbar4_value,
					'home_welcome_pbar5_text' => $home_welcome_pbar5_text,
					'home_welcome_pbar5_value' => $home_welcome_pbar5_value,
					'home_why_choose_title' => $home_why_choose_title,
					'home_why_choose_subtitle' => $home_why_choose_subtitle,
					'home_feature_title' => $home_feature_title,
					'home_feature_subtitle' => $home_feature_subtitle,
					'home_service_title' => $home_service_title,
					'home_service_subtitle' => $home_service_subtitle,
					'counter_1_title' => $counter_1_title,
					'counter_1_value' => $counter_1_value,
					'counter_1_icon' => $counter_1_icon,
					'counter_2_title' => $counter_2_title,
					'counter_2_value' => $counter_2_value,
					'counter_2_icon' => $counter_2_icon,
					'counter_3_title' => $counter_3_title,
					'counter_3_value' => $counter_3_value,
					'counter_3_icon' => $counter_3_icon,
					'counter_4_title' => $counter_4_title,
					'counter_4_value' => $counter_4_value,
					'counter_4_icon' => $counter_4_icon,
					'home_portfolio_title' => $home_portfolio_title,
					'home_portfolio_subtitle' => $home_portfolio_subtitle,
					'home_booking_form_title' => $home_booking_form_title,
					'home_booking_faq_title' => $home_booking_faq_title,
					'home_team_title' => $home_team_title,
					'home_team_subtitle' => $home_team_subtitle,
					'home_ptable_title' => $home_ptable_title,
					'home_ptable_subtitle' => $home_ptable_subtitle,
					'home_testimonial_title' => $home_testimonial_title,
					'home_testimonial_subtitle' => $home_testimonial_subtitle,
					'home_blog_title' => $home_blog_title,
					'home_blog_subtitle' => $home_blog_subtitle
	            );
	            $this->Model_page_home->update($id,$form_data);				
				
				$success = 'Home Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-home');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-home/edit'.$id);
		    }
           
		} else {
			$data['page_home'] = $this->Model_page_home->get_page_home($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_home_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function update()
	{
		$error = '';
		$success = '';

		if(isset($_POST['form_home_welcome'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'home_welcome_video'  => $_POST['home_welcome_video'],
				'home_welcome_status' => $_POST['home_welcome_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page welcome information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}

		if(isset($_POST['form_home_welcome_video_bg'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['home_welcome_video_bg']['name'];
		    $path_tmp = $_FILES['home_welcome_video_bg']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['page']['home_welcome_video_bg']);

		    	$final_name = 'home_welcome_video_bg'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'home_welcome_video_bg' => $final_name
	            );
	        	$this->Model_page_home->update_home($form_data);

	        	$success = 'Home page welcome video background is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/page-home');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/page-home');
		    }
		}



		if(isset($_POST['form_home_why_choose'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'home_why_choose_status' => $_POST['home_why_choose_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page why choose us information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}


		if(isset($_POST['form_home_feature'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'home_feature_status' => $_POST['home_feature_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page feature information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}

		if(isset($_POST['form_home_service'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'home_service_status' => $_POST['home_service_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page service information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}


		if(isset($_POST['form_home_counter_text'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'counter_status' => $_POST['counter_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page counter information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}

		if(isset($_POST['form_home_counter_photo'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['counter_photo']['name'];
		    $path_tmp = $_FILES['counter_photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['page']['counter_photo']);
		    	$final_name = 'counter'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'counter_photo' => $final_name
	            );
	        	$this->Model_page_home->update_home($form_data);

	        	$success = 'Home page counter photo is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/page-home');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/page-home');
		    }
		}

		if(isset($_POST['form_home_portfolio'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'home_portfolio_status' => $_POST['home_portfolio_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page portfolio information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}

		if(isset($_POST['form_home_booking'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'home_booking_status' => $_POST['home_booking_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page booking information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}


		if(isset($_POST['form_home_booking_photo'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['home_booking_photo']['name'];
		    $path_tmp = $_FILES['home_booking_photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['page']['home_booking_photo']);

		    	// updating the data
		    	$final_name = 'home_booking_photo'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'home_booking_photo' => $final_name
	            );
	        	$this->Model_page_home->update_home($form_data);

	        	$success = 'Home page booking photo is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/page-home');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/page-home');
		    }
		}




		if(isset($_POST['form_home_team'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'home_team_status' => $_POST['home_team_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page team information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}

		if(isset($_POST['form_home_pricing_table'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'home_ptable_status' => $_POST['home_ptable_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page pricing table information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}

		if(isset($_POST['form_home_testimonial'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'home_testimonial_status' => $_POST['home_testimonial_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page testimonial information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}

		if(isset($_POST['form_home_testimonial_photo'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$path = $_FILES['home_testimonial_photo']['name'];
		    $path_tmp = $_FILES['home_testimonial_photo']['tmp_name'];
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
		    	unlink('./public/uploads/'.$data['page']['home_testimonial_photo']);

		    	// updating the data
		    	$final_name = 'home_testimonial_photo'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'home_testimonial_photo' => $final_name
	            );
	        	$this->Model_page_home->update_home($form_data);

	        	$success = 'Home page testimonial photo is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/page-home');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/page-home');
		    }
		}


		if(isset($_POST['form_home_blog'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}
			
        	$form_data = array(
				'home_blog_item'   => $_POST['home_blog_item'],
				'home_blog_status' => $_POST['home_blog_status']
            );
        	$this->Model_page_home->update_home($form_data);
        	$success = 'Home page blog information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/page-home');
		}




	}
	
}
