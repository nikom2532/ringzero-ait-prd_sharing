<?php
class PRD_HomeGOVE_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	public function get_gove()
	{
		return $this->db->get('SendInformation')->row();
	}
	public function get_gove_search_title($news_title)
	{
		return $this->db->
			like('News_Title', $news_title)->
			get('SendInformation')->result();
	}
	public function get_gove_search_title_start($news_title, $start)
	{
		return $this->db->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			get('SendInformation')->result();
	}
	public function get_gove_search_title_start_end($news_title, $start, $end)
	{
		return $this->db->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			where("News_Date <=", $end)->
			get('SendInformation')->result();
	}
	
	public function get_gove_record_count()
	{
		return $this->db->count_all('SendInformation');
	}
	
	public function get_gove_limit($limit, $start)
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
	
	public function get_testdb2()
	{
		return $this->db_ntt_old->get('SC03_User')->result();
	}
}