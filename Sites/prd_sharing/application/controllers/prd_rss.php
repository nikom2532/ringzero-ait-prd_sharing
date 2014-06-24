<?php
class PRD_rss extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		// $this->load->model('news_model');
	}

	public function index()
	{
		// Check Is Authen?
		if($this->session->userdata('member_id') != ""){
			
			$data['member_id'] = $this->session->userdata('member_id');
			$data['session_Mem_Username'] = $this->session->userdata('Mem_Username');
			$data['session_Mem_Title'] = $this->session->userdata('Mem_Title');
			$data['session_Mem_Name'] = $this->session->userdata('Mem_Name');
			$data['session_Mem_LasName'] = $this->session->userdata('Mem_LasName');
			$data['session_Mem_EngName'] = $this->session->userdata('Mem_EngName');
			$data['session_Mem_EngLasName'] = $this->session->userdata('Mem_EngLasName');
			
			$data['title'] = 'RSS Feed';
			
			

			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/rss/rss', $data);
			$this->load->view('prdsharing/templates/footer');
		
		}
		else{
			redirect(base_url().index_page().'', 'refresh');
		}
	}
	public function rss_feed()
	{
		$this->load->database();
		$this->load->model('prd_rss_model');
		$data['rss'] = $this->prd_rss_model->generate_rss();
		echo $data['rss'];	
	}
	public function view_rss()
	{
		$this->load->database();
		$this->load->model('prd_rss_model');
		$this->load->model('prd_rss_old_model');
		$data['query'] = $this->prd_rss_model->get_rss_newsid($this->uri->segment(3));
		$i = 0;
		foreach($data['query'] as $item)
		{
			$newsid = $item->Detail_NewsID;
			$data['title'][$i] = $this->prd_rss_old_model->get_news($newsid);
			$i++;
		}
		$this->load->view('prdsharing/rss/view_rss',$data);
	}
}