<div id="manage-user" class="table-list">
	<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
	<form action="manageUser" method="post">
<?php
		foreach ($get_SC03_User as $get_SC03_User_item) {
			
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
					<input type="radio" name="sex" id="sex_male" value="0" <?php
						if($get_SC03_User_item->SC03_Gender == "นาย"){
							?>checked="checked"<?php
						}
					?> />
					<label for="sex_male" class="txt-radio">ผู้ชาย</label>
					<input type="radio" name="sex" id="sex_female" value="1" <?php
						if($get_SC03_User_item->SC03_Gender == "นาย"){
							?>checked="checked"<?php
						}
					?> />
					<label for="sex_female" class="txt-radio">ผู้หญิง</label>
<?php
					
?>
				</div>
			</div>
			<div class="row">
				<div class="col-left">
					<label class="label">คำนำหน้า</label>
				</div>
				<div class="col-right">
					<input type="radio" name="prefix" value="0" id="tname_male" <?php
						if($get_SC03_User_item->SC03_Gender == "นาย"){
							?>checked="checked"<?php
						}
					?> />
					<label for="tname_male" class="txt-radio">นาย</label>
					
					<input type="radio" name="prefix" value="1" id="tname_female" <?php
						if($get_SC03_User_item->SC03_Gender == "นาง"){
							?>checked="checked"<?php
						}
					?> />
					<label for="tname_female" class="txt-radio">นาง</label>
					
					<input type="radio" name="prefix" value="2" id="tname_girl" <?php
						if($get_SC03_User_item->SC03_Gender == "นางสาว"){
							?>checked="checked"<?php
						}
					?> />
					<label for="tname_girl" class="txt-radio">นางสาว</label>
					
					<input type="radio" name="prefix" value="3" id="tname_other" <?php
						if(
							$get_SC03_User_item->SC03_Gender != "นาย" &&
							$get_SC03_User_item->SC03_Gender != "นาง" &&
							$get_SC03_User_item->SC03_Gender != "นางสาว"
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
					<input type="text" class="form-control" id="InputKeyword" placeholder="" value="<?php echo $get_SC03_User_item->SC03_FName;?>" />
				</div>
				<div class="col-lg-6">
					<label class="label">นามสกุล (ไทย)</label>
					<input type="text" class="form-control" id="InputKeyword" placeholder="" value="<?php echo $get_SC03_User_item->SC03_LName;?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >ชื่อ (อังกฤษ)</label>
					<input type="text" class="form-control" id="InputKeyword" placeholder="" value="<?php echo $get_SC03_User_item->SC03_EngFName;?>" />
				</div>
				<div class="col-lg-6">
					<label >นามสกุล (อังกฤษ)</label>
					<input type="text" class="form-control" id="InputKeyword" placeholder="" value="<?php echo $get_SC03_User_item->SC03_EngLName;?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >Username</label>
					<input type="text" class="form-control" id="InputKeyword" placeholder="" value="<?php echo $get_SC03_User_item->SC03_UserName;?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >Password</label>
					<input type="text" class="form-control" id="InputKeyword" placeholder="" value="<?php //echo $get_SC03_User_item->SC03_Password;?>" />
				</div>
				<div class="col-lg-6">
					<label >Confirm Password</label>
					<input type="text" class="form-control" id="InputKeyword" placeholder="" >
				</div>
			</div>
		
			<div class="row">
				<div class="col-lg-6">
					<label >รหัสบัตรประชาชน</label>
					<input type="text" class="form-control" id="InputKeyword" placeholder="" >
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >กระทรวง</label>
					<select name="">
						<option value="">เลือกประเภทตำแหน่ง</option>
					</select>
				</div>
				<div class="col-lg-6">
					<label >กรม</label>
					<select name="">
						<option value="">เลือกตำแหน่ง</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >จังหวัด</label>
					<select name="">
						<option value="">เลือกจังหวัด</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >อำเภอ</label>
					<select name="">
						<option value="">เลือกอำเภอ</option>
					</select>
				</div>
				<div class="col-lg-6">
					<label >ตำบล</label>
					<select name="">
						<option value="">เลือกตำบล</option>
					</select>
				</div>
			</div>
		
			<div class="row">
				<div class="col-lg-6">
					<label >ที่อยู่</label>
					<textarea rows="4" cols="50" class="txt-area"></textarea>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<label class="label">Email</label>
						<input type="text" class="form-control" id="InputKeyword" placeholder="" >
					</div>
					<div class="row">
						<label class="label">รหัสไปรษณีย์</label>
						<input type="text" class="form-control" id="InputKeyword" placeholder="" >
					</div>
					<div class="row">
						<label class="label">ชื่อผู้ติดต่อ</label>
						<input type="text" class="form-control" id="InputKeyword" placeholder="" >
					</div>
					<div class="row">
						<label class="label">เบอร์ที่ทำงาน</label>
						<input type="text" class="form-control" id="InputKeyword" placeholder="" >
					</div>
					<div class="row">
						<label class="label">เบอร์มือถือ</label>
						<input type="text" class="form-control" id="InputKeyword" placeholder="" >
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >ระดับผู้ใช้งาน</label>
					<select name="">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >สถานะการใช้งาน</label>
					<select name="">
						<option value=""></option>
					</select>
				</div>
			</div>
		
			<div class="col-lg-12" style="text-align: center;    float: left;">
				<input class="bt" type="submit" name="share" value="บันทึก">
				<input class="bt" type="submit" name="share" value="ยกเลิก">
			</div>
<?php
		}
?>
	</form>
</div><!-- #manage-user -->