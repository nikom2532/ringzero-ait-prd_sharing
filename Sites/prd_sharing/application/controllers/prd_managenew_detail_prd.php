<?php
class PRD_ManageNew_detail_PRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_managenew_detail_prd_model');
	}

	public function index()
	{
		$data['title'] = 'Manage News';
		
		$data["news"] = $this->prd_managenew_detail_prd_model->get_NT01_News($this->input->get('news_id'));

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/managenew/detail_prd', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}