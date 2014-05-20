<?php
class PRD_ManageNew extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model('prd_managenew_model');
		$this->load->library("pagination");
	}

	public function index()
	{
		$data['title'] = 'Manage News';
		
		if($this->input->post("news_title") != ""){
			if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
				$data['news'] = $this->prd_homeprd_model->get_prd_search_title_start_end(($this->input->post("news_title")), ($this->input->post("start_date")), ($this->input->post("start_date")) );
			}
			elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){
				$data['news'] = $this->prd_homeprd_model->get_prd_search_title_start(($this->input->post("news_title")), ($this->input->post("start_date")) );
			}
			else{
				$data['news'] = $this->prd_homeprd_model->get_prd_search_title($this->input->post("news_title"));
			}
		}
		else{
			
			$config = array();
	        $config["base_url"] = base_url() . "homePRD";
	        $config["total_rows"] = $this->prd_homeprd_model->get_prd_record_count();
	        $config["per_page"] = 20;
	        $config["uri_segment"] = 3;
			
	        $this->pagination->initialize($config);
			
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			
			$data["news"] = $this->prd_homeprd_model->
            	get_prd_limit($config["per_page"], $page);
	        $data["links"] = $this->pagination->create_links();
		}

		$this->load->view('prdsharing/templates/header', $data);
		$this->load->view('prdsharing/managenew/header', $data);
		$this->load->view('prdsharing/managenew/managenew', $data);
		$this->load->view('prdsharing/templates/footer');
	}
}