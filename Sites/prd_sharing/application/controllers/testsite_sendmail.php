<?php
class Testsite_SendMail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}

	public function index()
	{
		
		$config['protocol'] = 'smtp';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = "mail.aitinnovation.co.th";
		$config['smtp_user'] = "no-reply@aitinnovation.co.th";
		$config['smtp_pass'] = "shk,9v[";
		$config['smtp_port'] = 25;

		/*$config['smtp_host'] = "ssl://smtp.googlemail.com";
		$config['smtp_user'] = "jayza.06@gmail.com";
		$config['smtp_pass'] = "061420029";
		$config['smtp_port'] = "465";*/
		
		/*$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'jayza.06@gmail.com',
		    'smtp_pass' => '061420029',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);*/
		
		$this->email->initialize($config);

		/*$this->email->from('nikom2532@gmail.com', 'Arming Huang naa');
		$this->email->to('nikom2532@gmail.com'); */

		$this->email->from('jayza.06@gmail.com', 'NLz_');
		$this->email->to('jayza.06@gmail.com'); 
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	
		
		$this->email->send();
		
		echo $this->email->print_debugger();
		
		
		// $this->load->view('prdsharing/templates/header_authen', $data);
		// $this->load->view('prdsharing/manageuser/userinfo_register', $data);
		// $this->load->view('prdsharing/templates/footer');
	}
}