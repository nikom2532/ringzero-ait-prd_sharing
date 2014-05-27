<?php
class PRD_ManageNew_Detail_PRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//#########  Database Old  ##########
	/*
	public function get_NT01_News()
	{
		return $this->db_ntt_old->
			LIMIT('20,0')->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_NewsSource,
				NT01_News.NT01_NewsReferance,
				NT01_News.NT01_UpdUserID,
				NT01_News.NT01_CreUserID,
				SC03_User.SC03_FName'
			)->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			
			get('NT01_News')->result();
	}
	*/
	
	//###################################################
	
	
	public function get_NT01_News($NT01_NewsID = '')
	{
		
		// ถ้าต้องการ Query 2 รอบ ก็ Query 2 ตัว
		// Select From Where 1
		// Select From Where 2
		// แล้ว ส่งค่า Returnไป  ทั้งก้อน (ยัด ลง  Array)
		
		$query_news = $this->db_ntt_old->
			LIMIT('20,0')->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_NewsTag,
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_NewsDesc,
				NT01_News.NT01_NewsSource,
				NT01_News.NT01_NewsReferance,
				NT01_News.NT01_UpdUserID,
				NT01_News.NT01_CreUserID,
				NT01_News.NT01_ReporterID,
				
				SC03_User.SC03_FName AS ReporterName,
				
				NT01_News.NT01_ApvUserID
			')->
			join('SC03_User', 
				'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID', 'left')->
			where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			get('NT01_News')->result();
		
		// $array_merge = array_merge(
			// $query_normal, $query_CreUser, $query_CamCoder, 
			// $query_file1, $query_file2,
			// $query_ApvUserName
		// );
		
		// $array_merge = array(
			// $query_news, $query_CreUser, $query_CamCoder, 
			// $query_file1, $query_file2,
			// $query_ApvUserName
		// );
		
		// var_dump($array_merge);
		
		return $query_news;
	}


	public function get_NT01_News_CreUser($NT01_NewsID = ''){
		
		$query_CreUser = $this->db_ntt_old->
			LIMIT('20,0')->
			select('
				SC03_User.SC03_FName AS CreUserName
			')->
			join('SC03_User', 
				'SC03_User.SC03_UserId = NT01_News.NT01_CreUserID', 
				'left')->	
			where('NT01_NewsID', $NT01_NewsID)->
			get('NT01_News')->result();
	}

	public function get_NT01_News_CamCoder($NT01_NewsID = ''){
	
		$query_CamCoder = $this->db_ntt_old->
			LIMIT('20,0')->
			select('
				SC03_User.SC03_FName AS CamCoderName
			')->
			join('SC03_User', 
				'SC03_User.SC03_UserId = NT01_News.NT01_CamCoderID', 
				'left')->	
			where('NT01_NewsID', $NT01_NewsID)->
			get('NT01_News')->result();
		
		return $query_CamCoder;
	}

	public function get_NT01_News_ApvUserName($NT01_NewsID = ''){
		
		$query_ApvUserName = $this->db_ntt_old->
			LIMIT('20,0')->
			select('
				NT01_News.NT01_ApvUserID,
				SC03_User.SC03_FName AS ApvUserName
			')->
			join('SC03_User', 
				'SC03_User.SC03_UserId = NT01_News.NT01_ApvUserID', 
				'left')->	
			where('NT01_NewsID', $NT01_NewsID)->
			get('NT01_News')->result();
			
		return $query_ApvUserName;
	}

	public function get_NT01_News_query_file1($NT01_NewsID = ''){
		$query_file2 = $this->db_ntt_old->
			select('
				NT11_Picture.NT11_PicName,
				NT11_Picture.NT11_PicPath,
				NT11_Picture.NT11_Extension,
				NT11_Picture.NT11_FileStatus
			')->
			join('NT11_Picture', 'NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID', 'left')->
			// where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			where('NT01_News.NT01_NewsID', 'INEWS130704204703081')->
			
			get('NT01_News')->result();
		return $query_file2;
		
	}

	public function get_NT01_News_query_file2($NT01_NewsID = ''){
		
		$query_file2 = $this->db_ntt_old->
			select('
				NT11_Picture.NT11_PicName,
				NT11_Picture.NT11_PicPath,
				NT11_Picture.NT11_Extension,
				NT11_Picture.NT11_FileStatus
			')->
			join('NT11_Picture', 'NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID', 'left')->
			// where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			where('NT01_News.NT01_NewsID', 'INEWS130704204703081')->
			
			get('NT01_News')->result();
		
		return $query_file2;
	}
	
	//###################################################
	
	public function get_NT02_NewsType()
	{
		return $this->db_ntt_old->
			LIMIT('20,0')->	
			get('NT02_NewsType')->result();
	}
	public function get_NT03_NewsSubType()
	{
		return $this->db_ntt_old->
			LIMIT('20,0')->	
			get('NT03_NewsSubType')->result();
	}
	
	//#########  Database New  ##########
	public function get_prd()
	{
		return $this->db->get('News')->result();
	}
	
	//##########################
	
	// $this->db->limit($limit, $start);
}