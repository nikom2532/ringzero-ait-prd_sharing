<?php
class PRD_HomePRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_prd()
	{
		return $this->db->get('News')->result();
	}
	public function get_prd_search_title($news_title)
	{
		$return = $this->db->
			where('News_Title', $news_title)->
			get('News')->result();
		// var_dump($return);
		return $return;
	}
	
}