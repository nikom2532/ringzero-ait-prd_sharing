<script src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script>
<script>
    $(function(){
        $(".select-menu > select > option:eq(0)").attr("selected","selected");
        $(".select-menu > select").live("change",function(){
            var selectmenu_txt = $(this).find("option:selected").text();
            $(this).prev("span").text(selectmenu_txt);
        });
        
    });
</script>
<div id="search-form">
	<form action="<?php echo base_url().index_page(); ?>manageUser" method="post">
		<input type="hidden" name="manage_user_is_search" value="yes" />
		<div class="row">
			<div class="col-lg-12">
				<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
				<input class="txt-field" type="text" value="" name="search_key" value="<?php
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
				<select style="" name="mem_status">
					<option value="">เลือกสถานะ</option>
					<option value="1" <?php
						if(isset($post_search_key)){
							if($post_search_key == "1"){
								?>selected='selected'<?php
							}
						}
					?>>ใช้งาน</option>
					<option value="0" <?php
						if(isset($post_search_key)){
							if($post_search_key == "0"){
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
				<select name="province_id" style="">
					<option value="">เลือกจังหวัด</option>
<?php				
					foreach ($CM06_Province as $CM06_Province_item) {
						?><option value="<?php echo $CM06_Province_item->CM06_ProvinceID; ?>"><?php echo $CM06_Province_item->CM06_ProvinceName; ?></option><?php
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
			<p class="col-2" style="width: 10%;float: left; ">
				Username
			</p>
			<p class="col-3" style="width: 20%;float: left; ">
				ชื่อ-นามสกุล
			</p>
			<p class="col-4" style="width: 10%;float: left; ">
				วันที่สมัคร
			</p>
			<p class="col-5" style="width: 30%;float: left; ">
				หน่วยงาน
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
		
		foreach ($SC03_User as $SC03_User_item) {
			
			if($i % 2 == 1){
				?><div class="odd"><?php
			}
			else{
				?><div class="event"><?php
			}
?>
					<a href="<?php echo base_url().index_page(); ?>userInfo_PRD?userid=<?php echo $SC03_User_item->SC03_UserId; ?>">
						<p class="col-1" style="width: 5%;float: left; ">
							<?php echo $i; ?>
						</p>
						<p class="col-2" style="width: 10%;float: left; ">
							<?php echo $SC03_User_item->SC03_UserName; ?>
						</p>
						<p class="col-3" style="width: 20%;float: left; ">
							<?php echo $SC03_User_item->SC03_FName." ".$SC03_User_item->SC03_LName; ?>
						</p>
						<p class="col-4" style="width: 10%;float: left; text-align: center;">
<?php 
							if(isset($SC03_User_item->SC03_RegisterDate)){
								echo $SC03_User_item->SC03_RegisterDate; 
							}
							else{
								echo "-";
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
							
							/*
							if($SC03_User_item->SC03_Status == "1"){
								echo "เปิดการใช้งาน";
							}
							elseif($SC03_User_item->SC03_Status == "0"){
								echo "ปิดการใช้งาน";
							}
							*/
?>
						</p>
					</a>
				</div>
<?php
			$i++;
		}
?>
		<div class="footer-table">
			<p style="width: 70%;float: left;margin-top: 20px;">
				ทั้งหมด: 73 รายการ (4หน้า)
			</p>
			<p style="width: 30%;float: left;margin-top: 20px;text-align: right;">
				<img src="<?php echo base_url(); ?>images/table/pev.png" style="margin: -5px 10px 0;">
				<span style="margin-top: 10px;">
					<select style="">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select> / 100</span>
				<img src="<?php echo base_url(); ?>images/table/next.png" style="margin: -5px 10px 0;">
				<img src="<?php echo base_url(); ?>images/table/end.png" style="margin: -5px 10px 0;">
			</p>
		</div>
	</div>
</div>