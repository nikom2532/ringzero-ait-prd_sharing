<?php
class PRD_HomePRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model('prd_homeprd_model');
		$this->load->library("pagination");
	}
	
	public function getReporter($reporter){
		return $data['Reporter'] = $this->prd_homeprd_model->get_NT01_News_Reporter($reporter);
	}

	public function index()
	{
		$data['title'] = 'Home';
		if($this->input->post("news_title") != ""){
			if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
				// $data['news'] = $this->prd_homeprd_model->get_prd_search_title_start_end(($this->input->post("news_title")), ($this->input->post("start_date")), ($this->input->post("start_date")) );
				$data['news'] = $this->prd_homeprd_model->get_NT01_News_search_title_start_end(($this->input->post("news_title")), ($this->input->post("start_date")), ($this->input->post("end_date")) );
				$data['post_news_title'] = $this->input->post("news_title");
				$data['post_start_date'] = $this->input->post("start_date");
				$data['post_end_date'] = $this->input->post("end_date");
			}
			elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){
				// $data['news'] = $this->prd_homeprd_model->get_prd_search_title_start(($this->input->post("news_title")), ($this->input->post("start_date")) );
				$data['news'] = $this->prd_homeprd_model->get_NT01_News_search_title_start(($this->input->post("news_title")), ($this->input->post("start_date")) );
				$data['post_news_title'] = $this->input->post("news_title");
				$data['post_start_date'] = $this->input->post("start_date");
			}
			else{
				
				// echo "search title";
				
				// $data['news'] = $this->prd_homeprd_model->get_prd_search_title($this->input->post("news_title"));
				$data['news'] = $this->prd_homeprd_model->get_NT01_News_search_title($this->input->post("news_title"));
				$data['post_news_title'] = $this->input->post("news_title");
			}
		}
		else{
			
			$data['news'] = $this->prd_homeprd_model->get_NT01_News();
			
			$data['New_News'] = $this->prd_homeprd_model->get_New_News();
			
			
			
			// foreach ($data['news'] as $key) {
				// echo $key->NT01_ReporterID."<br />";
			// }
			
			// var_dump($data['news']);
// 			
			// echo count($data['news']);
			
			// echo $data['news'][0]->NT01_ReporterID;
			
			
			
			
			
			// $data['Reporter'] = $this->prd_homeprd_model->get_NT01_News_Reporter($data['news']->NT01_ReporterID);
			
			
			
			
			//################### For Paging ####################
			
			// if(post("paging") != ""){
				// $data['news'] = $this->prd_homeprd_model->get_prd_limit(post("paging"));
			// }
			// else{
				// $data['news'] = $this->prd_homeprd_model->get_prd();
			// }
			
			//######################
			
			// $config = array();
	        // $config["base_url"] = base_url() . "homePRD";
	        // $config["total_rows"] = $this->prd_homeprd_model->get_prd_record_count();
	        // $config["per_page"] = 20;
	        // $config["uri_segment"] = 3;
// 			
	        // $this->pagination->initialize($config);
// 			
			// $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
// 			
			// $data["news"] = $this->prd_homeprd_model->
            	// get_prd_limit($config["per_page"], $page);
	        // $data["links"] = $this->pagination->create_links();
// 	 		
			// var_dump($news);
			
			// $data['news'] = $this->prd_homeprd_model->get_prd();
		}
		
		//For Test
		// var_dump($data['news']);
		// var_dump($this->input->post());
		// echo $this->input->post("news_title");
		// var_dump($this->input->post("news_title"));
		// echo ($data["news"]->News_Date);
		
		//For test Database NNT_DataCenter
		// $data["get_testdb2"] = $this->prd_homeprd_model->get_testdb2();
		// var_dump($data["get_testdb2"]);
		
		
		$this->load->view('prdsharing/templates/header', $data);
		
		$data['home_search'] = "homePRD";
		
		$this->load->view('prdsharing/home/header', $data);
		$this->load->view('prdsharing/home/homeprd', $data);
		$this->load->view('prdsharing/templates/footer', $data);
		
		// After Load the Page --> Will insert the UserID from Old Database to New Database
		
		
		// var_dump($data['news']);
		//Insert News Table from Old Database to New Database
		$this->prd_homeprd_model->set_News(
			$data['news'],
			$this->prd_homeprd_model->get_NT10_VDO(),
			$this->prd_homeprd_model->get_NT11_Picture(),
			$this->prd_homeprd_model->get_NT12_Voice(),
			$this->prd_homeprd_model->get_NT13_OtherFile()
		);
		
	}
}