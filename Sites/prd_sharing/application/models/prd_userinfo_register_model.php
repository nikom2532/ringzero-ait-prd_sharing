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
			where('Minis_Status', '1')->
			get('Ministry');
			
		return $query->result();
	}
	
	public function get_Department()
	{
		$query = $this->db->
			where('Dep_Status', '1')->
			get('Department');
			
		return $query->result();
	}
	
	public function get_Department_Unique($Ministry_ID = '')
	{
		$query = $this->db->
			where('Dep_Status', '1')->
			where('Ministry_ID', $Ministry_ID)->
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
	
	public function get_CM07_Ampur_Unique($ProvinceID = '')
	{
		$query_getProvince = $this->db_ntt_old->
			select('
				CM07_Ampur.CM07_AmpurName,
				CM07_Ampur.CM07_AmpurID,
			')->
			where('CM06_ProvinceID', $ProvinceID)->
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
	
	public function get_CM08_Tumbon_Unique($AmpurID = '')
	{
		$query_getProvince = $this->db_ntt_old->
			select('
				CM08_Tumbon.CM08_TumbonName,
				CM08_Tumbon.CM08_TumbonID,
			')->
			where('CM07_AmpurID', $AmpurID)->
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
	
	public function set_Member(
		$sex = '',
		$mem_title = '',
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
		$mem_mobile = '',
		$group_member = '',
		$mem_status = ''
	)
	{
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
			'Mem_Mobile' => $mem_mobile,
			'Group_ID' => $group_member,
			'Mem_Status' => $mem_status,
			
			'Group_ID' => '1'
		);
		//Group_ID = 1 is GOVE
		
		$query_setMember = $this->db->
			insert('Member', $data);
			
		return $query_setMember;
	}
}