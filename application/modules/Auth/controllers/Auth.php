<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_m');
	}

	public function index(){
		//$this->load->view('Auth/login_v', $data, FALSE);
		$this->load->view('Auth/login_v', FALSE);
	}

	public function userLogin(){
		$user = $this->auth_m->check_user_exist();
		$this->load->library('Hash');
		if($user){
			if (password_verify($this->input->post('password'), $user->password)) {

				$session_data = array(
		                   'userid'         => $user ->userid , 
		                   'uuid'    		=> $user ->uuid , 
		                   'fulname'    	=> $user ->fulname , 
		                   'email'    		=> $user ->email ,
		                   'access_level'   => $user ->access_level ,
		                   'dept_id'   		=> $user ->dept_id
		        );

				$this->set_session($session_data);


				$access_level = $user->access_level;

				if($accesslevel == 'Manager'){
				//echo "Manager";die();
				
			}elseif ($accesslevel == 'Admin') {
				
				//echo "Admin";die();
			}elseif ($accesslevel == 'Member') {
				
				//echo "Member";die();
			}

			}else{
				echo "user not found";die();
			}
			
		}else{
			echo "User does not exist";die();
		}


	}


	private function set_session($session_data){
      
      $result = $this->db->query($sql);
      $row = $result->row();
       //echo "<pre>";print_r($result);die();
       //echo $session_data['userid'];die();
      $setting_session = array(
                   'userid'       => $session_data['userid'] , 
                   'uuid'       => $session_data['uuid'] , 
                   'fulname'    => $session_data['fulname'] ,
                   'email'    => $session_data['email'] ,
                   'access_level'    => $session_data['access_level'] ,
                   'dept_id'   => $session_data['dept_id'] ,
                   'logged_in'  => 1
      ); 
      $sess = $this->auth_m->addsession($setting_session);
      $this->session->set_userdata($setting_session);

      //echo "<pre>";print_r($this->session->all_userdata());die();   
        
    }


	public function logout()
    {
        $sess_log = $this->session->userdata('session_id');
        $log = $this->auth_m->logoutuser($sess_log);

        $this->session->sess_destroy();
        redirect('/');
    }

    public function checkLogin(){
		if($this->session->userdata('userid') == ""){
			redirect('Auth/','refresh');
		}
	}


    public function clear(){
	    $setting_session = array(
	                   'userid'       => "" , 
	                   'uuid'       => "" , 
	                   'fulname'    => "" ,
	                   'email'    => "" ,
	                   'access_level'    => "" ,
	                   'dept_id'   => "" ,
	                   'logged_in'  => ""
	    ); 

	    $this->session->set_userdata($setting_session);

    }



}

/* End of file Auth.php */
/* Location: ./application/modules/Auth/controllers/Auth.php */