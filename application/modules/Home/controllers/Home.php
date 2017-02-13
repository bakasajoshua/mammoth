<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		$this->assets->addCss('sample.css');

		$this->assets->addJs('sample.js');
		$this->template
				->setPartial('home_v')
				->frontEndTemplate();
	}

}

/* End of file Home.php */
/* Location: ./application/modules/Home/controllers/Home.php */