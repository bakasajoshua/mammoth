<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

    public function get_all_reports($manager_id = NULL)
    {
    	$query = "SELECT * FROM reports WHERE userid=$manager_id";
    	$result = $this->db->query($query)->result_array();
    	return $result;
    }

    public function get_report_data($manager_id = NULL)
    {
    	$query = "SELECT * FROM reports WHERE userid=$manager_id";
    	$result = $this->db->query($query)->result_array();
    	return $result;
    }

    public function get_report_by_uuid($uuid)
    {
    	$query = "SELECT * FROM reports WHERE uuid= '$uuid'";
    	$result = $this->db->query($query)->result_array();
    	return array_pop($result);
    }

    public function get_report_content_by_report($report_id)
    {
        $query = "SELECT * FROM report_content WHERE repid = '$report_id'";
        $result = $this->db->query($query)->result_array();
        return array_pop($result);
    }

    public function get_user($user_id)
    {
        $query = "SELECT * FROM users WHERE userid = '$user_id'";
        $result = $this->db->query($query)->result_array();
        return array_pop($result);
    }

}