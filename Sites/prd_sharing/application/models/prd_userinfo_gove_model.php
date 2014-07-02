<?php
class PRD_UserInfo_GOVE_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//##################### New Database #########################
	
	public function update_Member(
		$Mem_ID = '',
		$sex = '',
		$mem_title = '',
		// $tname_other_text = '',
		$fname = '',
		$lname = '',
		$engfname = '',
		$englname = '',
		$mem_username = '',
		$mem_password = '',
		$mem_cardID = '',
		$mem_ministry = '',
		$mem_department = '',
		$mem_province = '',
		$mem_ampur = '',
		$mem_tumbon = '',
		$mem_address = '',
		$mem_email = '',
		$mem_postcode = '',
		$mem_nickname = '',
		$mem_tel = '',
		$mem_moble = '',
		$group_member = '',
		$mem_status = ''
	)
	{
		if($mem_password == ""){
			$data = array(
				'Mem_Sex' => $sex,
				'Mem_Title' => $mem_title,
				'Mem_Name' => $fname,
				'Mem_LasName' => $lname,
				'Mem_EngName' => $engfname,
				'Mem_EngLasName' => $englname,
				'Mem_Username' => $mem_username,
				'Mem_CardID' => $mem_cardID,
				'Mem_Ministry' => $mem_ministry,
				'Mem_Department' => $mem_department,
				'Prov_ID' => $mem_province,
				'Ampur_ID' => $mem_ampur,
				'Tumbon_ID' => $mem_tumbon,
				'Mem_Address' => $mem_address,
				'Mem_Email' => $mem_email,
				'Mem_Postcode' => $mem_postcode,
				'Mem_NickName' => $mem_nickname,
				'Mem_Tel' => $mem_tel,
				'Mem_Mobile' => $mem_moble,
				'Group_ID' => $group_member,
				'Mem_Status' => $mem_status
			);
		}
		else{
			$data = array(
				'Mem_Sex' => $sex,
				'Mem_Title' => $mem_title,
				'Mem_Name' => $fname,
				'Mem_LasName' => $lname,
				'Mem_EngName' => $engfname,
				'Mem_EngLasName' => $englname,
				'Mem_Username' => $mem_username,
				'Mem_Password' => $mem_password,
				'Mem_CardID' => $mem_cardID,
				'Mem_Ministry' => $mem_ministry,
				'Mem_Department' => $mem_department,
				'Prov_ID' => $mem_province,
				'Ampur_ID' => $mem_ampur,
				'Tumbon_ID' => $mem_tumbon,
				'Mem_Address' => $mem_address,
				'Mem_Email' => $mem_email,
				'Mem_Postcode' => $mem_postcode,
				'Mem_NickName' => $mem_nickname,
				'Mem_Tel' => $mem_tel,
				'Mem_Mobile' => $mem_moble,
				'Group_ID' => $group_member,
				'Mem_Status' => $mem_status
			);
		}
		// var_dump($data);
		
		$query_setMember = $this->db->
			where('Member.Mem_ID', $Mem_ID)->
			update('Member', $data);
			
		return $query_setMember;
	}
	
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
				Member.Prov_ID,
				Member.Ampur_ID,
				Member.Tumbon_ID,
				Member.Mem_Ministry,
				Member.Mem_Department,
				GroupMember.Group_Status
			')->
			join('GroupMember', 'GroupMember.Group_ID = Member.Group_ID', 'left')->
			// join('CM06_Province', 'CM06_Province.CM06_ProvinceID = Member.CM06_ProvinceId', 'left')->
			where('Member.Mem_ID', $userID)->
			get('Member');
			
		return $query_getUser->result();
	}
	
	
	
	
	//##################### Old Database #########################
	
	public function get_SC03_User($userID)
	{
		$query_getUser = $this->db_ntt_old->
			select('
				SC03_User.SC03_UserId,
				SC03_User.SC03_UserName,
				SC03_User.SC03_FName,
				SC03_User.SC03_LName,
				SC03_User.SC07_DepartmentId,
				SC03_User.CM06_ProvinceID,
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
			where('Minis_Status', '1')->
			get('Ministry');
			
		return $query->result();
	}
	
	public function get_Department()
	{
		$query = $this->db->
			get('Department');
			
		return $query->result();
	}
	
	public function get_Department_Unique($Ministry_ID = '')
	{
		$query = $this->db->
			where('Ministry_ID', $Ministry_ID)->
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
				CM07_Ampur.CM06_ProvinceID
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
				CM08_Tumbon.CM07_AmpurID
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