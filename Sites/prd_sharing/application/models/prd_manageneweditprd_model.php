<?php
class PRD_ManageNewEditPRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//#########  Database Old  ##########
	
	public function get_New_News($NT01_NewsID = '')
	{
		$query_news = $this->db->
			join('Category', 'News.Cate_ID = Category.Cate_ID', 'left')->
			where('News_OldID', $NT01_NewsID)->
			get('News')->result();
		return $query_news;
	}
	
	public function get_NT01_News($NT01_NewsID = '')
	{
		
		// ถ้าต้องการ Query 2 รอบ ก็ Query 2 ตัว
		// Select From Where 1
		// Select From Where 2
		// แล้ว ส่งค่า Returnไป  ทั้งก้อน (ยัด ลง  Array)
		
		$query_normal = $this->db_ntt_old->
			// LIMIT('20,0')->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_NewsTag,
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_NewsDesc,
				NT01_News.NT01_NewsSource,
				NT01_News.NT01_NewsReferance,
				NT01_News.NT01_UpdUserID,
				NT01_News.NT01_CreUserID,
				NT01_News.NT01_ReporterID,
				
				SC03_User.SC03_FName AS ReporterName,
				
				NT01_News.NT01_ApvUserID,
				
				NT02_NewsType.NT02_TypeID,
				NT03_NewsSubType.NT03_SubTypeID
			')->
			join(
				'SC03_User', 
				'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID', 
				'left'
			)->
			join(
				'NT02_NewsType', 
				'NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID',
				'left'
			)->
			join(
				'NT03_NewsSubType', 
				'NT03_NewsSubType.NT03_SubTypeID = NT01_News.NT03_SubTypeID',
				'left'
			)->
			where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			get('NT01_News')->result();
		
		
		$query_file1 = $this->db_ntt_old->
			// LIMIT('20,0')->
			select('
				NT10_VDO.NT10_VDOName,
				NT10_VDO.NT10_Extension,
				
				NT10_VDO.NT10_FileStatus,
			')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID', 'left')->
			where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			get('NT01_News')->result();
		
		$query_file2 = $this->db_ntt_old->
			// LIMIT('20,0')->
			select('
				NT11_Picture.NT11_PicName,
				NT11_Picture.NT11_Extension,
				
				NT11_Picture.NT11_FileStatus
			')->
			join('NT11_Picture', 'NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID', 'left')->
			where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			get('NT01_News')->result();
		
		// var_dump($query_file2);
		// exit;
		
		$query_file3 = $this->db_ntt_old->
			// LIMIT('20,0')->
			select('
				NT12_Voice.NT12_VoiceName,
				NT12_Voice.NT12_Extension,
				
				NT12_Voice.NT12_FileStatus
			')->
			join('NT12_Voice', 'NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID', 'left')->
			where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			get('NT01_News')->result();
			
			
		$query_file4 = $this->db_ntt_old->
			// LIMIT('20,0')->
			select('
				NT13_OtherFile.NT13_FileName,
				NT13_OtherFile.NT13_Extension,
				
				NT13_OtherFile.NT13_FileStatus
			')->
			join('NT13_OtherFile', 'NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID', 'left')->
			where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			get('NT01_News')->result();
		
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
			
			
		$array_merge = array_merge(
			$query_normal, $query_CreUser, $query_CamCoder, 
			$query_file1, $query_file2, $query_file3, $query_file4,
			$query_ApvUserName
		);
		
		// $array_merge = array_merge(
			// $query_normal, $query_CreUser, $query_CamCoder
		// );
		
		// $array_merge = array_merge_recursive($query_normal, $query_CreUser);
		
		// $array_merge = $query_normal + $query_CreUser;
		// $array_merge = array_combine($query_normal, $query_CreUser);
		
		// $array_merge = $query_normal;
		// array_push($array_merge, $query_CreUser);
		// $array_merge[0]["CreUserName"] = $array_merge[1]["CreUserName"];
		
		// $array_merge = array_replace($query_normal, $query_CreUser);
		
		// var_dump($query_normal);
		// echo "============================================= ";
		// var_dump($array_merge);
		// echo "============================================= ";
		// echo($array_merge[0]["NT01_NewsID"]);
		
		
		// return $query_normal;
		return $array_merge;
		
		
		
		/*
		return $this->db_ntt_old->
			LIMIT('20,0')->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_NewsDesc,
				NT01_News.NT01_NewsSource,
				NT01_News.NT01_NewsReferance,
				NT01_News.NT01_UpdUserID,
				NT01_News.NT01_CreUserID,
				
				NT01_News.NT01_ReporterID,
				
				SC03_User.SC03_FName
			')->
			join('SC03_User', '
				SC03_User.SC03_UserId = NT01_News.NT01_ReporterID
			
				SC03_User.SC03_UserId = NT01_News.NT01_CreUserID', 'left')->
			where('NT01_NewsID', $NT01_NewsID)->
			get('NT01_News')->result();
		*/
	}
	
	public function get_NT10_VDO($NT01_NewsID = '')
	{
		$query_file1 = $this->db_ntt_old->
			select("
				NT10_VDO.NT10_VDOName,
				'http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl='+NT10_VDO.NT10_VDOPath AS Url,
				NT10_VDO.NT10_Extension,
				NT10_VDO.NT10_FileStatus,
			")->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID', 'left')->
			where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			where('NT10_VDO.NT10_FileStatus', 'Y')->
			get('NT01_News')->result();
		
		return $query_file1;
	}
	
	public function get_NT11_Picture($NT01_NewsID = '')
	{
		$query_file2 = $this->db_ntt_old->
			select("
				NT11_Picture.NT11_PicName,
				NT11_Picture.NT11_Extension,
				'http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl='+NT11_Picture.NT11_PicPath AS Url,
				NT11_Picture.NT11_FileStatus
			")->
			join('NT11_Picture', 'NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID', 'left')->
			where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			where('NT11_Picture.NT11_FileStatus', 'Y')->
			get('NT01_News')->result();
		
		return $query_file2;
	}
	
	public function get_NT12_Voice($NT01_NewsID = '')
	{
		$query_file3 = $this->db_ntt_old->
			// LIMIT('20,0')->
			select("
				NT12_Voice.NT12_VoiceName,
				NT12_Voice.NT12_Extension,
				'http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl='+NT12_Voice.NT12_VoicePath AS Url,
				NT12_Voice.NT12_FileStatus
			")->
			join('NT12_Voice', 'NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID', 'left')->
			where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			where('NT12_Voice.NT12_FileStatus', 'Y')->
			get('NT01_News')->result();
			
	}
	
	public function get_NT13_OtherFile($NT01_NewsID = '')
	{
		$query_file4 = $this->db_ntt_old->
			// LIMIT('20,0')->
			select("
				NT13_OtherFile.NT13_FileName,
				NT13_OtherFile.NT13_Extension,
				'http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl='+NT13_OtherFile.NT13_FilePath AS Url,
				NT13_OtherFile.NT13_FileStatus
			")->
			join('NT13_OtherFile', 'NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID', 'left')->
			where('NT01_News.NT01_NewsID', $NT01_NewsID)->
			where('NT13_OtherFile.NT13_FileStatus', 'Y')->
			get('NT01_News')->result();
	}
	
	public function get_NT02_NewsType()
	{
		return $this->db_ntt_old->
			// LIMIT('20,0')->	
			get('NT02_NewsType')->result();
	}
	public function get_NT03_NewsSubType()
	{
		return $this->db_ntt_old->
			// LIMIT('20,0')->	
			get('NT03_NewsSubType')->result();
	}
	
	//#########  Database New  ##########
	public function get_prd()
	{
		return $this->db->get('News')->result();
	}
	public function get_prd_search_title($news_title)
	{
		return $this->db->
			like('News_Title', $news_title)->
			get('News')->result();
	}
	public function get_prd_search_title_start($news_title, $start)
	{
		return $this->db->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			get('News')->result();
	}
	public function get_prd_search_title_start_end($news_title, $start, $end)
	{
		return $this->db->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			where("News_Date <=", $end)->
			get('News')->result();
	}
	
	public function get_prd_record_count()
	{
		return $this->db->count_all('News');
	}
	
	public function get_prd_limit($limit, $start)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get('News');
			
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	//##########################
	
	// $this->db->limit($limit, $start);
}