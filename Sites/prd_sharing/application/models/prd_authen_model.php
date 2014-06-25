<?php
class PRD_Authen_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	public function get_Member(
		$Mem_Username = '',
		$Password = ''
	)
	{
		$query = $this->db->
			where('Mem_username', $Mem_Username)->
			where('Mem_Password', $Password)->
			where('Mem_Status', 1)->
			get('Member')->result();
		return $query;
	}
	
	public function get_SC03_User(
		$Mem_Username = '',
		$Password = ''
	)
	{
		$query = $this->db_ntt_old->
			where('SC03_UserName', $Mem_Username)->
			where('SC03_Password', $Password)->
			
			get('SC03_User')->result();
		return $query;
	}
}