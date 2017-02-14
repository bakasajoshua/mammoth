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

	function getDepartments(){
		$query = $this->db->get('department');

		return $query->result();
	}

	function getAccessLevels(){
		$this->db->where('desc !=', 'Admin');
		$query = $this->db->get('access_level');

		return $query->result();
	}

	function findDepartmentByUUID($uuid)
	{
		$this->db->where('uuid', $uuid);
		$query = $this->db->get('department');

		return $query->row();
	}

	function findAccessLevelByUUID($uuid){
		$this->db->where('uuid', $uuid);
		$query = $this->db->get('access_level');

		return $query->row();
	}

	function getUserByEmail($email){
		$this->db->where('email', $email);
		$query = $this->db->get('users');

		return $query->row();
	}

	function addUser($user){
		return $this->db->insert('users', $user);
	}

	function findUserByUUID($uuid){
		$this->db->where('uuid', $uuid);
		$query = $this->db->get('users');

		return $query->row();
	}
}

/* End of file M_User.php */
/* Location: ./application/modules/User/models/M_User.php */