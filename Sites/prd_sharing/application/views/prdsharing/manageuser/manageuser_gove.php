<div id="search-form">
	<form action="manageUser" method="post">
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
				<select style="" name="mem_status">
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
			</div>
			<div class="col-lg-6">
				<label >จังหวัด</label>
				<select name="province_id" style="">
<?php
					foreach ($CM06_Province as $CM06_Province_item) {
						?><option value="<?php echo $CM06_Province_item->CM06_ProvinceID; ?>"><?php echo $CM06_Province_item->CM06_ProvinceName; ?></option><?php
					}
?>
				</select>
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
		<a href="manageUserPRD">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 20%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
			MANAGER USER PRD
		</p></a>
		
		<a href="manageUserGOVE">
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
					<a href="userInfo_GOVE?userid=<?php echo $Member_item->Mem_ID; ?>">
						<p class="col-1" style="width: 5%;float: left; ">
							<?php echo $i; ?>
						</p>
						<p class="col-2" style="width: 10%;float: left; ">
							<?php echo $Member_item->Mem_Username; ?>
						</p>
						<p class="col-3" style="width: 20%;float: left; ">
							<?php echo $Member_item->Mem_Name." ".$Member_item->Mem_LasName; ?>
						</p>
						<p class="col-4" style="width: 10%;float: left; ">
<?php
							if($Member_item->Mem_CreateDate != null){
								echo $Member_item->Mem_CreateDate;
							}
							else{
								echo "-";
							}
?>
						</p>
						<p class="col-5" style="width: 15%;float: left; ">
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
						
						<p class="col-5" style="width: 15%;float: left; ">
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
						
						<p class="col-6" style="width: 15%;float: left; ">
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
						<p class="col-7" style="width: 10%;float: left; ">
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