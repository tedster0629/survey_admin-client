<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    function __construct ()
    {
        parent::__construct();
        
		$this->load->model('Model_lang');

	    if(!isset($_SESSION['sess_lang_id'])) {
		    $lang = $this->Model_lang->get_default_language_id();
		    $_SESSION['sess_lang_id'] = $lang['lang_id'];
		    $_SESSION['sess_layout_direction'] = $lang['layout_direction'];
		}

	    $detail_arr = array();
	    $detail_arr = $this->Model_lang->get_detail_by_language_id($_SESSION['sess_lang_id']);
	    foreach ($detail_arr as $row) {
	       	define($row['lang_string'], $row['lang_string_value']);
	    }

    }
}