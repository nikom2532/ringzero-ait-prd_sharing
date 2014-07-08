<?php
class PRD_UserInfo_PRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//##################### New Database #########################
	
	public function get_Member($userID)
	{
		$query_getUser = $this->db->
			select('
				Member.Mem_Username,
				Member.Mem_Name,
				Member.Mem_Name,
				Member.Mem_Sex,
				Member.Mem_Title,
				Member.Mem_Name,
				Member.Mem_LasName,
				Member.Mem_EngName,
				Member.Mem_EngLasName,
				Member.Mem_Username,
				Member.Mem_CardID,
				Member.Mem_Status,
				Member.Group_ID,
				GroupMember.Group_Status
			')->
			join('GroupMember', 'GroupMember.Group_ID = Member.Group_ID', 'left')->
			// join('CM06_Province', 'CM06_Province.CM06_ProvinceID = Member.CM06_ProvinceId', 'left')->
			where('Member.Mem_OldID', $userID)->
			get('Member');
			
		return $query_getUser->result();
	}
	
	public function update_Member(
		$Mem_ID = '',
		$mem_status = ''
	)
	{
		$data = array(
			'Mem_Status' => $mem_status
		);
		
		$query_setMember = $this->db->
			where('Member.Mem_OldID', $Mem_ID)->
			update('Member', $data);
			
		return $query_setMember;
	}
	
	
	//##################### Old Database #########################
	
	public function get_SC03_User($userID)
	{
		$query_getUser = $this->db_ntt_old->
			select('
				SC03_User.SC03_Gender,
				SC03_User.SC03_UserId,
				SC03_User.SC03_UserName,
				SC03_User.SC03_TName,
				SC03_User.SC03_FName,
				SC03_User.SC03_LName,
				SC03_User.SC03_EngTName,
				SC03_User.SC03_EngFName,
				SC03_User.SC03_EngLName,
				SC03_User.SC03_UserName,
				SC03_User.SC03_IDCard,
				SC03_User.SC03_Address,
				SC03_User.SC03_Email,
				
				SC03_User.SC07_DepartmentId,
				SC03_User.CM06_ProvinceID,
				SC03_User.CM07_AmpurId,
				SC03_User.CM08_TumbonId,
				
				SC03_User.SC03_Tel,
				
				
				SC03_User.SC03_Status,
				CM06_Province.CM06_ProvinceName,
				SC07_Department.SC07_DepartmentName
			')->
			where('SC03_User.SC03_Status', "T")->
			join('CM06_Province', 'CM06_Province.CM06_ProvinceID = SC03_User.CM06_ProvinceId', 'left')->
			join('SC07_Department', 'SC07_Department.SC07_DepartmentId = SC03_User.SC07_DepartmentId', 'left')->
			where('SC03_User.SC03_UserId', $userID)->
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
				CM06_Province.CM06_ProvinceID,
				CM06_Province.CM06_ProvinceName
			')->
			get('CM06_Province')->result();
		
		return $query_getProvince;
	}
	
	public function get_CM07_Ampur()
	{
		$query_getProvince = $this->db_ntt_old->
			select('
				CM07_Ampur.CM07_AmpurName,
				CM07_Ampur.CM07_AmpurID,
			')->
			get('CM07_Ampur')->result();
		
		return $query_getProvince;
	}
	
	public function get_CM08_Tumbon()
	{
		$query_getProvince = $this->db_ntt_old->
			select('
				CM08_Tumbon.CM08_TumbonName,
				CM08_Tumbon.CM08_TumbonID,
			')->
			get('CM08_Tumbon')->result();
		
		return $query_getProvince;
	}
	
	public function get_GroupMember()
	{
		$query = $this->db->
			select('
				GroupMember.Group_ID,
				GroupMember.Group_Name,
				GroupMember.Group_Desc
			')->
			get('GroupMember')->result();
		
		return $query;
	}
	
}