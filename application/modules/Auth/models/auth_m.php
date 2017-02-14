<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_m extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}


    public function logoutuser($sess_log){
    	$data['logged_in'] = 0;

	    $this->db->where('session_id', $sess_log);
	    $update = $this->db->update('usersessions', $data);


	    $setting_session = array(
	                   'session_id'       => "" , 
	                   'ip_address'       => "" , 
	                   'user_agent'       => "" ,
	                   'last_activity'    => "" ,
	                   'user_data'        => "" ,
	                   'userid'           => "" , 
	                   'uuid'             => "" , 
	                   'fulname'          => "" ,
	                   'email'            => "" ,
	                   'access_level'     => "" ,
	                   'dept_id'          => "" ,
	                   'logged_in'        => ""
	    ); 

	    $this->session->set_userdata($setting_session);


	    
     }


    public function check_user_exist()
    {
        $email = $this->input->post('email');

        $this->db->where('status', 1);
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        return $query->row();
    }


	public function check_user_authentic()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password'); 

        $sessioncheck = $this->checkLogin();

        if($sessioncheck){
        	echo "Session is already in use... Log out first";die();
        }else{

		        $sql = "SELECT * FROM users WHERE email = '". $email ."' LIMIT 1";

		        $result = $this->db->query($sql);
		        
		        $user = $result->row();
		         // echo '<pre>';print_r($result);echo'</pre>';die;

		  //       if ($user->email) {
				// 	$this->load->library('Hash');

				// 	if (password_verify($this->input->post('password'), $user->password)) {
		        
				// 		/* Valid */
				//     } else {
				//         /* Invalid */
				//     }
				// }


		        $sql2 = "SELECT * FROM users WHERE email = '". $email ."' AND password = '". $password ."' AND status = 1 ";
		        $result2 = $this->db->query($sql2);
		        $row2 = $result->row();

		        if($result->num_rows() == 1){
		           if($row2->status){
		             //if ($user->password === sha1($this->config->item('salt') . $password)) {
		             if ($user->password === $password) {
		               $session_data = array(
		                   'userid'         => $user ->userid , 
		                   'uuid'    		=> $user ->uuid , 
		                   'fulname'    	=> $user ->fulname , 
		                   'email'    		=> $user ->email ,
		                   'access_level'   => $user ->access_level ,
		                   'dept_id'   		=> $user ->dept_id
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

		     }
        
    }


    public function addsession($session_data){

      echo "<pre>";print_r($session_data);die();
      $details = $this->session->all_userdata();
       $sql = "INSERT INTO usersessions (`session_id`,`ip_address`,`user_agent`,`last_activity`,`user_data`,`userid`,`fulname`,`email`,`access_level`,`dept_id`,`logged_in`) 
               VALUES ('".$details['session_id']."', '".$details['ip_address']."','".$details['user_agent']."', 
               '".$details['last_activity']."','1', '".$details['userid']."', '".$details['fulname']."', 
               '".$details['email']."', '".$details['access_level']."', '".$details['dept_id']."', 
               '".$details['logged_in']."') ";

    $results = $this->db->query($sql);
        
    }



}