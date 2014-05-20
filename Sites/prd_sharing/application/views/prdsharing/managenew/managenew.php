	<div class="row">
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;">
			PRD NEWS
		</p>
		<a href="homeGOVE">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
			Government Agencies
		</p></a>
	</div>
	<div class="table-list">
		<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
		<!--<div class="row" style="margin-top: 20px;">
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 10%;text-align:center;float: left;">PRD NEWS</p>
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">Government Agencies</p>
		</div>-->
		<div class="row" style="margin-top: 20px;">
			<div class="header-table" style="text-align: right;">
				<p class="col-1" style="width: 10%;float: left; "></p>
				<p class="col-2" style="width: 10%;float: left; ">
					เลขที่ข่าว
				</p>
				<p class="col-1" style="width: 5%;float: left; ">
					สภานะ
				</p>
				<p class="col-1" style="width: 5%;float: left; ">
					ลบ
				</p>
				<p class="col-1" style="width: 40%;float: left; ">
					หัวข้อข่าว
				</p>
				<p class="col-1" style="width: 5%;float: left; ">
					วันที่ข่าว
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
					?><p class="col-1" style="width: 4%;float: left; ">
						<?php echo $i+1; ?>
					</p>
					<p class="col-2" style="width: 16%;float: left; ">
						<a href="detail" ><?php echo $news_item->NT01_NewsID; ?></a>
					</p>
					<p class="col-1" style="width: 5%;float: left; "><img src="images/icon/like.png" style="margin: -10px 10px 0;">
					</p>
					<p class="col-1" style="width: 5%;float: left; "><img src="images/icon/delete.png" style="margin: -5px 10px 0;">
					</p>
					<p class="col-1" style="width: 40%;float: left; ">
						<?php echo $news_item->NT01_NewsTitle; ?>
					</p>
					<p class="col-1" style="width: 5%;float: left; "><?php
						// if($news_item->NT01_UpdDate == ""){
							// echo $news_item->NT01_CreDate; 
						// }
						// else{
							// echo $news_item->NT01_UpdDate;
						// }
					?></p>
					<p class="col-4" style="width: 25%;float: left;  text-align: center;">
						<img src="images/icon/vdo.png" style="margin: -10px 10px 0;">
						<img src="images/icon/pic.png" style="margin: -10px 10px 0;">
						<img src="images/icon/null.png" style="margin: -10px 10px 0;">
						<img src="images/icon/null.png" style="margin: -10px 10px 0;">
					</p>
				</div>
<?php
			$i++;
		endforeach;
		//End Count News's Row 
?>
			<p><?php // echo $links; ?></p>
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
</div>