<?php
class PRD_ManageNew_detail_GROV extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_managenew_detail_grov_model');
	}

	public function index()
	{
		$data['title'] = 'Manage News';

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/managenew/detail_grov', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}