<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_search extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_search');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_search'] = $this->Model_page_search->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_search',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_search->page_search_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-search');
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

			$search_heading = $this->input->post('search_heading', true);
			$mt_search = $this->input->post('mt_search', true);
			$mk_search = $this->input->post('mk_search', true);
			$md_search = $this->input->post('md_search', true);

			$this->form_validation->set_rules('search_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'search_heading' => $search_heading,
					'mt_search' => $mt_search,
					'mk_search' => $mk_search,
					'md_search' => $md_search
	            );
	            $this->Model_page_search->update($id,$form_data);				
				
				$success = 'Search Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-search');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-search/edit'.$id);
		    }
           
		} else {
			$data['page_search'] = $this->Model_page_search->get_page_search($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_search_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}
	
}
