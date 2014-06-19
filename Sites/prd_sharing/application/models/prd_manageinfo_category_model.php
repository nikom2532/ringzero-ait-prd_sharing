<?php
class PRD_ManageInfo_Category_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//##################### No Search #########################
	
	public function get_Category()
	{
		return $this->db->
			SELECT('
				Category.Cate_ID,
				Category.Cate_OldID,
				Category.CateName,
				Category.Cate_Status,
				Category.Cate_UpdateDate,
				Category.MemUpdate_ID
			')->
			join('Member', 'Member.Mem_ID = Category.MemUpdate_ID', 'left')->
			get('Category')->result();
	}
	
	public function get_NT02_NewsType($page=1, $row_per_page=20)
	{
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					(NT02_NewsType.NT02_TypeID) AS NT02_TypeID, 
					(NT02_NewsType.NT02_TypeName) AS NT02_TypeName, 
					(NT02_NewsType.NT02_Status) AS NT02_Status, 
					(NT02_NewsType.NT02_TypeNameEn) AS NT02_TypeNameEn, 
					(NT02_NewsType.NT02_Sequence) AS NT02_Sequence, 
					ROW_NUMBER() OVER (ORDER BY (NT02_NewsType.NT02_TypeID) DESC) AS 'RowNumber'
				FROM 
					NT02_NewsType
				WHERE 
					NT02_NewsType.NT02_Status = 'Y'
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		"; 
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_NT02_NewsType_count()
	{
		$StrQuery = "
			SELECT
				COUNT(NT02_NewsType.NT02_TypeID) AS NUMROW
			FROM NT02_NewsType
			WHERE 
				NT02_NewsType.NT02_Status = 'Y'
		"; 
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	//##################### Search #########################
	
	public function NT02_NewsType_search1()
	{
		return $this->db_ntt_old->
			SELECT('
				NT02_NewsType.NT02_TypeID
			')->
			where('NT02_NewsType.NT02_Status', 'Y')->
			get('NT02_NewsType')->result();
	}
	
	public function Category_search2($NT02_NewsType_NT02_TypeID, $NT02_Status)
	{
		$statusArray = array();
		foreach($NT02_NewsType_NT02_TypeID as $val){
			$statusArray[] = "'".$val->NT02_TypeID."'";
		}
		$NT02_NewsType_NT02_TypeID = implode(",",$statusArray);
		
		// return $this->db->
			// SELECT('
				// Category.Cate_OldID
			// ')->
			// where('Category.Cate_Status', 'Y')->
			// where_in('Category.Cate_OldID', $NT02_NewsType_NT02_TypeID)->
			// get('Category')->result();
		$StrQuery = "
			SELECT
				Category.Cate_OldID
			FROM
				Category
			WHERE 
		";
		if($NT02_Status != ""){
			$StrQuery .= "
					Category.Cate_Status = '".$NT02_Status."'
				AND
			";
		}
		$StrQuery .= "
				Category.Cate_OldID IN (".$NT02_NewsType_NT02_TypeID.")
		";
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_NT02_NewsType_search(
		$NT02_TypeName = '',
		$Category_Cate_OldID = '',
		$page=1, 
		$row_per_page=20
		// $NT02_Status = ''
	)
	{
		$statusArray = array();
		foreach($Category_Cate_OldID as $val){
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Category_Cate_OldID = implode(",",$statusArray);
		
		$start = $page==1?0:$page*$row_per_page-($row_per_page);
		$end = $page*$row_per_page;
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					NT02_NewsType.NT02_TypeID,
					NT02_NewsType.NT02_TypeName,
					NT02_NewsType.NT02_Status,
					NT02_NewsType.NT02_TypeNameEn,
					NT02_NewsType.NT02_Sequence,
					ROW_NUMBER() OVER (ORDER BY (NT02_NewsType.NT02_TypeID) DESC) AS 'RowNumber'
				FROM NT02_NewsType
				WHERE 
					NT02_NewsType.NT02_TypeID IN (".$Category_Cate_OldID.")
		";
		if($NT02_TypeName != ""){
			$StrQuery .= "
				AND
					NT02_NewsType.NT02_TypeName LIKE '%".$NT02_TypeName."%' ESCAPE '!'
			";
		}
		$StrQuery .= "
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		"; 
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		return $query;
	}
	
	public function get_NT02_NewsType_search_count(
		$NT02_TypeName = '',
		$Category_Cate_OldID = ''
	)
	{
		$statusArray = array();
		foreach($Category_Cate_OldID as $val){
			$statusArray[] = "'".$val->Cate_OldID."'";
		}
		$Category_Cate_OldID = implode(",",$statusArray);
		
		$StrQuery = "
			SELECT
				COUNT(NT02_NewsType.NT02_TypeID) AS NUMROW
			FROM 
				NT02_NewsType
			WHERE 
				NT02_NewsType.NT02_TypeID IN (".$Category_Cate_OldID.")
		"; 
		if($NT02_TypeName != ""){
			$StrQuery .= "
				AND
					NT02_NewsType.NT02_TypeName LIKE '%".$NT02_TypeName."%' ESCAPE '!'
			";
		}
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	//##################### New Database #########################
	
	public function set_Category(
		$NT02_TypeID=''
	)
	{
		$query_read_new_category = $this->db->
			where('Cate_OldID', $NT02_TypeID)->
			get('Category')->result();
		
		$i=0;
		foreach ($query_read_new_category as $item) {
			
			if($item->Cate_Status == "N"){
			
				$data = array(
					'Cate_Status' => 'Y',
					'Cate_UpdateDate' => date('Y-m-d h:m:s'),
					'MemUpdate_ID' => $this->session->userdata('member_id')
				);
				
			}
			elseif($item->Cate_Status == "Y"){
				$data = array(
					'Cate_Status' => 'N',
					'Cate_UpdateDate' => date('Y-m-d h:m:s'),
					'MemUpdate_ID' => $this->session->userdata('member_id')
				);
			}
			
			$query = $this->db->
				where('Cate_OldID', $NT02_TypeID)->
				update('Category', $data);
			
			$i++;
		}
		if($i==0){
			
			$data = array(
				'Cate_OldID' => $NT02_TypeID,
				'Cate_Status' => 'Y',
				'Cate_UpdateDate' => date('Y-m-d h:m:s')
			);
			
			$query = $this->db->
				insert('Category', $data);
			
		}
		return $query;
	}
}