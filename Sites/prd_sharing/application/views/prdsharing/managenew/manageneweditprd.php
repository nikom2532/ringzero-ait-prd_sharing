<script>
	$(function() {
		$( ".datepicker" ).datepicker();
	});
</script>
<?php
// var_dump($news[4]);
// foreach ($news as $key => $news_item) {
	// var_dump($news[$key]);
	// echo "1";
?>
<form name="form" action="<?php echo base_url().index_page(); ?>manageNewPRD" method="post">
	<input type="hidden" name="NT01_NewsID" value="<?php echo $news[0]->NT01_NewsID; ?>" />
	<input type="hidden" name="manageNewEditPRD_record" value="yes" />
	<input type="hidden" name="News_UpdateID" value="<?php echo $New_News[0]->News_UpdateID ; ?>" />
	<?php // var_dump($New_News); ?>
	<div id="manage-user" class="table-list">
		<div class="row">
			<div id="gove-title" class="row">
				News Information
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >ช่วงวันที่</label>
				<input type="text" class="form-control datepicker" name="NT01_UpdDate" id="NT01_UpdDate" placeholder=""  value="<?php 
					// if($news[0]->NT01_UpdDate == ""){
						// echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_CreDate));
					// }
					// else{
						// echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_UpdDate));
					// }
					
					/*
					if($news[0]->NT01_UpdDate == ""){
						foreach ($New_News as $New_News_item) {
							if($New_News_item->News_OldID ==  $news_item->NT01_NewsID){
								if($New_News_item->News_UpdateDate == ""){
									echo date("d/m/Y h:m:s", strtotime($New_News_item->News_Date));
								}
								else{
									echo date("d/m/Y h:m:s", strtotime($New_News_item->News_UpdateDate));
								}
							}
						}
						// echo date("d/m/Y h:m:s", strtotime($news_item->NT01_UpdDate));
					}
					else{
						foreach ($New_News as $New_News_item) {
							if($New_News_item->News_OldID == $news[0]->NT01_NewsID){
								
								if($New_News_item->News_UpdateDate == "" || $New_News_item->News_UpdateDate == null){
									if($New_News_item->News_Date > $news[0]->NT01_UpdDate){
										echo date("d/m/Y h:m:s", strtotime($New_News_item->News_Date));
									}
									else{
										echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_UpdDate));
									}
								}
								else{
									if($New_News_item->News_UpdateDate > $news[0]->NT01_UpdDate){
										echo date("d/m/Y h:m:s", strtotime($New_News_item->News_UpdateDate));
									}
									else{
										echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_UpdDate));
									}
								}
								
							}
						}
						// echo date("d/m/Y h:m:s", strtotime($news_item->NT01_CreDate));
					}
					*/
					echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_NewsDate));
				?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >ประเภทข่าว</label>
				<select name="NewsTypeID" id="NewsTypeID" class="form-control"  style="width: 65%;">
					<option value="">เลือกหมวดหมู่ข่าว</option><?php
					foreach ($NT02_NewsType as $newType_item) {
						?><option 
							value="<?php echo $newType_item->NT02_TypeID; ?>" <?php 
							if($newType_item->NT02_TypeID == $news[0]->NT02_TypeID){
								?>selected='checked'<?php
							}
						?>><?php echo $newType_item->NT02_TypeName; ?></option><?php
					}
				?></select>
			</div>
			<div class="col-lg-6">
				<label >ประเภทข่าวย่อย</label>
				<select name="NewsSubTypeID" id="NewsSubTypeID" class="form-control"  style="width: 65%;">
					<option value="">เลือกหมวดหมู่ข่าวย่อย</option><?php
					foreach ($NT03_NewsSubType as $newType_item) {
						if($newType_item->NT02_TypeID == $news[0]->NT02_TypeID){
							?><option 
								value="<?php echo $newType_item->NT03_SubTypeID; ?>" <?php
								if($newType_item->NT03_SubTypeID == $news[0]->NT03_SubTypeID){
									?>selected='checked'<?php
								}
							?>><?php echo $newType_item->NT03_SubTypeName; ?></option><?php
						}
					}
				?></select>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-lg-6">
				<label >ประเภทข่าวเพิ่มเติม</label>
				<select name="">
					<option value="">เลือกนโยบาย</option>
				</select>
			</div>
		</div> -->
		<div class="row">
			<div class="col-lg-6">
				<label >หัวข้อข่าว</label>
				<input type="text" class="form-control" name="NT01_NewsTitle" id="InputKeyword" placeholder=""  value="<?php 
					//echo $news[0]->NT01_NewsTitle; //echo $news[0]->News_Title; 
					
					$i_item=0;
					foreach ($New_News as $New_News_item) {
						if(
							$New_News_item->News_OldID ==  $news[0]->NT01_NewsID &&
							$New_News_item->News_UpdateID > 0
						){
								echo $New_News_item->News_Title;
								$i_item++;
						}
					}
					if($i_item == 0){
						echo $news[0]->NT01_NewsTitle; 
					}
					
				?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11" style="width: 80%; margin: 0 auto; ">
				<label >เนื้อหาข่าว</label>
				<textarea class="ckeditor" name="NT01_NewsDesc" ><?php 
					//echo $news[0]->NT01_NewsDesc //echo $news[0]->News_Detail; 
					
					
					$i_item=0;
					foreach ($New_News as $New_News_item) {
						if(
							$New_News_item->News_OldID ==  $news[0]->NT01_NewsID &&
							$New_News_item->News_UpdateID > 0
						){
								// echo htmldecode($New_News_item->News_Detail);
								echo $New_News_item->News_Detail;
								$i_item++;
						}
					}
					if($i_item == 0){
						// echo $this->helper->utility_helper->htmldecode($news[0]->NT01_NewsDesc); 
						echo ($news[0]->NT01_NewsDesc);
					}
					
				?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >แหล่งที่มา</label>
				<input type="text" class="form-control" name="NT01_NewsSource" id="InputKeyword" placeholder=""  value="<?php 
					//echo $news[0]->NT01_NewsSource //echo $news[0]->News_Resource; 
					
					// var_dump($New_News);
					
					$i_item=0;
					foreach ($New_News as $New_News_item) {
						if(
							$New_News_item->News_OldID ==  $news[0]->NT01_NewsID &&
							$New_News_item->News_UpdateID > 0
						){
								echo $New_News_item->News_Resource;
								$i_item++;
						}
					}
					if($i_item == 0){
						echo $news[0]->NT01_NewsSource; 
					}
					
					
				?>">
			</div>
			<div class="col-lg-6">
				<label >อ้างอิงจาก</label>
				<input type="text" class="form-control" name="NT01_NewsReferance" id="InputKeyword" placeholder=""  <?php 
					//echo $news[0]->NT01_NewsReferance; // echo $news[0]->News_Referance; 
					foreach ($New_News as $New_News_item) {
						if(
							$New_News_item->News_OldID ==  $news[0]->NT01_NewsID &&
							$New_News_item->News_UpdateID > 0
						){
								if(isset($New_News_item->News_Referance)){
									if($New_News_item->News_Referance != ""){
										echo $New_News_item->News_Referance;
									}
								}
								$i_item++;
						}
					}
					if($i_item == 0){
						echo $news[0]->NT01_NewsReferance; 
					}
				?>>
			</div>
		</div>
	
		<!-- <div class="row">
			<div class="col-lg-6">
				<label >Attach file</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" >
			</div>
		</div> -->
	
		<div class="row">
			<div class="col-lg-6">
				<label >ผู้สื่อข่าว</label>
				<label ><?php 
					// echo $news[0]->NT01_ReporterID; 
					echo $news[0]->ReporterName; 
				?></label>
			</div>
			<div class="col-lg-6">
				<label >ผู้ส่งข่าว</label>
				<label ><?php 
					// echo $news[0]->NT01_CreUserID; 
					echo $news[1]->CreUserName; 
				?></label>
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >ช่างภาพ</label>
				<label ><?php echo $news[2]->CamCoderName; ?></label>
			</div>
			<div class="col-lg-6">
				<label >Tag</label>
				<input type="text" class="form-control" name="NT01_NewsTag" id="InputKeyword"  value="<?php echo $news[0]->NT01_NewsTag; ?>" placeholder="" >
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >Version</label>
				<?php
					// if($news[0]->NT01_UpdDate == ""){
						// echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_CreDate));
					// }
					// else{
						// echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_UpdDate));
					// }
					
					if($news[0]->NT01_UpdDate == ""){
						foreach ($New_News as $New_News_item) {
							if($New_News_item->News_OldID ==  $news_item->NT01_NewsID){
								if($New_News_item->News_UpdateDate == ""){
									echo date("d/m/Y h:m:s", strtotime($New_News_item->News_Date));
								}
								else{
									echo date("d/m/Y h:m:s", strtotime($New_News_item->News_UpdateDate));
								}
							}
						}
						// echo date("d/m/Y h:m:s", strtotime($news_item->NT01_UpdDate));
					}
					else{
						foreach ($New_News as $New_News_item) {
							if($New_News_item->News_OldID == $news[0]->NT01_NewsID){
								
								if($New_News_item->News_UpdateDate == "" || $New_News_item->News_UpdateDate == null){
									if($New_News_item->News_Date > $news[0]->NT01_UpdDate){
										echo date("d/m/Y h:m:s", strtotime($New_News_item->News_Date));
									}
									else{
										echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_UpdDate));
									}
								}
								else{
									if($New_News_item->News_UpdateDate > $news[0]->NT01_UpdDate){
										echo date("d/m/Y h:m:s", strtotime($New_News_item->News_UpdateDate));
									}
									else{
										echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_UpdDate));
									}
								}
								
							}
						}
						// echo date("d/m/Y h:m:s", strtotime($news_item->NT01_CreDate));
					}
					
					echo " (";
					if(isset($news[1]->CreUserName)){
						echo $news[1]->CreUserName;
					}
					echo " ";
					if(isset($news[7]->ApvUserName)){
						echo $news[7]->ApvUserName;
					}
					echo ") ";
				?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-6">
				<label >สถานะ</label>
				<!-- <label >รอการอนุมัติ</label> -->
				<?php //echo $New_News[0]->News_StatusPublic; ?>
				<select name="News_StatusPublic" class="form-control" style="width: 65%;">
					<option value="0"<?php 
					
						// var_dump($New_News);
					
						if($New_News[0]->News_StatusPublic == '0' || $New_News[0]->News_StatusPublic == '' || $New_News[0]->News_StatusPublic == null){ 	
							?>selected='selected'<?php
						}
					?>>ไม่อนุมัติ</option>
					<option value="1"<?php 
						if($New_News[0]->News_StatusPublic == 1){
							?>selected='selected'<?php
						}
					?>>อนุมัติ</option>
				</select>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-lg-6">
				<label >ไฟล์แนบ</label>
			</div>
		</div>
		
				<?php
					
				if(isset($NT10_VDO)){
					
					foreach ($NT10_VDO as $item) {
						if(isset($item->NT10_FileStatus)){
							if($item->NT10_FileStatus == "Y"){
								?>
								<div class="row">
									<div class="col-lg-6" style="margin-left: 10%; ">
										<img src="<?php echo base_url(); ?>images/icon/vdo.png" width="17" style="margin: -10px 10px 0;"> <?php
										// echo $item->NT10_FileStatus."<br />";	
										echo $item->NT10_VDOName."<br />";
									?></div>
								</div><?php
							}
						}
					}
				}
					
				// var_dump($NT11_Picture);
				// exit;
				if(isset($NT11_Picture)){
					
					foreach ($NT11_Picture as $item) {
						if(isset($item->NT11_FileStatus)){
							if($item->NT11_FileStatus == "Y"){
								?><div class="row">
									<div class="col-lg-6" style="margin-left: 10%; ">
										<img src="<?php echo base_url(); ?>images/icon/pic.png" width="17" style="margin: -10px 10px 0;"> <?php
										// echo $item->NT12_FileStatus."<br />";
										echo $item->NT11_PicName."<br />";
									?></div>
								</div><?php
							}
						}
					}
				}
					
				if(isset($NT12_Voice)){
					
					foreach ($NT12_Voice as $item) {
						if($item->NT12_FileStatus == "Y"){
							?><div class="row">
								<div class="col-lg-6" style="margin-left: 10%; ">
									<img src="<?php echo base_url(); ?>images/icon/voice_512x512.png" width="17" style="margin: -10px 10px 0;"> <?php
									// echo $item->NT13_FileStatus."<br />";
									if(isset($item->NT12_FileStatus)){
										echo $item->NT12_VoiceName."<br />";
									}
								?></div>
							</div><?php
						}
					}
				}
				
				if(isset($NT12_Voice)){
					
					foreach ($NT12_Voice as $item) {
						if($item->NT13_FileStatus == "Y"){
							?><div class="row">
								<div class="col-lg-6" style="margin-left: 10%; ">
									<img src="<?php echo base_url(); ?>images/icon/Document.jpg" width="17" style="margin: -10px 10px 0;"><?php
									// echo $item->NT11_FileStatus."<br />";
									if(isset($item->NT13_FileStatus)){
										echo $item->NT13_FileName."<br />";
									}
								?></div>
							</div><?php
						}
					}
				}
				?>
				<!-- <input type="text" class="form-control" id="InputKeyword" placeholder="" > -->
				<!-- <input class="bt" type="submit" name="share" value="BROWSE"> -->
			</div>
		</div>
		
<?php
		/*
		$row = 0;
		foreach ($FileAttach as $FileAttach_item){
			
			?><div class="row" style="margin-bottom: 0; padding: 10px 10px; <?php
				if($row % 2 == 0){
					?>background-color: #fbfaf6<?php
				}
				else{
					?>background-color: #ededed<?php
				}
			?>"> 
				<div style="float: left; width: 80%; padding-left: 10%; ">
					<a style="text-decoration:none; text-decoration:none; " href="<?php echo base_url()."uploads/".$FileAttach_item->File_Name; ?>"><?php 
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
							strtolower($FileAttach_item->File_Extension) == ".docs"
						){
							?>Document.jpg<?php
						}
						else{
							?>Document.jpg<?php
						}
						?>" style="margin-right: 10px; " width="17"><?php 
						echo $FileAttach_item->File_Name; 
					?></a>
				</div>
			</div><?php
			$row++;
		}
		*/
?>
		
	
		<div class="col-lg-12" style="text-align: center;    float: left;">
			<input class="bt" type="submit" name="share" value="บันทึก">
			<input class="bt" type="submit" name="share" value="ยกเลิก">
		</div>
	</div><!-- #sentnews -->
</form>
<script>
	$('select#NewsTypeID').change(function(){
		// debugger;
	    var type_id = $('select#NewsTypeID').val();
		if (type_id != ""){
			var post_url = "<?php echo base_url(); ?>PRD_ManageNewPRD/get_NT02_TypeID/" + type_id;
			// debugger;
			// alert(post_url);
			$.ajax({
				type: "POST",
				url: post_url,
				dataType :'json',
				success: function(subtype)
				{
					// var a = JSON.parse(subtype);
					$('#NewsSubTypeID').empty();
					
					var text = "<option value=\"\">เลือกหมวดหมู่ข่าวย่อย</option>";
					$('#NewsSubTypeID').append(text);
					
					$.each(subtype,function(index,val)
					{
						var text = ""+
						"<option value=\""+val.NT03_SubTypeID+"\">"+val.NT03_SubTypeName+"</option>";
						$('#NewsSubTypeID').append(text);
					});
				} //end success
			}); //end AJAX
		} else {
			$('#NewsSubTypeID').empty();
		}//end if
	}); //end change 
</script>
<?php
// }
?>