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

}

/* End of file Hash.php */
/* Location: ./application/libraries/Hash.php */
