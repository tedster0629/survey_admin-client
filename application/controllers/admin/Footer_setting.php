<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer_setting extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_footer_setting');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['footer_setting'] = $this->Model_footer_setting->show();
		$data['footer_setting_lang_independent'] = $this->Model_footer_setting->show_lang_independent();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_footer_setting',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_footer_setting->footer_setting_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/footer-setting');
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

			$footer_copyright = $this->input->post('footer_copyright', true);
			$footer_address = $this->input->post('footer_address', true);
			$footer_email = $this->input->post('footer_email', true);
			$footer_phone = $this->input->post('footer_phone', true);
			$newsletter_text = $this->input->post('newsletter_text', true);
			$cta_text = $this->input->post('cta_text', true);
			$cta_button_text = $this->input->post('cta_button_text', true);
			$cta_button_url = $this->input->post('cta_button_url', true);
			
			if($valid == 1) 
		    {
	    		$form_data = array(
					'footer_copyright' => $footer_copyright,
					'footer_address' => $footer_address,
					'footer_email' => $footer_email,
					'footer_phone' => $footer_phone,
					'newsletter_text' => $newsletter_text,
					'cta_text' => $cta_text,
					'cta_button_text' => $cta_button_text,
					'cta_button_url' => $cta_button_url
	            );
	            $this->Model_footer_setting->update($id,$form_data);				
				
				$success = 'Footer information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/footer-setting');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/footer-setting/edit'.$id);
		    }
           
		} else {
			$data['footer_setting'] = $this->Model_footer_setting->get_footer_setting($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_footer_setting_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function update()
	{
		$error = '';
		$success = '';

		if(isset($_POST['form_footer_general'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

        	$form_data = array(
				'footer_recent_news_item'  => $_POST['footer_recent_news_item'],
				'footer_recent_portfolio_item' => $_POST['footer_recent_portfolio_item']
            );
        	$this->Model_footer_setting->update_footer_setting($form_data);
        	$success = 'Footer General information is updated successfully!';
        	$this->session->set_flashdata('success',$success);
		    redirect(base_url().'admin/footer-setting');
		}

		if(isset($_POST['form_footer_cta_bg'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}
			
			$valid = 1;
			$path = $_FILES['cta_background']['name'];
		    $path_tmp = $_FILES['cta_background']['tmp_name'];
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
		    	unlink('./public/uploads/'.$_POST['previous_photo']);

		    	$final_name = 'cta_background'.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );
		    			        
				$form_data = array(
					'cta_background' => $final_name
	            );
	        	$this->Model_footer_setting->update_footer_setting($form_data);

	        	$success = 'Footer CTA Background is updated successfully!';
		    	$this->session->set_flashdata('success',$success);
		    	redirect(base_url().'admin/footer-setting');
		    } else {
		    	$this->session->set_flashdata('error',$error);
		    	redirect(base_url().'admin/footer-setting');
		    }
		}


	}
	
}
