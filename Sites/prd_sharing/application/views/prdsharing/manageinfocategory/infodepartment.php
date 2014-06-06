<div class="content">
	<div id="share-form">
		<form name="info_depatment_form" action="manageInfo_Department" method="post">
<?php
			foreach ($department as $department_item) {
				
?>
				<input type="hidden" name="info_department_is_submit" value="yes" />
				<input type="hidden" name="dep_id" value="<?php echo $department_item->Dep_ID; ?>" />
				<div class="row" id="gove-title" style="margin-top:5%;">
					รายละเอียดข้อมูล
				</div>
		
				<div id="manage-info">
					<div id="search-form">
						<div class="row">
							<div class="col-lg-12">
								<label >ลำดับที่:</label>
								<span class="number"><?php echo $department_item->Dep_ID; ?></span>
							</div>
							<div class="col-lg-12">
								<label >ชื่อกระทรวง:</label>
								<select class="select-opt" name="ministry_id">
<?php
									foreach ($ministry as $ministry_item) {
										?><option value="<?php echo $ministry_item->Minis_ID ?>" <?php
											
											if($ministry_item->Minis_ID == $department_item->Ministry_ID){
												?>selected='selected'<?php
											}
											
										?>><?php echo $ministry_item->Minis_Name; ?></option><?php
									}
?>
								</select>
							</div>
							<div class="col-lg-12">
								<label >ชื่อกรม:</label>
								<input type="text" class="form-control txt-field" name="dep_name" id="dep_name" value="<?php echo $department_item->Dep_Name; ?>" placeholder="" >
							</div>
							<div class="col-lg-12">
								<label >รายละเอียด:</label>
								<textarea rows="4" cols="50" class="txt-area" name="dep_desc"><?php echo $department_item->Dep_Desc; ?></textarea>
							</div>
							<div class="col-lg-12">
								<label >สถานะการใช้งาน:</label>
								<select class="select-opt" name="dep_status">
									<option value="1" <?php if($department_item->Dep_Status == "1"){ ?>selected='selected'<?php } ?>>ใช้งานได้</option>
									<option value="0" <?php if($department_item->Dep_Status == "0"){ ?>selected='selected'<?php } ?>>ใช้งานไม่ได้</option>
								</select>
							</div>
						</div>
		
						<!--<div class="col-lg-12" style="text-align: center;">
						<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:18%;padding: 4px;">
						</div>-->
		
					</div>
		
					<div class="col-lg-12" style="text-align: center;">
						<input class="bt" type="submit" value="บันทึก" name="share">
					</div>
				</div><!-- #manage-info -->
<?php
			}
?>
		</form>
	</div>
</div>