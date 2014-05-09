<?php
class PRD_sentNew extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'Sent News';

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/sentnew/sentnew', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}