<?php
class PRD_ManageNewGROV_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//#########  Database New  ##########
	public function get_ministry()
	{
		return $this->db->where('Minis_Status', '1')->
			get('Ministry')->result();
	}
	public function get_department()
	{
		return $this->db->where('Dep_Status', '1')->
			get('Department')->result();
	}
	
	public function get_grov()
	{
		return $this->db->get('SendInformation')->result();
	}
	public function get_grov_search_title($news_title)
	{
		return $this->db->
			like('News_Title', $news_title)->
			get('SendInformation')->result();
	}
	public function get_grov_search_title_start($news_title, $start)
	{
		return $this->db->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			get('SendInformation')->result();
	}
	public function get_grov_search_title_start_end($news_title, $start, $end)
	{
		return $this->db->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			where("News_Date <=", $end)->
			get('SendInformation')->result();
	}
	
	public function get_grov_record_count()
	{
		return $this->db->count_all('SendInformation');
	}
	
	public function get_grov_limit($limit, $start)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get('SendInformation');
			
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