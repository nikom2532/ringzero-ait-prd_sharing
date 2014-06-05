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
			get('Member')->result();
		return $query;
	}
}