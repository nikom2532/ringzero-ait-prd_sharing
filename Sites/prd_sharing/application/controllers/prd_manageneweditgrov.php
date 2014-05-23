<?php
class PRD_manageNewEditGROV extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_manageneweditgrov_model');
	}

	public function index()
	{
		$data['title'] = 'Manage News';
		$data['news'] = $this->prd_manageneweditgrov_model->get_grov($this->input->get('sendin_id'));
		
		// var_dump($data['news']);
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/managenew/manageneweditgrov', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}