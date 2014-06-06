<?php
class PRD_SentNew_model extends CI_Model {

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
	
	public function get_NT05_Policy()
	{
		$query = $this->db_ntt_old->
			get('NT05_Policy');
			
		return $query->result();
	}
	
	public function get_TargetGroup()
	{
		$query = $this->db->
			get('TargetGroup');
			
		return $query->result();
	}
	
	public function get_($value='')
	{
		
	}
}