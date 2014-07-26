<?php
class PRD_Authen_Normal_1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'Login PRD Sharing';
		$this->load->view('prdsharing/templates/header_authen', $data);
		$this->load->view('prdsharing/authen/login', $data);
	}
}