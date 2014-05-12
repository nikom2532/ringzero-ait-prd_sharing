<?php
class PRD_UserInfo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Users';

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageuser/userinfo', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}