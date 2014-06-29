<form name="formManageNewGROV" action="<?php echo base_url().index_page(); ?>manageNewGROV" method="post">
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
				<select name="Tar_ID" id="Tar_ID">
					<option value="" id="target0">เลือกกลุ่มเป้าหมาย</option>
<?php
					$i=1;
					foreach ($TargetGroup as $TargetGroup_item) {
						?><option id="target<?php echo $i; ?>" value="<?php echo $TargetGroup_item->Tar_ID;?>"><?php echo $TargetGroup_item->Tar_Name;?></option><?php
						$i++;
					}
?>
				</select>
			</div>
		</div>
		
		<?php // For toggle กลุ่มเป้าหมาย  ?>
		<style>
			.grov_active_col.row,
			.prd_active_col.row{
				display:none;
			}
		</style>
		<script>
			// $("select#Tar_ID").text("asdf");
			
			$("select#Tar_ID").change(function() {
				$( "select#Tar_ID option#target1:selected" ).each(function() {
					$(".grov_active_col").css("display", "BLOCK");
					$(".prd_active_col").css("display", "BLOCK");
				});
				
				$( "select#Tar_ID option#target2:selected" ).each(function() {
					$(".grov_active_col").css("display", "none");
					$(".prd_active_col").css("display", "BLOCK");
				});
				
				$( "select#Tar_ID option#target0:selected" ).each(function() {
					$(".grov_active_col").css("display", "none");
					$(".prd_active_col").css("display", "none");
				});
			});
		</script>
		
		
		<div class="row grov_active_col" >
			<div class="col-lg-6">
				<label id="grov_active" >หน่วยงานภาครัฐ</label>
				<select name="grov_active" id="grov_active">
					<option value="">เลือกหน่วยงานภาครัฐ</option>
<?php
					foreach ($SC07_Department as $Department_item) {
						?><option value="<?php echo $Department_item->SC07_DepartmentId;?>"><?php echo $Department_item->SC07_DepartmentName;?></option><?php
					}
?>
				</select>
			</div>
		</div>
		
		<div class="row prd_active_col" >
			<div class="col-lg-6">
				<label id="prd_active" >หน่วยงานสำนักข่าวกรมประชาสัมพันธ์</label>
				<select name="prd_active" id="prd_active">
					<option value="">เลือกเผยแพร่</option>
<?php
					foreach ($Ministry as $Ministry_item) {
						?><option value="<?php echo $Ministry_item->Minis_ID;?>"><?php echo $Ministry_item->Minis_Name;?></option><?php
					}
?>
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
			<div class="col-lg-11" style="width: 80%; margin: 0 auto; ">
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