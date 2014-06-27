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
			select('
				SC03_User.SC03_UserID,
				SC03_User.SC03_UserName AS Mem_Username,
				SC03_User.SC03_TName AS Mem_Title,
				SC03_User.SC03_FName AS Mem_Name,
				SC03_User.SC03_LName AS Mem_LasName,
				SC03_User.SC03_EngTName,
				SC03_User.SC03_EngFName AS Mem_EngName,
				SC03_User.SC03_EngLName AS Mem_EngLasName
			')->
			
			where('SC03_UserName', $Mem_Username)->
			where('SC03_Password', $Password)->
			where('SC03_Status', 'T')->
			get('SC03_User')->result();
		return $query;
	}
	
	public function get_Member_with_SC03UserID(
		$SC03UserID=''
	)
	{
		$query = $this->db->
			where('Mem_OldID', $SC03UserID)->
			where('Mem_Status', 1)->
			get('Member')->result();
		return $query;
	}
	
	//DO NOT REMOVE; 
	//IT IS THE UserLog.
	
	/*
	public function set_UserLog(
		$Mem_ID=''
	)
	{
		$data = array(
			'Log_Date' => ,
			'Log_IP' => ,
			'Lo'
		);
		
		$query = $this->db->
			insert('UserLog', $data)->
			where('Mem_ID', $Mem_ID)
	}
	*/
}