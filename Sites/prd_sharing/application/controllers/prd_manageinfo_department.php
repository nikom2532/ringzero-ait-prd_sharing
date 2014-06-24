<?php
class PRD_manageInfo_Department extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_manageinfo_department_model');
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
			
			$data['title'] = 'Manage Info';
			
			
			//For Query Add new
			if($this->input->post('info_department_is_add') == "yes"){
				// echo "save";
				// echo $this->input->post('dep_name');
				$this->prd_manageinfo_department_model->set_Department_New(
					$this->input->post('dep_name'),
					$this->input->post('dep_desc'),
					$this->input->post('dep_status'),
					$this->input->post('ministry_id')
				);
			}
		
		
			//For Query Save
			else if($this->input->post('info_department_is_submit') == "yes"){
				// echo "save";
				// echo $this->input->post('minis_status');
				$this->prd_manageinfo_department_model->set_Department(
					$this->input->post('dep_id'),
					$this->input->post('dep_name'),
					$this->input->post('dep_desc'),
					$this->input->post('dep_status'),
					$this->input->post('ministry_id')
				);
			}
			
			
			else if($this->input->get('del_department') == "1"){
				// echo "deleted";
				// echo $this->input->get('dep_id');
				$this->prd_manageinfo_department_model->del_Department(
					$this->input->get('dep_id')
				);
				
			}
			
			// var_dump($manageInfo_Category_is_search);
			
			$row_per_page = 20;
			//For Query Show
			if($this->input->post('manageInfo_Category_is_search') == "yes"){
				$data['department'] = $this->prd_manageinfo_department_model->get_Department_search(
					$page, 
					$row_per_page,
					$this->input->post('dep_name'), 
					$this->input->post('dep_status')
				);
				$count_row = $this->prd_manageinfo_department_model->get_Department_search_count(
					$this->input->post('dep_name'), 
					$this->input->post('dep_status')
				);
				
				$data['post_dep_name'] = $this->input->post('dep_name');
				$data['post_dep_status'] = $this->input->post('dep_status');
				
			}
			else{
				$data['department'] = $this->prd_manageinfo_department_model->get_Department(
					$page, 
					$row_per_page
				);
				$count_row = $this->prd_manageinfo_department_model->get_Department_count();
			}
			
			// $data['department'] = $this->prd_manageinfo_department_model->get_Department();
			
			//############## Pagination = For no Search ################
			$data['count_row'] = $count_row;
			$url = "manageInfo_Department";
			
			$total_page   = $count_row / $row_per_page;
			$page_mod     = $count_row % $row_per_page;
			if($page_mod > 0){
				list($unsign) = explode(".",$total_page);
				$total_page = $unsign + 1;
			}
			$currentPage = $page == null?1:$page;
			$page_url = array();
			for($i = 0;$i < $total_page;$i++){
				array_push($page_url,array(
						"page"    =>$i + 1,
						"value"   =>$i + 1,
						"selected"=>($i + 1 == $page?"selected=selected":"")
					));
			}
			$data['total_page'] = $total_page;
			$data['current_page'] = $currentPage;
			$data['jump_url'] = base_url().index_page().$url;
			$data['next_page'] = 
				$currentPage == $total_page
					? base_url().index_page().$url."$total_page"
					: base_url().index_page().$url.($currentPage + 1);
			$data["prev_page"] = 
				($currentPage > 1
				? base_url().index_page().$url.($currentPage - 1)
				: base_url().index_page().$url."1");
			$data["total_page"]  =
				($total_page == 0?1 : $total_page);
			$data["page_url"] = $page_url;
			$data["first_page"] = base_url().index_page().$url."1";
			$data["last_page"] = base_url().index_page().$url."$total_page";
			$data["current_page"] = $page;
			$data["row_per_page"] = $row_per_page;
			
			//#########################################################
			
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/manageinfocategory/manageinfodepartment', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect(base_url().index_page().'', 'refresh');
		}
	}
}