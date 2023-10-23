<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TakeSurvey extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_takeSurvey');
    }

    public function view_takeSurvey()
    {
        $current_theme = 'default';
        $theme_path = 'themes/'.$current_theme.'/';
        $id = $this->input->get('id', TRUE); // Get the "id" parameter from the URL
        $id = intval($id); // Convert it to an integer
        if(isset($id)) {
            if($this->Model_takeSurvey->check_template_survey('theme', 'survey_id', $id)) {
                $current_theme = $this->Model_takeSurvey->check_template_survey('theme', 'survey_id', $id);
                $theme_path = 'themes/'.$current_theme.'/';
            }
        }
        if(isset($id) && $this->Model_takeSurvey->is_survey_published($id) == true) {
            $thisID = $this->input->get('id', TRUE);
            $thisID = intval($thisID); 
            $sessions = $this->Model_takeSurvey->check_template_survey('sessions', 'survey_id', $thisID); 
            switch($sessions)
            {
                case 'Y':
                    // Get Sessions
                    foreach(the_dropzone() as $ks => $vs)
                    {
                        $session[] = $vs;	
                    }
                    $session = array_unique($session);
                    
                    // Get Respective Answers of the sessions by order
                    foreach(the_dropzone() as $k => $v)
                    {
                        $results[get_question($k, 'order')] = get_question($k, 'questions');	
                    }
                    
                    // Get Question types
                    foreach(the_dropzone() as $k => $v)
                    {
                        $order_array[] = get_question($k, 'question_type'); ksort($order_array);
                        $qtypes[get_question($k, 'order')] = get_question($k, 'question_type');	
                        $question_types[get_question($k, 'order')] = get_question($k, 'question_type');
                    }
                    ksort($qtypes); // not being used for templating due bug, was being used with ksort($answer) but was causing limitations
                    ksort($question_types);
                    
                    // Get Answers and build form
                    foreach(the_dropzone() as $k => $v)
                    {
                        $answer[get_question($k, 'order')] = unserialize(get_question($k, 'answer'));	
                    }
                    ksort($answer);
                    
                    if(!array_key_exists(1, $answer)) { include($theme_path.'/bad_survey.php'); die(); }
                    
                    // Get css class e requeriment e ids
                    foreach(the_dropzone() as $k => $v)
                    {
                        $css[get_question($k, 'order')] = get_question($k, 'css');	
                        $requeriment[get_question($k, 'order')] = get_question($k, 'requeriment');
                        $ids[get_question($k, 'order')] = get_question($k, 'question_ID');
                        $position[get_question($k, 'order')] = get_question($k, 'position');
                    }
                    ksort($css); ksort($requeriment); ksort($requeriment); ksort($position);
        
                    if(isset($_GET['page']) && $this->Model_takeSurvey->sanitize_integer($_GET['page']) == true)
                    {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;	
                    }
                    
                    // Pagination Var
                    $per_page = $this->Model_takeSurvey->settings_notice(4, 4);
                    $total_pages = count($results);
                    $pages = ceil($total_pages / $per_page);
                    $firstIndex = ($page - 1) * $per_page;
                    
                    // do the job
                    $i = 0;
                    
                    ksort($results); 
                    
                    // reindex arrays - this will prevent faulty questions to being published, faulty question order, etc
                    $requeriment = array_combine(range(1, count($requeriment)), array_values($requeriment));
                    $position = array_values($position);
                    ksort($ids); $ids = array_values($ids);
                    $results = array_combine(range(1, count($results)), array_values($results));
                    $answer = array_combine(range(1, count($answer)), array_values($answer));
                    $z = 1;
                    foreach($question_types as $k => $v)
                    {
                        $question_types_final[$z] = $v.'-'.$z;
                        $z++;	
                    }
                    
                    // combine to prepare to build form
                    $combine = @array_combine($question_types_final, $answer);
                    
                    if($combine == false) { include($theme_path.'/bad_survey.php'); die(); }
                    
                    // print_r($results); print_r($question_types_final); print_r($answer); print_r($combine); print_r($ids);
					$data['id'] = $id;
					$data['i'] = $i;
					$data['page'] = $page;
					$data['per_page'] = $per_page;
					$data['total_pages'] = $total_pages;
					$data['results'] = $results;
					$data['thisID'] = $thisID;
                    $data['firstIndex'] = $firstIndex;
                    $data['requeriment'] = $requeriment;
                    $data['combine'] = $combine;
                    $data['position'] = $position;
                    $data['ids'] = $ids;
                    $data['question_types_final'] = $question_types_final;
					$data['get_survey_subHeading'] = $this->get_survey_subHeading();
					$data['get_survey_heading'] = $this->get_survey_heading();
					$data['get_survey_intro'] = $this->get_survey_intro();
					$data['get_survey_description'] = $this->get_survey_description();
					$data['survey_have_password'] = $this->survey_have_password();
					$data['user_completed_survey'] = $this->user_completed_survey();
					$data['user_answered'] = $this->user_answered();
					$data['get_survey_note'] = $this->get_survey_note();
					$data['get_survey_title'] = $this->get_survey_title();
                    $data['get_theme_path'] = $this->get_theme_path();
                    $data['get_survey_footer'] = $this->get_survey_footer();
					$this->load->view('admin/'. $theme_path . '/view_header', $data);
                    $this->load->view('admin/' . $theme_path . '/view_home_basic', $data);
					$this->load->view('admin/'. $theme_path . '/view_footer', $data);
                break;
                
                case 'N':
                
                    // Get results
                    foreach($this->Model_takeSurvey->listQuestions($thisID) as $k => $v)
                    {
                        $results[$this->Model_takeSurvey->get_question($v->question_ID, 'order')] = $this->Model_takeSurvey->get_question($v->question_ID, 'questions');
                    }
                    ksort($results);
                    
                    // Get answers to build form
                    foreach($this->Model_takeSurvey->listQuestions($thisID) as $k => $v)
                    {
                        $answer[$this->get_question($v->question_ID, 'order')] = unserialize($this->get_question($v->question_ID, 'answer'));	
                    }
                    ksort($answer);
                    
                    // Get Question types
                    foreach($this->Model_takeSurvey->listQuestions($thisID) as $k => $v)
                    {
                        $question_types[$this->get_question($v->question_ID, 'order')] = $this->get_question($v->question_ID, 'question_type');
                    }
                    ksort($question_types);
                    
                    // Get css class e requeriment e ids
                    foreach($this->Model_takeSurvey->listQuestions($thisID) as $k => $v)
                    {
                        $css[$this->get_question($v->question_ID, 'order')] = $this->get_question($v->question_ID, 'css');	
                        $requeriment[$this->get_question($v->question_ID, 'order')] = $this->get_question($v->question_ID, 'requeriment');
                        $ids[$this->get_question($v->question_ID, 'order')] = $this->get_question($v->question_ID, 'question_ID');
                        $position[$this->get_question($v->question_ID, 'order')] = $this->get_question($v->question_ID, 'position');
                    }
                    ksort($css); ksort($requeriment); ksort($requeriment); ksort($position);
                    
                    if(isset($_GET['page']) && $this->Model_takeSurvey->sanitize_integer($_GET['page']) == true)
                    {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;	
                    }
                    
                    // Pagination Var
                    $per_page = $this->Model_takeSurvey->settings_notice(4, 4);
                    $total_pages = count($results);
                    $pages = ceil($total_pages / $per_page);
                    $firstIndex = ($page - 1) * $per_page;
                    
                    // do the job
                    $i = 0;
                    
                    $position = array_values($position);
                    ksort($ids); $ids = array_values($ids);
                    
                    $z = 1;
                    foreach($question_types as $k => $v)
                    {
                        $question_types_final[$z] = $v.'-'.$z;
                        $z++;	
                    }

                   // combine to prepare to build form
                    $combine = @array_combine($question_types_final, $answer);
                    if($combine == false) { include($theme_path.'/bad_survey.php'); die(); }
					$data['id'] = $id;
					$data['i'] = $i;
					$data['page'] = $page;
					$data['per_page'] = $per_page;
					$data['total_pages'] = $total_pages;
					$data['results'] = $results;
					$data['thisID'] = $thisID;
                    $data['firstIndex'] = $firstIndex;
                    $data['requeriment'] = $requeriment;
                    $data['combine'] = $combine;
                    $data['position'] = $position;
                    $data['ids'] = $ids;
                    $data['question_types_final'] = $question_types_final;
					$data['get_survey_subHeading'] = $this->get_survey_subHeading();
					$data['get_survey_heading'] = $this->get_survey_heading();
					$data['get_survey_intro'] = $this->get_survey_intro();
					$data['get_survey_description'] = $this->get_survey_description();
					$data['survey_have_password'] = $this->survey_have_password();
					$data['user_completed_survey'] = $this->user_completed_survey();
					$data['user_answered'] = $this->user_answered();
					$data['get_survey_note'] = $this->get_survey_note();
					$data['get_survey_title'] = $this->get_survey_title();
                    $data['get_theme_path'] = $this->get_theme_path();
                    $data['get_survey_footer'] = $this->get_survey_footer();

					$this->load->view('admin/'. $theme_path . '/view_header', $data);
                    $this->load->view('admin/' . $theme_path . '/view_home_basic', $data);
					$this->load->view('admin/'. $theme_path . '/view_footer', $data);
                    // redirect(base_url().'admin/' . $theme_path . 'home_basic?id=' . $thisID . '?page=' . $page );
                break;
                
                default:
                    $data['id'] = $id;
                    $data['i'] = $i;
                    $data['page'] = $page;
                    $data['per_page'] = $per_page;
                    $data['total_pages'] = $total_pages;
                    $data['results'] = $results;
                    $data['thisID'] = $thisID;
                    $data['firstIndex'] = $firstIndex;
                    $data['requeriment'] = $requeriment;
                    $data['combine'] = $combine;
                    $data['position'] = $position;
                    $data['ids'] = $ids;
                    $data['question_types_final'] = $question_types_final;
                    $data['get_survey_subHeading'] = $this->get_survey_subHeading();
                    $data['get_survey_heading'] = $this->get_survey_heading();
                    $data['get_survey_intro'] = $this->get_survey_intro();
                    $data['get_survey_description'] = $this->get_survey_description();
                    $data['survey_have_password'] = $this->survey_have_password();
                    $data['user_completed_survey'] = $this->user_completed_survey();
                    $data['user_answered'] = $this->user_answered();
                    $data['get_survey_note'] = $this->get_survey_note();
                    $data['get_survey_title'] = $this->get_survey_title();
                    $data['get_theme_path'] = $this->get_theme_path();
                    $data['get_survey_footer'] = $this->get_survey_footer();
					$this->load->view('admin/'. $theme_path . '/view_header', $data);
                    $this->load->view('admin/' . $theme_path . '/view_home_basic', $data);
					$this->load->view('admin/'. $theme_path . '/view_footer', $data);
                break;	
            }	
        
        } else {
            $this->load->view('admin/'. $theme_path.'/view_404');
        }

    }

    function get_survey_subHeading()
	{
		
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID); 
		$sub_head = $this->Model_takeSurvey->check_template_survey('sub_heading', 'survey_id', $thisID);
		
		if(empty($sub_head))
		{
			return 'mySurvey a sample survey';	
		} else {
			return $sub_head;	
		}
	}

    function get_survey_heading()
	{

		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID); 
		$res = $this->Model_takeSurvey->check_template_survey('heading', 'survey_id', $thisID);
		if(!empty($res))
		{
			if(stripos($res, '.jpg') || stripos($res, '.png') || stripos($res, '.jpeg') || stripos($res, '.gif'))
			{
				$ext = pathinfo($res, PATHINFO_EXTENSION);
				if($ext == 'png' || $ext == 'jpg' || $ext == 'gif')
				{
					return '<img src="'.html_entity_decode($res).'" alt="logo" />';
				}
			} else {
				return $res;	
			}	
		} else {
			return 'mySurvey';	
		}
	}

    function get_survey_intro()
	{
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID); 
		$si = $this->Model_takeSurvey->check_template_survey('intro', 'survey_id', $thisID);
		if($si)
		{
			return '<p class="survey-intro">'.$si.'</p>';
		}
	}

    function get_survey_description()
	{
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID);
		$se = $this->Model_takeSurvey->check_template_survey('description', 'survey_id', $thisID);
		if($se)
		{
			return '<p class="survey-description">'.$se.'</p>';
		}
	}

    function survey_have_password()
	{
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID); 
		$res = $this->Model_takeSurvey->get_survey_info($thisID, 'password');
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

    function user_answered()
	{
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID); 
		$page = $this->input->get('page', TRUE);
		$res = $this->Model_takeSurvey->user_already_answered_page($thisID, $this->Model_takeSurvey->get_client_ip(), $this->user_took_survey());
			
		if($res > $page)
		{
			return $res;	
		} else {
			return false;	
		}
	}

    function user_took_survey()
	{
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID);
		$res = $this->Model_takeSurvey->user_already_took_survey($thisID, $this->Model_takeSurvey->get_client_ip()); 
		if($res)
		{
			return $res;
		} else {
			return false;	
		}
	}

    function get_survey_note()
	{
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID); 
		return $this->Model_takeSurvey->check_template_survey('note', 'survey_id', $thisID);
	}

    function get_question($id, $return)
	{
		
		return $this->Model_takeSurvey->get_question($id, $return);	
	}

    
    function get_survey_title()
	{
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID); 
		$title = $this->Model_takeSurvey->check_template_survey('title', 'survey_id', $thisID);
		
		if(empty($title))
		{
			return 'mySurvey';	
		} else {
			return $title;	
		}
	}

    function get_theme_path()
    {
        $CI = get_instance(); // Get the CodeIgniter instance
        $theme_path = $CI->config->item('theme_path'); // Assuming you have a configuration item for the theme path
        
        return $theme_path;
    }
    function get_survey_footer()
	{
		$thisID = $this->input->get('id', TRUE);
        $thisID = intval($thisID);
		return $this->Model_takeSurvey->check_template_survey('footer', 'survey_id', $thisID);
	}

    function choices_hint($txt)
	{
		return $this->Model_takeSurvey->settings_notice(8, $txt);		
	}

    public function submitSurvey()
    {
		$thisID = $this->input->get('id', TRUE);
        $survey_id = $this->input->post('survey_id');
        $page = $this->input->post('page');
        $total_results = $this->input->post('total_results');
        $last_page = $this->input->post('last_page');
        $client_ip = $this->Model_takeSurvey->get_client_ip();
        $all_keys = array_keys($_POST);

        // Extract question ids from the keys
        $buffer = '';
        foreach ($all_keys as $key) {
            $buffer .= $key . '/';
        }
        preg_match_all("/\((\d+)\)/", $buffer, $matches, PREG_PATTERN_ORDER);
        $q_ids = $matches[1];
        // If survey continues or not
        if ($last_page == "true") {
            $page = 0;
        }

        if ($this->input->post()) {
            $total = count($this->input->post());
            $z = 0;
            for ($i = 0; $i <= $total - 1; $i++) {
                $z++;
				if(empty($q_ids[$i])) continue;
                switch ($this->input->post()) {
                    // Matrix Single
                    case null !== $this->input->post('matrix_single-(' . $q_ids[$i] . ')-' . (($q_ids[$i]) + $z - 1)):
                        // save
                        $this->Model_takeSurvey->add_result($survey_id, $q_ids[$i], $this->input->post('matrix_single-(' . $q_ids[$i] . ')-' . (($q_ids[$i]) + $z - 1)), 'matrix_single', $client_ip, $page);
                        break;
                    // Matrix Multi (array)
                    case null !== $this->input->post('matrix_multi_select-(' . $q_ids[$i] . ')'):
                        $array = $this->input->post('matrix_multi_select-(' . $q_ids[$i] . ')');
                        foreach ($array as $v) {
                            $this->Model_takeSurvey->add_result($survey_id, $q_ids[$i], $v, 'matrix_multi_select', $client_ip, $page);
                        }
                        break;
                    // Checkbox (array)
                    case null !== $this->input->post('checkbox-(' . $q_ids[$i] . ')'):
                        $array = $this->input->post('checkbox-(' . $q_ids[$i] . ')');
                        foreach ($array as $v) {
                            $this->Model_takeSurvey->add_result($survey_id, $q_ids[$i], $v, 'multiple_choice', $client_ip, $page);
                        }
                        break;
                    // Single
                    case null !== $this->input->post('single-(' . $q_ids[$i] . ')'):
                        $this->Model_takeSurvey->add_result($survey_id, $q_ids[$i], $this->input->post('single-(' . $q_ids[$i] . ')'), 'single_text', $client_ip, $page);
                        break;
                    // Radio
                    case null !== $this->input->post('radio-(' . $q_ids[$i] . ')'):
                        $this->Model_takeSurvey->add_result($survey_id, $q_ids[$i], $this->input->post('radio-(' . $q_ids[$i] . ')'), 'radio', $client_ip, $page);
                        break;
                    // Comment Box
                    case null !== $this->input->post('suggestion-(' . $q_ids[$i] . ')'):
                        $this->Model_takeSurvey->add_result($survey_id, $q_ids[$i], $this->input->post('suggestion-(' . $q_ids[$i] . ')'), 'comment_box', $client_ip, $page);
                        break;
                    // Yes / No
                    case null !==  $this->input->post('yes_no-(' . $q_ids[$i] . ')'):
                        $this->Model_takeSurvey->add_result($survey_id, $q_ids[$i], $this->input->post('yes_no-(' . $q_ids[$i] . ')'), 'yes_no', $client_ip, $page);
                        break;
                    // Dropdown Menu
                    case null !== $this->input->post('dropdown_menu-(' . $q_ids[$i] . ')'):
                        $this->Model_takeSurvey->add_result($survey_id, $q_ids[$i], $this->input->post('dropdown_menu-(' . $q_ids[$i] . ')'), 'dropdown_menu', $client_ip, $page);
                        break;
                }
            }

            if ($last_page == "true") {
                if (!isset($_SESSION['mySurvey_authenticated'])) {
                    setcookie('user_completed_survey' . intval($survey_id), intval($survey_id), time() + (10 * 365 * 24 * 60 * 60)); // 10 years
                }
                echo 'DONE';
            } else {
				echo "Sorry. You submit is not allowed";
                // echo 'takeSurvey.php?id=' . intval($survey_id) . '&page=' . intval($page);
            }
        }
    }
}