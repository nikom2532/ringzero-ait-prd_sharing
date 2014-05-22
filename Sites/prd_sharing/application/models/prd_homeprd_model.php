<?php
class PRD_HomePRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//##################### Old Database #########################
	
	public function get_NT01_News()
	{
		// return $this->db->get('News')->result();
		return $this->db_ntt_old->
			Limit(10, 0)->
			select('
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus'
			)->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			where('NT08_PubTypeID', '11')->
			get('NT01_News')->result();
	}
	
	
	public function get_NT01_News_search_title($news_title)
	{
		return $this->db_ntt_old->
			Limit(10, 0)->
			select('
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus'
			)->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			where('NT08_PubTypeID', '11')->
			like('NT01_News.NT01_NewsTitle', $news_title)->
			get('NT01_News')->result();
	}
	public function get_NT01_News_search_title_start($news_title, $start)
	{
		return $this->db_ntt_old->
			Limit(10, 0)->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			select('
				NT01_News.NT01_UpdDate, 
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus'
			)->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			where('NT08_PubTypeID', '11')->
			get('NT01_News')->result();
	}
	public function get_NT01_News_search_title_start_end($news_title, $start, $end)
	{
		return $this->db_ntt_old->
			Limit(10, 0)->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			where("News_Date <=", $end)->
			select('
				NT01_News.NT01_UpdDate, 
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus'
			)->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			where('NT08_PubTypeID', '11')->
			get('NT01_News')->result();
	}
	
	//################## New Database #######################
	
	public function get_prd()
	{
		// return $this->db->get('News')->result();
		return $this->db->
			get('News')->result();
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
	
	public function get_testdb2()
	{
		return $this->db_ntt_old->get('SC03_User')->result();
	}
	
	// $this->db->limit($limit, $start);
}