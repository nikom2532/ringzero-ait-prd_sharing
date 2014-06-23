<?php
class PRD_HomePRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("pagination");
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->model('prd_homeprd_model');
		// $this->load->library('ait');
	}
	
	public function getReporter($reporter){
		return $data['Reporter'] = $this->prd_homeprd_model->get_NT01_News_Reporter($reporter);
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
			
			$NT02_NewsType = $this->prd_homeprd_model->get_NT02_NewsType();
			// var_dump($NT02_NewsType);
			$category = $this->prd_homeprd_model->get_Category($NT02_NewsType);
			// var_dump($category);
			
			if($this->input->post("news_title") != ""){ //For search
				if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) { //For search title start end
					$data['news'] = $this->prd_homeprd_model->get_NT01_News_search_title_start_end(
						($this->input->post("news_title")), 
						($this->input->post("start_date")), 
						($this->input->post("end_date")),
						$category,
						$page
					);
					$data['post_news_title'] = $this->input->post("news_title");
					$data['post_start_date'] = $this->input->post("start_date");
					$data['post_end_date'] = $this->input->post("end_date");
					$count_row = $this->prd_homeprd_model->
						get_NT01_News_search_title_start_end_count(
							$this->input->post("news_title"),
							$this->input->post("start_date"),
							$this->input->post("end_date"),
							$category
						);
				}
				elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){ //For search title start
					// echo "test";
					$data['news'] = $this->prd_homeprd_model->get_NT01_News_search_title_start(
						($this->input->post("news_title")), 
						($this->input->post("start_date")),
						$category,
						$page
					);
					$data['post_news_title'] = $this->input->post("news_title");
					$data['post_start_date'] = $this->input->post("start_date");
					$count_row = $this->prd_homeprd_model->
						get_NT01_News_search_title_start_count(
							$this->input->post("news_title"),
							$this->input->post("start_date"),
							$category
						);
				}
				elseif(!($this->input->post('start_date') != "") && ($this->input->post('end_date') != "")){ //For search title end
					// echo "test";
					$data['news'] = $this->prd_homeprd_model->get_NT01_News_search_title_end(
						($this->input->post("news_title")), 
						($this->input->post("end_date")),
						$category,
						$page
					);
					$data['post_news_title'] = $this->input->post("news_title");
					$data['post_start_date'] = $this->input->post("start_date");
					$count_row = $this->prd_homeprd_model->
						get_NT01_News_search_title_end_count(
							$this->input->post("news_title"),
							$this->input->post("end_date"),
							$category
						);
				}
				else{
						//For search title
						$data['news'] = $this->prd_homeprd_model->
							get_NT01_News_search_title(
								$this->input->post("news_title"),
								$category,
								$page
							);
						$data['post_news_title'] = $this->input->post("news_title");
						$count_row = $this->prd_homeprd_model->
							get_NT01_News_search_title_count(
								$this->input->post("news_title"),
								$category
							);
				}
			}
			else{
				//For search start end
				if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
					$data['news'] = $this->prd_homeprd_model->get_NT01_News_search_start_end(
						($this->input->post("start_date")), 
						($this->input->post("end_date")),
						$category,
						$page
					);
					$data['post_start_date'] = $this->input->post("start_date");
					$data['post_end_date'] = $this->input->post("end_date");
					$count_row = $this->prd_homeprd_model->
						get_NT01_News_search_start_end_count(
							$this->input->post("start_date"),
							$this->input->post("end_date"),
							$category
						);
				}
				
				//For search start
				elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){
					// echo "test";
					$data['news'] = $this->prd_homeprd_model->get_NT01_News_search_start(
						($this->input->post("start_date")),
						$category,
						$page
					);
					$data['post_start_date'] = $this->input->post("start_date");
					$count_row = $this->prd_homeprd_model->
						get_NT01_News_search_start_count(
							$this->input->post("start_date"),
							$category
						);
				}
				//For search end
				elseif(!($this->input->post('start_date') != "") && ($this->input->post('end_date') != "")){
					// echo "test";
					$data['news'] = $this->prd_homeprd_model->get_NT01_News_search_end(
						($this->input->post("end_date")),
						$category,
						$page
					);
					$data['post_end_date'] = $this->input->post("end_date");
					$count_row = $this->prd_homeprd_model->
						get_NT01_News_search_end_count(
							$this->input->post("end_date"),
							$category
						);
				}
				else{
					//For no Search
					$data['news'] = $this->prd_homeprd_model->
						get_NT01_News(
							$category,
							$page
						);
					$count_row = $this->prd_homeprd_model->get_NT01_News_count($category);
				}
			}
			// var_dump($data['news'][0]);
			
			//$category = $category

			//############## Pagination = For no Search ################
			$row_per_page = 20;
			// $count_row = $this->prd_homeprd_model->get_NT01_News_count($category);
		 	$data['count_row'] = $count_row;
			// $data_pagination = $this->ait->pagination($count_row,"homePRD/",$page,$row_per_page);
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
			
			//After Load the Page --> Will insert the UserID from Old Database to New Database
			//Insert News Table from Old Database to New Database
			$this->prd_homeprd_model->set_News(
				$data['news']
			);
			
			$data['New_News'] = $this->prd_homeprd_model->get_New_News();
			
			$data['home_search'] = "homePRD";
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/home/header', $data);
			$this->load->view('prdsharing/home/homeprd', $data);
			$this->load->view('prdsharing/templates/footer', $data);
		}
		else{
			redirect(base_url().'/', 'refresh');
		}
	}
}