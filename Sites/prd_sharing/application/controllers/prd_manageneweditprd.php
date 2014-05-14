<?php
class PRD_manageNewEditPRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'Manage News';

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/managenew/manageneweditprd', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}