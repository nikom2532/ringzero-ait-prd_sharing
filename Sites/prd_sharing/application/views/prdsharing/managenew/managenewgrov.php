<script>
	$(function() {
		$( ".datepicker" ).datepicker();
	});
</script>
<div id="search-form">
	<div class="row">
		<div class="col-lg-12">
			<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
			<input class="txt-field" type="text" value="" name="date-from"  placeholder="" style=" margin-left: 15px;width: 77%;">
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<label >วันที่</label>
			<input type="text" class="form-control datepicker" id="InputKeyword" placeholder="" >
		</div>
		<div class="col-lg-6">
			<label >ถึง</label>
			<input type="text" class="form-control datepicker" id="InputKeyword" placeholder="" >
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<!-- Ministry  -->
			<label >กระทรวง</label>
			
			
			<select name="Ministry_ID" class="form-control" style="width: 65%;"><?php
				foreach ($ministry as $ministry_item) {
					?><option value="<?php echo $ministry_item->Minis_ID; ?>"><?php echo $ministry_item->Minis_Name; ?></option><?php
				}
			?></select>
			
			
		</div>
		<div class="col-lg-6">
			<!-- department -->
			<label >กรม</label>
			
			<select name="Dep_ID" class="form-control" style="width: 65%;"><?php
				foreach ($department as $department_item) {
					?><option value="<?php echo $department_item->Dep_ID; ?>"><?php echo $department_item->Dep_Name; ?></option><?php
				}
			?></select>
			
			
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<!--<label >ผู้สื่อข่าว</label>
			<input type="text" class="form-control" id="InputKeyword" placeholder="" >-->
		</div>
		<div style="float: right;margin-right: 5%;width: 45%;">
			<label style=" margin-left: 11%;">ไฟล์ประกอบข่าว</label>
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
		<a href="manageNewPRD">
		<p style=" border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;float: left;border: 1px solid #dcdcdc;">
			PRD NEWS
		</p></a>
		<p style=" border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;margin-left: 10px;">
			Government Agencies
		</p>
	</div>
	<div class="row">
		<div class="header-table" style="text-align: right;">
			<p class="col-1" style="width: 6%;float: left; "></p>
			<p class="col-2" style="width: 14%;float: left; ">
				เลขที่ข่าว
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				สภานะ
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				ลบ
			</p>
			<p class="col-1" style="width: 35%;float: left; ">
				ประเด็นประชาสัมพันธ์
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				วันที่
			</p>
			<p class="col-3" style="width: 25%;float: left; ">
				Icon ไฟล์แนบ
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
				<p class="col-1" style="width: 6%;float: left; ">
					<?php echo $i++; ?>
				</p>
				<p class="col-2" style="width: 14%;float: left; ">
					<a href="manageNewEditGROV" ><?php echo $news_item->SendIn_ID; ?> </a>
				</p>
				<p class="col-1" style="width: 5%;float: left; "><img src="images/icon/like.png" style="margin: -5px 10px 0;">
				</p>
				<p class="col-1" style="width: 5%;float: left; "><img src="images/icon/delete.png" style="margin: -5px 10px 0;">
				</p>
				<p class="col-1" style="width: 35%;float: left; ">
					<?php //echo $news_item->SendIn_Issues; ?>
				</p>
				<p class="col-1" style="width: 10%;float: left; "><?php
					if($news_item->SendIn_UpdateDate != ""){
						echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_UpdateDate));
					}
					else{
						echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_CreateDate));
					}
				?></p>
				<p class="col-3" style="width: 25%;float: left; ">
					<img src="images/icon/vdo.png" width="17" style="margin: -10px 10px 0;">
                    <img src="images/icon/voice_512x512.png" width="17" style="margin: -10px 10px 0;">
                    <img src="images/icon/Document.jpg" width="17" style="margin: -10px 10px 0;">
                    <img src="images/icon/like.png" width="17" style="margin: -10px 10px 0;">
				</p>
			</div>
<?php
		$i++;
	endforeach;
	//End Count News's Row 
?>
	<!-- <div class="footer-table">
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
	</div> -->
</div>
</div>