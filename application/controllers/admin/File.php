<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_file');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();

		$data['file'] = $this->Model_file->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_file',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$data['setting'] = $this->Model_common->get_setting_data();

		$error = '';
		$success = '';

		if(isset($_POST['form1'])) {

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$this->form_validation->set_rules('file_title', 'File Title', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['file_name']['name'];
		    $path_tmp = $_FILES['file_name']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $fn = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_file($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif, png, pdf, doc, docx, xls, xlsx, csv file<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error .= 'You must have to select a file<br>';
		    }

		    if($valid == 1) 
		    {
				$next_id = $this->Model_file->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        $final_name = 'file-'.$ai_id.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        $form_data = array(
					'file_name' => $final_name,
					'file_title' => $_POST['file_title']
	            );
	            $this->Model_file->add($form_data);

		        $success = 'File is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/file');
		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/file/add');
		    }
            
        } else {
            
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_file_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	// If there is no file in this id, then redirect
    	$tot = $this->Model_file->file_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/file');
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

			$this->form_validation->set_rules('file_title', 'File title', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['file_name']['name'];
		    $path_tmp = $_FILES['file_name']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $fn = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_file($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif, png, pdf, doc, docx, xls, xlsx, csv file<br>';
		        }
		    }

		    if($valid == 1) 
		    {
		    	$data['file'] = $this->Model_file->get_file($id);

		    	if($path == '') {
		    		$form_data = array(
						'file_title' => $_POST['file_title']
		            );
		            $this->Model_file->update($id,$form_data);
				}
				else {
					unlink('./public/uploads/'.$data['file']['photo']);

					$final_name = 'file-'.$id.'.'.$ext;
		        	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        	$form_data = array(
						'file_name' => $final_name,
						'file_title'  => $_POST['file_title'],
		            );
		            $this->Model_file->update($id,$form_data);
				}
				
				$success = 'File is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/file');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/file/edit'.$id);
		    }
           
		} else {
			$data['file'] = $this->Model_file->get_file($id);
	       	$this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_file_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
    	$tot = $this->Model_file->file_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/file');
        	exit;
    	}

		if(PROJECT_MODE == 0) {
			$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
			redirect($_SERVER['HTTP_REFERER']);
		}

        $data['file'] = $this->Model_file->get_file($id);
        if($data['file']) {
            unlink('./public/uploads/'.$data['file']['file_name']);
        }

        $this->Model_file->delete($id);
        $success = 'File is deleted successfully';
		$this->session->set_flashdata('success',$success);
        redirect(base_url().'admin/file');
    }

}