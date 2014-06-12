<?php
class PRD_HomeGOVE extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_homegove_model');
	}

	public function index()
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
			
			if($this->input->post("news_title") != ""){
				if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) {
					$data['news'] = $this->prd_homegove_model->
						get_gove_search_title_start_end(
							($this->input->post("news_title")), 
							($this->input->post("start_date")), 
							($this->input->post("end_date")) 
						);
					$data['post_news_title'] = $this->input->post("news_title");
					$data['post_start_date'] = $this->input->post("start_date");
					$data['post_end_date'] = $this->input->post("end_date");
				}
				elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){
					$data['news'] = $this->prd_homegove_model->
						get_gove_search_title_start(
							($this->input->post("news_title")), 
							($this->input->post("start_date")) 
						);
					$data['post_news_title'] = $this->input->post("news_title");
					$data['post_start_date'] = $this->input->post("start_date");
				}
				else{
					$data['news'] = $this->prd_homegove_model->
						get_gove_search_title(
							$this->input->post("news_title")
						);
					$data['post_news_title'] = $this->input->post("news_title");
				}
			}
			else{
				$data['news'] = $this->prd_homegove_model->get_gove();
			}
			//For Test
			// var_dump($data['news']);
	
			$this->load->view('prdsharing/templates/header', $data);
			
			$data['home_search'] = "homeGOVE";
			
			$this->load->view('prdsharing/home/header', $data);
			$this->load->view('prdsharing/home/homegove', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect('/', 'refresh');
		}
	}
}