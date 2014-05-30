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
		$search_key = '',
		$SC03_Status = '',
		$CM06_ProvinceID = ''
	)
	{
		$query_getUser = $this->db_ntt_old->
			where('SC03_User.SC03_Status', $SC03_Status)->
			where('SC03_User.CM06_ProvinceId', $CM06_ProvinceID)->
			where("
				
				(SC03_User.SC03_UserName LIKE '%".$search_key."%') 
				OR
				(SC03_User.SC03_FName LIKE '%".$search_key."%')
				OR
				(SC03_User.SC03_LName LIKE '%".$search_key."%')
				
			")->
			
			// like('SC03_User.SC03_UserName', $search_key)->
			// or_like('SC03_User.SC03_FName', $search_key)->
			// or_like('SC03_User.SC03_LName', $search_key)->
			get('SC03_User', 50, 0)->result();
			
			$str = $this->db->last_query();
			echo "Asdf";
			echo $str;
			
			exit;
		
		return $query_getUser;
	}
	
	
	public function get_CM06_Province()
	{
		$query_getProvince = $this->db_ntt_old->
			get('CM06_Province')->result();
		
		return $query_getProvince;
	}
	// $this->db->limit($limit, $start);
}