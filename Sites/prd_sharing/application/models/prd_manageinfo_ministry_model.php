<?php
class PRD_ManageInfo_Ministry_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//##################### New Database #########################
	
	public function get_Ministry()
	{
		$return = $this->db->
			SELECT('
				Minis_ID,
				Minis_Name,
				Minis_Status
			')->
			LIMIT('20,0')->	
			get('Ministry')->result();
		
		// var_dump($return);
		
		return $return;
	}
	
	// $this->db->limit($limit, $start);
}