<div id="search-form">
	<form action="manageUser" method="post">
		<input type="hidden" name="manage_user_is_search" value="yes" />
		<div class="row">
			<div class="col-lg-12">
				<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
				<input class="txt-field" type="text" value="" name="search_key"  placeholder="" style=" margin-left: 15px;width: 77%;">
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-6">
				<label >สถานะ</label>
				<select style="" name="sc03_status">
					<option value="T">ใช้งาน</option>
					<option value="F">ไม่ใช้งาน</option>
				</select>
			</div>
			<div class="col-lg-6">
				<label >จังหวัด</label>
				<select name="cm06_province_id" style="">
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
		<a href="userInfo">
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 10%;text-align:center;float: left;">
			MANAGER USER
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
					<a href="userInfo?userid=<?php echo $SC03_User_item->SC03_UserId; ?>">
						<p class="col-1" style="width: 5%;float: left; ">
							<?php echo $i; ?>
						</p>
						<p class="col-2" style="width: 10%;float: left; ">
							<?php echo $SC03_User_item->SC03_UserName; ?>
						</p>
						<p class="col-3" style="width: 20%;float: left; ">
							<?php echo $SC03_User_item->SC03_FName.$SC03_User_item->SC03_LName; ?>
						</p>
						<p class="col-4" style="width: 10%;float: left; ">
							-
						</p>
						<p class="col-5" style="width: 30%;float: left; ">
							<?php echo $SC03_User_item->SC07_DepartmentName; ?>
						</p>
						<p class="col-6" style="width: 15%;float: left; ">
<?php
							// foreach ($CM06_Province as $CM06_Province_item) {
								// if($CM06_Province_item->CM06_ProvinceID == $SC03_User_item->CM06_ProvinceID){
									// echo $CM06_Province_item->CM06_ProvinceName;
								// }
							// }
							echo $SC03_User_item->CM06_ProvinceName; 
?>
						</p>
						<p class="col-7" style="width: 10%;float: left; ">
<?php 
							// foreach ($Member as $Member_item) {
								// if($Member_item->)
							// }
							if($SC03_User_item->SC03_Status == "T"){
								echo "เปิดการใช้งาน";
							}
							elseif($SC03_User_item->SC03_Status == "F"){
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
				<img src="images/table/pev.png" style="margin: -5px 10px 0;">
				<span style="margin-top: 10px;">
					<select style="">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select> / 100</span>
				<img src="images/table/next.png" style="margin: -5px 10px 0;">
				<img src="images/table/end.png" style="margin: -5px 10px 0;">
			</p>
		</div>
	</div>
</div>