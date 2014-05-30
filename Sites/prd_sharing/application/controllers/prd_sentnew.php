<?php
class PRD_sentNew extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PRD_SentNew_model');
	}

	public function index()
	{
		$data['title'] = 'Sent News';
		
		$data['Ministry'] = $this->PRD_SentNew_model->get_Ministry();
		$data['Department'] = $this->PRD_SentNew_model->get_Department();
		$data['NT05_Policy'] = $this->PRD_SentNew_model->get_NT05_Policy();
		$data['TargetGroup'] = $this->PRD_SentNew_model->get_TargetGroup();
		
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/sentnew/sentnew', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}