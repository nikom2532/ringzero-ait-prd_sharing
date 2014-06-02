<?php
class PRD_HomePRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//##################### Old Database #########################
	
	public function get_NT01_News()
	{
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
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
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
			// join('Category', 'News.Cate_ID = Category.Cate_ID')->
			get('News')->result();
		return $query_news;
	}
	
	public function get_NT10_VDO()
	{
		return $this->db_ntt_old->
			get('NT10_VDO')->result();
	}
	public function get_NT11_Picture()
	{
		return $this->db_ntt_old->
			get('NT11_Picture')->result();
	}
	public function get_NT12_Voice()
	{
		return $this->db_ntt_old->
			get('NT12_Voice')->result();
	}
	public function get_NT13_OtherFile()
	{
		return $this->db_ntt_old->
			get('NT13_OtherFile')->result();
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
		return $this->db_ntt_old->
			Limit(20, 0)->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
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
	}
	public function get_NT01_News_search_title_start_end($news_title, $start, $end)
	{
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
			
			$data = array(
			   'News_OldID' => $news_item->NT01_NewsID,
			   'News_Date' => $newsDate,
			   'News_StatusPhoto' => $news_item->NT11_FileStatus,
			   'News_StatusVDO' => $news_item->NT10_FileStatus,
			   'News_StatusVoice' => $news_item->NT12_FileStatus,
			   'News_StatusOtherFile' => $news_item->NT13_FileStatus,
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