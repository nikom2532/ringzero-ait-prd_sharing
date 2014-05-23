<?php
class PRD_ManageNewEditPRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//#########  Database Old  ##########
	
	public function get_NT01_News($NT01_NewsID = '')
	{
		return $this->db_ntt_old->
			LIMIT('20,0')->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_NewsDesc,
				NT01_News.NT01_NewsSource,
				NT01_News.NT01_NewsReferance,
				NT01_News.NT01_UpdUserID,
				NT01_News.NT01_CreUserID,
				
				NT01_News.NT01_ReporterID,
				
				SC03_User.SC03_FName
			')->
			join('SC03_User', '
				SC03_User.SC03_UserId = NT01_News.NT01_ReporterID
				AND 
				SC03_User.SC03_UserId = NT01_News.NT01_CreUserID', 'left')->
			where('NT01_NewsID', $NT01_NewsID)->
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
	
	// $this->db->limit($limit, $start);
}