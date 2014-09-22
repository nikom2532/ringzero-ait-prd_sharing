<?php
class PRD_ManageNewPRD_model extends CI_Model {

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
			where('NT03_Status', 'Y')->
			get('NT03_NewsSubType')->result();
		return $query;
	}
	
	public function get_SC03_User()
	{
		return $this->db_ntt_old->
			SELECT("
				SC03_User.SC03_UserId,
				SC03_User.SC03_FName+' '+SC03_User.SC03_LName AS ReporterName
			")->
			get("SC03_User")->result();
	}
	
	public function checkDelete_News()
	{
		$checkDelete = "
			SELECT
				News.News_OldID
			FROM
				News
			WHERE 
				(News.News_Delete <> '1') 
				or 
				(News.News_Delete IS NULL)
		";
		$checkDeleteQuery = $this->db->
			query($checkDelete)->result();
		return $checkDeleteQuery;
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
	
	/*
	public function get_NT01_News_SaveToNewDatabase()
	{
		$StrQuery = "
			SELECT
				MAX(NT01_News.NT01_NewsID) AS NT01_NewsID, 
				MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
				MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
				
				MAX(NT10_VDO.NT10_FileStatus) AS NT10_FileStatus, 
				MAX(NT11_Picture.NT11_FileStatus) AS NT11_FileStatus, 
				MAX(NT12_Voice.NT12_FileStatus) AS NT12_FileStatus, 
				MAX(NT13_OtherFile.NT13_FileStatus) AS NT13_FileStatus,
				
				ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsID) DESC) AS 'RowNumber'
			FROM NT01_News 
			LEFT JOIN NT02_NewsType 
				ON NT02_NewsType.NT02_TypeID = NT01_News.NT02_TypeID
			LEFT JOIN SC03_User 
				ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
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
			AND
				NT02_NewsType.NT02_Status = 'Y'
			group by NT01_News.NT01_NewsID
		";
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		return $query;
	}
	*/
	
	//############################ News #############################
	
	public function get_NT01_NewsID_FromAttachment(
		$filter_vdo = '',
		$filter_sound = '',
		$filter_image = '',
		$filter_other = ''
	){
		$StrQuery = "
			SELECT DISTINCT
				NT01_News.NT01_NewsID,
				NT10_VDO.NT10_FileStatus, 
				NT11_Picture.NT11_FileStatus, 
				NT12_Voice.NT12_FileStatus, 
				NT13_OtherFile.NT13_FileStatus
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
				NT08_PubTypeID = '11'
			AND
				NT01_News.NT01_Status = 'Y'
		";
		if($filter_vdo == '1'){
			$StrQuery .= "
				AND
					NT10_VDO.NT10_FileStatus = 'Y'
			";
		}
		else{
			$StrQuery .= "
				AND
				(
					NT10_VDO.NT10_FileStatus = 'N'
					OR
					NT10_VDO.NT10_FileStatus IS NULL
				)
			";
		}
		if($filter_sound == '1'){
			$StrQuery .= "
				AND
					NT11_Picture.NT11_FileStatus = 'Y'
			";
		}
		else{
			$StrQuery .= "
				AND
				(
					NT11_Picture.NT11_FileStatus = 'N'
					OR
					NT11_Picture.NT11_FileStatus IS NULL
				)
			";
		}
		if($filter_image == '1'){
			$StrQuery .= "
				AND
					NT12_Voice.NT12_FileStatus = 'Y'
			";
		}
		else{
			$StrQuery .= "
				AND
				(
					NT12_Voice.NT12_FileStatus = 'N'
					OR
					NT12_Voice.NT12_FileStatus IS NULL
				)
			";
		}
		if($filter_other == '1'){
			$StrQuery .= "
				AND
					NT13_OtherFile.NT13_FileStatus = 'Y'
			";
		}
		else{
			$StrQuery .= "
				AND
				(
					NT13_OtherFile.NT13_FileStatus = 'N'
					OR
					NT13_OtherFile.NT13_FileStatus IS NULL
				)
			";
		}
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_NT01_News(
		$page=1, 
		$row_per_page=20, 
		$checkDelete_News = ''
	)
	{
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT
					MAX(NT01_News.NT01_NewsID) AS NT01_NewsID, 
					MAX(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					MAX(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					MAX(NT01_News.NT01_NewsDate) AS NT01_NewsDate,
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
					ROW_NUMBER() OVER (ORDER BY MAX(NT01_News.NT01_NewsDate) DESC) AS 'RowNumber'
					
				FROM NT01_News 
				LEFT JOIN SC03_User 
					ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
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
		";
		if($checkDelete_News != ""){
			$StrQuery .= "
					AND 
						NT01_News.NT01_NewsID IN (".$checkDelete_News.")
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
	
	public function get_NT01_News_count(
		$checkDelete_News = ''
	)
	{
		$StrQuery = "
				SELECT
					COUNT((NT01_News.NT01_NewsID)) AS NUMROW
				FROM NT01_News 
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
		";
		if($checkDelete_News != ""){
			$StrQuery .= "
					AND 
						NT01_News.NT01_NewsID IN (".$checkDelete_News.")
			";
		}
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	public function get_NT01_News_Search(
		$page=1, 
		$row_per_page=20, 
		$News_Title = '',
		$startdate = '',
		$enddate = '',
		$NewsTypeID = '',
		$NewsSubTypeID = '',
		$ReporterID = '',
		$checkDelete_News = '',
		$NT01_NewsID = ''
	)
	{
		$start = $page==1?1:(($page*$row_per_page-($row_per_page))+1);
		$end = $page*$row_per_page;
		
		$StrQuery = "
			WITH LIMIT AS(
				SELECT 
					NT01_News.NT01_NewsID,
					(NT01_News.NT01_NewsDate) AS NT01_NewsDate,
					(NT01_News.NT01_UpdDate) AS NT01_UpdDate, 
					(NT01_News.NT01_CreDate) AS NT01_CreDate, 
					(NT01_News.NT01_NewsTitle) AS NT01_NewsTitle, 
					(NT01_News.NT01_NewsSource) AS NT01_NewsSource,
					(NT01_News.NT01_NewsReferance) AS NT01_NewsReferance,
					(NT01_News.NT01_UpdUserID) AS NT01_UpdUserID,
					(NT01_News.NT01_CreUserID) AS NT01_CreUserID,
					(NT01_News.NT01_Status) AS NT01_Status,
					(SC03_User.SC03_FName) AS SC03_FName, 
					(SC03_User.SC03_LName) AS SC03_LName,
					'' AS NT10_FileStatus, 
					'' AS NT11_FileStatus, 
					'' AS NT12_FileStatus, 
					'' AS NT13_FileStatus, 
					ROW_NUMBER() OVER (ORDER BY (NT01_News.NT01_NewsDate) DESC) AS 'RowNumber'
				FROM 
					NT01_News 
				LEFT JOIN 
					SC03_User ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
				WHERE 
					NT01_News.NT08_PubTypeID = '11'
		";
		if($NT01_NewsID != ""){
			$StrQuery .= "
					AND 
						NT01_News.NT01_NewsID IN (".$NT01_NewsID.")
			";
		}
		if($checkDelete_News != ""){
			$StrQuery .= "
					AND 
						NT01_News.NT01_NewsID IN (".$checkDelete_News.")
			";
		}
		if($News_Title != ''){
			$StrQuery .= "
				AND 
					NT01_News.NT01_NewsTitle LIKE '%".$News_Title."%' ESCAPE '!'
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
		$StrQuery .= "
			)
			SELECT * from LIMIT WHERE RowNumber BETWEEN $start AND $end
		";
		// echo $StrQuery;
		// exit;
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		return $query;
	}
	
	public function get_NT01_News_search_with_attachment_count(
		$News_Title = '',
		$startdate = '',
		$enddate = '',
		$NewsTypeID = '',
		$NewsSubTypeID = '',
		$ReporterID = '',
		$filter_vdo = '',
		$filter_sound = '',
		$filter_image = '',
		$filter_other = '',
		$checkDelete_News = ''
	)
	{
		$StrQuery = "
			SELECT DISTINCT
				NT01_News.NT01_NewsID
			FROM 
				NT01_News 
			LEFT JOIN 
				SC03_User ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
			LEFT JOIN 
				NT10_VDO ON NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID 
			LEFT JOIN 
				NT11_Picture ON NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID 
			LEFT JOIN 
				NT12_Voice ON NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID 
			LEFT JOIN 
				NT13_OtherFile ON NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID 
			WHERE 
				NT01_News.NT08_PubTypeID = '11'
		";
		if($News_Title != ''){
			$StrQuery .= "
				AND 
					NT01_News.NT01_NewsTitle LIKE '%".$News_Title."%' ESCAPE '!'
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
		if($checkDelete_News != ""){
			$StrQuery .= "
					AND 
						NT01_News.NT01_NewsID IN (".$checkDelete_News.")
			";
		}
		// echo $StrQuery;
		// exit;
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
		
		return $query;
	}
	
	public function get_NT01_News_search_count(
		$News_Title = '',
		$startdate = '',
		$enddate = '',
		$NewsTypeID = '',
		$NewsSubTypeID = '',
		$ReporterID = '',
		$checkDelete_News = '',
		$NT01_NewsID = ''
	)
	{
		$StrQuery = "
			SELECT DISTINCT
				COUNT(NT01_News.NT01_NewsID) AS NUMROW
			FROM 
				NT01_News
			LEFT JOIN 
				SC03_User ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID 
			WHERE 
				NT01_News.NT08_PubTypeID = '11'
		";
		
		if($NT01_NewsID != ""){
			$StrQuery .= "
				AND 
					NT01_News.NT01_NewsID IN (".$NT01_NewsID.")
			";
		}
		if($News_Title != ''){
			$StrQuery .= "
				AND 
					NT01_News.NT01_NewsTitle LIKE '%".$News_Title."%' ESCAPE '!'
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
		if($checkDelete_News != ""){
			$StrQuery .= "
					AND 
						NT01_News.NT01_NewsID IN (".$checkDelete_News.")
			";
		}
		
		// echo $StrQuery;
		// exit;
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		foreach($query as $val){
			return $val->NUMROW;
		}
	}
	
	
	//#########  Database New  ##########
	
	public function get_New_News($news = '')
	{
		// -- MAX(News.News_OldID) AS News_OldID,
		// -- MAX(News.News_Delete) AS News_Delete,
		// -- MAX(News.News_UpdateID) AS News_UpdateID,
		// -- MAX(News.News_Title) AS News_Title,
		// -- MAX(News.News_Resource) AS News_Resource,
		// -- MAX(News.News_Reference) AS News_Reference
		
		$statusArray = array();
		foreach($news as $val){
			$statusArray[] = "'".$val->NT01_NewsID."'";
		}
		$news = implode(",",$statusArray);
		
		$SQL_query_news = "
			SELECT 
				(News.News_OldID) AS News_OldID,
				(News.News_Delete) AS News_Delete,
				(News.News_UpdateID) AS News_UpdateID,
				(News.News_Title) AS News_Title,
				(News.News_Resource) AS News_Resource,
				(News.News_Reference) AS News_Reference,
				News.News_StatusPublic AS News_StatusPublic
			FROM 
				News
			LEFT JOIN
				Category
			ON
				News.Cate_ID = Category.Cate_ID
		";
		if($news != ""){
			$SQL_query_news .= "
				WHERE 
					News.News_OldID IN (".$news.")
			";
		}
		
		$query_news = $this->db->
			query($SQL_query_news)->result();
		return $query_news;
		
		// $query_news = $this->db->
			// join('Category', 'News.Cate_ID = Category.Cate_ID', 'left')->
			// get('News')->result();
		// return $query_news;
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
			   'News_Active' => "1",
			   'News_StatusPublic' => "1"
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
		$News_UpdateID = '',
		$News_StatusPublic = ''
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
			   'News_UpdateID' => $News_UpdateID_next,
			   'News_StatusPublic' => $News_StatusPublic
			);
			
			// var_dump($data);
			// exit;
			
			// $data = array(
			   // 'News_StatusPublic' => $News_StatusPublic
			// );
			
			return $this->db->where("News_OldID", $NT01_NewsID)->
				update("News", $data);
	}
	
	//##########################
	
	// $this->db->limit($limit, $start);
}