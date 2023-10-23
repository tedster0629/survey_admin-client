<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lang extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_portfolio');
        $this->load->model('Model_lang');

    }

    public function index()
    {
    	redirect(base_url());
    	exit;
    }

    public function change()
    {
    	$lang_change_id = $this->input->post('lang_change_id',true);
    	if($lang_change_id)
    	{
            $lang = $this->Model_lang->get_direction_by_lang_id($lang_change_id);
    		$_SESSION['sess_lang_id'] = $lang_change_id;
            $_SESSION['sess_layout_direction'] = $lang['layout_direction'];
    	}
    	redirect($this->agent->referrer());
    }
}