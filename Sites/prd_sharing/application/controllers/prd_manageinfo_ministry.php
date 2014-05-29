<?php
class PRD_manageInfo_Ministry extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prd_manageinfo_ministry_model');
		// $this->load->model('prd_manageinfo_department_model');
	}

	public function index()
	{
		$data['title'] = 'Manage Info';
		
		
		//For Query Add
		if($this->input->post('info_ministry_is_add') == "yes"){
			// echo "save";
			// echo $this->input->post('minis_status');
			$this->prd_manageinfo_ministry_model->set_Minstry_new(
				$this->input->post('minis_name'),
				$this->input->post('minis_desc'),
				$this->input->post('minis_status')
			);
		}
		
		
		
		
		//For Query Save
		else if($this->input->post('info_ministry_is_submit') == "yes"){
			// echo "save";
			// echo $this->input->post('minis_status');
			$this->prd_manageinfo_ministry_model->set_Minstry(
				$this->input->post('minis_id'),
				$this->input->post('minis_name'),
				$this->input->post('minis_desc'),
				$this->input->post('minis_status')
			);
		}
		
		// For Query Delete Ministry
		else if($this->input->get('del_ministry') == "1"){
			$Ministry_children_query = $this->prd_manageinfo_ministry_model->Ministry_children_key(
				$this->input->get('minis_id')
			);
			
			if(count($Ministry_children_query) == 0){
				echo "deleted";
				$department_delete_query = $this->prd_manageinfo_ministry_model->del_Ministry(
					$this->input->get('minis_id')
				);
				
			}
			
			
			// var_dump($department_delete_query);
		}
		
		
		//For Query Show
		if($this->input->post('manageinfo_ministry_is_search') == "yes"){
			$data['ministry'] = $this->prd_manageinfo_ministry_model->get_Ministry_search($this->input->post('minis_name'));
			
			if($this->input->post('minis_name') != ""){
				$data['post_minis_name'] = $this->input->post('minis_name');
			}
		}
		else{
			$data['ministry'] = $this->prd_manageinfo_ministry_model->get_Ministry();
			$data['department'] = $this->prd_manageinfo_ministry_model->get_Department();
		}
		
		if($this->input->post('info_ministry_is_submit') == "yes"){
			$data['ministry_is_save'] = "yes";
		}
		else{
			$data['ministry_is_save'] = "no";
		}
		
		
		// var_dump($data['ministry']);
		
		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/manageinfocategory/manageinfoministry', $data);
		$this->load->view('prdsharing/templates/footer');
		
	}
}