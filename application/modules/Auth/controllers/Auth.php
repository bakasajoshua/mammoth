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

		$user_exist = $this->auth_m->check_user_exist();

		if($user_exist){
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
        $log = $this->auth_m->logoutuser($sess_log);

        $this->session->sess_destroy();
        redirect(base_url().'Auth');
    }



}

/* End of file Auth.php */
/* Location: ./application/modules/Auth/controllers/Auth.php */