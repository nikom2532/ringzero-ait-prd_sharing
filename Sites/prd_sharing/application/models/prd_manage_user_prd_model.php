<?php
class PRD_Manage_User_PRD_model extends CI_Model {

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
			where('Member.Mem_ID', $Mem_ID)->
			update('Member', $data);
			
		return $query_setMember;
	}
	
	
	public function get_Member()
	{
		$query_getUser = $this->db->
			select('
				Member.Mem_ID,
				Member.Mem_Username,
				Member.Mem_Name,
				Member.Mem_LasName,
				Member.Mem_Department,
				Member.Prov_ID,
				Member.Mem_Status,
				Member.Mem_OldID,
				GroupMember.Group_Status,
			')->
			join('GroupMember', 'GroupMember.Group_ID = Member.Group_ID', 'left')->
			// join('CM06_Province', 'CM06_Province.CM06_ProvinceID = Member.CM06_ProvinceId', 'left')->
			get('Member');
			
		return $query_getUser->result();
	}
	
	public function get_Member_search(
		$search_key = '',
		$mem_status = '',
		$CM06_ProvinceID = ''
	)
	{
		$str_getMember2 = "
			SELECT 
				Member.Mem_ID, 
				Member.Mem_Username, 
				Member.Mem_Name, 
				Member.Mem_LasName, 
				Member.Mem_Department, 
				Member.Prov_ID, 
				Member.Mem_Status, 
				GroupMember.Group_Status 
			FROM Member 
			LEFT JOIN GroupMember 
				ON GroupMember.Group_ID = Member.Group_ID 
			WHERE 
			(
				(Member.Mem_Username LIKE '%".$search_key."%') 
				OR 
				(Member.Mem_Name LIKE '%".$search_key."%') 
				OR 
				(Member.Mem_LasName LIKE '%".$search_key."%')
			)
			AND Member.Mem_Status = '".$mem_status."'
			AND Member.Prov_ID = '".$CM06_ProvinceID."'
		";
		
		$query_getMember2 = $this->db->query($str_getMember2);
		
		return $query_getMember2->result();
	}
	
	//##################### Old Database #########################
	
	public function get_SC03_User(
		$page=1, 
		$row_per_page=20
	)
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		
		$StrQuery_get_SC03_User = "
			WITH LIMIT AS(
				SELECT
					SC03_User.SC03_UserId,
					SC03_User.SC03_UserName,
					SC03_User.SC03_FName,
					SC03_User.SC03_LName,
					SC03_User.SC07_DepartmentId,
					SC03_User.CM06_ProvinceID,
					SC03_User.SC03_Status,
					SC03_User.SC03_RegisterDate,
					CM06_Province.CM06_ProvinceName,
					SC07_Department.SC07_DepartmentName,
					ROW_NUMBER() OVER (ORDER BY (SC03_User.SC03_UserId) DESC) AS 'RowNumber'
				FROM
					SC03_User
				LEFT JOIN
					CM06_Province
				ON
					CM06_Province.CM06_ProvinceID = SC03_User.CM06_ProvinceId
				LEFT JOIN
					SC07_Department
				ON 
					SC07_Department.SC07_DepartmentId = SC03_User.SC07_DepartmentId
				WHERE
					SC03_User.SC03_Status = 'T'
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
			
		";
		$query_get_SC03_User = $this->db_ntt_old->
			query($StrQuery_get_SC03_User)->result();
		
		return $query_get_SC03_User;
	}
	
	public function count_SC03_User()
	{
		$StrQuery = "
			SELECT
				COUNT(SC03_User.SC03_UserId) AS NUMROW
			FROM
				SC03_User
			LEFT JOIN
				CM06_Province
			ON
				CM06_Province.CM06_ProvinceID = SC03_User.CM06_ProvinceId
			LEFT JOIN
				SC07_Department
			ON 
				SC07_Department.SC07_DepartmentId = SC03_User.SC07_DepartmentId
			WHERE
				SC03_User.SC03_Status = 'T' 
		";
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_SC03_User_search(
		$page = 1, 
		$row_per_page = 20,
		$search_key = '',
		$SC03_Status = '',
		$CM06_ProvinceID = ''
	)
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		
		$StrQuery_get_SC03_User = "
			WITH LIMIT AS(
				SELECT
					SC03_User.SC03_UserId,
					SC03_User.SC03_UserName,
					SC03_User.SC03_FName,
					SC03_User.SC03_LName,
					SC03_User.SC07_DepartmentId,
					SC03_User.CM06_ProvinceID,
					SC03_User.SC03_Status,
					SC03_User.SC03_RegisterDate,
					CM06_Province.CM06_ProvinceName,
					SC07_Department.SC07_DepartmentName,
					ROW_NUMBER() OVER (ORDER BY (SC03_User.SC03_UserId) DESC) AS 'RowNumber'
				FROM
					SC03_User
				LEFT JOIN
					CM06_Province
				ON
					CM06_Province.CM06_ProvinceID = SC03_User.CM06_ProvinceId
				LEFT JOIN
					SC07_Department
				ON 
					SC07_Department.SC07_DepartmentId = SC03_User.SC07_DepartmentId
				WHERE
					SC03_User.SC03_Status = 'T'
		";
		if($search_key != ""){
			$StrQuery_get_SC03_User .= "
				AND
				(
					(SC03_User.SC03_UserName LIKE '%".$search_key."%') 
					OR
					(SC03_User.SC03_FName LIKE '%".$search_key."%')
					OR
					(SC03_User.SC03_LName LIKE '%".$search_key."%')
				)
			";
		}
		if($SC03_Status != ""){
			$StrQuery_get_SC03_User .= "
				AND
					SC03_User.SC03_Status = '".$SC03_Status."'
			";
		}
		if($CM06_ProvinceID != ""){
			$StrQuery_get_SC03_User .= "
				AND
					SC03_User.CM06_ProvinceId = '".$CM06_ProvinceID."'
			";
		}
		$StrQuery_get_SC03_User .= "
				
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		echo $StrQuery_get_SC03_User;
		exit;
		
		$query_getUser = $this->db_ntt_old->
			query($StrQuery_get_SC03_User)->result();
		
		return $query_getUser;
	}
	
	public function count_SC03_User_search(
		$search_key = '',
		$SC03_Status = '',
		$CM06_ProvinceID = ''
	)
	{
		$StrQuery_get_SC03_User = "
			SELECT
				COUNT(SC03_User.SC03_UserId) AS NUMROW
			FROM
				SC03_User
			LEFT JOIN
				CM06_Province
			ON
				CM06_Province.CM06_ProvinceID = SC03_User.CM06_ProvinceId
			LEFT JOIN
				SC07_Department
			ON 
				SC07_Department.SC07_DepartmentId = SC03_User.SC07_DepartmentId
			WHERE
				SC03_User.SC03_Status = 'T' 
		";
		if($search_key != ""){
			$StrQuery_get_SC03_User .= "
				AND
				(
					(SC03_User.SC03_UserName LIKE '%".$search_key."%') 
					OR
					(SC03_User.SC03_FName LIKE '%".$search_key."%')
					OR
					(SC03_User.SC03_LName LIKE '%".$search_key."%')
				)
			";
		}
		if($SC03_Status != ""){
			$StrQuery_get_SC03_User .= "
				AND
					SC03_User.SC03_Status = '".$SC03_Status."'
			";
		}
		if($CM06_ProvinceID != ""){
			$StrQuery_get_SC03_User .= "
				AND
					SC03_User.CM06_ProvinceId = '".$CM06_ProvinceID."'
			";
		}
		$query = $this->db_ntt_old->
			query($StrQuery_get_SC03_User)->result();
		
		foreach($query as $val){
			return $val->NUMROW;
		}
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
	// $this->db->limit($limit, $start);
	
	
	public function get_SC07_Department($SC07_DepartmentId = '')
	{
		$query_SC07_Department = $this->db_ntt_old->
			select('
				SC07_Department.SC07_DepartmentId,
				SC07_Department.SC07_DepartmentName
			');
			if($SC07_DepartmentId != ''){
				$query_SC07_Department = $query_SC07_Department->
					where('SC07_DepartmentId', $SC07_DepartmentId);
			}
			$query_SC07_Department = $query_SC07_Department->
				get('SC07_Department')->result();
		
		return $query_SC07_Department;
	}
	
	public function get_SC03_User_ForUpdate()
	{
		$query_getUser = $this->db_ntt_old->
			select('
				SC03_User.SC03_UserId,
			')->
			where('SC03_User.SC03_Status', "T")->
			get('SC03_User')->result();
		
		return $query_getUser;
	}
	
	public function set_Update_SC03_User($SC03_User='')
	{
		foreach ($SC03_User as $SC03_User_item) {
			
			$Str_query_Member = "
				SELECT 
					Mem_ID
				FROM 
					Member
				WHERE 
					Mem_OldID = '".$SC03_User_item->SC03_UserId."'
			";
			$query_Member = $this->db->
				query($Str_query_Member);
			
			if(!($query_Member->num_rows() > 0)){
				
				$data = array(
					'Mem_Status' => '1',
					'Group_ID' => '3',
					'Mem_OLdID' => $SC03_User_item->SC03_UserId
				);
				
				$query_update = $this->db->
					insert("Member", $data);
			}
	    }
	}
}