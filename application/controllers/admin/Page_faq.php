<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_faq extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_faq');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_faq'] = $this->Model_page_faq->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_faq',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_faq->page_faq_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-faq');
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

			$faq_heading = $this->input->post('faq_heading', true);
			$mt_faq = $this->input->post('mt_faq', true);
			$mk_faq = $this->input->post('mk_faq', true);
			$md_faq = $this->input->post('md_faq', true);

			$this->form_validation->set_rules('faq_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'faq_heading' => $faq_heading,
					'mt_faq'      => $mt_faq,
					'mk_faq'      => $mk_faq,
					'md_faq'      => $md_faq
	            );
	            $this->Model_page_faq->update($id,$form_data);				
				
				$success = 'FAQ Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-faq');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-faq/edit'.$id);
		    }
           
		} else {
			$data['page_faq'] = $this->Model_page_faq->get_page_faq($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_faq_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}
	
}
