<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_User');
	}

	public function index(){
		$data = [];

		$data['usersTable'] = $this->createUsersTable();

		$this->assets
				->addCss('plugins/datatables/dataTables.bootstrap.css');
		$this->assets
			->addJs('plugins/datatables/jquery.dataTables.js')
		->addJs('plugins/datatables/dataTables.bootstrap.min.js');
		$this->assets->setJavascript('User/user_js');
		$this->template
				->setPartial('User/users_v', $data)
				->frontEndTemplate();
	}

	function createUsersTable(){
		$this->load->library('table');
		$this->load->config('table');

		$this->table->set_heading([
			'#',
			'Full Name',
			'Email Address',
			'User Type',
			'Status',
			'Action'
		]);

		$tableData = [];

		$users = $this->M_User->getAllUsers();
		if ($users) {
			$counter = 1;
			foreach ($users as $user) {
				$status = $user->status;

				$status_text = "";
				if($status == 1){
					$status_text = "<a class = 'label label-success'>Active</a>";
				}else{
					$status_text = "<a class = 'label label-danger'>Inactive</a>";
				}
				$tableData[] = [
					$counter,
					$user->fulname,
					$user->email,
					$user->access_level,
					$status_text,
					''
				];
			}
		}

		$template = $this->config->item('default');

		$this->table->set_template($template);

		return $this->table->generate($tableData);
	}

}

/* End of file User.php */
/* Location: ./application/modules/User/controllers/User.php */