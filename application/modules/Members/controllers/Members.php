<?php
defined('BASEPATH') or exit('No direct script access allowed!');

/**
* 
*/
class Members extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('members_model');
		$this->members_model->set_member_department();
	}

	function index()
	{
		$data['active_reports'] = $this->members_model->get_active_reports();
		$this->template
				->setPartial('memebers_v', $data)
				->setPageTitle('Members')
				->frontEndTemplate();
	}

	function get_write_page($report=null)
	{
		// echo $report;
		$data = $this->members_model->get_report_details($report);
		// $data['report'] = $this->members_model->get_report_details(true);
		// $this->template
		// 		->setPartial('report_details_v', $data)
		// 		->setPageTitle('Members')
		// 		->frontEndTemplate();
		// echo "<pre>";print_r($data);die();
		$this->load->view('report_details_v', $data);
	}

	function start_report()
	{
		$this->members_model->start_report($this->input->post('reportID'));
		return true;
	}

	function save_draft()
	{
		$content = $this->input->post('reportContent');
		$update = $this->members_model->pause_report_content($content);

		echo $update;
	}

	function save_complete()
	{
		$content = $this->input->post('reportContent');
		$update = $this->members_model->finish_report_content($content);

		echo $update;
	}
}