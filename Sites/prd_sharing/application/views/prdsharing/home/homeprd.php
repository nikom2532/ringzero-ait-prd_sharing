	<div class="row">
		<?php 
			//For Test
			// echo $news->News_Title;
			// var_dump($news);
		?>
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
?>
		<div class="odd">
			<p class="col-1" style="width: 10%;float: left; ">
				<?php echo $news->News_ID; ?>
			</p>
			<p class="col-2" style="width: 90%;float: left; ">
				<?php echo $news->News_Title; ?>
			</p>
		</div>
		<div class="event">
			<p class="col-1" style="width: 20%;float: left; ">
				
			</p>
			<p class="col-2" style="width: 20%;float: left; ">
				<img src="images/icon/people.png" style="margin: -10px 10px 0;">
				ผู้สื่นข่าว:
			</p>
			<p class="col-3" style="width: 20%;float: left; ">
				<img src="images/icon/view.png" style="margin: -10px 10px 0;">
				views: <?php 
					echo $news->News_View;
				?>
			</p>
			<p class="col-4" style="width: 20%;float: left; ">
				<a href="detail">open new link</a>
			</p>
			<p class="col-5" style="width: 20%;float: left;  text-align: center;">
				
				<img src="images/icon/<?php 
					if($news->News_StatusVDO){
						?>vdo<?php
					}else{
						?>null<?php
					}
				?>.png" style="margin: -10px 10px 0;">
				
				<img src="images/icon/<?php 
					if($news->News_StatusVoice){
						?>pic<?php
					}else{
						?>null<?php
					}
				?>.png" style="margin: -10px 10px 0;">
				
				
				<img src="images/icon/<?php 
					if($news->News_StatusOtherFile){
						?>sh<?php
					}else{
						?>null<?php
					}
				?>.png" style="margin: -10px 10px 0;">
				
				<img src="images/icon/<?php
					if($news->News_StatusPublic){
						?>like<?php
					}else{
						?>null<?php
					}
				?>.png" style="margin: -10px 10px 0;">
			</p>
		</div>
<?php
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