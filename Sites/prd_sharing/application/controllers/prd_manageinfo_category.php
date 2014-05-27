<?php
class PRD_ManageInfo_Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Info';

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageinfocategory/manageinfocategory', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}