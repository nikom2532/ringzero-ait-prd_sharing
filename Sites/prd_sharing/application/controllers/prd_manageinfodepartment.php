<?php
class PRD_manageInfoDepartment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Info';

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageinfocategory/manageinfodepartment', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}