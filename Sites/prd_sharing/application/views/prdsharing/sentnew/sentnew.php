<script>
	$(function() {
		$(".datepicker").datepicker();
	}); 
</script>

<form name="form_sendnew" action="manageNewGROV" method="post">
	<input type="hidden" name="sentnew_is_add" value="yes" />
	
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
					<select name="Tar_ID" id="Tar_ID">
	<?php
						$i=1;
						foreach ($TargetGroup as $TargetGroup_item) {
							?><option id="target<?php echo $i; ?>" value="<?php echo $TargetGroup_item->Tar_ID;?>"><?php echo $TargetGroup_item->Tar_Name;?></option><?php
							$i++;
						}
	?>
						<option value="" selected="selected">เลือกกลุ่มเป้าหมาย</option>
					</select>
				</div>
			</div>
	
	<script>
		// $("select#Tar_ID").text("asdf");
		
		
		$("select#Tar_ID").change(function() {
			$( "select#Tar_ID option#target1:selected" ).each(function() {
				$(".grov_active_col").css("display", "active");
				$(".prd_active_col").css("display", "active");
			});
			
			$( "select#Tar_ID option#target2:selected" ).each(function() {
				$(".grov_active_col").css("display", "none");
				$(".prd_active_col").css("display", "active");
			});
		});
	</script>
	
	
			<div class="row grov_active_col" >
				<div class="col-lg-6">
					<label id="grov_active" >หน่วยงานภาครัฐ</label>
					<select name="grov_active" id="grov_active">
						<option value="">เลือกเผยแพร่</option>
					</select>
				</div>
			</div>
			
			<div class="row prd_active_col" >
				<div class="col-lg-6">
					<label id="prd_active" >หน่วยงานสำนักข่าวกรมประชาสัมพันธ์</label>
					<select name="prd_active" id="prd_active">
						<option value="">เลือกเผยแพร่</option>
					</select>
				</div>
			</div>
			
	
			<div class="row">
				<div class="col-lg-11">
					<label >แผนงานโครงการ/กิจกรรม</label>
					<input type="text" class="form-control" name="SendIn_Plan" id="SendIn_Plan" placeholder="" >
				</div>
			</div>
			<div class="row">
				<div class="col-lg-11">
					<label >ประเด็นประชาสัมพันธ์</label>
					<input type="text" class="form-control" name="SendIn_Issue" id="SendIn_Issue" placeholder="" >
				</div>
			</div>
			<div class="row">
				<div class="col-lg-11">
					<label >เนื้อหา</label>
					<textarea class="ckeditor" name="SendIn_Detail"></textarea>
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
				<input type="file" class="form-control bt" name="fileattach" id="fileattach" placeholder="" >
				<!-- <input class="bt" type="submit" name="share" value="BROWSE"> -->
			</div>
		</div>
	</fieldset>
	
	<div class="row">
		<div class="col-lg-12" style="text-align: center;    float: left;">
			<input class="bt" type="submit" name="share" value="บันทึก">
			<input class="bt" type="submit" name="share" value="ยกเลิก">
		</div>
	</div>

</form>