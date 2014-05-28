<?php
class PRD_manageInfo_Ministry extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_manageinfo_ministry_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Info';
		
		if($this->input->post('manageinfo_ministry_is_search') == "yes"){
			$data['ministry'] = $this->prd_manageinfo_ministry_model->get_Ministry_search($this->input->post('minis_name'));
			
			if($this->input->post('minis_name') != ""){
				$data['post_minis_name'] = $this->input->post('minis_name');
			}
		}
		else{
			$data['ministry'] = $this->prd_manageinfo_ministry_model->get_Ministry();
		}
		
		
		// var_dump($data['ministry']);
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageinfocategory/manageinfoministry', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}