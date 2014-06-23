<?php
class PRD_manageInfo_Ministry extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_manageinfo_ministry_model');
		// $this->load->model('prd_manageinfo_department_model');
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
			
			
			//############### For Query Show #########################
			
			$row_per_page = 20;
			
			if($this->input->post('manageinfo_ministry_is_search') == "yes"){
				$data['ministry'] = $this->prd_manageinfo_ministry_model->get_Ministry_search(
					$page, 
					$row_per_page,
					$this->input->post('minis_name'),
					$this->input->post('minis_status')
				);
				
				$count_row = $this->prd_manageinfo_ministry_model->get_Ministry_search_count(
					$this->input->post('minis_name'),
					$this->input->post('minis_status')
				);
				
				
				
				$data['department'] = $this->prd_manageinfo_ministry_model->get_Department();
				
				$data['post_minis_name'] = $this->input->post('minis_name');
				$data['post_minis_status'] = $this->input->post('minis_status');
			}
			else{
				$data['ministry'] = $this->prd_manageinfo_ministry_model->get_Ministry(
					$page, 
					$row_per_page
				);
				$count_row = $this->prd_manageinfo_ministry_model->get_Ministry_count();
				$data['department'] = $this->prd_manageinfo_ministry_model->get_Department();
			}
			
			//############### End For Query Show #######################
			
			if($this->input->post('info_ministry_is_submit') == "yes"){
				$data['ministry_is_save'] = "yes";
			}
			else{
				$data['ministry_is_save'] = "no";
			}
			
			//############## Pagination = For no Search ################
			$data['count_row'] = $count_row;
			$url = "manageInfo_Ministry";
			
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
			$data['jump_url'] = base_url().$url;
			$data['next_page'] = 
				$currentPage == $total_page
					? base_url().$url."$total_page"
					: base_url().$url.($currentPage + 1);
			$data["prev_page"] = 
				($currentPage > 1
				? base_url().$url.($currentPage - 1)
				: base_url().$url."1");
			$data["total_page"]  =
				($total_page == 0?1 : $total_page);
			$data["page_url"] = $page_url;
			$data["first_page"] = base_url().$url."1";
			$data["last_page"] = base_url().$url."$total_page";
			$data["current_page"] = $page;
			$data["row_per_page"] = $row_per_page;
			
			//#########################################################
			
			// var_dump($data['ministry']);
			
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/manageinfocategory/manageinfoministry', $data);
			$this->load->view('prdsharing/templates/footer');
		
		}
		else{
			redirect(base_url().'', 'refresh');
		}
	}
}