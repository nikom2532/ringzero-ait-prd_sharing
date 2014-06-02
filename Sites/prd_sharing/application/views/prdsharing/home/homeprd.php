	<div class="row">
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;">
			PRD NEWS
		</p>
		<a href="homeGOVE">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
			Government Agencies
		</p></a>
	</div>
	<div class="row">
		<div class="header-table" style="text-align: right;">
			<img src="images/rss.png" style="margin: 10px 10px 0;text-align: right;">
		</div>
<?php
		//Start to count News's rows
		// var_dump($news);
		
		foreach($news as $news_item):
?>
		<div class="odd">
			<p class="col-1" style="width: 20%;float: left; "><?php
				if($news_item->NT01_UpdDate == ""){
					// foreach ($New_News as $New_News_item) {
						// if($New_News_item-> > $news_item->NT01_UpdDate)
					// }
					
					
					echo date("d/m/Y h:m:s", strtotime($news_item->NT01_UpdDate));
				}
				else{
					echo date("d/m/Y h:m:s", strtotime($news_item->NT01_CreDate));
				}
			?></p>
			<p class="col-2" style="width: 80%;float: left; ">
				<?php echo $news_item->NT01_NewsTitle; ?>
			</p>
		</div>
		<div class="event">
			<p class="col-1" style="width: 20%;float: left; ">
<?php
				if($news_item->NT01_ViewCount <= 0){
					$star_count = 0;
				}
				elseif($news_item->NT01_ViewCount <= 20){
					$star_count = 1;
				}
				elseif($news_item->NT01_ViewCount <= 40){
					$star_count = 2;
				}
				elseif($news_item->NT01_ViewCount <= 60){
					$star_count = 3;
				}
				elseif($news_item->NT01_ViewCount <= 80){
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
				ผู้สื่อข่าว: <?php echo $news_item->SC03_FName; ?></p>
			<p class="col-3" style="width: 20%;float: left; ">
				<img src="images/icon/view.png" style="margin: -10px 10px 0;">
				views: <?php 
					if($news_item->NT01_ViewCount == 0 || $news_item->NT01_ViewCount == ""){
						echo "0";
					}
					else{
						echo $news_item->NT01_ViewCount;
					}
			?></p>
			<p class="col-4" style="width: 20%;float: left; ">
				<a href="detail_prd?news_id=<?php echo $news_item->NT01_NewsID; ?>">open new link</a>
			</p>
			<p class="col-5" style="width: 20%;float: left;  text-align: center;">
				
				<img src="images/icon/<?php
					if($news_item->NT10_FileStatus == "Y"){ //Video
						?>vdo<?php
					}else{
						?>null<?php
					}
				?>.png" width="17" style="margin: -10px 10px 0;">
				
				<img src="images/icon/<?php 
					if($news_item->NT12_FileStatus){ //Voice
						?>voice_512x512<?php
					}else{
						?>null<?php
					}
				?>.png" width="17" style="margin: -10px 10px 0;">
				
				
				<img src="images/icon/<?php 
					if($news_item->NT13_FileStatus){ //Document
						?>Document.jpg<?php
					}else{
						?>null.png<?php
					}
				?>" width="17" style="margin: -10px 10px 0;">
				
				<img src="images/icon/<?php
					if($news_item->NT11_FileStatus){ //Picture
						?>pic<?php
					}else{
						?>null<?php
					}	
				?>.png" width="17" style="margin: -10px 10px 0;">
			</p>
		</div>
<?php
		endforeach;
		//End Count News's Row 
?>

		<p><?php //echo $links; ?></p>

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
				<a href="homePRD?paging=">
					<img src="images/table/next.png" style="margin: -5px 10px 0;">
				</a>
				<img src="images/table/end.png" style="margin: -5px 10px 0;">
			</p>
		</div> -->
	</div>
</div>