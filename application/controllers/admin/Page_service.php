<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_service extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_service');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_service'] = $this->Model_page_service->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_service',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_service->page_service_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-service');
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

			$service_heading = $this->input->post('service_heading', true);
			$mt_service = $this->input->post('mt_service', true);
			$mk_service = $this->input->post('mk_service', true);
			$md_service = $this->input->post('md_service', true);

			$this->form_validation->set_rules('service_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'service_heading' => $service_heading,
					'mt_service' => $mt_service,
					'mk_service' => $mk_service,
					'md_service' => $md_service
	            );
	            $this->Model_page_service->update($id,$form_data);				
				
				$success = 'Service Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-service');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-service/edit'.$id);
		    }
           
		} else {
			$data['page_service'] = $this->Model_page_service->get_page_service($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_service_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}
	
}
