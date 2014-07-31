<style>
	.row .col-lg-6 span.select-menu{
		width: 62%;
	}
	.row .col-lg-6 span.select-menu select,
	#sentnews .col-lg-6 select{
		width: 100%;
	}
	.select-menu:hover {
	    background: url(../images/arrowhover.png) no-repeat 100% 0px #FFFFFF;
	}
	.select-menu {
	    background: url(../images/arrowhover.png) no-repeat 100% 0px #FFFFFF;
	}
	.row .col-lg-6 span.select-menu select{
		width: 100% !important;
	}
	
	.uploadfile_video .col-lg-12,
	.uploadfile_voice .col-lg-12,
	.uploadfile_document .col-lg-12,
	.uploadfile_picture .col-lg-12{
	    border-bottom: 1px dashed #d5d1e0;
	    margin-top: 15px;
	    padding-bottom: 2px;
	    width: 90%;
	    margin-left: 0;
	}
	.uploadfile_video .col-lg-12 input,
	.uploadfile_voice .col-lg-12 input,
	.uploadfile_document .col-lg-12 input,
	.uploadfile_picture .col-lg-12 input{
		border: 0;
	}
	
	.uploadfile_video  .dotline,
	.uploadfile_voice  .dotline,
	.uploadfile_document .dotline,
	.uploadfile_picture .dotline,{
		
	}
	
	input#addmorefile{
		padding: 6px 8px;
	}
	
	.show_size .clear{
		clear: both;
	}
	.show_size .line1{
		margin-left: 5%; margin-bottom: 40px; color: #cc0000; text-align: center; 
	}
	.show_size .line2{
		margin-left: 5%; margin-bottom: 10px; color: #444444; text-align: center; 
	}
	.show_size .line2-1{
		float: left; width: 40%; text-align: right; 
	}
	.show_size .line2-2{
		float: left; width: 55%; margin-left: 2%; text-align: left; 
	}
	.show_size .line3{
		margin-left: 5%; margin-bottom: 10px; color: #444444; text-align: center; 
	}
	.show_size .line3-1{
		float: left; width: 40%; text-align: right; 
	}
	.show_size .line3-2{
		float: left; width: 55%; margin-left: 2%; text-align: left;
	}
	.show_size .line4{
		 margin-left: 5%; margin-bottom: 40px; color: #444444; text-align: center; 
	}
	.show_size .line4-1{
		float: left; width: 40%; text-align: right; 
	}
	.show_size .line4-2{
		float: left; width: 55%; margin-left: 2%; text-align: left;
	}
}
</style>
<form name="formManageNewGROV" action="<?php echo base_url().index_page(); ?>manageNewEditGROV" method="post" enctype="multipart/form-data" onsubmit="return validateForm(); ">
<?php
//Start to count News GROV's rows
foreach($news as $news_item):
?>
	<input type="hidden" name="manageNewEditGROV_record" value="yes" />
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
				<span class="select-menu">
					<span>เลือกกระทรวง</span>
					<select name="Minis_ID" id="Minis_ID">
						<option value="">เลือกกระทรวง</option>
<?php
						foreach ($Ministry as $Ministry_item) {
							?><option data-minis_id="<?php echo $Ministry_item->Minis_ID;?>" value="<?php echo $Ministry_item->Minis_ID;?>" <?php
								if($news_item->Ministry_ID == 
								$Ministry_item->Minis_ID){
									?>selected='selected'<?php
								}
							?>><?php echo $Ministry_item->Minis_Name;?></option><?php
						}
?>
					</select>
				</span>
			</div>
			<div class="col-lg-6">
				<label >กรม</label>
				<span class="select-menu">
					<span>เลือกกรม</span>
					<select name="Dep_ID" id="Dep_ID">
						<option value="">เลือกกรม</option>
<?php
						if(isset($news_item->Dep_ID)){
							if($news_item->Dep_ID != ""){
								foreach ($Department as $Department_item) {
									?><option data-minis_id="<?php
										foreach ($Ministry as $Ministry_item) {
											if($Department_item->Ministry_ID == $Ministry_item->Minis_ID){
												echo $Ministry_item->Minis_ID;
											}
										}
									?>" value="<?php echo $Department_item->Dep_ID;?>" <?php
										if($news_item->Dep_ID == $Department_item->Dep_ID){
											?>selected='selected'<?php
										}
									?>><?php echo $Department_item->Dep_Name;?></option><?php
								}
							}
						}
?>
					</select>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >นโยบายรัฐบาล</label>
				<span class="select-menu">
					<span>เลือกนโยบายรัฐบาล</span>
					<select name="NT05_PolicyID" id="NT05_PolicyID">
						<option value="">เลือกนโยบาย</option>
<?php
						foreach ($NT05_Policy as $NT05_Policy_item) {
							?><option value="<?php 
								echo $NT05_Policy_item->NT05_PolicyID;
							?>" <?php 
								if($news_item->Policy_ID == $NT05_Policy_item->NT05_PolicyID){
									?>selected='selected'<?php
								}
							?>><?php 
								echo $NT05_Policy_item->NT05_PolicyName;
							?></option><?php
						}
?>
					</select>
				</span>
			</div>

		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >กลุ่มเป้าหมาย</label>
				<span class="select-menu">
					<span>เลือกกลุ่มเป้าหมาย</span>
					<select name="Tar_ID" id="Tar_ID">
						<option value="" id="target0">เลือกกลุ่มเป้าหมาย</option>
<?php
						$i=1;
						$target_selected = 0;
						//Check TargetGroup selected
						if(
							$news_item->PRD_Active == 1 && 
							$news_item->GOVE_Active == 1
						){
								$target_selected = 3;
						}
						elseif(
							$news_item->PRD_Active == 1 && 
							($news_item->GOVE_Active == 0 || $news_item->GOVE_Active == null || $news_item->GOVE_Active == "")
						){
								$target_selected = 4;
						}
						elseif(
							($news_item->PRD_Active == 0 || $news_item->PRD_Active == null || $news_item->PRD_Active == "") && 
							($news_item->GOVE_Active == 0 || $news_item->GOVE_Active == null || $news_item->GOVE_Active == "")
						){
								$target_selected = 0;
						}
						
						foreach ($TargetGroup as $TargetGroup_item) {
							?><option id="target<?php echo $TargetGroup_item->Tar_ID; ?>" value="<?php echo $TargetGroup_item->Tar_ID;?>" <?php
								if($TargetGroup_item->Tar_ID == null || $TargetGroup_item->Tar_ID == "" || $TargetGroup_item->Tar_ID == 0){
									$TargetGroup_item->Tar_ID = 0;
								}
								if($TargetGroup_item->Tar_ID == $target_selected){
									?>selected='selected'<?php
								}
							?>><?php echo $TargetGroup_item->Tar_Name;?></option><?php
							$i++;
						}
?>
					</select>
				</span>
			</div>
		</div>
<?php 
		// For toggle กลุ่มเป้าหมาย
		if($target_selected == 0){
?>
			<style>
				.grov_status_col.row,
				.prd_status_col.row{
					display:none;
				}
			</style>
<?php
		}
		elseif($target_selected == 3){
?>
			<style>
				.grov_status_col.row,
				.prd_status_col.row{
					display: BLOCK;
				}
			</style>
<?php
		}
		elseif($target_selected == 4){
?>
			<style>
				.prd_status_col.row{
					display: BLOCK;
				}
				.grov_status_col.row{
					display: none;
				}
			</style>
<?php
		}
?>
		<div class="row grov_status_col" >
			<div class="col-lg-6">
				<label>หน่วยงานภาครัฐ</label>
				<span class="select-menu">
					<span>เลือกหน่วยงานภาครัฐ</span>
					<select name="grov_status" id="grov_status">
						<option value="">เลือกหน่วยงานภาครัฐ</option>
<?php
						/*
						foreach ($SC07_Department as $Department_item) {
							?><option value="<?php echo $Department_item->SC07_DepartmentId;?>"><?php echo $Department_item->SC07_DepartmentName;?></option><?php
						}
						*/
						foreach ($Ministry as $Ministry_item) {
							?><option value="<?php echo $Ministry_item->Minis_ID;?>" <?php
								if($Ministry_item->Minis_ID == $news_item->GOVE_Status){
									?>selected='selected'<?php
								}
							?>><?php echo $Ministry_item->Minis_Name;?></option><?php
						}
?>
					</select>
				</span>
			</div>
		</div>
		
		<div class="row prd_status_col" >
			<div class="col-lg-6">
				<label>หน่วยงานสำนักข่าวกรมประชาสัมพันธ์</label>
				<span class="select-menu">
					<span>เลือกหน่วยงานสำนักข่าวกรมประชาสัมพันธ์</span>
					<select name="prd_status" id="prd_status">
						<option value="">เลือกหน่วยงานสำนักข่าวกรมประชาสัมพันธ์</option>
	<?php
						/*
						foreach ($Ministry as $Ministry_item) {
							?><option value="<?php echo $Ministry_item->Minis_ID;?>"><?php echo $Ministry_item->Minis_Name;?></option><?php
						}
						*/
						foreach ($SC07_Department as $Department_item) {
							?><option value="<?php echo $Department_item->SC07_DepartmentId;?>" <?php
								if($Department_item->SC07_DepartmentId == $news_item->PRD_Status){
									?>selected='selected'<?php
								}
							?>><?php echo $Department_item->SC07_DepartmentName;?></option><?php
						}
	?>
					</select>
				</span>
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
				<textarea class="ckeditor" name="SendIn_Detail" id="SendIn_Detail"><?php echo $news_item->SendIn_Detail; ?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >สถานะ</label>
				<span class="select-menu">
					<span>เลือกสถานะ</span>
					<select name="sendin_status" id="sendin_status" class="form-control" style="width: 65%;">
						<option value="n"<?php 
							if($news_item->SendIn_Status == 'n' || $news_item->SendIn_Status == 'w' || $news_item->SendIn_Status == null){
								?> selected='selected'<?php
							}
						?>>ไม่อนุมัติ</option>
						<option value="y"<?php 
							if($news_item->SendIn_Status == 'y'){
								?> selected='selected'<?php
							}
						?>>อนุมัติ</option>
					</select>
				</span>	
			</div>
		</div>
<?php 
		$row = 0;
		$total_file_size = 0;
		foreach ($FileAttach as $FileAttach_item){
			$total_file_size += ($FileAttach_item->File_FileSize)*1024;
			?><div class="row" style="margin-bottom: 0; padding: 10px 0; <?php
				if($row % 2 == 0){
					?>background-color: #fbfaf6<?php
				}
				else{
					?>background-color: #ededed<?php
				}
			?>"> 
				<div style="float: left; width: 35%; padding-left: 10%; ">
					<a style="text-decoration:none; text-decoration:none; " target="_blank" href="<?php echo base_url()."uploads/".$FileAttach_item->File_Name; ?>" ><?php 
						?><img src="<?php echo base_url(); ?>images/icon/<?php
						if(
							strtolower($FileAttach_item->File_Extension) == ".png" ||
							strtolower($FileAttach_item->File_Extension) == ".jpg" ||
							strtolower($FileAttach_item->File_Extension) == ".jpeg" ||
							strtolower($FileAttach_item->File_Extension) == ".bmp" ||
							strtolower($FileAttach_item->File_Extension) == ".tiff" ||
							strtolower($FileAttach_item->File_Extension) == ".gif"
						){
							?>pic.png<?php
						}
						elseif(
							strtolower($FileAttach_item->File_Extension) == ".mp3" ||
							strtolower($FileAttach_item->File_Extension) == ".ogg" ||
							strtolower($FileAttach_item->File_Extension) == ".wma"
						){
							?>voice_512x512.png<?php
						}
						elseif(
							strtolower($FileAttach_item->File_Extension) == ".avi" ||
							strtolower($FileAttach_item->File_Extension) == ".mpg" ||
							strtolower($FileAttach_item->File_Extension) == ".mpg4" ||
							strtolower($FileAttach_item->File_Extension) == ".mp4" ||
							strtolower($FileAttach_item->File_Extension) == ".wmv"
						){
							?>vdo.png<?php
						}
						elseif(
							strtolower($FileAttach_item->File_Extension) == ".doc" ||
							strtolower($FileAttach_item->File_Extension) == ".docs" ||
							strtolower($FileAttach_item->File_Extension) == ".xls"
						){
							?>Document.jpg<?php
						}
						else{
							?>Document.jpg<?php
						}
						?>" style="margin-right: 10px; " width="17"><?php 
						if($FileAttach_item->File_Label == ""){
							echo $FileAttach_item->File_Name;
						}
						else{
							echo $FileAttach_item->File_Label; 
						}
					?></a>
				</div>
				<div style="float: left; width: 55%; "> 
					<a href="#" class="FileAttachDelete" data-File_ID="<?php echo $FileAttach_item->File_ID; ?>">
						<img src="<?php echo base_url(); ?>images/icon/delete.png" style="margin: -5px 10px 0; padding-top: 1%;">
					</a>
				</div>
			</div><?php
			$row++;
		}
		// echo "total file = ".$total_file_size;
?>
		<!--<div class="col-lg-12" style="text-align: center;    float: left;">
		<input class="bt_gray" type="submit" name="share" value="บันทึก">
		<input class="bt_gray" type="submit" name="share" value="ยกเลิก">
		</div>-->

	</div><!-- #sentnews -->
</fieldset>

<fieldset class="frame-input show_size">
	<legend >
		File Upload
	</legend>
	<div class="line1">
		เอกสาร ขนาด File ทัั้งหมดรวมกันจะต้องไม่เกิน 40 MB
	</div>
	<div class="line2">
		<div class="line2-1">
			จำนวนขนาด File ที่เคย Upload ไปแล้ว :
		</div>
		<div class="line2-2">
			<span class="total_file_size"><?php 
				if($total_file_size < 1024.0){
					echo $total_file_size;
				}
				elseif($total_file_size < (1024.0*1024.0)){
					echo number_format(($total_file_size/1024.0), 2, '.', ','); 
				}
				elseif($total_file_size < (1024.0*1024.0*1024.0)){
					echo number_format(($total_file_size/(1024.0*1024.0)), 2, '.', ','); 
				}
			?></span>
			<span class="total_file_unit"><?php
				if($total_file_size < 1024.0){
					echo " Bytes";
				}
				elseif($total_file_size < (1024.0*1024.0)){
					echo " KB";
				}
				elseif($total_file_size < (1024.0*1024.0*1024.0)){
					echo " MB";
				}
			?></span>
			(<span class="total_file_size_bytes"><?php echo number_format($total_file_size, 2, '.', ','); ?></span>
			<span class="total_file_unit_bytes">Bytes</span>)
		</div>
		<div style="clear: both; "></div>
	</div>
	<div class="line3">
		<div class="line3-1">
			จำนวนขนาด File ที่กำลัง Upload : 
		</div>
		<div class="line3-2">
			<span class="total_before_file_size">0</span>
			<span class="total_before_file_unit"></span>  
			(<span class="total_before_file_size_bytes">0</span>
			<span class="total_before_file_unit_bytes">Bytes</span>)
		</div>
		<div style="clear: both; "></div>
	</div>
	<div class="line4">
		<div class="line4-1">
			จำนวนขนาด File เมื่อหลังจาก Upload ไปแล้ว : 
		</div>
		<div class="line4-2">
			<span class="total_after_file_size"><?php 
				if($total_file_size < 1024.0){
					echo $total_file_size;
				}
				elseif($total_file_size < (1024.0*1024.0)){
					echo number_format(($total_file_size/1024.0), 2, '.', ','); 
				}
				elseif($total_file_size < (1024.0*1024.0*1024.0)){
					echo number_format(($total_file_size/(1024.0*1024.0)), 2, '.', ','); 
				}
			?></span>
			<span class="total_after_file_unit"><?php
				if($total_file_size < 1024.0){
					echo " Bytes";
				}
				elseif($total_file_size < (1024.0*1024.0)){
					echo " KB";
				}
				elseif($total_file_size < (1024.0*1024.0*1024.0)){
					echo " MB";
				}
			?></span>
			(<span class="total_after_file_size_bytes"><?php echo number_format($total_file_size, 2, '.', ','); ?></span>
			<span class="total_after_file_unit_bytes">Bytes</span>)
		</div>
		<div style="clear: both; "></div>
	</div>	
	
	<div class="uploadfile_video uploadfile">
		<div style="margin-left: 5%; color: #000000; float: left; ">
			Video *
		</div>
		<div style="margin-left: 5%; color: #cc0000; ">
			รองรับนามสกุล .mp4, .avi, .wmv, .flv
		</div>
		
		<div class="row file_1" style="margin-bottom: 0; ">
			<div class="col-lg-12" style="margin-left: 5%; ">
				<span class="label_file" >file แนบเอกสาร</span>
				<input type="file" class="form-control" name="fileattach_video1" id="fileattach" onchange="check_file_ext('video', '1');" placeholder="" style="width: 40%; " multiple />
				<img src="<?php echo base_url(); ?>images/icon/delete_lock2.png" name="reducemorefile" id="reducemorefile" data-file_id="1" style="width: 20px; margin-left: 15px; cursor: pointer; " />
			</div>
		</div>
	</div>
	<div class="row uploadfile_video_btn">
		<div style="text-align: center;">
			<input class="bt_gray" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
		</div>
	</div>
	
	<div class="uploadfile_voice uploadfile">
		<div style="margin-left: 5%; color: #000000; float: left; ">
			เสียง *
		</div>
		<div style="margin-left: 5%; color: #cc0000; ">
			รองรับนามสกุล .mp3, .ogg, .wma
		</div>
		<div class="row file_1" style="margin-bottom: 0; ">
			<div class="col-lg-12" style="margin-left: 5%; ">
				<span class="label_file" >file แนบเอกสาร</span>
				<input type="file" class="form-control" name="fileattach_voice1" id="fileattach" onchange="check_file_ext('voice', '1');" placeholder="" style="width: 40%; " multiple />
				<img src="<?php echo base_url(); ?>images/icon/delete_lock2.png" name="reducemorefile" id="reducemorefile" data-file_id="1" style="width: 20px; margin-left: 15px; cursor: pointer; " />
			</div>
			<!-- <div class="col-lg-6">
				<input class="bt_gray" type="button" name="reducemorefile" id="reducemorefile" data-file_id="1" value="ลด file แนบเอกสาร" style="background-color: #E20000; border: 1px solid #E20000" />
			</div> -->
		</div>
	</div>
	<div class="row uploadfile_voice_btn">
		<div style="text-align: center;">
			<input class="bt_gray" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
		</div>
	</div>
	
	<div class="uploadfile_document uploadfile">
		<div style="margin-left: 5%; color: #000000; float: left; ">
			เอกสาร *
		</div>
		<div style="margin-left: 5%; color: #cc0000; ">
			รองรับนามสกุล .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .csv
		</div>
		<div class="row file_1" style="margin-bottom: 0; ">
			<div class="col-lg-12" style="margin-left: 5%; ">
				<span class="label_file" >file แนบเอกสาร</span>
				<input type="file" class="form-control" name="fileattach_document1" id="fileattach" onchange="check_file_ext('document', '1');" placeholder="" style="width: 40%; " multiple />
				<img src="<?php echo base_url(); ?>images/icon/delete_lock2.png" name="reducemorefile" id="reducemorefile" data-file_id="1" style="width: 20px; margin-left: 15px; cursor: pointer; " />
			</div>
		</div>
	</div>
	<div class="row uploadfile_document_btn">
		<div style="text-align: center;">
			<input class="bt_gray" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
		</div>
	</div>
	
	<div class="uploadfile_picture uploadfile">
		<div style="margin-left: 5%; color: #000000; float: left; ">
			รูปภาพ *
		</div>
		<div style="margin-left: 5%; color: #cc0000; ">
			รองรับนามสกุล .jpg, .jpeg, .gif, .png
		</div>
		<div class="row file_1" style="margin-bottom: 0; ">
			<div class="col-lg-12" style="margin-left: 5%; ">
				<span class="label_file" >file แนบเอกสาร</span>
				<input type="file" class="form-control" name="fileattach_picture1" id="fileattach" onchange="check_file_ext('picture', '1');" placeholder="" style="width: 40%; " multiple />
				<img src="<?php echo base_url(); ?>images/icon/delete_lock2.png" name="reducemorefile" id="reducemorefile" data-file_id="1" style="width: 20px; margin-left: 15px; cursor: pointer; " />
			</div>
		</div>
	</div>
	<div class="row uploadfile_picture_btn">
		<div style="text-align: center;">
			<input class="bt_gray" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
		</div>
	</div>
	
</fieldset>

<script>
	CKEDITOR.replace( 'SendIn_Detail', {
		// Load the German interface.
		language: 'th',
		toolbar :
		[
			['Source','-','Save','NewPage','Preview','-','Templates'],
			['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
			['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
			['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
			['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
			['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
			'/',
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Link','Unlink'],
			['Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
			['Styles','Format','Font','FontSize'],
			['TextColor','BGColor'],
			['Maximize', 'ShowBlocks']
		],
	});
	
	var selectmenu_txt = $("#sendin_status").find("option:selected").text();
	$("#sendin_status").prev("span").text(selectmenu_txt);
	
	function push_mem_department(id){
		// debugger;
	    if(id != ""){
	    	var type_id = id;
	    }
	    else{
	    	var type_id = $('select#mem_ministry').val();
	    }
	    
	    var type_id = $('select#Minis_ID').val();
	    if (type_id != ""){
	        var post_url = "<?php echo base_url().index_page(); ?>PRD_sentNew/get_Department/" + type_id;
	    	// debugger;
	    	// alert(post_url);
	        $.ajax({
	            type: "POST",
	             url: post_url,
				 dataType :'json',
	             success: function(subtype)
	              {
	              	// var a = JSON.parse(subtype);
	                $('#Dep_ID').empty();
	                
	                var text = "<option value=\"\">เลือกกรม</option>";
	                $('#Dep_ID').append(text);
	                
					$.each(subtype,function(index,val) 
					{
						text = ""+
						"<option value=\""+val.Dep_ID+"\">"+val.Dep_Name+"</option>";
						$('#Dep_ID').append(text);
					});
					var selectmenu_txt = $("#Dep_ID").find("option:selected").text();
					$("#Dep_ID").prev("span").text(selectmenu_txt);
				} //end success
			}); //end AJAX
	    } else {
	        $('#SubTypeID').empty();
	    }//end if
	}
	$( document ).ready(function() {
		$('select#Minis_ID').change(function(){
			push_mem_department('');
			
			$('#Dep_ID').empty();
            var text = "<option value=\"\" selected='selected'>เลือกกรม</option>";
            $('#Dep_ID').append(text);
            
            var selectmenu_txt = $("#Dep_ID").find("option:selected").text();
			$("#Dep_ID").prev("span").text(selectmenu_txt);
		});
	});
	
	$("select#Tar_ID").live("change",function() {
		$( "select#Tar_ID option#target3:selected" ).each(function() {
			$(".prd_status_col").css("display", "BLOCK");
			$(".grov_status_col").css("display", "BLOCK");
		});
		
		$( "select#Tar_ID option#target4:selected" ).each(function() {
			$(".prd_status_col").css("display", "BLOCK");
			$(".grov_status_col").css("display", "none");
		});
		
		$( "select#Tar_ID option#target0:selected" ).each(function() {
			$(".prd_status_col").css("display", "none");
			$(".grov_status_col").css("display", "none");
		});
	});
	
	//############################### Video ####################################
	
	var count_input_files = 4;
	
	var number_video = 2;
	$(".uploadfile_video_btn input#addmorefile").live('click', function(){
		var str = "" +
		"<div class=\"row file_"+(number_video)+"\" style=\"margin-bottom: 0;\">"+
		"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
		"		<span class=\"label_file\">file แนบเอกสาร</span>"+
		"		<input type=\"file\" class=\"form-control\" name=\"fileattach_video"+(number_video)+"\" id=\"fileattach\"  onchange=\"check_file_ext('video', '"+(number_video)+"');\" style=\"width: 40%; \" multiple />"+
		"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number_video)+"\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
		"	</div>"+
		"</div>";
		
		$("div.uploadfile_video").append(str);
		number_video++;
		count_input_files++;
	});
	
	$(".uploadfile_video #reducemorefile").live('click', function(){
		var file_id = $(this).attr("data-file_id");
		// var file_id = $(this).data("file_id");
		
		$("div.uploadfile_video .row.file_"+file_id).remove();
		// number--;
		count_input_files--;
	});
	
	//############################### Voice ####################################
	
	var number_voice = 2;
	$(".uploadfile_voice_btn input#addmorefile").live('click', function(){
		var str = "" +
		"<div class=\"row file_"+(number_voice)+"\" style=\"margin-bottom: 0;\">"+
		"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
		"		<span class=\"label_file\">file แนบเอกสาร</span>"+
		"		<input type=\"file\" class=\"form-control\" name=\"fileattach_voice"+(number_voice)+"\" id=\"fileattach\"  onchange=\"check_file_ext('voice', '"+(number_voice)+"');\" style=\"width: 40%; \" multiple />"+
		"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number_voice)+"\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
		"	</div>"+
		"</div>";
		
		$("div.uploadfile_voice").append(str);
		number_voice++;
		count_input_files++;
	});
	
	$(".uploadfile_voice #reducemorefile").live('click', function(){
		var file_id = $(this).attr("data-file_id");
		// var file_id = $(this).data("file_id");
		
		$("div.uploadfile_voice .row.file_"+file_id).remove();
		// number_voice--;
		count_input_files--;
	});
	
	//############################### document ####################################
	
	var number_document = 2;
	$(".uploadfile_document_btn input#addmorefile").live('click', function(){
		var str = "" +
		"<div class=\"row file_"+(number_document)+"\" style=\"margin-bottom: 0;\">"+
		"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
		"		<span class=\"label_file\">file แนบเอกสาร</span>"+
		"		<input type=\"file\" class=\"form-control\" name=\"fileattach_document"+(number_document)+"\" id=\"fileattach\"  onchange=\"check_file_ext('document', '"+(number_document)+"');\" style=\"width: 40%; \" multiple />"+
		"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number_document)+"\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
		"	</div>"+
		"</div>";
		
		$("div.uploadfile_document").append(str);
		number_document++;
		count_input_files++;
	});
	
	$(".uploadfile_document #reducemorefile").live('click', function(){
		var file_id = $(this).attr("data-file_id");
		// var file_id = $(this).data("file_id");
		
		$("div.uploadfile_document .row.file_"+file_id).remove();
		// number_document--;
		count_input_files--;
	});
	
	//################################# picture ##################################
	
	var number_picture = 2;
	$(".uploadfile_picture_btn input#addmorefile").live('click', function(){
		var str = "" +
		"<div class=\"row file_"+(number_picture)+"\" style=\"margin-bottom: 0;\">"+
		"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
		"		<span class=\"label_file\">file แนบเอกสาร</span>"+
		"		<input type=\"file\" class=\"form-control\" name=\"fileattach_picture"+(number_picture)+"\" id=\"fileattach\"  onchange=\"check_file_ext('picture', '"+(number_picture)+"');\" style=\"width: 40%; \" multiple />"+
		"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number_picture)+"\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
		"	</div>"+
		"</div>";
		
		$("div.uploadfile_picture").append(str);
		number_picture++;
		count_input_files++;
	});
	
	$(".uploadfile_picture #reducemorefile").live('click', function(){
		var file_id = $(this).attr("data-file_id");
		// var file_id = $(this).data("file_id");
		
		$("div.uploadfile_picture .row.file_"+file_id).remove();
		
		count_input_files--;
		/*
		var i=0;
		var label_file_id = "";
		for(i = parseInt(file_id)+1; i <= number ; i++){
			console.log("=== i = "+i);
			
			$(".uploadfile .row.file_"+i+" .label_file").html("file แนบเอกสาร "+(i-1)+".)");
			$(".uploadfile .row.file_"+i+" #reducemorefile").data("file_id", (i-1));
			$(".uploadfile .row.file_"+i+" #reducemorefile").removeClass("file_"+i);
			$(".uploadfile .row.file_"+i+" #reducemorefile").addClass("file_"+(i-1));
			
			$(".uploadfile .row.file_"+i).addClass("file_"+(i-1));
			$(".uploadfile .row.file_"+i).removeClass("file_"+i);
			
			// $(".uploadfile .row.file_"+i+" #reducemorefile").toggleClass("file_"+i+" file_"+(i-1));
			// $(this).parent(".file_"+i).next()
		}
		*/
		// console.log("-----------");
		// count--;
		// number_picture--;
	});
	
	//################################################################### 	
	
	var total_file_size = <?php echo $total_file_size; ?>;
	var temp_file_size = 0;
	var file_i = 0;
	var file_j = 0;
	
	//Check that cannot upload more that 40 MB
	$(".uploadfile input[type=file]").live("change", function() {
		
		temp_file_size = 0;
		for(file_i = 0; file_i < count_input_files; file_i++){
			for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
				temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
			}
		}
		
		var after_file_size = (total_file_size+temp_file_size);
		
		if(after_file_size > 41943040){
			$(this).val("");
			alert("ตอนนี้ขนาด File รวมกัน เกิน 40 MB ไม่สามารถ Upload เพิ่มได้อีก");
			for(file_i = 0; file_i < count_input_files; file_i++){
				for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
					temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
				}
			}
			$(".total_before_file_size_bytes").html(numberWithCommas(temp_file_size));
			$(".total_after_file_size_bytes").html(numberWithCommas(total_file_size+temp_file_size));
			
			if(temp_file_size < 1024.0){
				$(".total_before_file_size").html(numberWithCommas(temp_file_size));
				$(".total_before_file_unit").html("Bytes");
			}
			else if(temp_file_size < 1024*1024.0){
				
				var temp_file_size_new = temp_file_size/1024.0;
				temp_file_size_new = temp_file_size_new.toFixed(2)
				
				$(".total_before_file_size").html(numberWithCommas(temp_file_size_new));
				$(".total_before_file_unit").html("KB");
			}
			else if(temp_file_size < (1024*1024*1024.0)){
				
				var temp_file_size_new = temp_file_size/(1024*1024.0);
				temp_file_size_new = temp_file_size_new.toFixed(2)
				
				$(".total_before_file_size").html(numberWithCommas(temp_file_size_new));
				$(".total_before_file_unit").html("MB");
			}
			
			var after_file_size = (total_file_size+temp_file_size);
			
			if(after_file_size < 1024.0){
				$(".total_after_file_size").html(numberWithCommas(after_file_size));
				$(".total_after_file_unit").html("Bytes");
			}
			else if(after_file_size < 1024*1024.0){
				
				after_file_size = after_file_size/1024.0;
				after_file_size = after_file_size.toFixed(2)
				
				$(".total_after_file_size").html(numberWithCommas(after_file_size));
				$(".total_after_file_unit").html("KB");
			}
			else if(after_file_size < (1024*1024*1024.0)){
				
				after_file_size = after_file_size/(1024*1024.0);
				after_file_size = after_file_size.toFixed(2)
				
				$(".total_after_file_size").html(numberWithCommas(after_file_size));
				$(".total_after_file_unit").html("MB");
			}
		}
		else{
			$(".total_before_file_size_bytes").html(numberWithCommas(temp_file_size));
			$(".total_after_file_size_bytes").html(numberWithCommas(total_file_size+temp_file_size));
			
			if(temp_file_size < 1024.0){
				$(".total_before_file_size").html(numberWithCommas(temp_file_size));
				$(".total_before_file_unit").html("Bytes");
			}
			else if(temp_file_size < 1024*1024.0){
				
				var temp_file_size_new = temp_file_size/1024.0;
				temp_file_size_new = temp_file_size_new.toFixed(2)
				
				$(".total_before_file_size").html(numberWithCommas(temp_file_size_new));
				$(".total_before_file_unit").html("KB");
			}
			else if(temp_file_size < (1024*1024*1024.0)){
				
				var temp_file_size_new = temp_file_size/(1024*1024.0);
				temp_file_size_new = temp_file_size_new.toFixed(2)
				
				$(".total_before_file_size").html(numberWithCommas(temp_file_size_new));
				$(".total_before_file_unit").html("MB");
			}
			
			var after_file_size = (total_file_size+temp_file_size);
			
			if(after_file_size < 1024.0){
				$(".total_after_file_size").html(numberWithCommas(after_file_size));
				$(".total_after_file_unit").html("Bytes");
			}
			else if(after_file_size < 1024*1024.0){
				
				after_file_size = after_file_size/1024.0;
				after_file_size = after_file_size.toFixed(2)
				
				$(".total_after_file_size").html(numberWithCommas(after_file_size));
				$(".total_after_file_unit").html("KB");
			}
			else if(after_file_size < (1024*1024*1024.0)){
				
				after_file_size = after_file_size/(1024*1024.0);
				after_file_size = after_file_size.toFixed(2)
				
				$(".total_after_file_size").html(numberWithCommas(after_file_size));
				$(".total_after_file_unit").html("MB");
			}
		}
	});
	
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
	
	function check_file_ext(type, file_id){
		// var file_id = $(this).attr("data-file_id");
		// var str = $("div.uploadfile div.row.file_1 div.col-lg-6 input#fileattach[name=fileattach1]").val().toUpperCase();
		
		var text = "div.uploadfile_"+type+" div.row.file_"+file_id+" input#fileattach[name=fileattach_"+type+file_id+"]";
		var ext = $(text).val().split('.').pop().toLowerCase();
		
		// ########### Video ############
		if(type == 'video'){
			if($.inArray(
				ext, 
				['mp4','avi','wmv']
			) == -1) {
					alert('นามสกุลเอกสารไม่ใช่ Video โปรดทำใหม่');
					$("div.uploadfile div.row.file_"+file_id+" div.col-lg-12 input#fileattach[name=fileattach_"+type+file_id+"]").val("");
					
					for(file_i = 0; file_i < count_input_files; file_i++){
						for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
							temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
						}
					}
					$(".total_before_file_size").html(temp_file_size);
					$(".total_after_file_size").html(total_file_size+temp_file_size);
			}
		}
		
		// ########### Voice ############
		
		if(type == 'voice'){
			if($.inArray(
				ext, 
				['mp3','ogg','wma']
			) == -1) {
					alert('นามสกุลเอกสารไม่ใช่เสียง โปรดทำใหม่');
					$("div.uploadfile div.row.file_"+file_id+" div.col-lg-12 input#fileattach[name=fileattach_"+type+file_id+"]").val("");
					
					for(file_i = 0; file_i < count_input_files; file_i++){
						for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
							temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
						}
					}
					$(".total_before_file_size").html(temp_file_size);
					$(".total_after_file_size").html(total_file_size+temp_file_size);
			}
		}
		
		// ########### Document ############
		
		if(type == 'document'){
			if($.inArray(
				ext, 
				['doc','docx','xls','xlsx','ppt','pptx','pdf','csv']
			) == -1) {
					alert('นามสกุลเอกสารไม่ใช่เอกสาร โปรดทำใหม่');
					$("div.uploadfile div.row.file_"+file_id+" div.col-lg-12 input#fileattach[name=fileattach_"+type+file_id+"]").val("");
					
					for(file_i = 0; file_i < count_input_files; file_i++){
						for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
							temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
						}
					}
					$(".total_before_file_size").html(temp_file_size);
					$(".total_after_file_size").html(total_file_size+temp_file_size);
			}
		}
		
		// ########### Picture ############
		
		if(type == 'picture'){
			if($.inArray(
				ext, 
				['jpg','jpeg','gif','png']
			) == -1) {
					alert('นามสกุลเอกสารไม่ใช่รูปภาพ โปรดทำใหม่');
					$("div.uploadfile div.row.file_"+file_id+" div.col-lg-12 input#fileattach[name=fileattach_"+type+file_id+"]").val("");
					
					for(file_i = 0; file_i < count_input_files; file_i++){
						for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
							temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
						}
					}
					$(".total_before_file_size").html(temp_file_size);
					$(".total_after_file_size").html(total_file_size+temp_file_size);
			}
		}
	}
	
	$(".FileAttachDelete").click( function() {
		var file_ID = $(this).attr("data-File_ID");
		if (confirm("คุณแน่ใจว่าจะลบรายการ เลขที่เอกสาร = "+file_ID+" หรือไม่ ") == true) {
	        location.href="manageNewEditGROV?is_del_fileattach=1&File_ID="+file_ID;
	    }
	});
	
	$(function(){
        var selectmenu_txt = $("#Minis_ID").find("option:selected").text();
			$("#Minis_ID").prev("span").text(selectmenu_txt);
        selectmenu_txt = $("#Dep_ID").find("option:selected").text();
			$("#Dep_ID").prev("span").text(selectmenu_txt);
		selectmenu_txt = $("#NT05_PolicyID").find("option:selected").text();
			$("#NT05_PolicyID").prev("span").text(selectmenu_txt);
        selectmenu_txt = $("#Tar_ID").find("option:selected").text();
			$("#Tar_ID").prev("span").text(selectmenu_txt);
		selectmenu_txt = $("#grov_status").find("option:selected").text();
			$("#grov_status").prev("span").text(selectmenu_txt);
		selectmenu_txt = $("#prd_status").find("option:selected").text();
			$("#prd_status").prev("span").text(selectmenu_txt);
        
        $(".select-menu > select").live("change",function(){
            var selectmenu_txt = $(this).find("option:selected").text();
            $(this).prev("span").text(selectmenu_txt);
        });
    });
    
    function validateForm() {
		var create_date = document.forms["form_sendnew"]["create_date"].value;
		if (create_date==null || create_date=="") {
			alert("โปรดใส่ค่า ข่าววันที่");
			document.forms["form_sendnew"]["create_date"].focus();
			return false;
		}
		
		var SendIn_Plan = document.forms["form_sendnew"]["SendIn_Plan"].value;
		if (SendIn_Plan==null || SendIn_Plan=="") {
			alert("โปรดใส่ค่า แผนงานโครงการ/กิจกรรม");
			document.forms["form_sendnew"]["SendIn_Plan"].focus();
			return false;
		}
		
		var SendIn_Issue = document.forms["form_sendnew"]["SendIn_Issue"].value;
		if (SendIn_Issue==null || SendIn_Issue=="") {
			alert("โปรดใส่ค่า ประเด็นประชาสัมพันธ์");
			document.forms["form_sendnew"]["SendIn_Issue"].focus();
			return false;
		}
		
		var SendIn_Detail = document.getElementById("SendIn_Detail").value;
		
		if (SendIn_Detail==null || SendIn_Detail=="") {
			alert("โปรดใส่ค่า เนื้อหา");
			CKEDITOR.instances.SendIn_Detail.focus();
			return false;
		}
	}
    
</script>

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