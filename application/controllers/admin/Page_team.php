<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_team extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_team');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_team'] = $this->Model_page_team->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_team',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_team->page_team_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-team');
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

			$team_heading = $this->input->post('team_heading', true);
			$mt_team = $this->input->post('mt_team', true);
			$mk_team = $this->input->post('mk_team', true);
			$md_team = $this->input->post('md_team', true);

			$this->form_validation->set_rules('team_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'team_heading' => $team_heading,
					'mt_team' => $mt_team,
					'mk_team' => $mk_team,
					'md_team' => $md_team
	            );
	            $this->Model_page_team->update($id,$form_data);				
				
				$success = 'Team Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-team');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-team/edit'.$id);
		    }
           
		} else {
			$data['page_team'] = $this->Model_page_team->get_page_team($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_team_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}
	
}
