<?php
class PRD_manageNewEditGROV extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_manageneweditgrov_model');
	}

	public function index()
	{
		//Check Is Authen?
		if($this->session->userdata('member_id') != ""){
			
			$data['title'] = 'Manage News';
			$data['news'] = $this->prd_manageneweditgrov_model->get_grov($this->input->get('sendin_id'));
			$data['TargetGroup'] = $this->prd_manageneweditgrov_model->get_TargetGroup();
			$data['SC07_Department'] = $this->prd_manageneweditgrov_model->get_SC07_Department();
			$data['Ministry'] = $this->prd_manageneweditgrov_model->get_Ministry();
			
			// var_dump($data['news']);
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/managenew/manageneweditgrov', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect('/', 'refresh');
		}
	}
}