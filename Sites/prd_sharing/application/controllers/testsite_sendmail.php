<?php
class Testsite_SendMail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->library('email');
		
		$config['protocol'] = 'smtp';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = "mail.aitinnovation.co.th";
		$config['smtp_user'] = "no-reply@aitinnovation.co.th";
		$config['smtp_pass'] = "shk,9v[";
		
		
		
		$this->email->initialize($config);
		
		$this->email->from('nikom2532@gmail.com', 'Arming Huang naa');
		$this->email->to('nikom2532@gmail.com'); 
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	
		
		$this->email->send();
		
		echo $this->email->print_debugger();
		
		
		// $this->load->view('prdsharing/templates/header_authen', $data);
		// $this->load->view('prdsharing/manageuser/userinfo_register', $data);
		// $this->load->view('prdsharing/templates/footer');
	}
}