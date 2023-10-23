<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_testimonial extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_testimonial');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_testimonial'] = $this->Model_page_testimonial->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_testimonial',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_testimonial->page_testimonial_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-testimonial');
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

			$testimonial_heading = $this->input->post('testimonial_heading', true);
			$mt_testimonial = $this->input->post('mt_testimonial', true);
			$mk_testimonial = $this->input->post('mk_testimonial', true);
			$md_testimonial = $this->input->post('md_testimonial', true);

			$this->form_validation->set_rules('testimonial_heading', 'Heading', 'trim|required');
			
			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'testimonial_heading' => $testimonial_heading,
					'mt_testimonial' => $mt_testimonial,
					'mk_testimonial' => $mk_testimonial,
					'md_testimonial' => $md_testimonial
	            );
	            $this->Model_page_testimonial->update($id,$form_data);				
				
				$success = 'Testimonial Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-testimonial');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-testimonial/edit'.$id);
		    }
           
		} else {
			$data['page_testimonial'] = $this->Model_page_testimonial->get_page_testimonial($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_testimonial_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}
	
}
