<script>
	$(function() {
		$( ".datepicker" ).datepicker();
	});
</script>
<?php
foreach ($news as $news_item) {
?>
	<div id="manage-user" class="table-list">
		<div class="row">
			<div id="gove-title" class="row">
				News Information
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >ช่วงวันที่</label>
				<input type="text" class="form-control datepicker" id="InputKeyword" placeholder="" value="<?php 
					if($news_item->NT01_UpdDate == ""){
						echo date("d/m/Y h:m:s", strtotime($news_item->NT01_CreDate));
					}
					else{
						echo date("d/m/Y h:m:s", strtotime($news_item->NT01_UpdDate));
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
				<input type="text" class="form-control" id="InputKeyword" placeholder="" value="<?php echo $news_item->NT01_NewsTitle; //echo $news_item->News_Title; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11">
				<label >เนื้อหาข่าว</label>
				<textarea class="ckeditor" name="editor1"><?php echo $news_item->NT01_NewsDesc //echo $news_item->News_Desc; ?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >แหล่งที่มา</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" <?php echo $news_item->NT01_NewsSource //echo $news_item->News_Source; ?>>
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >Attach file</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" >
			</div>
			<div class="col-lg-6">
				<label >อ้างอิงจาก</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" <?php echo $news_item->NT01_NewsReferance // echo $news_item->News_Referance; ?>>
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >ผู้สื่อข่าว</label>
				<label ><?php echo $news_item->NT01_ReporterID; ?></label>
			</div>
			<div class="col-lg-6">
				<label >ผู้ส่งข่าว</label>
				<label ><?php echo $news_item->NT01_CreUserID; ?></label>
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >ช่างภาพ</label>
				<label >xxxxxxx xxxxxxx</label>
			</div>
			<div class="col-lg-6">
				<label >Tag</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" >
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >Version</label>
				<label >xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</label>
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >ไฟล์แนบ</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" >
				<input class="bt" type="submit" name="share" value="BROWSE">
			</div>
		</div>
	
		<div class="col-lg-12" style="text-align: center;    float: left;">
			<input class="bt" type="submit" name="share" value="บันทึก">
			<input class="bt" type="submit" name="share" value="ยกเลิก">
		</div>
	
	</div><!-- #sentnews -->
<?php
}
?>