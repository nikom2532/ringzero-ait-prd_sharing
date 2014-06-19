<?php
class PRD_ManageInfo_Category_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//##################### Old Database #########################
	
	public function get_NT02_NewsType($page=1, $row_per_page=20)
	{
		/*
		$query = $this->db_ntt_old->
			SELECT('
				NT02_NewsType.NT02_TypeID,
				NT02_NewsType.NT02_TypeName,
				NT02_NewsType.NT02_Status,
				NT02_NewsType.NT02_TypeNameEn,
				NT02_NewsType.NT02_Sequence
			')->
			// LIMIT('20,0')->	
			where('NT02_Status', 'Y')->
			get('NT02_NewsType')->result();
		return $query;
		*/
		//*
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
				FROM NT02_NewsType
				WHERE 
					NT02_NewsType.NT02_Status = 'Y'
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		"; 
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		return $query;
		//*/
	}
	
	public function get_NT02_NewsType_search(
		$NT02_TypeName = ''//,
		// $NT02_Status = ''
	)
	{
		/*
		return $this->db_ntt_old->
			SELECT('
				NT02_NewsType.NT02_TypeID,
				NT02_NewsType.NT02_TypeName,
				NT02_NewsType.NT02_Status,
				NT02_NewsType.NT02_TypeNameEn,
				NT02_NewsType.NT02_Sequence
			')->
			LIMIT('20,0')->	
			where('NT02_Status', 'Y')->
			like('NT02_TypeName', $NT02_TypeName)->
			get('NT02_NewsType')->result();
		*/
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
					NT02_NewsType.NT02_Status = 'Y'
				AND
					NT02_NewsType.NT02_TypeName LIKE '%".$NT02_TypeName."%' ESCAPE '!'
				ORDER BY NT02_NewsType.NT02_TypeID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		"; 
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		return $query;
	}
	
	//##################### New Database #########################
	
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
			LIMIT('20,0')->	
			join('Member', 'Member.Mem_ID = Category.MemUpdate_ID', 'left')->
			get('Category')->result();
	}
	
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
	
	// $this->db->limit($limit, $start);
}