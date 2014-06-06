	<div class="row">
		<a href="homePRD">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;float: left;border: 1px solid #dcdcdc;">
			PRD NEWS
		</p></a>
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;margin-left: 10px;">
			Government Agencies
		</p>
	</div>
	<div class="row">
		<div class="header-table" style="text-align: right;">
			<img src="images/rss.png" style="margin: 10px 10px 0;text-align: right;">
		</div>
<?php
		// var_dump($news); 
		
		//Start to count News's rows
		foreach($news as $news_item){
?>
		<div class="odd">
			<p class="col-1" style="width: 20%;float: left; "><?php
				if($news_item->SendIn_UpdateDate != ""){
					// echo $news_item->SendIn_CreateDate;
					echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_CreateDate));
				}
				else{
					// echo $news_item->SendIn_CreateDate;
					echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_UpdateDate));
				}
				
			?></p>
			<p class="col-2" style="width: 80%;float: left; ">
				<?php echo $news_item->SendIn_Issue; ?>
			</p>
		</div>
		<div class="event">
			<p class="col-1" style="width: 20%;float: left; ">
<?php
				if($news_item->SendIn_view <= 0){
					$star_count = 0;
				}
				elseif($news_item->SendIn_view <= 20){
					$star_count = 1;
				}
				elseif($news_item->SendIn_view <= 40){
					$star_count = 2;
				}
				elseif($news_item->SendIn_view <= 60){
					$star_count = 3;
				}
				elseif($news_item->SendIn_view <= 80){
					$star_count = 4;
				}
				else{
					$star_count = 5;
				}
				$star_count_less = 5 - $star_count;
				for ($i=0; $i < $star_count; $i++) {
					?><img src="images/icon/star-on-big.png" width="16" />&nbsp;<?php
				}
				for ($i=0; $i < $star_count_less; $i++) { 
					?><img src="images/icon/star-off-big.png" width="16" />&nbsp;<?php
				}
?>
			</p>
			<p class="col-2" style="width: 20%;float: left; ">
				<img src="images/icon/people.png" style="margin: -10px 10px 0;">
				ผู้สื่อข่าว: <?php //echo $news_item->Mem_ID; ?>
			</p>
			<p class="col-3" style="width: 20%;float: left; ">
				<img src="images/icon/view.png" style="margin: -10px 10px 0;">
				views:  <?php 
					echo $news_item->SendIn_view;
			?></p>
			<p class="col-4" style="width: 20%;float: left; ">
				<a href="detail_grov?sendinformation_id=<?php echo $news_item->SendIn_ID; ?>">open new link</a>
			</p>
			<p class="col-5" style="width: 20%;float: left;  text-align: center;">
				<img src="images/icon/<?php 
					if($news_item->File_Status == '1'){
						?>vdo<?php
					}else{
						?>null<?php
					}
				?>.png" style="margin: -10px 10px 0;">
				
				<img src="images/icon/<?php 
					if($news_item->File_Status == '2'){
						?>voice_512x512<?php
					}else{
						?>null<?php
					}
				?>.png" style="margin: -10px 10px 0;">
				
				
				<img src="images/icon/<?php 
					if($news_item->File_Status == '3'){
						?>Document.jpg<?php
					}else{
						?>null.png<?php
					}
				?>" style="margin: -10px 10px 0;">
				
				<img src="images/icon/<?php
					if($news_item->File_Status == '4'){
						?>like<?php
					}else{
						?>null<?php
					}
				?>.png" style="margin: -10px 10px 0;">
			</p>
		</div>
<?php
		//End Count News's Row 
		} // endforeach;
?>
		<p><?php // echo $links; ?></p>
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