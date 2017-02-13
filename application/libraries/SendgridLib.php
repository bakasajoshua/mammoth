<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendgridLib
{
	protected $ci;

	public function __construct(){
        $this->ci =& get_instance();
	}

	function sendMail($subject, $to, $view){
		$from = new SendGrid\Email("Mammoth Accounts", "accounts@mammoth.com");
		$to = new SendGrid\Email($to['name'], $to['email']);
		$content = new SendGrid\Content("text/html", $view);
		$mail = new SendGrid\Mail($from, $subject, $to, $content);

		$apiKey = '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';
		$sg = new \SendGrid($apiKey);

		$response = $sg->client->mail()->send()->post($mail);
		return $response->statusCode();
	}
	

}

/* End of file Sendgrid.php */
/* Location: ./application/libraries/Sendgrid.php */
