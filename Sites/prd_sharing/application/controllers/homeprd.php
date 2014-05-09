<?php
class HomePRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');
	}

	public function index()
	{
		$data['title'] = 'News archive';

		$this->load->view('templates/header', $data);
		$this->load->view('home/homeprd', $data);
		$this->load->view('templates/footer');
	}
}