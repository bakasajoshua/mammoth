<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->module('Template');
		$this->load->module('Auth');
		$this->auth->checkLogin();
	}
}
