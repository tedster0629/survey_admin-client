<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finalpage extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
		// $this->load->model('admin/Model_launch_survey');
    }

	public function index()
	{
		// if($this->survey_have_password())
        // {
        //     if(isset($_POST['password']))
        //     {
        //         if($_POST['password'] == $this->survey_have_password())
        //         {
        //             setcookie('cookie_survey_allowed', $thisID);
        //         } else {
		// 			$this->load->view('admin/themes/default/view_final');
		// 		}
        //     } else {
		// 		if(isset($_COOKIE['cookie_survey_allowed']) && @$_COOKIE['cookie_survey_allowed'] == $thisID)
		// 		{ } else {
		// 			$this->load->view('admin/themes/default/view_final');
		// 		}
		// 	}
        // }

		$this->load->view('admin/themes/default/view_final');
		
	}

	// function survey_have_password()
	// {
	// 	$thisID = $this->input->get('id', TRUE);
    //     $thisID = intval($thisID); 
	// 	$res = $this->Model_launch_survey->get_survey_info($thisID, 'password');
	// 	if($res !== "NULL")
	// 	{
	// 		return $res;	
	// 	} else {
	// 		return false;	
	// 	}
	// }
}

?>