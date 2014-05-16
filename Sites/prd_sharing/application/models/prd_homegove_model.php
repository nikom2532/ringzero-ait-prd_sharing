<?php
class PRD_HomeGOVE_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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
}