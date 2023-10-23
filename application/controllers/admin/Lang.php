<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lang extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_lang');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['lang'] = $this->Model_lang->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_lang',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$data['setting'] = $this->Model_common->get_setting_data();

		$next_id = $this->Model_lang->get_auto_increment_id();
		foreach ($next_id as $row) {
            $ai_id = $row['Auto_increment'];
        }

		$lang_name = $this->input->post('lang_name', true);
		$lang_short_name = $this->input->post('lang_short_name', true);
		$layout_direction = $this->input->post('layout_direction', true);
		$lang_default = $this->input->post('lang_default', true);

		if(PROJECT_MODE == 1) {
			if($lang_default == 1)
			{
				// Update others as empty
				$arr = array(
					'lang_default' => ''
				);
				$this->Model_lang->make_all_empty($arr);

				// Make this one 'Yes'
				$lang_default = 'Yes';
			}
			else
			{
				$lang_default = '';	
			}
		}

		$error = '';
		$success = '';

		if(isset($_POST['form1'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$this->form_validation->set_rules('lang_name', 'Language Name', 'trim|required');
			$this->form_validation->set_rules('lang_short_name', 'Language Short Name', 'trim|required');
			$this->form_validation->set_rules('layout_direction', 'Layout Direction', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error = validation_errors();
            }

	   		if($valid == 1)
		    {
		        $form_data = array(
					'lang_name' => $lang_name,
					'lang_short_name' => $lang_short_name,
					'layout_direction' => $layout_direction,
					'lang_default' => $lang_default
	            );
	            $this->Model_lang->add($form_data);

	            $temp_arr = array(
	            	'HOME',
	            	'ABOUT',
	            	'TEAM',
	            	'PAGE',
	            	'EVENT',
	            	'PHOTO_GALLERY',
	            	'TESTIMONIAL',
	            	'FAQ',
	            	'PRICING_TABLE',
	            	'SERVICE',
	            	'PORTFOLIO',
	            	'NEWS',
	            	'CONTACT',
	            	'SEARCH_FOR',
	            	'READ_MORE',
	            	'SUBMIT',
	            	'FIRST_NAME',
	            	'LAST_NAME',
	            	'PHONE_NUMBER',
	            	'EMAIL_ADDRESS',
	            	'ADDRESS',
	            	'MESSAGE',
	            	'START_DATE',
	            	'END_DATE',
	            	'EVENT_START_DATE',
	            	'EVENT_END_DATE',
	            	'EVENT_LOCATION_MAP',
	            	'SHARE_THIS_EVENT',
	            	'SHARE_THIS_NEWS',
	            	'COMMENT',
	            	'NAME',
	            	'ALL',
	            	'PROJECT_OVERVIEW',
	            	'CATEGORY',
	            	'CLIENT_NAME',
	            	'CLIENT_COMPANY_NAME',
	            	'PROJECT_START_DATE',
	            	'PROJECT_END_DATE',
	            	'CLIENT_COMMENT',
	            	'NEWS_DATE',
	            	'RECENT_PORTFOLIO',
	            	'RECENT_PORTFOLIO_SUBTITLE',
	            	'CONTACT_FORM',
	            	'SEND_MESSAGE',
	            	'SUBJECT',
	            	'NO_RESULT_FOUND',
	            	'TERMS_AND_CONDITIONS',
	            	'PRIVACY_POLICY',
	            	'SUCCESS_SUBSCRIPTION',
	            	'FOOTER_1_HEADING',
	            	'FOOTER_2_HEADING',
	            	'FOOTER_3_HEADING',
	            	'FOOTER_4_HEADING',
	            	'SIDEBAR_NEWS_HEADING_1',
	            	'SIDEBAR_NEWS_HEADING_2',
	            	'SIDEBAR_EVENT_HEADING_1',
	            	'SIDEBAR_EVENT_HEADING_2',
	            	'SIDEBAR_SERVICE_HEADING_1',
	            	'SIDEBAR_SERVICE_HEADING_2',
	            	'SIDEBAR_PORTFOLIO_HEADING_1',
	            	'SIDEBAR_PORTFOLIO_HEADING_2',
	            	'ERROR_EMPTY_NAME',
	            	'ERROR_EMPTY_FIRST_NAME',
	            	'ERROR_EMPTY_LAST_NAME',
	            	'ERROR_EMPTY_PHONE',
	            	'ERROR_EMPTY_EMAIL',
	            	'ERROR_INVALID_EMAIL',
	            	'ERROR_EXIST_EMAIL',
	            	'ERROR_EMPTY_SUBJECT',
	            	'ERROR_EMPTY_MESSAGE',
	            	'ERROR_EMPTY_CAPTCHA',
	            	'ERROR_INCORRECT_CAPTCHA',
	            	'SUCCESS_CONTACT_FORM',
	            	'SUCCESS_SUBSCRIPTION_FORM',
	            	'SUCCESS_SERVICE_PAGE_FORM',
	            	'SUCCESS_PORTFOLIO_PAGE_FORM'
	            );

	            for($i=0;$i<count($temp_arr);$i++)
	            {
	            	$form_data = array(
	            		'lang_string' => $temp_arr[$i],
	            		'lang_string_value' => '',
	            		'lang_id' => $ai_id
		            );
		            $this->Model_lang->add_detail($form_data);
	            }


	            // Adding Item in tbl_page_home
	            $form_data = array(
            		'title' => 'Home Page',
            		'meta_keyword' => '',
            		'meta_description' => '',
            		'home_welcome_title' => '',
            		'home_welcome_subtitle' => '',
            		'home_welcome_text' => '',
            		'home_welcome_pbar1_text' => '',
            		'home_welcome_pbar1_value' => '',
            		'home_welcome_pbar2_text' => '',
            		'home_welcome_pbar2_value' => '',
            		'home_welcome_pbar3_text' => '',
            		'home_welcome_pbar3_value' => '',
            		'home_welcome_pbar4_text' => '',
            		'home_welcome_pbar4_value' => '',
            		'home_welcome_pbar5_text' => '',
            		'home_welcome_pbar5_value' => '',
            		'home_why_choose_title' => '',
            		'home_why_choose_subtitle' => '',
            		'home_feature_title' => '',
            		'home_feature_subtitle' => '',
            		'home_service_title' => '',
            		'home_service_subtitle' => '',
            		'counter_1_title' => '',
            		'counter_1_value' => '',
            		'counter_1_icon' => '',
            		'counter_2_title' => '',
            		'counter_2_value' => '',
            		'counter_2_icon' => '',
            		'counter_3_title' => '',
            		'counter_3_value' => '',
            		'counter_3_icon' => '',
            		'counter_4_title' => '',
            		'counter_4_value' => '',
            		'counter_4_icon' => '',
            		'home_portfolio_title' => '',
            		'home_portfolio_subtitle' => '',
            		'home_booking_form_title' => '',
            		'home_booking_faq_title' => '',
            		'home_team_title' => '',
            		'home_team_subtitle' => '',
            		'home_ptable_title' => '',
            		'home_ptable_subtitle' => '',
            		'home_testimonial_title' => '',
            		'home_testimonial_subtitle' => '',
            		'home_blog_title' => '',
            		'home_blog_subtitle' => '',
            		'home_cta_text' => '',
            		'home_cta_button_text' => '',
            		'home_cta_button_url' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_home($form_data);


	            // Adding Item in tbl_page_about
	            $form_data = array(
            		'about_heading' => 'About Heading',
            		'about_content' => 'About Content',
            		'mt_about' => '',
            		'mk_about' => '',
            		'md_about' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_about($form_data);


	            // Adding Item in tbl_page_faq
	            $form_data = array(
            		'faq_heading' => 'FAQ Heading',
            		'mt_faq' => '',
            		'mk_faq' => '',
            		'md_faq' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_faq($form_data);


	            // Adding Item in tbl_page_service
	            $form_data = array(
            		'service_heading' => 'Service Heading',
            		'mt_service' => '',
            		'mk_service' => '',
            		'md_service' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_service($form_data);


	            // Adding Item in tbl_page_testimonial
	            $form_data = array(
            		'testimonial_heading' => 'Testimonial Heading',
            		'mt_testimonial' => '',
            		'mk_testimonial' => '',
            		'md_testimonial' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_testimonial($form_data);


	            // Adding Item in tbl_page_news
	            $form_data = array(
            		'news_heading' => 'News Heading',
            		'mt_news' => '',
            		'mk_news' => '',
            		'md_news' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_news($form_data);


	            // Adding Item in tbl_page_event
	            $form_data = array(
            		'event_heading' => 'Event Heading',
            		'mt_event' => '',
            		'mk_event' => '',
            		'md_event' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_event($form_data);


	            // Adding Item in tbl_page_search
	            $form_data = array(
            		'search_heading' => 'Search Heading',
            		'mt_search' => '',
            		'mk_search' => '',
            		'md_search' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_search($form_data);


	            // Adding Item in tbl_page_term
	            $form_data = array(
            		'term_heading' => 'Term Heading',
            		'term_content' => 'Term Content',
            		'mt_term' => '',
            		'mk_term' => '',
            		'md_term' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_term($form_data);


	            // Adding Item in tbl_page_privacy
	            $form_data = array(
            		'privacy_heading' => 'Privacy Heading',
            		'privacy_content' => 'Privacy Content',
            		'mt_privacy' => '',
            		'mk_privacy' => '',
            		'md_privacy' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_privacy($form_data);


	            // Adding Item in tbl_page_team
	            $form_data = array(
            		'team_heading' => 'Team Heading',
            		'mt_team' => '',
            		'mk_team' => '',
            		'md_team' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_team($form_data);

	            // Adding Item in tbl_page_portfolio
	            $form_data = array(
            		'portfolio_heading' => 'Portfolio Heading',
            		'mt_portfolio' => '',
            		'mk_portfolio' => '',
            		'md_portfolio' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_portfolio($form_data);

	            // Adding Item in tbl_page_photo_gallery
	            $form_data = array(
            		'photo_gallery_heading' => 'Photo Gallery Heading',
            		'mt_photo_gallery' => '',
            		'mk_photo_gallery' => '',
            		'md_photo_gallery' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_photo_gallery($form_data);

	            // Adding Item in tbl_page_pricing
	            $form_data = array(
            		'pricing_heading' => 'Pricing Heading',
            		'mt_pricing' => '',
            		'mk_pricing' => '',
            		'md_pricing' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_pricing($form_data);


	            // Adding Item in tbl_page_contact
	            $form_data = array(
            		'contact_heading' => 'Contact Heading',
            		'contact_address' => '',
            		'contact_email' => '',
            		'contact_phone' => '',
            		'contact_map' => '',
            		'mt_contact' => '',
            		'mk_contact' => '',
            		'md_contact' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_page_contact($form_data);


	            // Adding Item in tbl_footer
	            $form_data = array(
            		'footer_copyright' => '',
            		'footer_address' => '',
            		'footer_email' => '',
            		'footer_phone' => '',
            		'newsletter_text' => '',
            		'cta_text' => '',
            		'cta_button_text' => '',
            		'cta_button_url' => '',
            		'lang_id' => $ai_id
	            );
	            $this->Model_lang->add_footer_setting($form_data);


		        $success = 'Language is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/lang');		        
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/lang/add');
		    }
            
        } else {
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_lang_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
    	$tot = $this->Model_lang->lang_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/lang');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();

       	$error = '';
		$success = '';

       	$lang_name = $this->input->post('lang_name', true);
		$lang_short_name = $this->input->post('lang_short_name', true);
		$layout_direction = $this->input->post('layout_direction', true);
		$lang_default = $this->input->post('lang_default', true);

		if(PROJECT_MODE == 1) {
			if($lang_default == 1)
			{
				// Update others as empty
				$arr = array(
					'lang_default' => ''
				);
				$this->Model_lang->make_all_empty($arr);

				// Make this one 'Yes'
				$lang_default = 'Yes';
			}
			else
			{
				$lang_default = '';	
			}
		}

		if(isset($_POST['form1'])) 
		{
			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}
			
			$valid = 1;

			$this->form_validation->set_rules('lang_name', 'Language Name', 'trim|required');
			$this->form_validation->set_rules('lang_short_name', 'Language Short Name', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error = validation_errors();
            }
            
		    if($valid == 1) 
		    {
		    	$data['faq'] = $this->Model_lang->getData($id);

	    		$form_data = array(
					'lang_name'  => $lang_name,
					'lang_short_name'=> $lang_short_name,
					'layout_direction'=> $layout_direction,
					'lang_default' => $lang_default
	            );
	            $this->Model_lang->update($id,$form_data);
				
				$success = 'Language is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/lang');
		    }
		    else 
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/lang/add');
		    }

          
		} else {
			$data['lang'] = $this->Model_lang->getData($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_lang_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}

	public function delete($id)
	{
    	$tot = $this->Model_lang->lang_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/lang');
        	exit;
    	}

		if(PROJECT_MODE == 0) {
			$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
			redirect($_SERVER['HTTP_REFERER']);
		}


    	// Check first if you this lang_id is in other tables.
    	$check_1 = $this->Model_lang->check_category_for_lang_id($id);
    	$check_2 = $this->Model_lang->check_event_for_lang_id($id);
    	$check_3 = $this->Model_lang->check_faq_for_lang_id($id);
    	$check_4 = $this->Model_lang->check_feature_for_lang_id($id);
    	$check_5 = $this->Model_lang->check_news_for_lang_id($id);
    	$check_6 = $this->Model_lang->check_portfolio_for_lang_id($id);
    	$check_7 = $this->Model_lang->check_portfolio_category_for_lang_id($id);
    	$check_8 = $this->Model_lang->check_pricing_table_for_lang_id($id);
    	$check_9 = $this->Model_lang->check_service_for_lang_id($id);
    	$check_10 = $this->Model_lang->check_slider_for_lang_id($id);
    	$check_11 = $this->Model_lang->check_team_member_for_lang_id($id);
    	$check_12 = $this->Model_lang->check_testimonial_for_lang_id($id);
    	$check_13 = $this->Model_lang->check_why_choose_for_lang_id($id);

    	

    	if( (!$check_1) && 
    		(!$check_2) && 
    		(!$check_3) && 
    		(!$check_4) && 
    		(!$check_5) && 
    		(!$check_6) && 
    		(!$check_7) && 
    		(!$check_8) && 
    		(!$check_9) && 
    		(!$check_10) && 
    		(!$check_11) && 
    		(!$check_12) && 
    		(!$check_13)
    	)
    	{
    		$this->Model_lang->delete($id);
	        $this->Model_lang->delete_detail($id);

			$this->Model_lang->delete_from_footer($id);
			$this->Model_lang->delete_from_page_about($id);
			$this->Model_lang->delete_from_page_contact($id);
			$this->Model_lang->delete_from_page_event($id);
			$this->Model_lang->delete_from_page_faq($id);
			$this->Model_lang->delete_from_page_home($id);
			$this->Model_lang->delete_from_page_news($id);
			$this->Model_lang->delete_from_page_photo_gallery($id);
			$this->Model_lang->delete_from_page_portfolio($id);
			$this->Model_lang->delete_from_page_pricing($id);
			$this->Model_lang->delete_from_page_privacy($id);
			$this->Model_lang->delete_from_page_search($id);
			$this->Model_lang->delete_from_page_service($id);
			$this->Model_lang->delete_from_page_team($id);
			$this->Model_lang->delete_from_page_term($id);
			$this->Model_lang->delete_from_page_testimonial($id);

	        $success = 'Language is deleted successfully';
			$this->session->set_flashdata('success',$success);
    	}
    	else
    	{
    		$error = 'This language can not be deleted because this is used in other tables';
			$this->session->set_flashdata('error',$error);
    	}
        
		redirect(base_url().'admin/lang');
    }

    public function detail($id)
    {
    	$tot = $this->Model_lang->lang_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/lang');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();

       	$error = '';
		$success = '';

		if(isset($_POST['form1'])) 
		{
			foreach ($_POST['new_arr'] as $val) {
				$new_arr2[] = $val;
			}

			foreach ($_POST['new_arr1'] as $val) {
				$new_arr3[] = $val;
			}

			for($i=0;$i<count($new_arr2);$i++) {
							
				$form_data = array(
					'lang_string_value' => $new_arr2[$i]
	            );
	            $this->Model_lang->update_detail($new_arr3[$i],$form_data);
			}

	    	$data['lang_detail'] = $this->Model_lang->detail($_POST['id']);
			
			$success = 'Language detail is updated successfully';
			$this->session->set_flashdata('success',$success);
			redirect(base_url().'admin/lang/detail/'.$id);
		}
		else
		{
			$data['lang_detail'] = $this->Model_lang->detail($id);
			$data['id'] = $id;
			$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_lang_detail',$data);
			$this->load->view('admin/view_footer');	
		}
		
    }


    function change($short_name)
    {

		if(PROJECT_MODE == 0) {
			$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
			redirect($_SERVER['HTTP_REFERER']);
		}

    	if($short_name == 'EN')
    	{
			$_SESSION['admin_sess_lang'] = 'EN';
    	}
    	elseif($short_name == 'AR')
    	{
    		$_SESSION['admin_sess_lang'] = 'AR';	
    	}
    	else
    	{
    		$_SESSION['admin_sess_lang'] = 'EN';
    	}

    	redirect($this->agent->referrer());
    }

}