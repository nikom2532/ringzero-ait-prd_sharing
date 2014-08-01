<?php
class PRD_reportPRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_report_prd_model');
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
			
			$data['title'] = 'Report';
			
			$showStatus = "";
			$this->load->library('authenstatus');
			$this->authenstatus->Group_ID = $this->session->userdata('Group_ID');
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			//showtstatus เอาไว้ กำหนดว่า จะ show menu อะไรไปบ้าง
			if($showStatus == "yes"){
			
				//manageNewEditPRD_record คือ เมื่อหลักจากกด search แล้วจะเข้ามาที่นี้
				if($this->input->post("manageNewEditPRD_record") == "yes"){
					// echo "record";
					$return = $this->prd_report_prd_model->set_prd_news(
						$this->input->post("NT01_NewsID"),
						$this->input->post("NT01_NewsTitle"),
						htmldecode($this->input->post("NT01_NewsDesc")),
						$this->input->post("NT01_NewsSource"),
						$this->input->post("NT01_NewsReferance"),
						$this->input->post("NT01_NewsTag"),
						$this->input->post("NewsTypeID"),
						$this->input->post("NewsSubTypeID"),
						$this->input->post("News_UpdateID")
					);
				}
				
				//manageNewEditPRD_record คือ เมื่อไม่ได้กด search แล้วจะเข้ามาที่นี้
				else if($this->input->get('is_del_oldnews') == "1"){
					$data['delete_News'] = $this->prd_report_prd_model->delete_News(
						$this->input->get('oldnews_id')
					);
					redirect(base_url().index_page()."manageNewPRD");
				}
				
				$data['New_News'] = $this->prd_report_prd_model->get_New_News();
				$data['SC03_User'] = $this->prd_report_prd_model->get_SC03_User();
				$row_per_page = 20;
				$data['SC07_Department'] = $this->prd_report_prd_model->get_SC07_Department();
				
				if($this->input->post("reportprd_is_search") == "yes"){
					
					// $NT01_NewsID_AttachmentFilter = $this->prd_report_prd_model->get_NT01_NewsID_FromAttachment(
						// $this->input->post('filter_vdo'),
						// $this->input->post('filter_sound'),
						// $this->input->post('filter_image'),
						// $this->input->post('filter_other')
					// );
					
					$get_NT01_NewsID_vdo = $this->prd_report_prd_model->get_NT01_NewsID_vdo(
						$this->input->post('filter_vdo')
					);
					$get_NT01_NewsID_picture = $this->prd_report_prd_model->get_NT01_NewsID_picture(
						$this->input->post('filter_image')
					);
					$get_NT01_NewsID_sound = $this->prd_report_prd_model->get_NT01_NewsID_sound(
						$this->input->post('filter_sound')
					);
					$get_NT01_NewsID_document = $this->prd_report_prd_model->get_NT01_NewsID_document(
						$this->input->post('filter_other')
					);
					
					if($get_NT01_NewsID_vdo != ""){
						$statusArray = array();
						foreach($get_NT01_NewsID_vdo as $val){
							$statusArray[] = "'".$val->NT01_NewsID."'";
						}
						$get_NT01_NewsID_vdo = implode(",",$statusArray);
					}
					if($get_NT01_NewsID_picture != ""){
						$statusArray = array();
						foreach($get_NT01_NewsID_picture as $val){
							$statusArray[] = "'".$val->NT01_NewsID."'";
						}
						$get_NT01_NewsID_picture = implode(",",$statusArray);
					}
					if($get_NT01_NewsID_sound != ""){
						$statusArray = array();
						foreach($get_NT01_NewsID_sound as $val){
							$statusArray[] = "'".$val->NT01_NewsID."'";
						}
						$get_NT01_NewsID_sound = implode(",",$statusArray);
					}
					if($get_NT01_NewsID_document != ""){
						$statusArray = array();
						foreach($get_NT01_NewsID_document as $val){
							$statusArray[] = "'".$val->NT01_NewsID."'";
						}
						$get_NT01_NewsID_document = implode(",",$statusArray);
					}
					
					
					
					$news = $this->prd_report_prd_model->
						get_NT01_News_Search(
							$page, 
							$row_per_page,
							$this->input->post('grov_active'),
							$this->input->post('start_date'),
							$this->input->post('end_date'),
							$this->input->post('NewsTypeID'),
							$this->input->post('NewsSubTypeID'),
							$this->input->post('reporter_id'),
							$get_NT01_NewsID_vdo,
							$get_NT01_NewsID_picture,
							$get_NT01_NewsID_sound,
							$get_NT01_NewsID_document
						);
					
					$count_row = $this->prd_report_prd_model->get_NT01_News_search_count(
						$get_NT01_NewsID_vdo,
						$get_NT01_NewsID_picture,
						$get_NT01_NewsID_sound,
						$get_NT01_NewsID_document
					);
						
					foreach ($news as $news_item) {
						foreach ($get_NT01_NewsID_vdo as $attachment_item) {
							if($news_item->NT01_NewsID == $attachment_item->NT01_NewsID){
								$news_item->NT10_FileStatus = $attachment_item->NT10_FileStatus;
							}
						}
						foreach ($get_NT01_NewsID_picture as $attachment_item) {
							if($news_item->NT01_NewsID == $attachment_item->NT01_NewsID){
								$news_item->NT11_FileStatus = $attachment_item->NT11_FileStatus;
							}
						}
						foreach ($get_NT01_NewsID_sound as $attachment_item) {
							if($news_item->NT01_NewsID == $attachment_item->NT01_NewsID){
								$news_item->NT12_FileStatus = $attachment_item->NT12_FileStatus;
							}
						}
						foreach ($get_NT01_NewsID_document as $attachment_item) {
							if($news_item->NT01_NewsID == $attachment_item->NT01_NewsID){
								$news_item->NT13_FileStatus = $attachment_item->NT13_FileStatus;
							}
						}
					}
					
					$data['post_grov_active'] = $this->input->post('grov_active');
					$data['post_start_date'] = $this->input->post('start_date');
					$data['post_end_date'] = $this->input->post('end_date');
					$data['post_News_type_id'] = $this->input->post('NewsTypeID');
					$data['post_News_subtype_id'] = $this->input->post('NewsSubTypeID');
					$data['post_reporter_id'] = $this->input->post('reporter_id');
					$data['post_filter_vdo'] = $this->input->post('filter_vdo');
					$data['post_filter_sound'] = $this->input->post('filter_sound');
					$data['post_filter_image'] = $this->input->post('filter_image');
					$data['post_filter_other'] = $this->input->post('filter_other');
				}
				else{	//## No Search ##
					$news = $this->prd_report_prd_model->get_NT01_News($page, $row_per_page);
					$count_row = $this->prd_report_prd_model->get_NT01_News_count();
					$data['post_grov_active'] = "";
					$data['post_start_date'] = "";
					$data['post_end_date'] = "";
					$data['post_News_type_id'] = "";
					$data['post_News_subtype_id'] = "";
					$data['post_reporter_id'] = "";
					$data['post_filter_vdo'] = "";
					$data['post_filter_sound'] = "";
					$data['post_filter_image'] = "";
					$data['post_filter_other'] = "";
				}
				
				if(isset($_POST["reportprd_is_search"])){
					$data["post_reportprd_is_search"] = $this->input->post("reportprd_is_search");
				}
				else {
					$data["post_reportprd_is_search"] = "";	
				}
				
				$data['news'] = $news;
				
				
				//############## Pagination = For no Search ################
				$data['count_row'] = $count_row;
				$url = "reportPRD";
				
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
				
				//Query update Old News to New News
				$this->prd_report_prd_model->set_FirstAddNews($news);
				
				
				$data['NT02_NewsType'] = $this->prd_report_prd_model->get_NT02_NewsType();
				$data['NT03_NewsSubType'] = $this->prd_report_prd_model->get_NT03_NewsSubType();
				
				$this->load->view('prdsharing/templates/header', $data);
				$this->load->view('prdsharing/reportprd/reportprd', $data);
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