<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_m extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}


    public function logoutadmin($sess_log){
         $data['status'] = 0;

         $this->db->where('userid', $sess_log);
         $update = $this->db->update('users', $data);
     }


    public function check_user_exist()
    {
        $email = $this->input->post('email');

        $this->db->where('email', $email);
        $query = $this->db->get('users');

        return $query->row();
    }


	public function check_user_authentic()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password'); 

         //echo '<pre>';print_r($email);echo'</pre>';die;
        $sql = "SELECT * FROM users WHERE email = '". $email ."' LIMIT 1";

        $result = $this->db->query($sql);
        
        $row = $result->row();
         // echo '<pre>';print_r($result);echo'</pre>';die;
        $sql2 = "SELECT * FROM users WHERE email = '". $email ."' AND password = '". $password ."' AND status = 1 ";

        $result2 = $this->db->query($sql2);
        $row2 = $result->row();

        if($result->num_rows() == 1){
           if($row2->status){
             //if ($row->password === sha1($this->config->item('salt') . $password)) {
             if ($row->password === $password) {
               $session_data = array(
                   'userid'         => $row ->userid , 
                   'uuid'    		=> $row ->uuid , 
                   'fulname'    	=> $row ->fulname , 
                   'email'    		=> $row ->email ,
                   'access_level'   => $row ->access_level ,
                   'dept_id'   		=> $row ->dept_id
                );

                $this -> set_session($session_data);
                //return 'logged_in';
                return $session_data;
             } else {
               return "incorrect_password";
             }
           }else{
             return "not_activated";
           }
         }else{
          return "unknown_email";
         }


       
       //print_r($this->session->all_userdata());
    }


    private function set_session($session_data){
      $sql = "SELECT * FROM users WHERE email = '". $session_data['email'] ."' LIMIT 1";
      $result = $this->db->query($sql);
      $row = $result->row();
       //echo "<pre>";print_r($result);die();
       //echo $session_data['userid'];die();
      $setting_session = array(
                   'userid'       => $session_data['userid'] , 
                   'fulname'    => $session_data['fulname'] ,
                   'email'    => $session_data['email'] ,
                   'access_level'    => $session_data['access_level'] ,
                   'dept_id'   => $session_data['dept_id'] ,
                   'logged_in'  => 1
      ); 

      $this->session->set_userdata($setting_session);

      //echo "<pre>";print_r($setting_session);die();
      
      $details = $this->session->all_userdata();
       // $sql = "INSERT INTO usersessions (`session_id`,`ip_address`,`user_agent`,`last_activity`,`user_data`,`userid`,`fulname`,`email`,`access_level`,`dept_id`,`logged_in`) 
       //         VALUES ('".$details['session_id']."', '".$details['ip_address']."','".$details['user_agent']."', 
       //         '".$details['last_activity']."','1', '".$details['userid']."', '".$details['fulname']."', 
       //         '".$details['email']."', '".$details['access_level']."', '".$details['dept_id']."', 
       //         '".$details['logged_in']."') ";

    //$results = $this->db->query($sql);
        
    }



}