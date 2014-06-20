<?php
class PRD_ManageNewGROV extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_managenewgrov_model');
		$this->load->library("pagination");
	}

	public function index($page = 1)
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
			
			$row_per_page = 20;
			
			if($this->input->post("manageNewEditPRD_record") == "yes"){
				// echo "record";
				$return_manageNewEditPRD_record = $this->prd_managenewgrov_model->set_prd_news(
					$this->input->post("SendIn_ID"),
					$this->input->post("SendIn_Plan"),
					$this->input->post("SendIn_Issue")
				);
				// var_dump($return_manageNewEditPRD_record);
			}
			elseif ($this->input->post('sentnew_is_add')) {
				$query_sentnew_record = $this->prd_managenewgrov_model->set_sentnew(
					$this->input->post('create_date'),
					$this->input->post('Minis_ID'),
					$this->input->post('Dep_ID'),
					$this->input->post('NT05_PolicyID'),
					$this->input->post('Tar_ID'),
					$this->input->post('grov_active'),
					$this->input->post('prd_active'),
					$this->input->post('SendIn_Plan'),
					$this->input->post('SendIn_Issue'),
					$this->input->post('SendIn_Detail')
				);
			}
			
			if($this->input->post("manageNewGROV_is_submit") == "yes"){
				
				$data['news'] = $this->prd_managenewgrov_model->get_grov_search(
					$page,
					$row_per_page,
					$this->input->post("sendin_issue"), 
					$this->input->post("start_date"), 
					$this->input->post("end_date"),
					$this->input->post("Ministry_ID"),
					$this->input->post("Dep_ID")
				);
				
				$data['post_sendin_issue'] = $this->input->post('sendin_issue');
				$data['post_start_date'] = $this->input->post('start_date');
				$data['post_end_date'] = $this->input->post('end_date');
				$data['post_Ministry_ID'] = $this->input->post('Ministry_ID');
				$data['post_Dep_ID'] = $this->input->post('Dep_ID');
				
			}
			else{
				// echo "no search";
				$data['news'] = $this->prd_managenewgrov_model->get_grov(
					$page,
					$row_per_page
				);
			}
			
			$data['ministry'] = $this->prd_managenewgrov_model->get_ministry();
			$data['department'] = $this->prd_managenewgrov_model->get_department();
	
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/managenew/managenewgrov', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect('/', 'refresh');
		}
	}
	public function get_department($Ministry_ID ='')
	{
		$_data = $this->prd_managenewgrov_model->get_department_Unique($Ministry_ID);
		echo json_encode($_data);
	}
}