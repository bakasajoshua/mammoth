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

				$counter++;
			}
		}

		$template = $this->config->item('default');

		$this->table->set_template($template);

		return $this->table->generate($tableData);
	}

	function add(){
		$this->assets
				->addCss('plugins/select2/select2.min.css')
				->addJs('plugins/select2/select2.full.min.js')
				->setJavascript('User/user_js');
		$this->template
					->setPartial('User/user_details')
					->frontEndTemplate();
	}

	function completeReg(){
		if ($this->input->post()) {
			$this->load->helper('string');
			$this->load->library('Hash');

			$fullname = $this->input->post('user_fullname');
			$email = $this->input->post('user_emailaddress');
			$department = $this->M_User->findDepartmentByUUID($this->input->post('department'))->deptid;
			$access_level = $this->M_User->findAccessLevelByUUID($this->input->post('access_level'))->accessid;

			// Generate random password
			$randomPassword = random_string('alnum', 6);
			$hashedPassword = $this->hash->hashPassword($randomPassword);

			// Check whether email exists in db
			$user = $this->M_User->getUserByEmail($email);
			if (!$user) {
				$user = new StdClass;
				$user->uuid = $this->hash->createUUID();
				$user->fulname = $fullname;
				$user->email = $email;
				$user->password = $hashedPassword;
				$user->access_level = $access_level;
				$user->status = 1;
				$user->dept_id = $department;

				$this->M_User->addUser($user);

				// Send email
				$data = [
					'name'	=>	$fullname,
					'password'	=>	$randomPassword,
					'emailaddress'	=>	$email
				];

				$email_view = $this->load->view('Template/account_created_v', $data, TRUE);
				$subject = "Report Mammoth Account";

				$this->load->library('SendgridLib');
				$this->sendgridlib->sendMail($subject, ['name'	=>	$fullname, 'email'	=>	$email], $email_view);

				redirect('User','refresh');
			}else{
				redirect('User/add','refresh');
			}
		}else{
			redirect('User/add','refresh');
		}
	}

	function testMail(){
		$this->load->library('SendgridLib');

		$this->sendgridlib->sendMail();
	}

	// Ajax Data
	public function getDepartments(){
		$departments = $this->M_User->getDepartments();

		$department_data = [];
		if ($departments) {
			foreach ($departments as $department) {
				$department_data[] = [
					'id'	=>	$department->uuid,
					'text'	=>	$department->desc
				];
			}
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($department_data));
	}

	public function getAccessLevels(){
		$access_levels = $this->M_User->getAccessLevels();

		$access_data = [];
		if ($access_levels) {
			foreach ($access_levels as $access) {
				$access_data[] = [
					'id'	=>	$access->uuid,
					'text'	=>	$access->desc
				];
			}
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($access_data));
	}
}

/* End of file User.php */
/* Location: ./application/modules/User/controllers/User.php */