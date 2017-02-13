<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Hash
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function createUUID()
	{
		return Uuid::uuid4();
	}

	function hashPassword($password){
		return password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
	}
}

/* End of file Hash.php */
/* Location: ./application/libraries/Hash.php */
