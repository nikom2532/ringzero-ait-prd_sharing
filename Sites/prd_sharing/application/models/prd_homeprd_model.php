<?php
class PRD_HomePRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	public function get_NT01_News()
	{
		// return $this->db->get('News')->result();
		return $this->db_ntt_old->
			Limit(10, 0)->
			select('*, SC03_User.SC03_TName')->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			where('NT08_PubTypeID', '11')->
			get('NT01_News')->result();
	}
	
	public function get_NT01_News_Reporter($reportID)
	{
		// return $this->db->get('News')->result();
		return $this->db_ntt_old->
			Limit(10, 0)->
			select('SC03_FName,SC03_LName')->
			where('SC03_UserId', $reportID)->
			get('SC03_User')->result();
	}
	
	
	
	
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