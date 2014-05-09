<?php
class PRD_rss extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'News archive';

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/rss/rss', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}