<?php
class PRD_reportPRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'Report';

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/reportprd/reportprd', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}