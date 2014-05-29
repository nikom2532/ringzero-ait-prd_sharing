<?php
class PRD_ManageNewPRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//#########  Database Old  ##########
	
	public function get_NT01_News()
	{
		return $this->db_ntt_old->
			LIMIT('20,0')->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_NewsSource,
				NT01_News.NT01_NewsReferance,
				NT01_News.NT01_UpdUserID,
				NT01_News.NT01_CreUserID,
				SC03_User.SC03_FName'
			)->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			get('NT01_News')->result();
	}
	
	
	public function get_NT01_News_Search_Title($News_Title = '')
	{
		return $this->db_ntt_old->
			LIMIT('20,0')->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_NewsSource,
				NT01_News.NT01_NewsReferance,
				NT01_News.NT01_UpdUserID,
				NT01_News.NT01_CreUserID,
				SC03_User.SC03_FName'
			)->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			like('NT01_News.NT01_NewsTitle', $News_Title)->
			get('NT01_News')->result();
	}
	
	
	
	
	public function get_NT02_NewsType()
	{
		return $this->db_ntt_old->
			LIMIT('20,0')->	
			get('NT02_NewsType')->result();
	}
	public function get_NT03_NewsSubType()
	{
		return $this->db_ntt_old->
			LIMIT('20,0')->	
			get('NT03_NewsSubType')->result();
	}
	
	//#########  Database New  ##########
	public function get_prd()
	{
		return $this->db->get('News')->result();
	}
	public function get_prd_search_title($news_title)
	{
		return $this->db->
			like('News_Title', $news_title)->
			get('News')->result();
	}
	public function get_prd_search_title_start($news_title, $start)
	{
		return $this->db->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			get('News')->result();
	}
	public function get_prd_search_title_start_end($news_title, $start, $end)
	{
		return $this->db->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			where("News_Date <=", $end)->
			get('News')->result();
	}
	
	public function get_prd_record_count()
	{
		return $this->db->count_all('News');
	}
	
	public function get_prd_limit($limit, $start)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get('News');
			
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	//##########################
	
	
	public function set_FirstAddNews($news='')
	{
		// var_dump($news);
		
		foreach ($news as $news_item) {
	    	
			$data = array(
			   'News_OldID' => $news_item->NT01_NewsID,
			   'News_Date' => date('Y-m-d h:m:s')
			);
			
			// var_dump($data);
			// echo $data["News_OldID"];
			
			$query2 = $this->db->
						where('News_OldID', $data['News_OldID'])->
						get('News');
						
			// var_dump($query2);
			
			// echo($query2->num_rows());
						
			if($query2->num_rows() > 0){
				
			}
			else{
				$this->db->insert("News", $data);
			}
	    }
	}
	
	
	//For record a new news
	public function set_prd_news(
		$NT01_NewsID='',
		$NT01_NewsTitle='',
		$NT01_NewsDesc='',
		$NT01_NewsSource='',
		$NT01_NewsReferance='',
		$NT01_NewsTag=''
	)
	{
			$data = array(
			   'News_Title' => $NT01_NewsTitle,
			   'News_Desc' => $NT01_NewsDesc,
			   'News_Source' => $NT01_NewsSource,
			   'News_Reference' => $NT01_NewsReferance,
			   'News_Tag' => $NT01_NewsTag
			);
			
			// var_dump($data);
			
			return $this->db->where("News_OldID", $NT01_NewsID)->
				update("News", $data);
	}
	
	
	//##########################
	
	// $this->db->limit($limit, $start);
}