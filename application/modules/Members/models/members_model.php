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
	{
		$this->db->where(['status' => 'active', 'dept_id' => $this->department]);
		$res = $this->db->get('view_reports')->result_array();

		$count = 1;
		$tableData = '';
		foreach ($res as $key => $value) {
			$tableData .= '<tr>';
			$tableData .= '<td>'.$count.'</td>';
			$tableData .= '<td>'.$value['title'].'</td>';
			$tableData .= '<td>'.$value['fulname'].'</td>';
			$tableData .= '<td>'.$value['email'].'</td>';
			$tableData .= '<td><button style="border-radius:0px;" class="btn btn-success button" value="'.$value['repid'].'">Start</button></td>';
			$tableData .= '<tr>';
		}

		return $tableData;
	}

	function get_report_details($data)
	{
		$this->db->where(['repid' => $data, 'userid' => $this->session->userdata('user')]);
		$result = $this->db->get('report_content')->result_array();

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