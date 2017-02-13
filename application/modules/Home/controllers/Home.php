<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		// $this->assets->addCss('bootstrap/css/bootstrap.min.css');
		// $this->assets->addCss('dist/css/AdminLTE.min.css');
		// $this->assets->addCss('dist/css/skins/_all-skins.min.css');
		$this->load->library('Hash');
		// var_dump($this->hash->createUUID());die();
		$this->template
				->setPartial('home_v')
				->frontEndTemplate();
	}

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */