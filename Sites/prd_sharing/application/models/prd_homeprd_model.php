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
	public function get_prd_search_title($title)
	{
		return $this->db->
			where('News_Title',$title)->
			get('News')->row();
	}
	
}