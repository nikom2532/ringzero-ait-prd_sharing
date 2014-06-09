<?php
class PRD_ManageNewPRD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('prd_managenewprd_model');
		$this->load->library("pagination");
	}

	public function index()
	{
		//Check Is Authen?
		if($this->session->userdata('member_id') != ""){
			
			$data['title'] = 'Manage News';
			
			if($this->input->post("manageNewEditPRD_record") == "yes"){
				// echo "record";
				$return = $this->prd_managenewprd_model->set_prd_news(
					$this->input->post("NT01_NewsID"),
					$this->input->post("NT01_NewsTitle"),
					$this->input->post("NT01_NewsDesc"),
					$this->input->post("NT01_NewsSource"),
					$this->input->post("NT01_NewsReferance"),
					$this->input->post("NT01_NewsTag"),
					$this->input->post("NewsTypeID"),
					$this->input->post("NewsSubTypeID"),
					$this->input->post("News_UpdateID")
				);
			}
			
			
			$data['New_News'] = $this->prd_managenewprd_model->get_New_News();
			
			
			
			if($this->input->post("news_title") != ""){
				if (($this->input->post('start_date') != "") && ($this->input->post('end_date') != "") ) { // Start->End
					
					//Fillter Title
					$news_Fillter_title = $this->prd_managenewprd_model->get_NT01_News_Search_Title($this->input->post("news_title"));
					$data['post_start_date'] = $this->input->post('start_date');
					$data['post_end_date'] = $this->input->post('end_date');
					
				}
				elseif(($this->input->post('start_date') != "") && !($this->input->post('end_date') != "")){ // Start->...
					$data['post_news_title'] = $this->input->post('news_title');
					$data['post_start_date'] = $this->input->post('start_date');
					
					//Fillter Title
					$old_news_Fillter_title = $this->prd_managenewprd_model->get_NT01_News_Search_IsHaveUpdateDate($data['post_news_title']);
					
					foreach ($old_news_Fillter_title as $old) {
						
						foreach ($data['New_News'] as $new) {
						
							if($old->NT01_UpdDate == null){
								
								// $old->NT01_CreDate = $old->NT01_UpdDate;
								if($new->News_Date != null){
									$old->NT01_UpdDate = $new->News_Date;
								}
								if($new->News_UpdateDate != null){
									$old->NT01_UpdDate = $new->News_Date;
								}
							}
							else{
								
								if($new->News_Date != null){
									$old->NT01_UpdDate = $new->News_Date;
								}
								if($new->News_UpdateDate != null){
									$old->NT01_UpdDate = $new->News_Date;
								}
								
							}
						
						}
						
					}
					
					foreach ($old_news_Fillter_title as $old) {
						// echo $old->NT01_UpdDate." = ".$this->input->post('start_date')."<br/>";
						
						$NT01_UpdDate = strtotime($old->NT01_UpdDate);
						$start_date = strtotime($this->input->post('start_date'));
						
						// echo $NT01_UpdDate." = ".$start_date."<br/>";
						
						if($NT01_UpdDate < $start_date){
							echo "0";
							$old = "";
						}
					}
					
					// var_dump($old_news_Fillter_title);
					
					
					$data['news'] = $old_news_Fillter_title;
				}
				else{	//## Search only Title ##
					$data['news'] = $this->prd_managenewprd_model->get_NT01_News_Search_Title(
						$this->input->post("news_title"),
						$this->input->post("NewsTypeID"),
						$this->input->post("NewsSubTypeID")
					);
					$data['post_news_title'] = $this->input->post('news_title');
				}
			}
			else{	//## No Search ##
				$data['news'] = $this->prd_managenewprd_model->get_NT01_News();
			}
			
			
			//Query update Old News to New News
			$this->prd_managenewprd_model->set_FirstAddNews($data['news']);
			
			
			$data['NT02_NewsType'] = $this->prd_managenewprd_model->get_NT02_NewsType();
			$data['NT03_NewsSubType'] = $this->prd_managenewprd_model->get_NT03_NewsSubType();
			
			
			$this->load->view('prdsharing/templates/header', $data);
			$this->load->view('prdsharing/managenew/managenewprd', $data);
			$this->load->view('prdsharing/templates/footer');
			
		}
		else{
			redirect('/', 'refresh');
		}
	}
	
	public function get_NT02_TypeID($NT02_TypeID='')
	{
		$_data = $this->prd_managenewprd_model->get_NT03_NewsSubType_Unique($NT02_TypeID);
		echo json_encode($_data);
	}
	
}