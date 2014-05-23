<?php
class PRD_HomePRD_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_ntt_old = $this->load->database('nnt_data_center_old', TRUE);
	}
	
	//##################### Old Database #########################
	
	public function get_NT01_News_rows($News_OldID)
	{
		$this->db_ntt_old->
			where('News_OldID', $News_OldID)->
			get('News')->rows();
	}
	
	public function get_NT01_News()
	{
		// return $this->db->get('News')->result();
		$query = $this->db_ntt_old->
			Limit(5, 0)->
			select('
				NT01_News.NT01_NewsID,
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus
			')->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			where('NT08_PubTypeID', '11')->
			get('NT01_News');
			
		// var_dump($query->num_rows());
		
		// var_dump($query);
		
		// if($query->num_rows() > 0) {
		    // $new_author = $query->result();
// 			
		    // foreach ($new_author as $author) {
					// $data = array(
					   // 'News_OldID' => $author['NT01_NewsID'],
					   // 'News_Date' => date('Y-m-d h:m:s')
					// );
// 					
					// $query2 = $this->db->
								// where('News_OldID', $data['News_OldID'])->
								// get('News');
// 					
					// // echo($query2->num_rows());
// 					
					// if($query2->num_rows() > 0){
						// // $query3 = $this->db->
							// // update("News", $data)->
							// // where('', '');
						// // echo  $query3 = $this->db;
// 						
// 						
						// // $query3 = "
							// // UPDATE News
							// // SET
								// // News_OldID = $data['News_OldID']
							// // WHERE some_column=some_value;
						// // ";
						// // $this->db->query($query3);
					// }
					// else{
						// $query3 = $this->db->insert("News", $data);
					// }
// 					
		    // }
		// }
		
		
		// var_dump($query->result());
		
		return $query->result();
	}
	
	
	public function get_NT01_News_search_title($news_title)
	{
		return $this->db_ntt_old->
			Limit(10, 0)->
			select('
				NT01_News.NT01_UpdDate,
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus'
			)->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			where('NT08_PubTypeID', '11')->
			like('NT01_News.NT01_NewsTitle', $news_title)->
			get('NT01_News')->result();
	}
	public function get_NT01_News_search_title_start($news_title, $start)
	{
		return $this->db_ntt_old->
			Limit(10, 0)->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			select('
				NT01_News.NT01_UpdDate, 
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus'
			)->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			where('NT08_PubTypeID', '11')->
			get('NT01_News')->result();
	}
	public function get_NT01_News_search_title_start_end($news_title, $start, $end)
	{
		return $this->db_ntt_old->
			Limit(10, 0)->
			like('News_Title', $news_title)->
			where("News_Date >=", $start)->
			where("News_Date <=", $end)->
			select('
				NT01_News.NT01_UpdDate, 
				NT01_News.NT01_CreDate,
				NT01_News.NT01_NewsTitle,
				NT01_News.NT01_ViewCount,
				SC03_User.SC03_FName, 
				NT10_VDO.NT10_FileStatus'
			)->
			join('SC03_User', 'SC03_User.SC03_UserId = NT01_News.NT01_ReporterID')->
			join('NT10_VDO', 'NT01_News.NT01_NewsID = NT10_VDO.NT01_NewsID')->
			where('NT08_PubTypeID', '11')->
			get('NT01_News')->result();
	}
	
	
	//##################### Old Database --- Set #########################
	
	
	public function set_News($news='')
	{
		//Test insert 1 record
		// $data = array(
			   // 'News_OldID' => "99",
			   // 'News_Date' => date('Y-m-d h:m:s')
		// );
		//########
		
		// var_dump($news);
		
		foreach ($news as $news_item) {
	    	
			$data = array(
			   'News_OldID' => $news_item->NT01_NewsID,
			   'News_Date' => date('Y-m-d h:m:s')
			);
			
			// var_dump($data);
			// echo $data["News_OldID"];
			
			$query2 = $this->db->
						where('News_OldID', $data['News_OldID'])->
						get('News');
						
			// var_dump($query2);
				
			echo($query2->num_rows());	
						
			if($query2->num_rows() > 0){
				
			}
			else{
				$this->db->insert("News", $data);
			}
			
	    }
		
	}
	
	//################## New Database #######################
	
	public function get_prd()
	{
		// return $this->db->get('News')->result();
		return $this->db->
			get('News')->result();
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
	
	public function get_testdb2()
	{
		return $this->db_ntt_old->get('SC03_User')->result();
	}
	
	// $this->db->limit($limit, $start);
}