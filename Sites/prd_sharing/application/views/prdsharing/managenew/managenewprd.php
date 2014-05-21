<div id="search-form">

	<div class="row">
		<div class="col-lg-12">
			<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
			<input class="txt-field" type="text" value="" name="news_title"  placeholder="" style=" margin-left: 15px;width: 77%;">
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<label >วันที่</label>
			<input type="text" class="form-control" name="start_date" id="InputKeyword" placeholder="" >
		</div>
		<div class="col-lg-6">
			<label >ถึง</label>
			<input type="text" class="form-control" name="end_date" id="InputKeyword" placeholder="" >
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<label >หมวดหมู่ข่าว</label>
			<input type="text" class="form-control" id="InputKeyword" placeholder="" >
		</div>
		<div class="col-lg-6">
			<label >หมวดหมู่ข่าวย่อย</label>
			<input type="text" class="form-control" id="InputKeyword" placeholder="" >
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div style="float: left;width: 30%;">
				<label style="width: 100%;" >ผู้สื่อข่าว</label>
			</div>
			<div style="margin-left: 2%;float: left;">
				<img src="images/icon/sh.png" style="margin: -5px 10px 0;">
				<img src="images/icon/delete.png" style="margin: -5px 10px 0;">
			</div>
		</div>
		<div style="float: left;margin-right: 5%;width: 45%;">
			<label style="margin-left: 11%;">ไฟล์ประกอบข่าว</label>
			<input type="checkbox" name="vdo" value="0">
			วิดีโอ
			<input type="checkbox" name="sound" value="1">
			เสียง
			<input type="checkbox" name="image" value="2">
			ภาพ
			<input type="checkbox" name="other" value="3">
			อื่นๆ
		</div>
	</div>

	<div class="col-lg-12" style="text-align: center;">
		<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:18%;padding: 4px;">
	</div>

</div>

<div class="table-list">
	<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
	<div class="row" style="margin-top: 20px;">
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;">
			PRD NEWS
		</p>
		<a href="manageNewGROV">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
			Government Agencies
		</p></a>
	</div>
	<div class="row">
		<div class="header-table" style="text-align: right;">
			<p class="col-1" style="width: 4%;float: left; "></p>
			<p class="col-2" style="width: 16%;float: left; ">
				เลขที่ข่าว
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				สภานะ
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				ลบ
			</p>
			<p class="col-1" style="width: 35%;float: left; ">
				หัวข้อข่าว
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				วันที่ข่าว
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				แหล่งข่าว
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				สายข่าว
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				ผู้สื่อข่าว
			</p>
		</div>
<?php
		//Start to count News's rows
		$i=0;
		foreach($news as $news_item):
			if($i % 2 == 0){
				?><div class="odd"><?php
			}
			elseif($i % 2 == 1){
				?><div class="event"><?php
			}
?>
					<p class="col-1" style="width: 4%;float: left; ">
						<?php echo $i+1; ?>
					</p>
					<p class="col-2" style="width: 16%;float: left; ">
						<a href="manageNewEditPRD" ><?php echo $news_item->NT01_NewsID; ?></a>
					</p>
					<p class="col-1" style="width: 5%;float: left; "><img src="images/icon/like.png" style="margin: -5px 10px 0;">
					</p>
					<p class="col-1" style="width: 5%;float: left; "><img src="images/icon/delete.png" style="margin: -5px 10px 0;">
					</p>
					<p class="col-1" style="width: 35%;float: left; ">
						<?php echo $news_item->NT01_NewsTitle; ?>
					</p>
					<p class="col-1" style="width: 10%;float: left; "><?php
						if($news_item->NT01_UpdDate == ""){
							echo date("d/m/Y h:m:s", strtotime($news_item->NT01_CreDate));
						}
						else{
							echo date("d/m/Y h:m:s", strtotime($news_item->NT01_UpdDate));
						}
					?></p>
					<p class="col-1" style="width: 10%;float: left; ">
						<?php $news_item->NT01_NewsSource; ?>
					</p>
					<p class="col-1" style="width: 5%;float: left; ">
						<?php $news_item->NT01_NewsReferance; ?>
					</p>
					<p class="col-1" style="width: 10%;float: left; "><?php 
						if($news_item->NT01_UpdUserID == ""){
							echo $news_item->NT01_CreUserID;
						}
						else{
							echo $news_item->NT01_UpdUserID;
						}
					?></p>
				</div>
<?php
			$i++;
		endforeach;
		//End Count News's Row 
?>
		<div class="footer-table">
			<p style="width: 70%;float: left;margin-top: 20px;">
				ทั้งหมด: 73 รายการ (4หน้า)
			</p>
			<p style="width: 30%;float: left;margin-top: 20px;text-align: right;">
				<img src="images/table/pev.png" style="margin: -5px 10px 0;">
				<span style="margin-top: 10px;">
					<select style="">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select> / 100</span>
				<img src="images/table/next.png" style="margin: -5px 10px 0;">
				<img src="images/table/end.png" style="margin: -5px 10px 0;">
			</p>
		</div>
	</div>
</div>