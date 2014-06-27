<?php
class PRD_ManageInfo_Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_manageinfo_category_model');
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
			
			$showStatus = "";
			$this->load->library('authenstatus');
			$this->authenstatus->Group_ID = $this->session->userdata('Group_ID');
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			if($showStatus == "yes"){
				
				$row_per_page = 20;
				$data_Category = $this->prd_manageinfo_category_model->get_Category(); // For load all Category New
				
				if($this->input->post('manageInfo_Category_is_search') == "yes"){
					
					$NT02_NewsType_search1 = $this->prd_manageinfo_category_model->NT02_NewsType_search1();
					$Category_search2 = $this->prd_manageinfo_category_model->Category_search2(
						$NT02_NewsType_search1,
						$this->input->post('NT02_Status')
					);
					
					$data_NT02_NewsType = $this->prd_manageinfo_category_model->get_NT02_NewsType_search(
						$this->input->post('NT02_TypeName'),
						$Category_search2,
						$page,
						$row_per_page//,
						// $this->input->post('NT02_Status')
					);
					
					foreach ($data_NT02_NewsType as $category_old) {
						foreach ($data_Category as $category_new) {
							if($category_old->NT02_TypeID == $category_new->Cate_OldID){
								$category_old->NT02_Status = $category_new->Cate_Status;
							}
						}
					}
					
					$data['category_old'] = $data_NT02_NewsType;
					
					$count_row = $this->prd_manageinfo_category_model->get_NT02_NewsType_search_count(
						$this->input->post('NT02_TypeName'),
						$Category_search2
					);
					$data['post_NT02_TypeName'] = $this->input->post('NT02_TypeName');
					$data['post_NT02_Status'] = $this->input->post('NT02_Status');
				}
				
				else{
					$data_NT02_NewsType = $this->prd_manageinfo_category_model->get_NT02_NewsType($page, $row_per_page);
					
					foreach ($data_NT02_NewsType as $category_old) {
						foreach ($data_Category as $category_new) {
							if($category_old->NT02_TypeID == $category_new->Cate_OldID){
								$category_old->NT02_Status = $category_new->Cate_Status;
							}
						}
					}
					$data['category_old'] = $data_NT02_NewsType;
					$count_row = $this->prd_manageinfo_category_model->get_NT02_NewsType_count();
				}
				
				//############## Pagination = For no Search ################
				$data['count_row'] = $count_row;
				$url = "manageInfo_Category";
				
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
				$this->load->view('prdsharing/manageinfocategory/manageinfocategory', $data);
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
	
	public function set_category($cate_oldid='' )
	{
		if($this->session->userdata('member_id') != ""){
			$_data = $this->prd_manageinfo_category_model->
				set_Category(
					$cate_oldid
				);
				
			echo json_encode($_data);
		}
		else{
			redirect(base_url().index_page().'', 'refresh');
		}
	}
}