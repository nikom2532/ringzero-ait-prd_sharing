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
			
			$data['member_id'] = $this->session->userdata('member_id');
			$data['session_Mem_Username'] = $this->session->userdata('Mem_Username');
			$data['session_Mem_Title'] = $this->session->userdata('Mem_Title');
			$data['session_Mem_Name'] = $this->session->userdata('Mem_Name');
			$data['session_Mem_LasName'] = $this->session->userdata('Mem_LasName');
			$data['session_Mem_EngName'] = $this->session->userdata('Mem_EngName');
			$data['session_Mem_EngLasName'] = $this->session->userdata('Mem_EngLasName');
			
			$data['title'] = 'Manage News';
			
			$showStatus = "";
			$this->load->library('authenstatus');
			$this->authenstatus->Group_ID = $this->session->userdata('Group_ID');
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			
			if($this->input->post("manageNewEditGROV_record") == "yes"){
				// echo "record";
				$return_manageNewEditGROV_record = $this->prd_manageneweditgrov_model->set_prd_news(
					$this->input->post("SendIn_ID"),
					$this->input->post("SendIn_Plan"),
					$this->input->post("SendIn_Issue"),
					$this->input->post('Minis_ID'),
					$this->input->post('Dep_ID'),
					$this->input->post('NT05_PolicyID'),
					$this->input->post('Tar_ID'),
					$this->input->post('grov_active'),
					$this->input->post('prd_active'),
					$this->input->post('SendIn_Detail')
					
				);
				// var_dump($return_manageNewEditGROV_record);
				
				redirect(base_url().index_page().'manageNewGROV', 'refresh');
			}
			elseif($this->input->get('is_del_fileattach') == "1"){
				$delete_fileattach_get_SendIn_ID = $this->prd_manageneweditgrov_model->delete_FileAttach(
					$this->input->get('File_ID')
				);
				
				redirect(base_url().index_page()."manageNewEditGROV?sendin_id=".$delete_fileattach_get_SendIn_ID);
			}
			
			if($showStatus == "yes"){
				
				$data['news'] = $this->prd_manageneweditgrov_model->get_grov($this->input->get('sendin_id'));
				$data['TargetGroup'] = $this->prd_manageneweditgrov_model->get_TargetGroup();
				$data['SC07_Department'] = $this->prd_manageneweditgrov_model->get_SC07_Department();
				$data['Ministry'] = $this->prd_manageneweditgrov_model->get_Ministry();
				$data['NT05_Policy'] = $this->prd_manageneweditgrov_model->get_NT05_Policy();
				
				$data['FileAttach'] = $this->prd_manageneweditgrov_model->get_FileAttach($this->input->get('sendin_id'));
				
				// var_dump($data['news']);
				$this->load->view('prdsharing/templates/header', $data);
				$this->load->view('prdsharing/managenew/manageneweditgrov', $data);
				$this->load->view('prdsharing/templates/footer');
				
			}
			else{
				redirect(base_url().index_page().'', 'refresh');
			}
		}
		else{
			redirect(base_url().index_page().'', 'refresh');
		}
	}
}