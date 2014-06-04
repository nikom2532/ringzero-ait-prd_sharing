<?php
class PRD_UserInfo_Register_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	public function get_Ministry()
	{
		$query = $this->db->
			get('Ministry');
			
		return $query->result();
	}
	
	public function get_Department()
	{
		$query = $this->db->
			get('Department');
			
		return $query->result();
	}
	
	public function get_CM06_Province()
	{
		$query_getProvince = $this->db_ntt_old->
			select('
				CM06_Province.CM06_ProvinceName,
				CM06_Province.CM06_ProvinceID,
			')->
			get('CM06_Province')->result();
		
		return $query_getProvince;
	}
	// $this->db->limit($limit, $start);
}