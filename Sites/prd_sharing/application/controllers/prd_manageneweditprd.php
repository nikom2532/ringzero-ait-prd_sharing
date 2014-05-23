<?php
class PRD_manageNewEditPRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_manageneweditprd_model');
	}

	public function index()
	{
		$data['title'] = 'Manage News';
		
		$data['news'] = $this->prd_manageneweditprd_model->get_NT01_News();

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/managenew/manageneweditprd', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}