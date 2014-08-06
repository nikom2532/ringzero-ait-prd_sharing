<?php
class PRD_Report_detail_PRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_report_detail_prd_model');
	}

	public function index()
	{
		//Check Is Authen?
		// if($this->session->userdata('member_id') != ""){
			
			$data['member_id'] = $this->session->userdata('member_id');
			$data['session_Mem_Username'] = $this->session->userdata('Mem_Username');
			$data['session_Mem_Title'] = $this->session->userdata('Mem_Title');
			$data['session_Mem_Name'] = $this->session->userdata('Mem_Name');
			$data['session_Mem_LasName'] = $this->session->userdata('Mem_LasName');
			$data['session_Mem_EngName'] = $this->session->userdata('Mem_EngName');
			$data['session_Mem_EngLasName'] = $this->session->userdata('Mem_EngLasName');
			
			$data['title'] = 'Report';
			
			$showStatus = "";
			$this->load->library('authenstatus');
			$this->authenstatus->Group_ID = $this->session->userdata('Group_ID');
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			if($showStatus == "yes"){
				
				$this->prd_report_detail_prd_model->set_News_increase_view($this->input->get('news_id'));
				
				$data["news"] = $this->prd_report_detail_prd_model->get_NT01_News($this->input->get('news_id'));
				$data['New_News'] = $this->prd_report_detail_prd_model->get_New_News();
				
				$data['get_NT01_News_ReWriteName'] = $this->prd_report_detail_prd_model->get_NT01_News_ReWriteName($this->input->get('news_id'));
				$data['get_NT01_News_CreUser'] = $this->prd_report_detail_prd_model->get_NT01_News_CreUser($this->input->get('news_id'));
				$data['get_NT01_News_CamCoder'] = $this->prd_report_detail_prd_model->get_NT01_News_CamCoder($this->input->get('news_id'));
				$data['get_NT01_News_ApvUserName'] = $this->prd_report_detail_prd_model->get_NT01_News_ApvUserName($this->input->get('news_id'));
				$data['get_NT01_News_videos'] = $this->prd_report_detail_prd_model->get_NT01_News_query_file1($this->input->get('news_id'));
				$data['get_NT01_News_pictures'] = $this->prd_report_detail_prd_model->get_NT01_News_query_file2($this->input->get('news_id'));
				$data['get_NT01_News_Voice'] = $this->prd_report_detail_prd_model->get_NT01_News_query_file3($this->input->get('news_id'));
				$data['get_NT01_News_OtherFile'] = $this->prd_report_detail_prd_model->get_NT01_News_query_file4($this->input->get('news_id'));
				
				$this->load->view('prdsharing/templates/header', $data);
				$this->load->view('prdsharing/reportprd/report_detail_prd', $data);
				$this->load->view('prdsharing/templates/footer');
			}
			else{
				redirect(base_url().index_page().'', 'refresh');
			}
			
			
		// }
		// else{
			// redirect(base_url().index_page().'', 'refresh');
		// }
	}
}