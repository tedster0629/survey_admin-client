<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_news extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_news');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_news'] = $this->Model_page_news->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_news',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_news->page_news_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-news');
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

			$news_heading = $this->input->post('news_heading', true);
			$mt_news = $this->input->post('mt_news', true);
			$mk_news = $this->input->post('mk_news', true);
			$md_news = $this->input->post('md_news', true);

			$this->form_validation->set_rules('news_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'news_heading' => $news_heading,
					'mt_news' => $mt_news,
					'mk_news' => $mk_news,
					'md_news' => $md_news
	            );
	            $this->Model_page_news->update($id,$form_data);				
				
				$success = 'News Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-news');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-news/edit'.$id);
		    }
           
		} else {
			$data['page_news'] = $this->Model_page_news->get_page_news($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_news_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}
	
}
