<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_dynamic extends MY_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_page_dynamic');
    }

	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['page_dynamic'] = $this->Model_page_dynamic->show();

		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_page_dynamic',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$data['all_lang'] = $this->Model_common->all_lang();
		
		$error = '';
		$success = '';

		if(isset($_POST['form1'])) 
		{

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$name = $this->input->post('name', true);
			$slug = $this->input->post('slug', true);
			$content = $this->input->post('content', true);
			$meta_title = $this->input->post('meta_title', true);
			$meta_description = $this->input->post('meta_description', true);
			$lang_id  = $this->input->post('lang_id', true);

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['banner']['name'];
		    $path_tmp = $_FILES['banner']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for banner<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error .= 'You must have to select a photo for banner<br>';
		    }


		    if($valid == 1) 
		    {
				$next_id = $this->Model_page_dynamic->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        if($slug == '') {
		    		$temp_string = strtolower($name);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($slug);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_page_dynamic->slug_duplication_check($slug);
				if($tot_slug) {
					$slug = $slug.'-1';
				}

		        $final_name = 'page-dynamic-banner-'.$ai_id.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        $form_data = array(
					'name'             => $name,
					'slug'             => $slug,
					'content'          => $content,
					'banner'           => $final_name,
					'meta_title'       => $meta_title,
					'meta_description' => $meta_description,
					'lang_id'          => $lang_id
	            );
	            $this->Model_page_dynamic->add($form_data);

		        $success = 'Dynamic Page is added successfully!';
		        $this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-dynamic');
		    } 
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-dynamic/add');
		    }
            
        } else {
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_dynamic_add',$data);
			$this->load->view('admin/view_footer');
        }		
	}


	public function edit($id)
	{
    	// If there is no post in this id, then redirect
    	$tot = $this->Model_page_dynamic->page_dynamic_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-dynamic');
        	exit;
    	}
       	
       	$data['setting'] = $this->Model_common->get_setting_data();
       	$data['all_lang'] = $this->Model_common->all_lang();
		$error = '';
		$success = '';

		if(isset($_POST['form1'])) 
		{

			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$name = $this->input->post('name', true);
			$slug = $this->input->post('slug', true);
			$content = $this->input->post('content', true);
			$meta_title = $this->input->post('meta_title', true);
			$meta_description = $this->input->post('meta_description', true);
			$lang_id  = $this->input->post('lang_id', true);

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['banner']['name'];
		    $path_tmp = $_FILES['banner']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_common->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for banner<br>';
		        }
		    }

		    if($valid == 1) 
		    {
		    	$data['page_dynamic'] = $this->Model_page_dynamic->getData($id);

		    	if($slug == '') {
		    		$temp_string = strtolower($name);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	} else {
		    		$temp_string = strtolower($slug);
		    		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
		    	}

		    	$tot_slug = $this->Model_page_dynamic->slug_duplication_check_edit($slug,$data['page_dynamic']['slug']);
				if($tot_slug) {
					$slug = $slug.'-1';
				}

		    	if($path == '')
		    	{
		    		$form_data = array(
						'name'             => $name,
						'slug'             => $slug,
						'content'          => $content,
						'meta_title'       => $meta_title,
						'meta_description' => $meta_description,
						'lang_id'          => $lang_id
		            );
		            $this->Model_page_dynamic->update($id,$form_data);
				}
				else
				{
					unlink('./public/uploads/'.$data['page_dynamic']['banner']);

					$final_name = 'page-dynamic-banner-'.$id.'.'.$ext;
		        	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        	$form_data = array(
						'name'             => $name,
						'slug'             => $slug,
						'content'          => $content,
						'banner'           => $final_name,
						'meta_title'       => $meta_title,
						'meta_description' => $meta_description,
						'lang_id'          => $lang_id
		            );
		            $this->Model_page_dynamic->update($id,$form_data);
				}

				$success = 'Dynamic Page is updated successfully';
				$this->session->set_flashdata('success',$success);
				redirect(base_url().'admin/page-dynamic');
		    }
		    else
		    {
		    	$this->session->set_flashdata('error',$error);
				redirect(base_url().'admin/page-dynamic/add');
		    }
           
		} else {
			$data['page_dynamic'] = $this->Model_page_dynamic->getData($id);
            $this->load->view('admin/view_header',$data);
			$this->load->view('admin/view_page_dynamic_edit',$data);
			$this->load->view('admin/view_footer');
		}
	}


	public function delete($id) 
	{
    	$tot = $this->Model_page_dynamic->page_dynamic_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/page-dynamic');
        	exit;
    	}

		if(PROJECT_MODE == 0) {
			$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
			redirect($_SERVER['HTTP_REFERER']);
		}

        $data['page_dynamic'] = $this->Model_page_dynamic->getData($id);
        if($data['page_dynamic']) {
            unlink('./public/uploads/'.$data['page_dynamic']['banner']);
        }

        $this->Model_page_dynamic->delete($id);
        $success = 'Dynamic Page is deleted successfully';
		$this->session->set_flashdata('success',$success);
		redirect(base_url().'admin/page-dynamic');
    }
}