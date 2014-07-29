<?php
class PRD_Report_PRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
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
	public function get_NT03_NewsSubType_Unique($NT02_TypeID = '')
	{
		$query = $this->db_ntt_old;
			// LIMIT('20,0')->
		if($NT02_TypeID != ""){
			$query = $query->
				where('NT02_TypeID', $NT02_TypeID);
		}
		$query = $query->
			get('NT03_NewsSubType')->result();
		return $query;
	}
	
	public function get_SC03_User()
	{
		return $this->db_ntt_old->
			SELECT("
				SC03_User.SC03_UserId,
				SC03_User.SC03_TName+' '+SC03_User.SC03_FName+' '+SC03_User.SC03_LName AS ReporterName
			")->
			get("SC03_User")->result();
	}
	
	//############################ Delete News #############################
	
	public function delete_News($old_news_id = '')
	{
		$isDelete = 0;
		$checkDelete = "
			SELECT
				News_Delete
			FROM
				News
			WHERE 
				News_OldID = '".$old_news_id."'
		";
		$checkDeleteQuery = $this->db->
			query($checkDelete)->result();
		foreach ($checkDeleteQuery as $checkDeleteItem) {
			$isDelete = $checkDeleteItem->News_Delete;
		}
		if($isDelete == 1){
			$StrQuery = "
				UPDATE News
				SET 
					News_Delete = '0'
				WHERE 
					News_OldID = '".$old_news_id."'
			";
		}
		else{
			$StrQuery = "
				UPDATE News
				SET 
					News_Delete = '1'
				WHERE 
					News_OldID = '".$old_news_id."'
			";
		}
		$query = $this->db->
			query($StrQuery);
		return $query;
	}
	
	public function get_SC07_Department()
	{
		$query_SC07_Department = $this->db_ntt_old->
			select('
				SC07_Department.SC07_DepartmentId,
				SC07_Department.SC07_DepartmentName
			')->
			get('SC07_Department')->result();
		
		return $query_SC07_Department;
	}
	
	/*
	public function undelete_News($old_news_id = '')
	{
		$StrQuery = "
			UPDATE News
			SET 
				News_Delete = '0'
			WHERE 
				News_OldID = '".$old_news_id."'
		";
		$query = $this->db->
			query($StrQuery)->result();
		return $query;
	}
	*/
	//############################ News #############################
	
	public function get_NT01_News($page=1, $row_per_page=20)
	{
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					MAX(NT01_News.NT01_NewsID) AS NT01_NewsID, 
					MAX(NT01_News.NT01_NewsDate) AS NT01_NewsDate,
					MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					MAX(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
					MAX(NT01_News.NT01_NewsSource) AS NT01_NewsSource,
					MAX(NT01_News.NT01_NewsReferance) AS NT01_NewsReferance,
					MAX(NT01_News.NT01_UpdUserID) AS NT01_UpdUserID,
					MAX(NT01_News.NT01_CreUserID) AS NT01_CreUserID,
					MAX(NT01_News.NT01_Status) AS NT01_Status,
					MAX(SC03_User.SC03_FName) AS SC03_FName,
					MAX(SC03_User.SC03_LName) AS SC03_LName,
					MAX(SC03_User.SC07_DepartmentId) AS SC07_DepartmentId,
					MAX(NT10_VDO.NT10_FileStatus) AS NT10_FileStatus,
					MAX(NT11_Picture.NT11_FileStatus) AS NT11_FileStatus, 
					MAX(NT12_Voice.NT12_FileStatus) AS NT12_FileStatus, 
					MAX(NT13_OtherFile.NT13_FileStatus) AS NT13_FileStatus,
					MAX(SC07_Department.SC07_DepartmentName) AS SC07_DepartmentName,
					ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsID) DESC) AS 'RowNumber'
				FROM NT01_News 
				LEFT JOIN SC03_User 
					ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
				JOIN SC07_Department
					ON SC07_Department.SC07_DepartmentId = SC03_User.SC07_DepartmentId
				LEFT JOIN NT10_VDO 
					ON NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID 
				LEFT JOIN NT11_Picture 
					ON NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID 
				LEFT JOIN NT12_Voice 
					ON NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID 
				LEFT JOIN 
					NT13_OtherFile ON NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID 
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
				AND
					NT01_News.NT01_Status = 'Y'
				group by NT01_News.NT01_NewsID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_NT01_News_count()
	{
		$StrQuery = "
				SELECT
					COUNT((NT01_News.NT01_NewsID)) AS NUMROW
				FROM NT01_News 
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
				AND
					NT01_News.NT01_Status = 'Y'
		";
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_NT01_NewsID_FromAttachment(
		$filter_vdo = '',
		$filter_sound = '',
		$filter_image = '',
		$filter_other = ''
	){
		
	}
	
	public function get_NT01_News_Search(
		$page=1, 
		$row_per_page=20, 
		$grov_active = '',
		$startdate = '',
		$enddate = '',
		$NewsTypeID = '',
		$NewsSubTypeID = '',
		$ReporterID = '',
		$filter_vdo = '',
		$filter_sound = '',
		$filter_image = '',
		$filter_other = ''
	)
	{
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					NT01_News.NT01_NewsID,
					MAX(NT01_News.NT01_NewsDate) AS NT01_NewsDate,
					MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					MAX(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
					MAX(NT01_News.NT01_NewsSource) AS NT01_NewsSource,
					MAX(NT01_News.NT01_NewsReferance) AS NT01_NewsReferance,
					MAX(NT01_News.NT01_UpdUserID) AS NT01_UpdUserID,
					MAX(NT01_News.NT01_CreUserID) AS NT01_CreUserID,
					MAX(NT01_News.NT01_Status) AS NT01_Status,
					MAX(SC03_User.SC03_FName) AS SC03_FName, 
					MAX(SC03_User.SC03_LName) AS SC03_LName,
					MAX(NT10_VDO.NT10_FileStatus) AS NT10_FileStatus, 
					MAX(NT11_Picture.NT11_FileStatus) AS NT11_FileStatus, 
					MAX(NT12_Voice.NT12_FileStatus) AS NT12_FileStatus, 
					MAX(NT13_OtherFile.NT13_FileStatus) AS NT13_FileStatus,
					MAX(SC07_Department.SC07_DepartmentName) AS SC07_DepartmentName,
					ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsID) DESC) AS 'RowNumber'
				FROM NT01_News 
				LEFT JOIN 
					SC03_User 
				ON 
					SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
				LEFT JOIN 
					SC07_Department
				ON 
					SC07_Department.SC07_DepartmentId = SC03_User.SC07_DepartmentId
				LEFT JOIN 
					NT10_VDO 
				ON 
					NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID 
				LEFT JOIN 
					NT11_Picture 
				ON 
					NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID 
				LEFT JOIN 
					NT12_Voice 
				ON 
					NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID 
				LEFT JOIN 
					NT13_OtherFile 
				ON 
					NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID 
				WHERE 
					NT08_PubTypeID = '11'
				AND
					NT01_News.NT01_Status = 'Y'
		";
		if($grov_active != ''){
			$StrQuery .= "
				AND 
					NT01_News.SC07_DepartmentId LIKE '%".$grov_active."%' ESCAPE '!'
			";
		}
		if(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate > '".date("Y-m-d H:i:s", strtotime($startdate))."'
			";
		}
		elseif(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate < '".date("Y-m-d H:i:s", strtotime($enddate))."'
			";
		}
		elseif(
			($startdate != '') &&
			($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate
						BETWEEN 
							'".date("Y-m-d H:i:s", strtotime($startdate))."'
							AND
							'".date("Y-m-d H:i:s", strtotime($enddate)+86399)."'
			";
		}
		if($NewsTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT02_TypeID = '".$NewsTypeID."'
			";
		}
		if($NewsSubTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT03_SubTypeID = '".$NewsSubTypeID."'
			";
		}
		if($ReporterID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT01_ReporterID = '".$ReporterID."'
			";
		}
		if($filter_vdo == '1'){
			$StrQuery .= "
				AND
					NT10_VDO.NT10_FileStatus = 'Y'
			";
		}
		if($filter_sound == '1'){
			$StrQuery .= "
				AND
					NT11_Picture.NT11_FileStatus = 'Y'
			";
		}
		if($filter_image == '1'){
			$StrQuery .= "
				AND
					NT12_Voice.NT12_FileStatus = 'Y'
			";
		}
		if($filter_other == '1'){
			$StrQuery .= "
				AND
					NT13_OtherFile.NT13_FileStatus = 'Y'
			";
		}
		
		$StrQuery .= "
				group by NT01_News.NT01_NewsID
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_NT01_NewsID_search_with_attachment_count(
		$grov_active = '',
		$startdate = '',
		$enddate = '',
		$NewsTypeID = '',
		$NewsSubTypeID = '',
		$ReporterID = '',
		$filter_vdo = '',
		$filter_sound = '',
		$filter_image = '',
		$filter_other = ''
	)
	{
		$StrQuery = "
			SELECT DISTINCT
				NT01_News.NT01_NewsID
			FROM NT01_News 
			LEFT JOIN 
				NT10_VDO 
			ON 
				NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID 
			LEFT JOIN 
				NT11_Picture 
			ON 
				NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID 
			LEFT JOIN 
				NT12_Voice 
			ON 
				NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID 
			LEFT JOIN 
				NT13_OtherFile 
			ON 
				NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID
			WHERE 
				NT01_News.NT08_PubTypeID = '11'
			AND
				NT01_News.NT01_Status = 'Y'
		";
		if($grov_active != ''){
			$StrQuery .= "
				AND 
					NT01_News.SC07_DepartmentId LIKE '%".$grov_active."%' ESCAPE '!'
			";
		}
		if(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate > '".date("Y-m-d H:i:s", strtotime($startdate))."'
			";
		}
		elseif(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate < '".date("Y-m-d H:i:s", strtotime($enddate))."'
			";
		}
		elseif(
			($startdate != '') &&
			($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate
						BETWEEN 
							'".date("Y-m-d H:i:s", strtotime($startdate))."'
							AND
							'".date("Y-m-d H:i:s", strtotime($enddate)+86399)."'
			";
		}
		if($NewsTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT02_TypeID = '".$NewsTypeID."'
			";
		}
		if($NewsSubTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT03_SubTypeID = '".$NewsSubTypeID."'
			";
		}
		if($ReporterID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT01_ReporterID = '".$ReporterID."'
			";
		}
		if($filter_vdo == '1'){
			$StrQuery .= "
				AND
					NT10_VDO.NT10_FileStatus = 'Y'
			";
		}
		if($filter_sound == '1'){
			$StrQuery .= "
				AND
					NT11_Picture.NT11_FileStatus = 'Y'
			";
		}
		if($filter_image == '1'){
			$StrQuery .= "
				AND
					NT12_Voice.NT12_FileStatus = 'Y'
			";
		}
		if($filter_other == '1'){
			$StrQuery .= "
				AND
					NT13_OtherFile.NT13_FileStatus = 'Y'
			";
		}
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		return $query;
	}
	
	public function get_NT01_News_search_count(
		$NT01_NewsID = ''
	)
	{
		if($NT01_NewsID != ""){
			$statusArray = array();
			foreach($NT01_NewsID as $val){
				$statusArray[] = "'".$val->NT01_NewsID."'";
			}
			$NT01_NewsID = implode(",",$statusArray);
		}
		
		$StrQuery = "
			SELECT
				COUNT(NT01_News.NT01_NewsID) AS NUMROW
			FROM NT01_News 
			WHERE 
				NT01_News.NT01_NewsID IN (".$NT01_NewsID.")
		";
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_NT01_News_search_count_backupQuery(
		$grov_active = '',
		$startdate = '',
		$enddate = '',
		$NewsTypeID = '',
		$NewsSubTypeID = '',
		$ReporterID = '',
		$filter_vdo = '',
		$filter_sound = '',
		$filter_image = '',
		$filter_other = ''
	)
	{
		$StrQuery = "
			SELECT
				COUNT(NT01_News.NT01_NewsID) AS NUMROW
			FROM NT01_News 
			LEFT JOIN 
				NT10_VDO 
			ON 
				NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID 
			LEFT JOIN 
				NT11_Picture 
			ON 
				NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID 
			LEFT JOIN 
				NT12_Voice 
			ON 
				NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID 
			LEFT JOIN 
				NT13_OtherFile 
			ON 
				NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID
			WHERE 
				NT01_News.NT08_PubTypeID = '11'
			AND
				NT01_News.NT01_Status = 'Y'
		";
		if($grov_active != ''){
			$StrQuery .= "
				AND 
					NT01_News.SC07_DepartmentId LIKE '%".$grov_active."%' ESCAPE '!'
			";
		}
		if(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate > '".date("Y-m-d H:i:s", strtotime($startdate))."'
			";
		}
		elseif(
			($startdate != '') && 
			!($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate < '".date("Y-m-d H:i:s", strtotime($enddate))."'
			";
		}
		elseif(
			($startdate != '') &&
			($enddate != '')
		){
			$StrQuery .= "
				AND
					NT01_News.NT01_NewsDate
						BETWEEN 
							'".date("Y-m-d H:i:s", strtotime($startdate))."'
							AND
							'".date("Y-m-d H:i:s", strtotime($enddate)+86399)."'
			";
		}
		if($NewsTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT02_TypeID = '".$NewsTypeID."'
			";
		}
		if($NewsSubTypeID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT03_SubTypeID = '".$NewsSubTypeID."'
			";
		}
		if($ReporterID != ''){
			$StrQuery .= "
				AND
					NT01_News.NT01_ReporterID = '".$ReporterID."'
			";
		}
		if($filter_vdo == '1'){
			$StrQuery .= "
				AND
					NT10_VDO.NT10_FileStatus = 'Y'
			";
		}
		if($filter_sound == '1'){
			$StrQuery .= "
				AND
					NT11_Picture.NT11_FileStatus = 'Y'
			";
		}
		if($filter_image == '1'){
			$StrQuery .= "
				AND
					NT12_Voice.NT12_FileStatus = 'Y'
			";
		}
		if($filter_other == '1'){
			$StrQuery .= "
				AND
					NT13_OtherFile.NT13_FileStatus = 'Y'
			";
		}
		// $StrQuery .= "
				// group by NT01_News.NT01_NewsID
		// ";
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	/*
	//for search where have no update
	public function get_NT01_News_Search_IsHaveUpdateDate(
		$News_Title = '' //,
		// $NewsTypeID = '',
		// $NewsSubTypeID = ''
	)
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
				SC03_User.SC03_FName,
				NT10_VDO.NT10_FileStatus,
				NT11_Picture.NT11_FileStatus,
				NT12_Voice.NT12_FileStatus,
				NT13_OtherFile.NT13_FileStatus
			')->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID', 'left')->
			join('NT11_Picture', 'NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID', 'left')->
			join('NT12_Voice', 'NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID', 'left')->
			join('NT13_OtherFile', 'NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID', 'left')->
			where('NT08_PubTypeID', '11')->
			like('NT01_News.NT01_NewsTitle', $News_Title)->
			
			// where('NT01_News.NT01_UpdUserID IS NOT NULL', null)->
			
			// where('NT01_News.NT02_TypeID = '.$NewsTypeID)->
			// where('NT01_News.NT03_SubTypeID = '.$NewsSubTypeID)->
			
			get('NT01_News')->result();
	}
	*/
	
	//#########  Database New  ##########
	
	public function get_New_News()
	{
		$query_news = $this->db->
			join('Category', 'News.Cate_ID = Category.Cate_ID', 'left')->
			get('News')->result();
		return $query_news;
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
	
	//##########################
	
	
	public function set_FirstAddNews($news='')
	{
		// var_dump($news);
		
		foreach ($news as $news_item) {
			
			$newsCreDate = strtotime($news_item->NT01_CreDate);
			$newsUpdDate = strtotime($news_item->NT01_UpdDate);
	    	
			if(isset($newsUpdDate)){
				if($newsUpdDate > $newsCreDate){
					$newsDate = $news_item->NT01_UpdDate;
				}
				else{
					$newsDate = $news_item->NT01_CreDate;
				}
			}
			else{
				$newsDate = $news_item->NT01_CreDate;
			}
			
			if($news_item->NT11_FileStatus == "Y"){
				$NT11_FileStatus = "1";
			}
			else{
				$NT11_FileStatus = "0";
			}
			if($news_item->NT10_FileStatus == "Y"){
				$NT10_FileStatus = "1";
			}
			else{
				$NT10_FileStatus = "0";
			}
			if($news_item->NT12_FileStatus == "Y"){
				$NT12_FileStatus = "1";
			}
			else{
				$NT12_FileStatus = "0";
			}
			if($news_item->NT13_FileStatus == "Y"){
				$NT13_FileStatus = "1";
			}
			else{
				$NT13_FileStatus = "0";
			}
			
			
			$data = array(
			   'News_OldID' => $news_item->NT01_NewsID,
			   'News_Date' => $newsDate,
			   'News_StatusPhoto' => $NT11_FileStatus,
			   'News_StatusVDO' => $NT10_FileStatus,
			   'News_StatusVoice' => $NT12_FileStatus,
			   'News_StatusOtherFile' => $NT13_FileStatus,
			   'News_Active' => "1" //,
			   // 'News_StatusPublic' => "1"
			);
			
			
			$query2 = $this->db->
						where('News_OldID', $data['News_OldID'])->
						get('News');
						
			// var_dump($query2);
			
			// echo($query2->num_rows());
						
			if(!($query2->num_rows() > 0)){
				$this->db->insert("News", $data);
			}
	    }
	}
	
	
	//For record a new news
	public function set_prd_news(
		$NT01_NewsID='',
		$NT01_NewsTitle='',
		$NT01_NewsDesc='',
		$NT01_NewsSource='',
		$NT01_NewsReferance='',
		$NT01_NewsTag='',
		$NewsTypeID='',
		$NewsSubTypeID='',
		$News_UpdateID=''
	)
	{
			if(isset($News_UpdateID)){
				$News_UpdateID_next = 1;
			}
			elseif($News_UpdateID>0){
				$News_UpdateID += 1;
			}
			
			$data = array(
			   'News_Title' => $NT01_NewsTitle,
			   'News_Detail' => $NT01_NewsDesc,
			   'News_Resource' => $NT01_NewsSource,
			   'News_Reference' => $NT01_NewsReferance,
			   'News_Tag' => $NT01_NewsTag,
			   'News_OldCateID' => $NewsTypeID,
			   'News_OldSubCateID' => $NewsSubTypeID,
			   'News_UpdateID' => $News_UpdateID_next
			);
			
			// var_dump($data);
			
			return $this->db->where("News_OldID", $NT01_NewsID)->
				update("News", $data);
	}
	
	
	//##########################
	
	// $this->db->limit($limit, $start);
}