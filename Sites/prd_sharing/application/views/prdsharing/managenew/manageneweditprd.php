<script>
	$(function() {
		$( ".datepicker" ).datepicker();
	});
</script>
<?php
// var_dump($news[1]);
// foreach ($news as $key => $news_item) {
	// var_dump($news[$key]);
	// echo "1";
?>
<form name="form" action="manageNewPRD" method="post">
	<input type="hidden" name="NT01_NewsID" value="<?php echo $news[0]->NT01_NewsID; ?>" />
	<input type="hidden" name="manageNewEditPRD_record" value="yes" />
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
					if($news[0]->NT01_UpdDate == ""){
						echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_CreDate));
					}
					else{
						echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_UpdDate));
					}
				?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >ประเภทข่าว</label>
				<select name="">
					<option value="">เลือกประเภทข่าว</option>
				</select>
			</div>
			<div class="col-lg-6">
				<label >ประเภทข่าวย่อย</label>
				<select name="">
					<option value="">เลือกประเภทข่าวย่อย</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >ประเภทข่าวเพิ่มเติม</label>
				<select name="">
					<option value="">เลือกนโยบาย</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >หัวข้อข่าว</label>
				<input type="text" class="form-control" name="NT01_NewsTitle" id="InputKeyword" placeholder="" value="<?php echo $news[0]->NT01_NewsTitle; //echo $news[0]->News_Title; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11">
				<label >เนื้อหาข่าว</label>
				<textarea class="ckeditor" name="NT01_NewsDesc"><?php echo $news[0]->NT01_NewsDesc //echo $news[0]->News_Detail; ?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >แหล่งที่มา</label>
				<input type="text" class="form-control" name="NT01_NewsSource" id="InputKeyword" placeholder="" <?php echo $news[0]->NT01_NewsSource //echo $news[0]->News_Resource; ?>>
			</div>
			<div class="col-lg-6">
				<label >อ้างอิงจาก</label>
				<input type="text" class="form-control" name="NT01_NewsReferance" id="InputKeyword" placeholder="" <?php echo $news[0]->NT01_NewsReferance // echo $news[0]->News_Referance; ?>>
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
					if($news[0]->NT01_UpdDate == ""){
						echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_CreDate));
					}
					else{
						echo date("d/m/Y h:m:s", strtotime($news[0]->NT01_UpdDate));
					}
					echo " (".$news[1]->CreUserName." ".$news[7]->ApvUserName.") ";
				?>
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >ไฟล์แนบ</label>
				<?php
					if($news[3]->NT10_FileStatus == "Y"){
						?><img src="images/icon/vdo.png" width="17" style="margin: -10px 10px 0;"> <?php
						// echo $news[3]->NT10_FileStatus."<br />";
						foreach ($news[3] as $vdo) {
							echo $vdo->NT10_FileStatus."<br />";
						}
					}
					if($news[4]->NT11_FileStatus == "Y"){
						?><img src="images/icon/voice_512x512.png" width="17" style="margin: -10px 10px 0;"> <?php
						// echo $news[4]->NT12_FileStatus."<br />";
						foreach($news[4] as $vdo) {
							echo $vdo->NT12_FileStatus."<br />";
						}
					}
					if($news[5]->NT12_FileStatus == "Y"){
						?><img src="images/icon/Document.jpg" width="17" style="margin: -10px 10px 0;"> <?php
						// echo $news[5]->NT13_FileStatus."<br />";
						foreach ($news[5] as $vdo) {
							echo $vdo->NT13_FileStatus."<br />";
						}
					}
					if($news[6]->NT13_FileStatus == "Y"){
						?><img src="images/icon/like.png" width="17" style="margin: -10px 10px 0;"><?php
						// echo $news[6]->NT11_FileStatus."<br />";
						foreach ($news[6] as $vdo) {
							echo $vdo->NT13_FileStatus."<br />";
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
<?php
// }
?>