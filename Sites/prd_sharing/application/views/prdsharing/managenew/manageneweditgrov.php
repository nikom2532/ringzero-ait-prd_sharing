<form name="formManageNewGROV" action="manageNewGROV" method="post">
<?php
//Start to count News GROV's rows
foreach($news as $news_item):
?>
	<input type="hidden" name="manageNewEditPRD_record" value="yes" />
	<input type="hidden" name="SendIn_ID" value="<?php echo $news_item->SendIn_ID; ?>" />
<fieldset class="frame-input">
	<legend >
		News Information
	</legend>
	<div id="sentnews" class="table-list">
		<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
		<div class="row">
			<div class="col-lg-6">
				<label >ช่วงวันที่</label>
				<label ><?php 
					if($news_item->SendIn_UpdateDate != ""){
						echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_UpdateDate));
					}
					else{
						echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_CreateDate));
					} 
				?></label>
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
				<label >นโยบายรัฐบาล</label>
				<select name="">
					<option value="">เลือกนโยบาย</option>
				</select>
			</div>
			<div class="col-lg-6">
				<label >เผยแพร่</label>
				<select name="">
					<option value="">เลือกเผยแพร่</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >กลุ่มเป้าหมาย</label>
				<select name="">
					<option value="">เลือกกลุ่มเป้าหมาย</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11">
				<label >แผนงานโครงการ/กิจกรรม</label>
				<input type="text" class="form-control" name="SendIn_Plan" id="SendIn_Plan" placeholder="" value="<?php echo $news_item->SendIn_Plan; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11">
				<label >ประเด็นประชาสัมพันธ์</label>
				<input type="text" class="form-control" name="SendIn_Issue" id="SendIn_Issue" placeholder="" value="<?php echo $news_item->SendIn_Issue; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11">
				<label >เนื้อหา</label>
				<textarea class="ckeditor" name="editor1"><?php echo $news_item->SendIn_Detail; ?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >สถานะ</label>
				<label >รอการอนุมัติ</label>
				
				<select name="sendin_status" class="form-control" style="width: 65%;">
					<option value="0"<?php 
						if($news_item->SendIn_Status == '0' || $news_item->SendIn_Status == ''){
							?> checked='checked' <?php
						}
					?>>ไม่อนุมัติ&frasl;รอการอนุมัติ</option>
					<option value="1"<?php 
						if($news_item->SendIn_Status == '1'){
							?> checked='checked' <?php
						}
					?>>อนุมัติ</option>
				</select>
			</div>
		</div>
		
		<!--<div class="col-lg-12" style="text-align: center;    float: left;">
		<input class="bt" type="submit" name="share" value="บันทึก">
		<input class="bt" type="submit" name="share" value="ยกเลิก">
		</div>-->

	</div><!-- #sentnews -->
</fieldset>

<fieldset class="frame-input">
	<legend >
		File Upload
	</legend>
	<div class="row">
		<div class="col-lg-6">
			<label >Attach file</label>
			<input type="text" class="form-control" id="InputKeyword" placeholder="" >
			<input class="bt" type="submit" name="share" value="BROWSE">
		</div>
	</div>
</fieldset>

<div class="row">
	<div class="col-lg-12" style="text-align: center;    float: left;">
		<input class="bt" type="submit" name="share" value="บันทึก">
		<input class="bt" type="submit" name="share" value="ยกเลิก">
	</div>
</div>
<?php
endforeach;
//End Count News GROV's Row 
?>
</form>