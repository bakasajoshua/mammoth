<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_Dashboard');
	}

	public function index(){
		$data = [];

		$this->template
				->setPartial('Dashboard/dashboard_v', $data)
				->frontEndTemplate();
	}


	public function manager(){
		$data = [];

		$this->template
		     	->setPageTitle('Manager')
				->setPartial('Dashboard/dashboard_v', $data)
				->frontEndTemplate();
	}

	public function admin(){
		$data = [];

		$this->template
				->setPageTitle('Admin')
				->setPartial('Dashboard/dashboard_v', $data)
				->frontEndTemplate();
	}

	public function member(){
		$data = [];

		$this->template
				->setPageTitle('Member')
				->setPartial('Dashboard/dashboard_v', $data)
				->frontEndTemplate();
	}


}

/* End of file Dashboard.php */
/* Location: ./application/modules/User/controllers/Dashboard.php */