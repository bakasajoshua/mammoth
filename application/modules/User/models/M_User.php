<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	function getAllUsers(){
		$this->db->select('users.uuid, users.fulname, users.email, users.status, department.desc as department, access_level.desc as access_level');
		$this->db->from('users');
		$this->db->join('department', 'department.deptid = users.dept_id');
		$this->db->join('access_level', 'access_level.accessid = users.access_level');

		$query = $this->db->get();

		return $query->result();
	}
}

/* End of file M_User.php */
/* Location: ./application/modules/User/models/M_User.php */