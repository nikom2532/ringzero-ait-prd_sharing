<script>
	$(function() {
		$(".datepicker").datepicker();
	}); 
</script>
<fieldset class="frame-input">
	<legend >
		News Information
	</legend>
	<div id="sentnews" class="table-list">
		<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
		<div class="row">
			<div class="col-lg-6">
				<label >ช่วงวันที่</label>
				<input type="text" class="form-control datepicker" name="create_date" id="create_date" placeholder="" >
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >กระทรวง</label>
				<select name="Minis_ID">
<?php
					foreach ($Ministry as $Ministry_item) {
						?><option value="<?php echo $Ministry_item->Minis_ID;?>"><?php echo $Ministry_item->Minis_Name;?></option><?php
					}
?>
				</select>
			</div>
			<div class="col-lg-6">
				<label >กรม</label>
				<select name="Dep_ID">
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
				<label >นโยบายรัฐบาล</label>
				<select name="NT05_PolicyID">
<?php
					foreach ($NT05_Policy as $NT05_Policy_item) {
						?><option value="<?php echo $NT05_Policy_item->NT05_PolicyID;?>"><?php echo $NT05_Policy_item->NT05_PolicyName;?></option><?php
					}
?>
					<option value="">เลือกนโยบาย</option>
				</select>
			</div>

		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >กลุ่มเป้าหมาย</label>
				<select name="">
<?php
					foreach ($TargetGroup as $TargetGroup_item) {
						?><option value="<?php echo $TargetGroup_item->Tar_ID;?>"><?php echo $TargetGroup_item->Tar_Name;?></option><?php
					}
?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<label >เผยแพร่</label>
				<select name="">
					<option value="">เลือกเผยแพร่</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-11">
				<label >แผนงานโครงการ/กิจกรรม</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" >
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11">
				<label >ประเด็นประชาสัมพันธ์</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" >
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11">
				<label >เนื้อหา</label>
				<textarea class="ckeditor" name="editor1"></textarea>
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