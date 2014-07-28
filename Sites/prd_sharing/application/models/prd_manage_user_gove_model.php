<?php
class PRD_Manage_User_GOVE_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//##################### New Database #########################
	
	public function set_Member(
		$sex = '',
		$mem_title = '',
		$tname_other_text = '',
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
		$query_setMember = $this->db->
			insert('Member', $data);
			
		return $query_setMember;
	}
	
	public function get_Member(
		$page=1, 
		$row_per_page=20
	)
	{
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		
		$strQuery_get_Member = "
			WITH LIMIT AS(
				SELECT
					Member.Mem_ID,
					Member.Mem_Username,
					Member.Mem_Name,
					Member.Mem_LasName,
					Member.Mem_Department,
					Member.Prov_ID,
					Member.Mem_Status,
					Member.Mem_Ministry,
					Member.Mem_CreateDate,
					GroupMember.Group_Status,
					ROW_NUMBER() OVER (ORDER BY (Member.Mem_ID) DESC) AS 'RowNumber'
				FROM 
					Member
				LEFT JOIN 
					GroupMember
				ON
					GroupMember.Group_ID = Member.Group_ID
				WHERE
					Member.Group_ID IN ('1', '2')
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		$query_get_Member = $this->db->
			query($strQuery_get_Member)->result();
		
		return $query_get_Member;
	}
	
	public function count_Member()
	{
		$StrQuery = "
			SELECT
				COUNT(Member.Mem_ID) AS NUMROW
			FROM
				Member
			LEFT JOIN 
				GroupMember
			ON
				GroupMember.Group_ID = Member.Group_ID
			WHERE
				Member.Group_ID IN ('1', '2')
		";
		$query = $this->db->
			query($StrQuery)->result();
		
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_Member_search(
		$page=1, 
		$row_per_page = 20,
		$search_key = '',
		$mem_status = '',
		$CM06_ProvinceID = ''
	)
	{
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		
		$strQuery_get_Member = "
			WITH LIMIT AS(
				SELECT
					Member.Mem_ID,
					Member.Mem_Username,
					Member.Mem_Name,
					Member.Mem_LasName,
					Member.Mem_Department,
					Member.Prov_ID,
					Member.Mem_Status,
					Member.Mem_Ministry,
					Member.Mem_CreateDate,
					GroupMember.Group_Status,
					ROW_NUMBER() OVER (ORDER BY (Member.Mem_ID) DESC) AS 'RowNumber'
				FROM 
					Member
				LEFT JOIN 
					GroupMember
				ON
					GroupMember.Group_ID = Member.Group_ID
				WHERE
					Member.Group_ID IN ('1', '2')
		";
		if($search_key != ""){
			$strQuery_get_Member .= "
				AND
				(
					(Member.Mem_Username LIKE '%".$search_key."%') 
					OR 
					(Member.Mem_Name LIKE '%".$search_key."%') 
					OR 
					(Member.Mem_LasName LIKE '%".$search_key."%')
				)
			";
		}
		if($mem_status != ""){
			$strQuery_get_Member .= "
				AND 
					Member.Mem_Status = '".$mem_status."'
			";
		}
		if($CM06_ProvinceID != ""){
			$strQuery_get_Member .= "
				AND 
					Member.Prov_ID = '".$CM06_ProvinceID."'
			";
		}
		$strQuery_get_Member .= "
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		$query_get_Member = $this->db->
			query($strQuery_get_Member)->result();
		
		return $query_get_Member;
	}
	
	public function count_Member_search(
		$search_key = '',
		$mem_status = '',
		$CM06_ProvinceID = ''
	)
	{
		$StrQuery = "
			SELECT
				COUNT(Member.Mem_ID) AS NUMROW
			FROM
				Member
			LEFT JOIN 
				GroupMember
			ON
				GroupMember.Group_ID = Member.Group_ID
			WHERE
				Member.Group_ID IN ('1', '2')
		";
		if($search_key != ""){
			$StrQuery .= "
				AND
				(
					(Member.Mem_Username LIKE '%".$search_key."%') 
					OR 
					(Member.Mem_Name LIKE '%".$search_key."%') 
					OR 
					(Member.Mem_LasName LIKE '%".$search_key."%')
				)
			";
		}
		if($mem_status != ""){
			$StrQuery .= "
				AND 
					Member.Mem_Status = '".$mem_status."'
			";
		}
		if($CM06_ProvinceID != ""){
			$StrQuery .= "
				AND 
					Member.Prov_ID = '".$CM06_ProvinceID."'
			";
		}
		$query = $this->db->
			query($StrQuery)->result();
		
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	//##################### Old Database #########################
	
	public function get_SC03_User()
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
			join('SC07_Department', 'SC07_Department.SC07_DepartmentId = SC03_User.SC07_DepartmentId')->
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
	
	public function get_Department()
	{
		$query_getDepartment = $this->db->
			select('
				Department.Dep_ID,
				Department.Dep_Name
			')->
			get('Department')->result();
		
		return $query_getDepartment;
	}
	
	public function get_Ministry()
	{
		$query_getMinistry = $this->db->
			select('
				Ministry.Minis_ID,
				Ministry.Minis_Name
			')->
			get('Ministry')->result();
		
		return $query_getMinistry;
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
}