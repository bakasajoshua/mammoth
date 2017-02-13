<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Hash');
		$this->load->model('manager_model');
		$this->simulate_session(1);
		error_reporting(-1);
		ini_set('display_errors', 1);
	}
	
	public function index()
	{
		$this->add_js();
		$reports = $this->manager_model->get_report_data(1);
		$data['report_data'] = $reports;

		$this->template
				->setPartial('manager_v',$data)
				->frontEndTemplate();
	}

	public function create_report()
	{
		$this->template
				->setPartial('manager_new_report_v')
				->frontEndTemplate();
	}

	public function save_report()
	{	
		$post_data = $this->input->post();
		// echo "<pre>";print_r($post_data);exit;
		$posted_uuid = $post_data['uuid'];
		if (isset($posted_uuid) && $posted_uuid !='') {
			// echo $post_data['uuid'];exit;
			$data = array(
               'title' => $post_data['title'],
               'desc' => $post_data['desc'],
               'deadline' => $post_data['deadline']
            );

			$this->db->where('uuid', $posted_uuid);
			$this->db->update('reports', $data); 

		}else{
		$uuid = $this->hash->createUUID();
		$user_id = $this->session->userdata('userid');
		// echo $uuid;exit;
		$data_final = array();
		$data['uuid'] = $uuid;
		$data['title'] = $post_data['title'];
		$data['desc'] = $post_data['desc'];
		$data['userid'] = $user_id;
		$data['status'] = 0;//Change to number based on Josh
		$data['status_desc'] = "Pending";
		$data['deadline'] = $post_data['deadline'];

		array_push($data_final, $data);
		// echo "<pre>";print_r($data);exit;
		$insert = $this->db->insert_batch('reports',$data_final);
		// echo "<pre>";print_r($insert);exit;
		}
		return redirect('Manager');
	}

	public function edit_report($uuid)
	{
		$report = $this->manager_model->get_report_by_uuid($uuid);
		// $report = array_pop($report);

		// echo "<pre>";print_r($report);exit;
		$update['uuid'] = $report['uuid'];
		$update['title'] = $report['title'];
		$update['desc'] = $report['desc'];
		$update['deadline'] = $report['deadline'];

		$data['update'] = $update;
		// echo "<pre>";print_r($data);exit;
		$this->template
				->setPartial('manager_new_report_v',$data)
				->frontEndTemplate();
	}

	public function delete_report($uuid)
	{
		$data = array(
               'title' => $post_data['title'],
               'desc' => $post_data['desc'],
               'deadline' => $post_data['deadline']
            );

		$this->db->where('uuid', $uuid);
		$this->db->delete('reports'); 

		return redirect('Manager');

	}

	public function view_report($uuid)
	{
		$report_data = $this->manager_model->get_report_by_uuid($uuid);
		// echo "<pre>";print_r($report_data);

		$report_id = $report_data['repid'];
		$report_content_data = $this->manager_model->get_report_content_by_report($report_id);
		// echo "<pre>";print_r($report_content_data);exit;
		$writer_id = $report_content_data['userid'];
		$user = $this->manager_model->get_user($writer_id);
		// echo "<pre>";print_r($user);exit;
		$report['title'] = $report_data['title'];
		$report['desc'] = $report_data['desc'];
		$report['deadline'] = $report_data['deadline'];

		$report['content'] = $report_content_data['content'];
		$report['updated_at'] = $report_content_data['updated_at'];

		$report['writer_name'] = $user['fulname'];
		$report['writer_email'] = $user['email'];

		$data['report_data'] = $report;
		// echo "<pre>";print_r($report);exit;

		$this->template
				->setPartial('manager_view_report_v',$data)
				->frontEndTemplate();
	}	

	public function add_js()
	{
		// $this->assets->addCss('plugins/datatables/dataTables.bootstrap.css');
		$this->assets->addCss('plugins/datatables/jquery.dataTables.css');
		$this->assets->addJs('plugins/datatables/jquery.dataTables.js');
		$this->assets->addJs('custom/custom.js');
	}

	public function simulate_session($user_id)
	{
		$data = array(
        'userid'  => $user_id,
        'email'     => 'test@mammoth.com',
        'logged_in' => TRUE
		);

		$this->session->set_userdata($data);
	}

}

/* End of file Manager.php */
/* Location: ./application/modules/Manager/controllers/Manager.php */