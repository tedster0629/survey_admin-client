<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_contact extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_contact');
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_contact'] = $this->Model_page_contact->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_contact',$data);
		$this->load->view('admin/view_footer');
		
	}

	public function edit($id)
	{
		
    	$tot = $this->Model_page_contact->page_contact_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-contact');
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

			$contact_heading = $this->input->post('contact_heading', true);
			$contact_address = $this->input->post('contact_address', true);
			$contact_email = $this->input->post('contact_email', true);
			$contact_phone = $this->input->post('contact_phone', true);
			$contact_map = $this->input->post('contact_map');
			$mt_contact = $this->input->post('mt_contact', true);
			$mk_contact = $this->input->post('mk_contact', true);
			$md_contact = $this->input->post('md_contact', true);

			$this->form_validation->set_rules('contact_heading', 'Heading', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
	    		$form_data = array(
					'contact_heading' => $contact_heading,
					'contact_address' => $contact_address,
					'contact_email' => $contact_email,
					'contact_phone' => $contact_phone,
					'contact_map' => $contact_map,
					'mt_contact' => $mt_contact,
					'mk_contact' => $mk_contact,
					'md_contact' => $md_contact
	            );
	            $this->Model_page_contact->update($id,$form_data);				
				
				$success = 'Contact Page information is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-contact');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-contact/edit'.$id);
		    }
           
		} else {
			$data['page_contact'] = $this->Model_page_contact->get_page_contact($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_contact_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}
	
}
