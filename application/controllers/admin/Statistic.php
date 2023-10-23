<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistic extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_common');
        $this->load->model('admin/Model_statistic');
    }
	public function index()
	{
		$data['setting'] = $this->Model_common->get_setting_data();
		$this->load->view('admin/view_header',$data);
		$this->load->view('admin/view_statistic');
		$this->load->view('admin/view_footer');
	}

	public function download_csv() {

        $qid = $this->input->get('id');
        $qtype = $this->input->get('qtype');
        $sname = $this->session->userdata('survey_name');

        $raw = $this->Model_statistic->chart_data($qid, $qtype);
        $total = array_sum($this->Model_statistic->array_values_recursive($raw));
        $buffer = '';
        foreach ($raw as $v) {
            $buffer .= round($v['qtd'] / $total, 2) * 100 . '% says: ' . $v['answer'] . ' | ';
        }
        $buffer = rtrim($buffer, ' | ');

        $list = array(
            array('Survey Name: ' . $sname),
            array('Question: ' . $this->Model_statistic->get_questions_info($qid, 'questions')),
            array(''),
            array(''),
            array('Survey Statistics:'),
            array($this->Model_statistic->get_number_of_answers($qid) . ' answered this question'),
            array('Most of the users are from: '),
            array('The answer rate to this question is: ' . $this->Model_statistic->get_answer_rate($qid)),
            array($buffer)
        );

		$this->load->helper('download');
        $csv_data = '';
        foreach ($list as $fields) {
            $csv_data .= implode(',', $fields) . "\n";
        }

        $file_name = 'statistic-' . $qid . '.csv';
        force_download($file_name, $csv_data);
    }
	
}