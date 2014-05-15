<?php
class PRD_HomeGOVE extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'Home PRD';

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/home/header', $data);
		$this->load->view('prdsharing/home/homegove', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}