<?php 
defined('BASEPATH') or exit('No direct script access allowed!');
/**
* 
*/
class Members_model extends CI_Model

{
	protected $department;
	protected $rcid;

	function __construct()
	{
		parent:: __construct();
	}

	function set_member_department()
	{
		$this->db->where('userid', $this->session->userdata('user'));
		$res = $this->db->get('users')->result_array();
		$this->department = $res[0]['dept_id'];

		return $this;
	}

	function get_active_reports()
	{	$query = "select vr.repid, vr.title,vr.desc, vr.created_by, vr.fulname, vr.email, vr.dept_id, r.content, r.userid, r.`status`
from view_reports vr left join report_content r on vr.repid = r.repid WHERE vr.`status` = 'active' and vr.dept_id = '".$this->department."'";
	// echo $query;die();
		$result = $this->db->query($query)->result_array();
		// echo "<pre>";print_r($result);die();
		if ($result) {
			$count = 1;
			$tableData = '';
			foreach ($result as $key => $value) {
				if ($value['status']=='pending' || $value['status']=='ongoing') {
					$status = '<span class="label label-info">'.$value['status'].'</span>';
					$button = '<button style="border-radius:0px;" class="btn btn-warning button" value="'.$value['repid'].'">Continue</button>';
				}else {
					// echo "<pre>";print(arg)
					$status = '<span class="label label-success">To be started</span>';
					$button = '<button style="border-radius:0px;" class="btn btn-success button" value="'.$value['repid'].'">Start</button>';
				}
				$tableData .= '<tr>';
				$tableData .= '<td>'.$count.'</td>';
				$tableData .= '<td>'.$value['title'].'</td>';
				$tableData .= '<td>'.$value['fulname'].'</td>';
				$tableData .= '<td>'.$value['email'].'</td>';
				$tableData .= '<td>'.$status.'</td>';
				$tableData .= '<td>'.$button.'</td>';
				$tableData .= '<tr>';
			}
		} else {
			# code...
		}
		
		// $this->db->where(['status' => 'active', 'dept_id' => $this->department]);
		// $res = $this->db->get('view_reports')->result_array();

		// $count = 1;
		// $tableData = '';
		// foreach ($res as $key => $value) {
		// 	$tableData .= '<tr>';
		// 	$tableData .= '<td>'.$count.'</td>';
		// 	$tableData .= '<td>'.$value['title'].'</td>';
		// 	$tableData .= '<td>'.$value['fulname'].'</td>';
		// 	$tableData .= '<td>'.$value['email'].'</td>';
		// 	$tableData .= '<td><button style="border-radius:0px;" class="btn btn-success button" value="'.$value['repid'].'">Start</button></td>';
		// 	$tableData .= '<tr>';
		// }

		return $tableData;
	}

	function get_report_details($data=null)
	{
		$this->db->where(['repid' => $data, 'userid' => $this->session->userdata('user')]);
		$result = $this->db->get('report_content')->result_array();
		// echo "<pre>";print_r($result);die();
		if ($result) {
			$result = $this->db->query("select * from view_reports vr left join report_content r on vr.repid = r.repid where vr.repid ='".$data."' and r.userid ='".$this->session->userdata('user')."'")->result_array();
			return ["repID"=>$result[0]['repid'], "title"=>$result[0]['title'], "description"=>$result[0]['title'], "name"=>$result[0]['fulname'], "content"=>$result[0]['content']];
		} else {
			$this->db->where(['repid' => $data]);
			$res = $this->db->get('view_reports')->result_array();

			return ["repID"=>$res[0]['repid'], "title"=>$res[0]['title'], "description"=>$res[0]['title'], "name"=>$res[0]['fulname'], "content"=>NULL];
		}
	}

	function start_report($id)
	{
		$this->load->library('Hash');
		$insert_data = array('uuid' => $this->hash->createUUID(),
							'repid' => $id,
							'userid' => $this->session->userdata('user'),
							'status' => 'ongoing');

		$this->db->trans_start();
	    $this->db->insert('report_content', $insert_data);
		$this->rcid = $this->db->insert_id();
	    $this->db->trans_complete();

	    return $this;
	}

	function pause_report_content($data)
	{
		$update_data = array('content' => $data[1]['value'],
							'status' => 'ongoing');
		$this->db->where(['repid'=> $data[0]['value'], 'userid'=>$this->session->userdata('user')]);

		$this->db->trans_start();
	    $update = $this->db->update('report_content', $update_data);
	    $this->db->trans_complete();

	    return $update;
	}

	function finish_report_content($data)
	{
		$update_data = array('content' => $data[1]['value'],
							'status' => 'pending');
		$this->db->where(['repid'=> $data[0]['value'], 'userid'=>$this->session->userdata('user')]);

		$this->db->trans_start();
	    $update = $this->db->update('report_content', $update_data);
	    $this->db->trans_complete();

	    return $update;
	}
}
?>