<!-- <script src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script> -->
<div id="search-form">
	<form id="homeSearch" action="<?php echo base_url().index_page(); ?>manageUserPRD" method="post">
		<input type="hidden" name="manage_user_is_search" value="yes" />
		<div class="row">
			<div class="col-lg-12">
				<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
				<input class="txt-field" type="text" name="search_key" value="<?php
					if(isset($post_search_key)){
						echo $post_search_key;
					}
				?>" placeholder="" style=" margin-left: 15px;width: 77%;">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >สถานะ</label>
				<span class="select-menu">
					<span>เลือกสถานะ</span>
					<select style="" name="mem_status" id="mem_status">
						<option value="">เลือกสถานะ</option>
						<option value="1" <?php
							if(isset($post_mem_status)){
								if($post_mem_status == "1"){
									?>selected='selected'<?php
								}
							}
						?>>ใช้งาน</option>
						<option value="0" <?php
							if(isset($post_mem_status)){
								if($post_mem_status == "0"){
									?>selected='selected'<?php
								}
							}
						?>>ไม่ใช้งาน</option>
					</select>
				</span>
			</div>
			<div class="col-lg-6">
				<label >จังหวัด</label>
				<span class="select-menu">
				<span>เลือกจังหวัด</span>
				<select name="province_id" id="province_id" style="">
					<option value="">เลือกจังหวัด</option>
<?php				
					foreach ($CM06_Province as $CM06_Province_item) {
						?><option value="<?php echo $CM06_Province_item->CM06_ProvinceID; ?>" <?php 
							if(isset($post_province_id)){
								if($CM06_Province_item->CM06_ProvinceID == $post_province_id){
									?>selected='selected'<?php
								}
							}
						?>><?php echo $CM06_Province_item->CM06_ProvinceName; ?></option><?php
					}
?>
				</select>
				</span>
			</div>
		</div>
	
		<div class="col-lg-12" style="text-align: center;">
			<input class="bt" type="submit" value="ค้นหา" name="share" style="width:18%;padding: 4px;">
		</div>
	</form>
</div>

<div class="table-list">
	<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
	<div class="row" style="margin-top: 20px;">
		<a href="<?php echo base_url().index_page(); ?>manageUserPRD">
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;">
			MANAGER USER PRD
		</p></a>
		
		<a href="<?php echo base_url().index_page(); ?>manageUserGOVE">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
			MANAGER USER GOVE
		</p></a>
	</div>
	<div class="row">
		<div class="header-table" style="text-align: right;">
			<p class="col-1" style="width: 5%;float: left; "></p>
			<p class="col-2" style="width: 10%;float: left; text-align: left; ">
				Username
			</p>
			<p class="col-3" style="width: 20%;float: left; text-align: left; ">
				ชื่อ-นามสกุล
			</p>
			<p class="col-4" style="width: 10%;float: left; text-align: left; ">
				วันที่สมัคร
			</p>
			<p class="col-5" style="width: 30%;float: left; text-align: left; ">
				หน่วยงาน
			</p>
			<p class="col-6" style="width: 15%;float: left; text-align: left; ">
				จังหวัด
			</p>
			<p class="col-7" style="width: 10%;float: left; text-align: left; ">
				สถานะการใช้งาน
			</p>
		</div>
<?php
		$i=0;
		
		// var_dump($SC03_User);
		
		foreach ($SC03_User as $SC03_User_item) {
			
			if($i % 2 == 0){
				?><div class="odd"><?php
			}
			else{
				?><div class="event"><?php
			}
?>
					<a href="<?php echo base_url().index_page(); ?>userInfo_PRD?userid=<?php echo $SC03_User_item->SC03_UserId; ?>">
						<p class="col-1" style="width: 5%;float: left; ">
							<?php echo $SC03_User_item->RowNumber; ?>
						</p>
						<p class="col-2" style="width: 10%;float: left; ">
							<?php echo $SC03_User_item->SC03_UserName; ?>
						</p>
						<p class="col-3" style="width: 20%;float: left; ">
							<?php echo $SC03_User_item->SC03_FName." ".$SC03_User_item->SC03_LName; ?>
						</p>
						<p class="col-4" style="width: 10%;float: left; text-align: left;">
<?php 
							if(isset($SC03_User_item->SC03_RegisterDate)){
								// echo $SC03_User_item->SC03_RegisterDate; 
								echo date("d/m/Y", strtotime($SC03_User_item->SC03_RegisterDate))."<br />";
								echo date("h:m:s", strtotime($SC03_User_item->SC03_RegisterDate));
							}
							else{
								echo "<span style='margin-left: 20%'>-</span>";
							}
?>
						</p>
						<p class="col-5" style="width: 30%;float: left; ">
<?php
							foreach ($SC07_Department as $SC07_Department_item) {
								
								if($SC03_User_item->SC07_DepartmentId == $SC07_Department_item->SC07_DepartmentId){
									echo $SC07_Department_item-> SC07_DepartmentName;
								}
								
							}
?>
						</p>
						<p class="col-6" style="width: 15%;float: left; ">
<?php
							// var_dump($Member_item);
							$count=0;
							foreach ($CM06_Province as $CM06_Province_item) {
								if($CM06_Province_item->CM06_ProvinceID == $SC03_User_item->CM06_ProvinceID){
									echo $CM06_Province_item->CM06_ProvinceName;
									$count++;
								}
							}
							if($count==0){
								echo "-";
							}
							// echo $Member_item->Prov_ID; 
?>
						</p>
						<p class="col-7" style="width: 10%;float: left; ">
<?php 
							/*
							$count=0;
							foreach ($Member as $Member_item) {
								if(
									$Member_item->Mem_OldID == $SC03_User_item->SC03_UserId &&
									$Member_item->Mem_Status == "1"
								){
									$count++;
									// echo "เปิดการใช้งาน";
								}
								else{
									// echo "ปิดการใช้งาน";
								}
							}
							if($count>0){
								echo "เปิดการใช้งาน";
							}
							else{
								echo "ปิดการใช้งาน";
							}
							*/
							///*
							if($SC03_User_item->Mem_Status == "1"){
								echo "เปิดการใช้งาน";
							}
							elseif($SC03_User_item->Mem_Status == "0"){
								echo "ปิดการใช้งาน";
							}
							//*/
?>
						</p>
					</a>
				</div>
<?php
			$i++;
		}
		if($i == 0){
?>
			<div class="news-form" style="color: red; text-align: center;">ไม่พบข้อมูล</div>
<?php
		}
?>
		<div class="footer-table">
			<p style="width: 70%;float: left;margin-top: 20px;">
				<span><?php echo "ทั้งหมด : ".$count_row." รายการ (".$total_page." หน้า )"; ?></span>
			</p>
            
			<p style="width: 30%;float: left;margin-top: 20px;text-align: right;">
            	<a href="javascript:firstPage()"><img src="<?php echo base_url(); ?>img/prew.png"></a><?php
            	if($current_page != 1){
            		?> <a href="javascript:prevPage('<?php echo $current_page; ?>')"><img src="<?php echo base_url(); ?>img/prev.png"></a><?php
				}
				?><span style="margin-top: 10px;">
					<!-- <span><?php //echo $current_page; ?></span> -->
					<select onchange="jump_page(this.value)">
<?php 
						// var_dump($page_url);
						foreach ($page_url as $item) {
							?><option value="<?php echo $item['value']; ?>" <?php echo $item['selected']; ?>><?php echo $item['value']; ?></option><?php
						}
?>
					</select> / <?php echo $total_page; ?>
              </span><?php
				if($current_page != $total_page) {
					?><a href="javascript:nextPage('<?php echo $current_page; ?>')"><img src="<?php echo base_url(); ?>img/next.png"></a><?php
				}
				?> <a href="javascript:lastPage('<?php echo $total_page; ?>')"><img src="<?php echo base_url(); ?>img/next2.png"></a>
            </p>
		</div>
	</div>
</div>
<script>
	function jump_page(val){
		location='<?php echo $jump_url; ?>/'+val;
	}
	function nextPage(val){
		var nextpage = parseInt(val)+1;
		if(<?php echo $total_page; ?>==val){
			nextpage = val;
		}
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageUserPRD"; ?>/"+nextpage);
<?php
		if($post_manage_user_is_search == ""){
?>
			$("#homeSearch input[name=manage_user_is_search]").val("");
<?php
		}
?>
		$("#homeSearch").submit();
	}
	function lastPage(val){
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageUserPRD"; ?>/"+val);
<?php
		if($post_manage_user_is_search == ""){
?>
			$("#homeSearch input[name=manage_user_is_search]").val("");
<?php
		}
?>
		$("#homeSearch").submit();
	}
	function prevPage(val){
		var prevpage = parseInt(val)-1;
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageUserPRD"; ?>/"+prevpage);
<?php
		if($post_manage_user_is_search == ""){
?>
			$("#homeSearch input[name=manage_user_is_search]").val("");
<?php
		}
?>
		$("#homeSearch").submit();
	}
	function firstPage(){
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageUserPRD"; ?>/1");
<?php
		if($post_manage_user_is_search == ""){
?>
			$("#homeSearch input[name=manage_user_is_search]").val("");
<?php
		}
?>
		$("#homeSearch").submit();
	}
	
    $(function(){
        // $(".select-menu > select > option:eq(0)").attr("selected","selected");
		var selectmenu_txt = $("#mem_status").find("option:selected").text();
			$("#mem_status").prev("span").text(selectmenu_txt);
			
        selectmenu_txt = $("#province_id").find("option:selected").text();
			$("#province_id").prev("span").text(selectmenu_txt);
			
        $(".select-menu > select").live("change",function(){
            var selectmenu_txt = $(this).find("option:selected").text();
            $(this).prev("span").text(selectmenu_txt);
        });
    });
</script>