<?php
class PRD_HomePRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('test_model');
	}

	public function index()
	{
		$data['title'] = 'Home PRD';
		$data['test'] = $this->test_model->get_test();
		
		// var_dump($data['test']);

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/home/header', $data);
		$this->load->view('prdsharing/home/homeprd', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}