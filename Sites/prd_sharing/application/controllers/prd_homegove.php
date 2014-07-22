<?php
class PRD_HomeGOVE extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_homegove_model');
		$this->load->model('prd_rss_home_gove_model');
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
			
			
			$data['title'] = 'Home';
			
			$showStatus = "";
			$this->load->library('authenstatus');
			$this->authenstatus->Group_ID = $this->session->userdata('Group_ID');
			$this->authenstatus->page_title = $data['title'];
			$showStatus = $this->authenstatus->checkGroupID();
			$data['getMenuHeader'] = $this->authenstatus->getMenuHeader();
			
			$CI_stringManagement =& get_instance();
			$CI_stringManagement->load->library('string_management');
			$data["CI_stringManagement"] = $CI_stringManagement;
			
			if($showStatus == "yes"){
			
				$row_per_page = 20;
				
				// $data['get_grov_fileattach'] = $this->prd_homegove_model->get_grov_fileattach();
				$FileAttach = $this->prd_homegove_model->get_FileAttach();
				
				if($this->input->post("news_title") != ""){
					if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
						$news = $this->prd_homegove_model->
							get_gove_search_title_start_end(
								$page, 
								$row_per_page,
								($this->input->post("news_title")), 
								($this->input->post("start_date")), 
								($this->input->post("end_date")) 
							);
						$count_row = $this->prd_homegove_model->
							get_gove_search_title_start_end_count(
								$this->input->post("news_title"),
								$this->input->post("start_date"),
								$this->input->post("end_date")
							);
						$data['post_news_title'] = $this->input->post("news_title");
						$data['post_start_date'] = $this->input->post("start_date");
						$data['post_end_date'] = $this->input->post("end_date");
					}
					elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){
						$news = $this->prd_homegove_model->
							get_gove_search_title_start(
								$page, 
								$row_per_page,
								($this->input->post("news_title")), 
								($this->input->post("start_date")) 
							);
						$count_row = $this->prd_homegove_model->
							get_gove_search_title_start_count(
								$this->input->post("news_title"),
								$this->input->post("start_date")
							);
						$data['post_news_title'] = $this->input->post("news_title");
						$data['post_start_date'] = $this->input->post("start_date");
					}
					elseif(!($this->input->post('start_date') != "") && ($this->input->post('end_date') != "")){
						$news = $this->prd_homegove_model->
							get_gove_search_title_start(
								$page, 
								$row_per_page,
								($this->input->post("news_title")), 
								($this->input->post("end_date")) 
							);
						$count_row = $this->prd_homegove_model->
							get_gove_search_title_start_count(
								$this->input->post("news_title"),
								$this->input->post("end_date")
							);
						$data['post_news_title'] = $this->input->post("news_title");
						$data['post_end_date'] = $this->input->post("end_date");
					}
					else{
						$news = $this->prd_homegove_model->
							get_gove_search_title(
								$page, 
								$row_per_page,
								$this->input->post("news_title")
							);
						$count_row = $this->prd_homegove_model->
							get_gove_search_title_count(
								$this->input->post("news_title")
							);
						$data['post_news_title'] = $this->input->post("news_title");
					}
				}
				else{
					
					if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
						$news = $this->prd_homegove_model->
							get_gove_search_start_end(
								$page, 
								$row_per_page,
								($this->input->post("start_date")), 
								($this->input->post("end_date")) 
							);
						$count_row = $this->prd_homegove_model->
							get_gove_search_start_end_count(
								$this->input->post("start_date"),
								$this->input->post("end_date")
							);
						$data['post_start_date'] = $this->input->post("start_date");
						$data['post_end_date'] = $this->input->post("end_date");
					}
					
					elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){
						$news = $this->prd_homegove_model->
							get_gove_search_start(
								$page, 
								$row_per_page,
								($this->input->post("start_date")) 
							);
						$count_row = $this->prd_homegove_model->
							get_gove_search_start_count(
								$this->input->post("start_date")
							);
						$data['post_start_date'] = $this->input->post("start_date");
					}
					elseif(!($this->input->post('start_date') != "") && ($this->input->post('end_date') != "")){
						$news = $this->prd_homegove_model->
							get_gove_search_end(
								$page, 
								$row_per_page,
								($this->input->post("end_date")) 
							);
						$count_row = $this->prd_homegove_model->
							get_gove_search_end_count(
								$this->input->post("end_date")
							);
						$data['post_end_date'] = $this->input->post("end_date");
					}
					
					else{
						$news = $this->prd_homegove_model->get_gove($page, $row_per_page);
						$count_row = $this->prd_homegove_model->get_gove_count();
					}
				}
				
				//###### Add File_Status to News ######
				foreach ($news as $news_item) {
					foreach ($FileAttach as $FileAttach_item) {
						if(
							$news_item->SendIn_ID == $FileAttach_item->SendIn_ID
						){
								if($FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "video/")){
									$news_item->File_Type_video = 1;
								}
								elseif($FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "audio/")){
									$news_item->File_Type_voice = 1;
								}
								elseif($FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "image/")){
									$news_item->File_Type_image = 1;
								}
								elseif(
									!(
										$FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "video/") ||
										$FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "audio/") ||
										$FileAttach_item->File_Type == $CI_stringManagement->string_management->startsWith($FileAttach_item->File_Type, "image/")
									)
								){
											$news_item->File_Type_document = 1;
								}
						}
					}
				}
				//###### End Add File_Status to News ######
				
				$data["news"] = $news;
				
				//############## Pagination = For no Search ################
				$data['count_row'] = $count_row;
				$url = "homePRD";
				
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
				
				// $this->prd_homegove_model->set_gove(
					// $news
				// );
				
				$this->load->view('prdsharing/templates/header', $data);
				
				$data['home_search'] = "homeGOVE";
				
				$this->load->view('prdsharing/home/header', $data);
				$this->load->view('prdsharing/home/homegove', $data);
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
	
	public function rss_feed_home_gove()
	{
		// $NT02_NewsType = $this->prd_rss_home_gove_model->get_NT02_NewsType();
		// $category = $this->prd_rss_home_gove_model->get_Category($NT02_NewsType);
		
		$data['rss'] = $this->prd_rss_home_gove_model->generate_rss(
			$this->session->userdata('member_id'),
			$this->input->post('search'),
			$this->input->post('start_date'),
			$this->input->post('end_date')
		);
		echo $data['rss'];
	}
	
	public function view_rss_gove()
	{
		$this->load->database();
		$this->load->model('PRD_rss_Home_GOVE_model');
		$this->load->model('prd_rss_old_model');
		
		$get_rss_newsid = $this->PRD_rss_Home_GOVE_model->get_rss_newsid($this->uri->segment(3));
		// $NewsNews = $this->PRD_rss_Home_GOVE_model->get_NewsNews();
		
		/*
		//###########  DETAIL_RSS and NEWS Merge together  #############
		foreach ($get_rss_newsid as $get_rss_newsid_item) {
			foreach ($NewsNews as $NewsNews_item) {
				if($get_rss_newsid_item->Detail_NewsID == $NewsNews_item->News_OldID){
					$get_rss_newsid_item->News_Date = $NewsNews_item->News_Date;
				}
			}
		}
		//##############################################################
		*/
		
		// var_dump($get_rss_newsid);
		// exit;
		
		$data['query'] = $get_rss_newsid;
		$i = 0;
		
		foreach($data['query'] as $item)
		{
			$newsid = $item->Detail_NewsID;
			
			$data['title'][$i] = $this->prd_rss_old_model->get_news($newsid);
			
			$i++;
		}
		$this->load->view('prdsharing/rss/view_rss_gove',$data);
	}
}