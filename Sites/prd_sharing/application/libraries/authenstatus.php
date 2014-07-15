<?php 
class AuthenStatus{
	
	var $showStatus = "";
	var $Group_ID = "";
	var $page_title = "";
	
	public function checkGroupID(
		$Group_ID = '', 
		$page_title = ''
	)
	{
		if($this->Group_ID == 1){
			
			if(
				$this->page_title == "Home" || 
				$this->page_title == "Sent News" ||
				$this->page_title == "RSS Feed" ||
				$this->page_title == "Manage News"
			){
					$this->showStatus = "yes";
			}
			else{
					$this->showStatus = "no";
			}
			
		}
		elseif($this->Group_ID == 2){
			$this->showStatus = "yes";
		}
		
		elseif($this->Group_ID == 3){
			if(
				$this->page_title == "Home" || 
				$this->page_title == "RSS Feed"
			){
					$this->showStatus = "yes";
			}
			else{
					$this->showStatus = "no";
			}
		}
		return $this->showStatus;
	}
	
	public function getMenuHeader()
	{
		if($this->Group_ID == 1){
			$menu = array(
				"Group_ID" => 1,
				"Home" => "yes",
				"Sent News" => "yes",
				"RSS Feed" => "yes",
				"Manage News" => "yes",
				"Manage Users" => "no",
				"Manage Info" => "no",
				"Report" => "no",
				"_Tab_less" => 3
			);
		}
		elseif($this->Group_ID == 2){
			$menu = array(
				"Group_ID" => 2,
				"Home" => "yes",
				"Sent News" => "yes",
				"RSS Feed" => "yes",
				"Manage News" => "yes",
				"Manage Users" => "yes",
				"Manage Info" => "yes",
				"Report" => "yes",
				"_Tab_less" => 0
			);
		}
		elseif($this->Group_ID == 3){
			$menu = array(
				"Group_ID" => 3,
				"Home" => "yes",
				"Sent News" => "no",
				"RSS Feed" => "yes",
				"Manage News" => "no",
				"Manage Users" => "no",
				"Manage Info" => "no",
				"Report" => "no",
				"_Tab_less" => 5
			);
		}
		return $menu;
				// "Home"
				// "Sent News"
				// "RSS Feed"
				// "Manage News"
				// "Manage Users"
				// "Manage Info"
				// "Report"
	}
}

