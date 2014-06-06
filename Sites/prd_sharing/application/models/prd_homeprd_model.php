<?php
class PRD_HomePRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
		
		
		
		// $this->db_ntt_pooh = $this->load->database('nnt_data_center_pooh', TRUE);
	}
	
	//##################### For Test P'Ooh Database #########################
	
	public function get_NT01_News()
	{
		//Test
		/*
		$serverName = "111.223.32.9";
		$connectionInfo = array( "Database"=>"NNT_DataCenter", "UID"=>"dbuser_km", "PWD"=>"123456");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		if( $conn ) {
			echo "Connection established.<br />";
			
			// $query = "SELECT TOP 1000 [field1]
			      // ,[field2]
			  // FROM [ringzero_ait_prd_sharing].[dbo].[test]";
			// $stmt = sqlsrv_query($conn, $query);
			// // print_r($stmt);
			// while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			      // echo $row['field1'].", ".$row['field2']."<br />";
			// }
		}else{
			echo "Connection could not be established.<br />";
			echo "<pre>";
			print_r(sqlsrv_errors());
			echo "</pre>";
		}
		*/
		//####################################
		
		
		
		// return $this->db->get('News')->result();
		$query = $this->db_ntt_old->
			Limit(20, 0)->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus,
				NT11_Picture.NT11_FileStatus,
				NT12_Voice.NT12_FileStatus,
				NT13_OtherFile.NT13_FileStatus
			')->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID', 'left')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID', 'left')->
			join('NT11_Picture', 'NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID', 'left')->
			join('NT12_Voice', 'NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID', 'left')->
			join('NT13_OtherFile', 'NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID', 'left')->
			where('NT08_PubTypeID', '11')->
			get('NT01_News');
			
		// var_dump($query->num_rows());
		
		// var_dump($query);
		
		// var_dump($query->result());
		
		return $query->result();
	}
	
	public function get_New_News()
	{
		$query_news = $this->db->
			join('Category', 'News.Cate_ID = Category.Cate_ID', 'left')->
			get('News')->result();
		return $query_news;
	}
	
	//##################### search ###################
	
	public function get_NT01_News_search_title($news_title)
	{
		// echo "search title";
		
		return $this->db_ntt_old->
			Limit(20, 0)->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus,
				NT11_Picture.NT11_FileStatus,
				NT12_Voice.NT12_FileStatus,
				NT13_OtherFile.NT13_FileStatus
			')->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			join('NT11_Picture', 'NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID', 'left')->
			join('NT12_Voice', 'NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID', 'left')->
			join('NT13_OtherFile', 'NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID', 'left')->
			where('NT08_PubTypeID', '11')->
			like('NT01_News.NT01_NewsTitle', $news_title)->
			get('NT01_News')->result();
	}
	public function get_NT01_News_search_title_start($news_title, $start)
	{
		/*
		return $this->db_ntt_old->
			Limit(20, 0)->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate, 
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus,
				NT11_Picture.NT11_FileStatus,
				NT12_Voice.NT12_FileStatus,
				NT13_OtherFile.NT13_FileStatus
			')->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			join('NT11_Picture', 'NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID', 'left')->
			join('NT12_Voice', 'NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID', 'left')->
			join('NT13_OtherFile', 'NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID', 'left')->
			where('NT08_PubTypeID', '11')->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			get('NT01_News')->result();
		*/
		
		$StrQuery = "
			SELECT 
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate, 
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus,
				NT11_Picture.NT11_FileStatus,
				NT12_Voice.NT12_FileStatus,
				NT13_OtherFile.NT13_FileStatus
			FROM NT01_News 
			LEFT JOIN SC03_User
				ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID
			LEFT JOIN NT10_VDO
				ON NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID
			LEFT JOIN NT11_Picture
				ON NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID
			LEFT JOIN NT12_Voice
				ON NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID
			LEFT JOIN NT13_OtherFile
				ON NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID
			WHERE 
				NT08_PubTypeID = '11'
			AND
				NT01_NewsTitle LIKE '%".$news_title."%' ESCAPE '!'
			AND
				NT01_NewsDate > Convert(datetime, '".$start."')
		";
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		return $query;
	}
	public function get_NT01_News_search_title_start_end($news_title, $start, $end)
	{
		/*
		return $this->db_ntt_old->
			Limit(20, 0)->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			where("News_Date <=", $end)->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate, 
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus,
				NT11_Picture.NT11_FileStatus,
				NT12_Voice.NT12_FileStatus,
				NT13_OtherFile.NT13_FileStatus
			')->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			join('NT11_Picture', 'NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID', 'left')->
			join('NT12_Voice', 'NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID', 'left')->
			join('NT13_OtherFile', 'NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID', 'left')->
			where('NT08_PubTypeID', '11')->
			get('NT01_News')->result();
		*/
		
		$StrQuery = "
			SELECT 
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate, 
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus,
				NT11_Picture.NT11_FileStatus,
				NT12_Voice.NT12_FileStatus,
				NT13_OtherFile.NT13_FileStatus
			FROM NT01_News 
			LEFT JOIN SC03_User
				ON SC03_User.SC03_UserId = NT01_News.NT01_ReporterID
			LEFT JOIN NT10_VDO
				ON NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID
			LEFT JOIN NT11_Picture
				ON NT01_News.NT01_NewsID = NT11_Picture.NT01_NewsID
			LEFT JOIN NT12_Voice
				ON NT01_News.NT01_NewsID = NT12_Voice.NT01_NewsID
			LEFT JOIN NT13_OtherFile
				ON NT01_News.NT01_NewsID = NT13_OtherFile.NT01_NewsID
			WHERE 
				NT08_PubTypeID = '11'
			AND
				NT01_NewsTitle LIKE '%".$news_title."%' ESCAPE '!'
			AND
				NT01_NewsDate 
					BETWEEN 
						Convert(datetime, '".$start."') 
						AND
						Convert(datetime, '".$end."')
		";
		
		// like('News_Title', $news_title)->
		// where("News_Date >=", $start)->
		// where("News_Date <=", $end)->
		
		$query = $this->db_ntt_old->
			query($StrQuery)->result();
			
		return $query;
		
	}
	
	
	//##################### Old Database --- Set #########################
	
	
	public function set_News(
		$news='' /*,
		$NT10_VDO='',
		$NT11_Picture='',
		$NT12_Voice='',
		$NT13_OtherFile=''
		*/
	)
	{
		//Test insert 1 record
		// $data = array(
			   // 'News_OldID' => "99",
			   // 'News_Date' => date('Y-m-d h:m:s')
		// );
		
		//########
		
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
						
			if(!($query2->num_rows() > 0)){
				$this->db->insert("News", $data);
			}
			
	    }
	}
	
	//################## New Database #######################
	
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
	
	public function get_testdb2()
	{
		return $this->db_ntt_old->get('SC03_User')->result();
	}
	
	// $this->db->limit($limit, $start);
}