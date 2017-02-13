<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->load->view('Auth/login_v', $data, FALSE);
	}

}

/* End of file Auth.php */
/* Location: ./application/modules/Auth/controllers/Auth.php */