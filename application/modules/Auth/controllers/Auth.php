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
				$access_level = $user->access_level;
			}else{
				echo "user not found";
			}die;
			$user_log = $this->auth_m->check_user_authentic();
			$accesslevel = $user_log['access_level'];
			if($accesslevel == 'Manager'){
				echo "Manager";die();
			}elseif ($accesslevel == 'Admin') {
				echo "Admin";die();
			}elseif ($accesslevel == 'Member') {
				echo "Member";die();
			}
		}else{
			echo "User does not exist";
		}


	}


	public function logout()
    {
        $sess_log = $this->session->userdata('userid');
        $log = $this->auth_m->logoutadmin($sess_log);

        $this->session->sess_destroy();
        redirect('/');
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