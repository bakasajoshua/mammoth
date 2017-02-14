<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller {
	protected $asset_url;

	protected $pageTitle;
	protected $pageDescription;
	protected $contentView;
	protected $contentViewData;
	protected $metaData;

	function __construct(){
		$this->asset_url = $this->config->item('assets_url');
		$this->load->library('Assets', $this->config);
	}
	function adminTemplate(){
		$data['page_css'] = $this->assets->css;
		$data['page_js'] = $this->assets->js;


		$data['javascript_file'] = $this->assets->javascript_file;
		$data['javascript_data'] = $this->assets->javascript_data;
		$data['user_details'] = $user_details;

		$data['menu'] = $this->createSideBar();
		$data['pagetitle'] = $this->pageTitle;
		$data['pagedescription'] = $this->pageDescription;
		$data['partial'] = $this->contentView;
		$data['partialData'] = $this->contentViewData;

		$this->load->view('Template/admin_template_v', $data);
	}

	function frontEndTemplate(){
		$data['metadata'] = $this->metaData;

		$data['page_css'] = $this->assets->css;
		$data['page_js'] = $this->assets->js;
		$this->load->module('User');
		$user = $this->M_User->findUserByUUID($this->session->userdata('uuid'));
		$data['userDetails'] = $user;

		$data['pagetitle'] = $this->pageTitle;
		$data['pagedescription'] = $this->pageDescription;

		$data['menu']	=	$this->createSideBar();

		$data['partial'] = $this->contentView;
		$data['partialData'] = $this->contentViewData;

		$data['javascript_file'] = $this->assets->javascript_file;
		$data['javascript_data'] = $this->assets->javascript_data;
		$this->load->view('Template/frontend_template_v', $data);
	}

	function createSideBar($selected = null){

		$class = $this->router->class;
		$menus = [];
		$menu_list = "";
		// ,
		// 	'orders'	=>	[
		// 		'icon'	=>	'fa fa-shopping-cart',
		// 		'text'	=>	'Orders',
		// 		'link'	=>	'Backend/Orders'
		// 	]
		$menus = [
			'dashboard'	=>	[
				'icon'	=>	'fa fa-tachometer',
				'text'	=>	'Dashboard',
				'link'	=>	'Dashboard/',
				'allowed'	=>	[1]
			],
			'Reports' => [
				'icon'	=>	'fa fa-file-o',
				'text'	=>	'Report Management',
				'link'	=>	'Manager/',
				'allowed'	=>	[1, 2]
			],
			'tickets'	=>	[
				'icon'	=>	'fa fa-ticket',
				'text'	=>	'Report Content Management',
				'link'	=>	'Members',
				'allowed'	=>	[3]
			],
			'logout'	=>	[
				'icon'	=>	'fa fa-sign-out',
				'text'	=>	'Log Out',
				'link'	=>	'Auth/logout',
				'allowed'	=>	[1, 2, 3]
			]
		];

		if (count($menus) > 0) {
			foreach ($menus as $key => $item) {
				$active = "";
				if (in_array($this->session->userdata('access_level'), $item['allowed'])) {
					$menu_list .= "<li {$active}><a href='".base_url()."{$item['link']}'><i class='{$item['icon']}'></i> <span>{$item['text']}</span></a></li>";
				}
				
			}
		}

		return $menu_list;
	}

	function setPageTitle($page_title = ""){
		$this->pageTitle = $page_title;

		return $this;
	}

	function setPageDescription($pageDescription){
		$this->pageDescription = $pageDescription;

		return $this;
	}

	function setPartial($view, $data = []){
		$this->contentView = $view;
		$this->contentViewData = $data;

		return $this;
	}

	function setMetaData($key, $value){
		$metadata_string = "";

		$metadata_string = "<meta property = '{$key}' content = '{$value}'>\r\n";

		$this->metaData .= $metadata_string;

		return $this;
	}
}

/* End of file Template.php */
/* Location: ./application/modules/Template/controllers/Template.php */