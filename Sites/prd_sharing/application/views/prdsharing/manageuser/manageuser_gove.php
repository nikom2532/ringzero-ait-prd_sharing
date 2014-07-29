<!-- <script src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script> -->
<div id="search-form">
	<form id="homeSearch" action="<?php echo base_url().index_page(); ?>manageUserGOVE" method="post">
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
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 20%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
			MANAGER USER PRD
		</p></a>
		
		<a href="<?php echo base_url().index_page(); ?>manageUserGOVE">
		<p style="margin-left:3% ;border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 20%;text-align:center;float: left;">
			MANAGER USER Government
		</p></a>

	</div>
	<div class="row">
		<div class="header-table" style="text-align: right;">
			<p class="col-1" style="width: 5%;float: left; "></p>
			<p class="col-2" style="width: 10%;float: left; ">
				Username
			</p>
			<p class="col-3" style="width: 20%;float: left; ">
				ชื่อ-นามสกุล
			</p>
			<p class="col-4" style="width: 10%;float: left; ">
				วันที่สมัคร
			</p>
			<p class="col-5" style="width: 15%;float: left; ">
				กระทรวง
			</p>
			<p class="col-5" style="width: 15%;float: left; ">
				กรม
			</p>
			<p class="col-6" style="width: 15%;float: left; ">
				จังหวัด
			</p>
			<p class="col-7" style="width: 10%;float: left; ">
				สถานะการใช้งาน
			</p>
		</div>
<?php
		$i=1;
		
		// var_dump($SC03_User);
		
		foreach ($Member as $Member_item) {
			
			if($i % 2 == 1){
				?><div class="odd"><?php
			}
			else{
				?><div class="event"><?php
			}
?>
					<a href="<?php echo base_url().index_page(); ?>userInfo_GOVE?userid=<?php echo $Member_item->Mem_ID; ?>">
						<p class="col-1" style="width: 5%;float: left; text-align: center; ">
							<?php echo $i; ?>
						</p>
						<p class="col-2" style="width: 10%;float: left; text-align: center; ">
							<?php echo $Member_item->Mem_Username; ?>
						</p>
						<p class="col-3" style="width: 20%;float: left; text-align: center; ">
							<?php echo $Member_item->Mem_Name." ".$Member_item->Mem_LasName; ?>
						</p>
						<p class="col-4" style="width: 10%;float: left; text-align: center; ">
<?php
							if($Member_item->Mem_CreateDate != null){
								echo $Member_item->Mem_CreateDate;
							}
							else{
								echo "-";
							}
?>
						</p>
						<p class="col-5" style="width: 15%;float: left; text-align: center; ">
<?php
							$count=0;
							foreach ($Ministry as $Ministry_item) {
								if($Ministry_item->Minis_ID == $Member_item->Mem_Ministry){
									echo $Ministry_item->Minis_Name;
									$count++;
								}
							}
							if($count==0){
								echo "-";
							}
?>
						</p>
						
						<p class="col-5" style="width: 15%;float: left; text-align: center; ">
<?php
							$count=0;
							foreach ($Department as $Department_item) {
								if($Department_item->Dep_ID == $Member_item->Mem_Department){
									echo $Department_item->Dep_Name;
									$count++;
								}
							}
							if($count==0){
								echo "-";
							}
?>
						</p>
						
						<p class="col-6" style="width: 15%;float: left; text-align: center; ">
<?php
							// var_dump($Member_item);
							$count=0;
							foreach ($CM06_Province as $CM06_Province_item) {
								if($CM06_Province_item->CM06_ProvinceID == $Member_item->Prov_ID){
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
						<p class="col-7" style="width: 10%;float: left; text-align: center; ">
<?php 
							// foreach ($Member as $Member_item) {
								// if($Member_item->)
							// }
							if($Member_item->Mem_Status == "1"){
								echo "ใช้งาน";
							}
							elseif($Member_item->Mem_Status == "0"){
								echo "รออนุมัติ";
							}
							elseif($Member_item->Mem_Status == "-1"){
								echo "ปิดการใช้งาน";
							}
?>
						</p>
					</a>
				</div>
<?php
			$i++;
		}
		if($i == 1){
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
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageUserGOVE"; ?>/"+nextpage);
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
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageUserGOVE"; ?>/"+val);
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
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageUserGOVE"; ?>/"+prevpage);
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
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageUserGOVE"; ?>/1");
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