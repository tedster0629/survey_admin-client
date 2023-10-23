<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_portfolio extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_portfolio');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_portfolio'] = $this->Model_page_portfolio->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_portfolio',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_portfolio->page_portfolio_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-portfolio');
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

			$portfolio_heading = $this->input->post('portfolio_heading', true);
			$mt_portfolio = $this->input->post('mt_portfolio', true);
			$mk_portfolio = $this->input->post('mk_portfolio', true);
			$md_portfolio = $this->input->post('md_portfolio', true);

			$this->form_validation->set_rules('portfolio_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'portfolio_heading' => $portfolio_heading,
					'mt_portfolio' => $mt_portfolio,
					'mk_portfolio' => $mk_portfolio,
					'md_portfolio' => $md_portfolio
	            );
	            $this->Model_page_portfolio->update($id,$form_data);				
				
				$success = 'Portfolio Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-portfolio');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-portfolio/edit'.$id);
		    }
           
		} else {
			$data['page_portfolio'] = $this->Model_page_portfolio->get_page_portfolio($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_portfolio_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}
	
}
