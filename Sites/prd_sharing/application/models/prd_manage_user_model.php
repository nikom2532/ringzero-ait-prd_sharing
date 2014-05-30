<?php
class PRD_Manage_User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//##################### Old Database #########################
	
	public function get_SC03_User()
	{
		$query_getUser = $this->db_ntt_old->
			get('SC03_User', 20, 0)->result();
		
		return $query_getUser;
	}
	
	public function get_SC03_User_search(
		$search_key = ''
	)
	{
		$query_getUser = $this->db_ntt_old->
			like('SC03_UserName', $search_key)->
			or_like('SC03_FName', $search_key)->
			or_like('SC03_LName', $search_key)->
			get('SC03_User', 20, 0)->result();
		
		return $query_getUser;
	}
	
	// $this->db->limit($limit, $start);
}