<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_privacy extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_privacy');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_privacy'] = $this->Model_page_privacy->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_privacy',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_privacy->page_privacy_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-privacy');
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

			$privacy_heading = $this->input->post('privacy_heading', true);
			$privacy_content = $this->input->post('privacy_content', true);
			$mt_privacy = $this->input->post('mt_privacy', true);
			$mk_privacy = $this->input->post('mk_privacy', true);
			$md_privacy = $this->input->post('md_privacy', true);

			$this->form_validation->set_rules('privacy_heading', 'Heading', 'trim|required');
			$this->form_validation->set_rules('privacy_content', 'Content', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'privacy_heading' => $privacy_heading,
					'privacy_content' => $privacy_content,
					'mt_privacy' => $mt_privacy,
					'mk_privacy' => $mk_privacy,
					'md_privacy' => $md_privacy
	            );
	            $this->Model_page_privacy->update($id,$form_data);				
				
				$success = 'Privacy Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-privacy');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-privacy/edit'.$id);
		    }
           
		} else {
			$data['page_privacy'] = $this->Model_page_privacy->get_page_privacy($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_privacy_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}
	
}
