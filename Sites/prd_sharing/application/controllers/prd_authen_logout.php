<?php
class PRD_Authen_Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_authen_model');
	}

	public function index()
	{
		//Logout
		$this->session->unset_userdata('member_id');
		redirect('/', 'refresh');
	}
}