<?php
class PRD_ManageInfo_Category_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//##################### Old Database #########################
	
	public function get_NT02_NewsType()
	{
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
			get('NT02_NewsType')->result();
	}
	
	public function get_NT02_NewsType_search(
		$NT02_TypeName = '',
		$NT02_Status = ''
	)
	{
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
			where('$NT02_TypeName', $NT02_TypeName)->
			get('NT02_NewsType')->result();
	}
	
	//##################### New Database #########################
	
	public function get_Category()
	{
		
		return $this->db->
			SELECT('
				Cate_ID,
				Cate_OldID,
				Cate_OldID,
				Cate_Status,
				Cate_UpdateDate,
				MemUpdate_ID
			')->
			LIMIT('20,0')->	
			join('Member', 'Member.Mem_ID = Category.MemUpdate_ID', 'left')->
			get('Category')->result();
	}
	
	// $this->db->limit($limit, $start);
}