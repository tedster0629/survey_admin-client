<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
		$this->load->model('admin/Model_launch_survey');
    }

	public function index()
	{
        $thisID = $this->input->get('id');
        if($this->user_completed_survey()){
            $this->load->view('admin/themes/default/view_final');
        }
        else {
            if(isset($_COOKIE['cookie_survey_allowed']) && @$_COOKIE['cookie_survey_allowed'] == $thisID)
            {
                redirect(base_url() . 'admin/launch_survey/view_takeSurvey?id=' . $thisID);
                // var_dump('asdfasdf');die();
            }
            else{
		        $this->load->view('admin/themes/default/view_validation');
            } 
        }
	}
    public function testpassword()
    {
        $thisID = $this->input->get('id');
        if($this->survey_have_password())
        {
            if(isset($_POST['password']))
            {
                if($_POST['password'] == $this->survey_have_password())
                {
                    setcookie('cookie_survey_allowed', $thisID);
                    redirect(base_url() . 'admin/launch_survey/view_takeSurvey?id=' . $thisID);
                } else {
                    redirect(base_url() . 'admin/themes/default/validation?id=' . $thisID);
                }
            }
        }
    }
    function survey_have_password()
	{
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID); 
        
		$res = $this->Model_launch_survey->get_survey_info($thisID, 'password');
		if($res !== "NULL")
		{
			return $res;	
		} else {
			return false;	
		}
	}
    function user_completed_survey()
	{
		
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID); 
        
		if(isset($_COOKIE['user_completed_survey'.$thisID]))
		{
			if($_COOKIE['user_completed_survey'.$thisID] == $thisID)
			{
				return true;
			} else {
				return false;
			}
		} else { 
			return false;	
		}
	}

}

?>