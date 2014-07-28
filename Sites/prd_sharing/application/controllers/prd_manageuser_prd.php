<?php
class PRD_ManageUser_PRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_manage_user_prd_model');
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
			
			$data['title'] = 'Manage Users';
			
			$showStatus = "";
			$this->load->library('authenstatus');
			$data["Group_ID"] = $this->session->userdata('Group_ID');
			$this->authenstatus->Group_ID = $data["Group_ID"];
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			if($showStatus == "yes"){
			
				$data['CM06_Province'] = $this->prd_manage_user_prd_model->get_CM06_Province();
				$data['Department'] = $this->prd_manage_user_prd_model->get_Department();
				
				$row_per_page = 20;
				
				if($this->input->post('manage_user_is_search') == "yes"){
					
					//Get Province
					// $get_UserOld = $this->prd_manage_user_prd_model->get_UserOld($this->input->post('province_id'), $this->input->post('search_key'));
					// $get_UserNew = $this->prd_manage_user_prd_model->get_UserNew($get_UserOld, $this->input->post('mem_status'));
					
					// foreach ($get_UserNew as $get_UserNew_item) {
						// echo $get_UserNew_item->Mem_ID."<br/>";
					// }
					// exit;
					
					$Member_OldID = $this->prd_manage_user_prd_model->get_Member_Status(
						$this->input->post('mem_status')
					);
					
					$SC03_User = $this->prd_manage_user_prd_model->get_SC03_User_search(
						$page, 
						$row_per_page,
						$this->input->post('search_key'),
						$this->input->post('province_id'),
						$Member_OldID
					);
					
					$count_row = $this->prd_manage_user_prd_model->count_SC03_User_search(
						$this->input->post('search_key'),
						$this->input->post('province_id'),
						$Member_OldID
					);
					
					$data['post_search_key'] = $this->input->post('search_key');
					$data['post_mem_status'] = $this->input->post('mem_status');
					$data['post_province_id'] = $this->input->post('province_id');
					
					//###### Add Mem_Status to SC03_User ######
					foreach ($SC03_User as $SC03_User_item) {
						foreach ($Member_OldID as $Member_item) {
							if($SC03_User_item->SC03_UserId == $Member_item->Mem_OldID){
								if($Member_item->Mem_Status == 1){
									$SC03_User_item->Mem_Status = 1;
								}
							}
						}
					}
					
				}
				else{
					$Member_OldID = $this->prd_manage_user_prd_model->get_Member();
					$SC03_User = $this->prd_manage_user_prd_model->get_SC03_User(
						$page, 
						$row_per_page
					);
					$count_row = $this->prd_manage_user_prd_model->count_SC03_User();
					
					$data['post_search_key'] = "";
					$data['post_mem_status'] = "";
					$data['post_province_id'] = "";
					
					//###### Add Mem_Status to SC03_User ######
					foreach ($SC03_User as $SC03_User_item) {
						foreach ($Member_OldID as $Member_item) {
							if($SC03_User_item->SC03_UserId == $Member_item->Mem_OldID){
								if($Member_item->Mem_Status == 1){
									$SC03_User_item->Mem_Status = 1;
								}
							}
						}
					}
					//###### End Add Mem_Status to SC03_User ######
				}
				
				$data['SC03_User'] = $SC03_User;
				$data['Member'] = $Member_OldID;
				
				$data['SC07_Department'] = $this->prd_manage_user_prd_model->get_SC07_Department();
				
				$data['set_Update_SC03_User'] = $this->prd_manage_user_prd_model->set_Update_SC03_User(
					$this->prd_manage_user_prd_model->get_SC03_User_ForUpdate()
				);
				
				
				//############## Pagination = For no Search ################
				$data['count_row'] = $count_row;
				$url = "manageUserPRD";
				
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
				$this->load->view('prdsharing/manageuser/manageuser_prd', $data);
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