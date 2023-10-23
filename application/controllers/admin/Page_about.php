<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_about extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_about');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_about'] = $this->Model_page_about->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_about',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_about->page_about_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-about');
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

			$about_heading = $this->input->post('about_heading', true);
			$about_content = $this->input->post('about_content', true);
			$mt_about = $this->input->post('mt_about', true);
			$mk_about = $this->input->post('mk_about', true);
			$md_about = $this->input->post('md_about', true);

			$this->form_validation->set_rules('about_heading', 'Heading', 'trim|required');
			$this->form_validation->set_rules('about_content', 'Content', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'about_heading' => $about_heading,
					'about_content' => $about_content,
					'mt_about' => $mt_about,
					'mk_about' => $mk_about,
					'md_about' => $md_about
	            );
	            $this->Model_page_about->update($id,$form_data);				
				
				$success = 'About Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-about');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-about/edit'.$id);
		    }
           
		} else {
			$data['page_about'] = $this->Model_page_about->get_page_about($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_about_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}
	
}
