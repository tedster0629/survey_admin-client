<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Val_fileupload extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
		$this->load->model('admin/Model_launch_survey');
    }

	public function index()
	{
		$survey_id = $this->input->get('survey_id');
		$ids = $this->input->get('ids');
		$re_fileSize = $this->Model_launch_survey->getfileSize($survey_id, $ids);
		$re_fileSize_string = $re_fileSize[0]["rule"];
		$data['re_fileSize'] = $re_fileSize_string;
		$this->load->view('admin/themes/default/view_val_fileupload', $data);
	}
}

?>