<div class="content">
	<div id="share-form">
		<form name="info_depatment_form" action="manageInfo_Department" method="post">
			<input type="hidden" name="info_department_is_add" value="yes" />
			<div class="row" id="gove-title" style="margin-top:5%;">
				รายละเอียดข้อมูล
			</div>
	
			<div id="manage-info">
				<div id="search-form">
					<div class="row">
						<div class="col-lg-12">
							<label >ลำดับที่:</label>
							<span class="number"></span>
						</div>
						<div class="col-lg-12">
							<label >ชื่อกระทรวง:</label>
							<select class="select-opt" name="ministry_id">
<?php
								foreach ($ministry as $ministry_item) {
									?><option value="<?php echo $ministry_item->Minis_ID ?>"><?php echo $ministry_item->Minis_Name; ?></option><?php
								}
?>
							</select>
						</div>
						<div class="col-lg-12">
							<label >ชื่อกรม:</label>
							<input type="text" class="form-control txt-field" name="dep_name" id="dep_name" value="" placeholder="" >
						</div>
						<div class="col-lg-12">
							<label >รายละเอียด:</label>
							<textarea rows="4" cols="50" class="txt-area" name="dep_desc"></textarea>
						</div>
						<div class="col-lg-12">
							<label >สถานะการใช้งาน:</label>
							<select class="select-opt" name="dep_status">
								<option value="1" >ใช้งานได้</option>
								<option value="0" selected='selected'>ใช้งานไม่ได้</option>
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
		</form>
	</div>
</div>