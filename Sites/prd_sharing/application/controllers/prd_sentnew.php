<?php
class PRD_sentNew extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'News archive';

		$this->load->view('templates/header', $data);
		$this->load->view('sentnew/sentnew', $data);
		$this->load->view('templates/footer');
	}
}