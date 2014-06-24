<?php
class PRD_HomeGOVE extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_homegove_model');
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
			$row_per_page = 20;
			
			if($this->input->post("news_title") != ""){
				if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
					$data['news'] = $this->prd_homegove_model->
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
					$data['news'] = $this->prd_homegove_model->
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
					$data['news'] = $this->prd_homegove_model->
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
					$data['news'] = $this->prd_homegove_model->
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
					$data['news'] = $this->prd_homegove_model->
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
					$data['news'] = $this->prd_homegove_model->
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
					$data['news'] = $this->prd_homegove_model->
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
					$data['news'] = $this->prd_homegove_model->get_gove($page, $row_per_page);
					$count_row = $this->prd_homegove_model->get_gove_count();
				}
			}
			
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
}