<div id="manage-user" class="table-list">
	<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
	<form action="<?php echo base_url().index_page(); ?>manageUser" method="post">
		<input type="hidden" name="update_member" value="yes" />
		<input type="hidden" name="member_id" value="<?php echo $Mem_ID; ?>" />
<?php
		foreach ($SC03_User as $SC03_User_item) {
			
?>
			<div class="row">
				<div class="row" id="gove-title">
					User Information
				</div>
			</div>
			<div class="row">
				<div class="col-left">
					<label class="label">เพศ</label>
				</div>
				<div class="col-right">
<?php
					
?>
					<input type="radio" name="sex" id="sex_male" value="M" <?php
						if($SC03_User_item->SC03_Gender == "M"){
							?>checked="checked"<?php
						}
					?> />
					<label for="sex_male" class="txt-radio">ผู้ชาย</label>
					<input type="radio" name="sex" id="sex_female" value="F" <?php
						if($SC03_User_item->SC03_Gender == "F"){
							?>checked="checked"<?php
						}
					?> />
					<label for="sex_female" class="txt-radio">ผู้หญิง</label>

				</div>
			</div>
			<div class="row">
				<div class="col-left">
					<label class="label">คำนำหน้า</label>
				</div>
				<div class="col-right">
					<input type="radio" name="mem_title" value="0" id="tname_male" <?php
						if($SC03_User_item->SC03_TName == "นาย"){
							?>checked="checked"<?php
						}
					?> />
					<label for="tname_male" class="txt-radio">นาย</label>
					
					<input type="radio" name="mem_title" value="1" id="tname_female" <?php
						if($SC03_User_item->SC03_TName == "นาง"){
							?>checked="checked"<?php
						}
					?> />
					<label for="tname_female" class="txt-radio">นาง</label>
					
					<input type="radio" name="mem_title" value="2" id="tname_girl" <?php
						if($SC03_User_item->SC03_TName == "นางสาว"){
							?>checked="checked"<?php
						}
					?> />
					<label for="tname_girl" class="txt-radio">นางสาว</label>
					
					<input type="radio" name="prefix" value="3" id="tname_other" <?php
						if(
							$SC03_User_item->SC03_TName != "นาย" &&
							$SC03_User_item->SC03_TName != "นาง" &&
							$SC03_User_item->SC03_TName != "นางสาว"
						){
							?>checked="checked"<?php
						}
					?> />
					<label for="tname_other" class="txt-radio">อื่นๆ</label>
					
					<input type="text" class="form-control" name="tname_other_text" id="tname_other_text" placeholder="" />
					
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label class="label">ชื่อ (ไทย)</label>
					<input type="text" class="form-control" name="fname" id="fname" placeholder="" value="<?php echo $SC03_User_item->SC03_FName;?>" />
				</div>
				<div class="col-lg-6">
					<label class="label">นามสกุล (ไทย)</label>
					<input type="text" class="form-control" name="lname" id="lname" placeholder="" value="<?php echo $SC03_User_item->SC03_LName;?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >ชื่อ (อังกฤษ)</label>
					<input type="text" class="form-control" name="engfname" id="engfname" placeholder="" value="<?php echo $SC03_User_item->SC03_EngFName;?>" />
				</div>
				<div class="col-lg-6">
					<label >นามสกุล (อังกฤษ)</label>
					<input type="text" class="form-control" name="englname" id="englname" placeholder="" value="<?php echo $SC03_User_item->SC03_EngLName;?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >Username</label>
					<input type="text" class="form-control" name="mem_username" id="mem_username" placeholder="" value="<?php echo $SC03_User_item->SC03_UserName;?>" />
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-lg-6">
					<label >Password</label>
					<input type="text" class="form-control" name="mem_password1" id="mem_password1" placeholder="" value="<?php //echo $SC03_User_item->SC03_Password;?>" />
				</div>
				<div class="col-lg-6">
					<label >Confirm Password</label>
					<input type="text" class="form-control" name="mem_password2" id="mem_password2" placeholder="" >
				</div>
			</div> -->
			<div class="row">
				<div class="col-lg-6">
					<label >รหัสบัตรประชาชน</label>
					<input type="text" class="form-control" name="mem_card_id" id="Mem_CardID" placeholder="" value="<?php echo $SC03_User_item->SC03_IDCard;?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >กระทรวง</label>
					<select name="mem_ministry">
						<option value="">เลือกประเภทตำแหน่ง</option>
<?php
						foreach ($Ministry as $Ministry_item) {
							?><option value="<?php echo $Ministry_item->Minis_ID;?>"><?php echo $Ministry_item->Minis_Name;?></option><?php
						}
?>
					</select>
				</div>
				<div class="col-lg-6">
					<label >กรม</label>
					<select name="mem_department">
						<option value="">เลือกตำแหน่ง</option>
<?php
						foreach ($Department as $Department_item) {
							?><option value="<?php echo $Department_item->Dep_ID;?>"><?php echo $Department_item->Dep_Name;?></option><?php
						}
?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >จังหวัด</label>
					<select name="mem_province">
						<option value="">เลือกจังหวัด</option>
<?php
						foreach ($CM06_Province as $Province) {
							if($Province->CM06_ProvinceID == $SC03_User_item->CM06_ProvinceId){
								?><option value="<?php echo $Province->CM06_ProvinceID;?>" selected='selected'><?php echo $Province->CM06_ProvinceName;?></option><?php
							}
						}
?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >อำเภอ</label>
					<select name="mem_ampur">
						<option value="">เลือกอำเภอ</option>
<?php
						foreach ($CM07_Ampur as $Ampur) {
							if($Ampur->CM06_ProvinceID == $SC03_User_item->CM06_ProvinceId){
								if($Ampur->CM07_AmpurID == $SC03_User_item->CM07_AmpurId){
									?><option value="<?php echo $Ampur->CM07_AmpurID;?>" selected='selected'><?php echo $Ampur->CM07_AmpurName;?></option><?php
								
								}
							}
						}
?>
					</select>
				</div>
				<div class="col-lg-6">
					<label >ตำบล</label>
					<select name="mem_tumbon">
						<option value="">เลือกตำบล</option>
<?php
						foreach ($CM08_Tumbon as $Tumbon) {
							if($Tumbon->CM07_AmpurID == $SC03_User_item->CM07_AmpurID){
								if($Tumbon->CM08_TumbonID == $SC03_User_item->CM08_TumbonId){
									?><option value="<?php echo $Tumbon->CM08_TumbonID;?>" selected='selected'><?php echo $Tumbon->CM08_TumbonName;?></option><?php
								}
							}
						}
?>
					</select>
				</div>
			</div>
<?php
			//*
?>
			<div class="row">
				<div class="col-lg-6">
					<label >ที่อยู่</label>
					<textarea rows="4" cols="50" class="txt-area" name="mem_address"><?php echo $SC03_User_item->SC03_Address; ?></textarea>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<label class="label">Email</label>
						<input type="text" class="form-control" name="mem_email" id="Mem_Email" placeholder="" value="<?php echo $SC03_User_item->SC03_Email; ?>" />
					</div>
					<div class="row">
						<label class="label">รหัสไปรษณีย์</label>
						<input type="text" class="form-control" name="mem_postcode" id="Mem_Postcode" placeholder="" value="<?php // echo $SC03_User_item->; ?>" />
					</div>
					<div class="row">
						<label class="label">ชื่อผู้ติดต่อ</label>
						<input type="text" class="form-control" name="mem_nickname" id="Mem_NickName" placeholder="" value="<?php // echo $SC03_User_item->SC03_Email; ?>" />
					</div>
					<div class="row">
						<label class="label">เบอร์ที่ทำงาน</label>
						<input type="text" class="form-control" name="mem_tel" id="Mem_Tel" placeholder="" value="<?php echo $SC03_User_item->SC03_Tel; ?>" />
					</div>
					<div class="row">
						<label class="label">เบอร์มือถือ</label>
						<input type="text" class="form-control" name="mem_moble" id="Mem_Moble" placeholder="" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >ระดับผู้ใช้งาน</label>
					<select name="group_member">
						<option value="-1">เลือกระดับผู้ใช้งาน</option>
<?php
						foreach ($GroupMember as $GroupMember_item) {
							?><option value="<?php echo $GroupMember_item->Group_ID;?>"><?php echo $GroupMember_item->Group_Desc;?></option><?php
						}
?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >สถานะการใช้งาน</label>
					<select name="mem_status">
						<option value="1">เปิดการใช้งาน</option>
						<option value="0">ปิดการใช้งาน</option>
					</select>
				</div>
			</div>
<?php
			//*/
?>
			<div class="col-lg-12" style="text-align: center;    float: left;">
				<input class="bt" type="submit" name="share" value="บันทึก">
				<input class="bt" type="submit" name="share" value="ยกเลิก">
			</div>
<?php
		}
?>
	</form>
</div><!-- #manage-user -->