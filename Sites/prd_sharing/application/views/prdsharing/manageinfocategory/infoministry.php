<div class="content">
	<div id="share-form">
		<form name="form" action="<?php echo base_url().index_page(); ?>manageInfo_Ministry" method="post">
			<input type="hidden" name="info_ministry_is_submit" value="yes" />
<?php
			// var_dump($ministry);
			foreach ($ministry as $ministry_item) {
				// var_dump($ministry_item->Minis_ID);
				
?>
				<input type="hidden" name="minis_id" value="<?php echo $ministry_item->Minis_ID; ?>" />
				<div class="row" id="gove-title">
					รายละเอียดข้อมูล
				</div>
		
				<div id="manage-info">
					<div id="search-form">
						<div class="row">
							<div class="col-lg-12">
								<label >ลำดับที่:</label>
								<span class="number"><?php echo $ministry_item->Minis_ID; ?></span>
							</div>
							<div class="col-lg-12">
								<label >ชื่อกระทรวง:</label>
								<input type="text" class="form-control txt-field" name="minis_name" id="InputKeyword" value="<?php echo $ministry_item->Minis_Name; ?>" placeholder="" required="required">
							</div>
							<div class="col-lg-12">
								<label >รายละเอียด:</label>
								<textarea rows="4" cols="50" name="minis_desc" class="txt-area" required="required"><?php echo $ministry_item->Minis_Desc; ?></textarea>
							</div>
							<div class="col-lg-12">
								<label >สถานะการใช้งาน:</label>
								<select class="select-opt" name="minis_status">
									<option value="1" <?php if($ministry_item->Minis_Status == "1"){ ?>selected=''<?php } ?>>ใช้งานได้</option>
									<option value="0" <?php if($ministry_item->Minis_Status == "0"){ ?>selected=''<?php } ?>>ใช้งานไม่ได้</option>
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
<?php
			}
?>
		</form>
	</div>
</div>
