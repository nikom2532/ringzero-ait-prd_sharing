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
<form name="form" action="manageNewPRD" method="post">
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
				<input type="text" class="form-control datepicker" name="NT01_UpdDate" id="InputKeyword" placeholder="" value="<?php 
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
					
				?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >ประเภทข่าว</label>
				<select name="NewsTypeID" id="NewsTypeID" class="form-control" style="width: 65%;">
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
				<select name="NewsSubTypeID" id="NewsSubTypeID" class="form-control" style="width: 65%;">
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
				<input type="text" class="form-control" name="NT01_NewsTitle" id="InputKeyword" placeholder="" value="<?php 
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
			<div class="col-lg-11">
				<label >เนื้อหาข่าว</label>
				<textarea class="ckeditor" name="NT01_NewsDesc"><?php 
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
				<input type="text" class="form-control" name="NT01_NewsSource" id="InputKeyword" placeholder="" <?php 
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
					
					
				?>>
			</div>
			<div class="col-lg-6">
				<label >อ้างอิงจาก</label>
				<input type="text" class="form-control" name="NT01_NewsReferance" id="InputKeyword" placeholder="" <?php 
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
				<label ><?php echo $news[2]->CamCoderName;  ?></label>
			</div>
			<div class="col-lg-6">
				<label >Tag</label>
				<input type="text" class="form-control" name="NT01_NewsTag" id="InputKeyword" value="<?php echo $news[0]->NT01_NewsTag; ?>" placeholder="" >
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
				<label >ไฟล์แนบ</label>
				<?php
					// var_dump($news[4]->NT11_FileStatus);
					// var_dump($news[3]);
					if(isset($news[3]->NT10_FileStatus)){
						if($news[3]->NT10_FileStatus == "Y"){
							?><img src="<?php echo base_url(); ?>images/icon/vdo.png" width="17" style="margin: -10px 10px 0;"> <?php
							// echo $news[3]->NT10_FileStatus."<br />";
							foreach ($news[3] as $vdo) {
								// var_dump($vdo);
								if(isset($vdo->NT10_FileStatus)){
									echo $vdo->NT10_VDOName."<br />";
								}
							}
						}
					}
					if(isset($news[4]->NT11_FileStatus)){
						if($news[4]->NT11_FileStatus == "Y"){
							?><img src="<?php echo base_url(); ?>images/icon/voice_512x512.png" width="17" style="margin: -10px 10px 0;"> <?php
							// echo $news[4]->NT12_FileStatus."<br />";
							foreach($news[4] as $vdo) {
								if(isset($vdo->NT12_FileStatus)){
									echo $vdo->NT12_VoiceName."<br />";
								}
							}
						}
					}
					if(isset($news[5]->NT12_FileStatus)){
						if($news[5]->NT12_FileStatus == "Y"){
							?><img src="<?php echo base_url(); ?>images/icon/Document.jpg" width="17" style="margin: -10px 10px 0;"> <?php
							// echo $news[5]->NT13_FileStatus."<br />";
							foreach ($news[5] as $vdo) {
								if(isset($vdo->NT13_FileStatus)){
									echo $vdo->NT13_FileName."<br />";
								}
							}
						}
					}
					if(isset($news[6]->NT13_FileStatus)){
						if($news[6]->NT13_FileStatus == "Y"){
							?><img src="<?php echo base_url(); ?>images/icon/like.png" width="17" style="margin: -10px 10px 0;"><?php
							// echo $news[6]->NT11_FileStatus."<br />";
							foreach ($news[6] as $vdo) {
								if(isset($vdo->NT11_FileStatus)){
									echo $vdo->NT11_PicName."<br />";
								}
							}
						}
					}
				?>
				<!-- <input type="text" class="form-control" id="InputKeyword" placeholder="" > -->
				<!-- <input class="bt" type="submit" name="share" value="BROWSE"> -->
			</div>
		</div>
	
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