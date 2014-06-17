	<div class="row">
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;">
			PRD NEWS
		</p>
		<a href="<?php echo base_url(); ?>homeGOVE">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
			Government Agencies
		</p></a>
	</div>
	<div class="row">
		<div class="header-table" style="text-align: right;">
			<img src="<?php echo base_url(); ?>images/rss.png" style="margin: 10px 10px 0;text-align: right;">
		</div>
<?php
		//Start to count News's rows
		// var_dump($news);
		$countNews=0;
		// var_dump($news);
		foreach($news as $news_item):	
?>
			<div class="odd">
				<p class="col-1" style="width: 20%; float: left; "><?php
					if($news_item->NT01_UpdDate == ""){
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
							if($New_News_item->News_OldID == $news_item->NT01_NewsID){
								
								if($New_News_item->News_UpdateDate == "" || $New_News_item->News_UpdateDate == null){
									if($New_News_item->News_Date > $news_item->NT01_UpdDate){
										echo date("d/m/Y h:m:s", strtotime($New_News_item->News_Date));
									}
									else{
										echo date("d/m/Y h:m:s", strtotime($news_item->NT01_UpdDate));
									}
								}
								else{
									if($New_News_item->News_UpdateDate > $news_item->NT01_UpdDate){
										echo date("d/m/Y h:m:s", strtotime($New_News_item->News_UpdateDate));
									}
									else{
										echo date("d/m/Y h:m:s", strtotime($news_item->NT01_UpdDate));
									}
								}
								
							}
						}
						// echo date("d/m/Y h:m:s", strtotime($news_item->NT01_CreDate));
					}
				?></p>
				<p class="col-2" style="width: 80%;float: left; ">
<?php
					$i=0;
					foreach ($New_News as $New_News_item) {
						if(
							$New_News_item->News_OldID ==  $news_item->NT01_NewsID &&
							$New_News_item->News_UpdateID > 0
						){
								echo $New_News_item->News_Title;
								$i++;
						}
					}
					if($i == 0){
						echo $news_item->NT01_NewsTitle; 
					}
?>
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
						?><img src="<?php echo base_url(); ?>images/icon/star-on-big.png" width="16" />&nbsp;<?php
					}
					for ($i=0; $i < $star_count_less; $i++) {
						?><img src="<?php echo base_url(); ?>images/icon/star-off-big.png" width="16" />&nbsp;<?php
					}
?>
				</p>
				<p class="col-2" style="width: 20%;float: left; ">
					<img src="<?php echo base_url(); ?>images/icon/people.png" style="margin: -10px 10px 0;">
					ผู้สื่อข่าว: <?php echo $news_item->SC03_FName; ?></p>
				<p class="col-3" style="width: 20%;float: left; ">
					<img src="<?php echo base_url(); ?>images/icon/view.png" style="margin: -10px 10px 0;">
					views: <?php 
						if($news_item->NT01_ViewCount == 0 || $news_item->NT01_ViewCount == ""){
							echo "0";
						}
						else{
							echo $news_item->NT01_ViewCount;
						}
				?></p>
				<p class="col-4" style="width: 20%;float: left; ">
					<a href="<?php echo base_url(); ?>detail_prd?news_id=<?php echo $news_item->NT01_NewsID; ?>">open new link</a>
				</p>
				
				<p class="col-5" style="width: 20%;float: left;  text-align: center;">
					
					<img src="<?php echo base_url(); ?>images/icon/<?php
						if($news_item->NT10_FileStatus == "Y"){ //Video
							?>vdo<?php
						}else{
							?>null<?php
						}
					?>.png" width="17" style="margin: -10px 10px 0;">
					
					<img src="<?php echo base_url(); ?>images/icon/<?php 
						if($news_item->NT12_FileStatus == 'Y'){ //Voice
							?>voice_512x512<?php
						}else{
							?>null<?php
						}
					?>.png" width="17" style="margin: -10px 10px 0;">
					
					
					<img src="<?php echo base_url(); ?>images/icon/<?php 
						if($news_item->NT13_FileStatus == 'Y'){ //Document
							?>Document.jpg<?php
						}else{
							?>null.png<?php
						}
					?>" width="17" style="margin: -10px 10px 0;">
					
					<img src="<?php echo base_url(); ?>images/icon/<?php
						if($news_item->NT11_FileStatus == 'Y'){ //Picture
							?>pic<?php
						}else{
							?>null<?php
						}
					?>.png" width="17" style="margin: -10px 10px 0;">
				</p>
				
			</div>
<?php
			$countNews++;
		endforeach;
		//End Count News's Row 
		
		if($countNews == 0){
?>
			<div class="news-form" style="color: red; text-align: center;">ไม่มีข้อความ</div>
<?php
		}
?>
			<!-- <link href="<?php echo base_url(); ?>assets/css/style-report.css" rel="stylesheet" type="text/css"> -->
			<div class="footer-table">
            	<p style="width: 70%;float: left;margin-top: 20px;">
					<span><?php echo "ทั้งหมด : ".$count_row." รายการ (".$total_page." หน้า )"; ?></span>
				</p>
                
                <p style="width: 30%;float: left;margin-top: 20px;text-align: right;">
                	<a href="javascript:firstPage()"><img src="<?php echo base_url(); ?>img/prew.png"></a>
                	<a href="javascript:prevPage('<?php echo $current_page; ?>')"><img src="<?php echo base_url(); ?>img/prev.png"></a>
                    <span style="margin-top: 10px;">
						<!-- <span><?php //echo $current_page; ?></span> -->
						<select onchange="jump_page(this.value)">
<?php 
							// var_dump($page_url);
							foreach ($page_url as $item) {
								?><option value="<?php echo $item['value']; ?>" <?php echo $item['selected']; ?>><?php echo $item['value']; ?></option><?php
							}
?>
						</select> / <?php echo $total_page; ?>
                    </span>
                    <a href="javascript:nextPage('<?php echo $current_page; ?>')"><img src="<?php echo base_url(); ?>img/next.png"></a>
                    <a href="javascript:lastPage('<?php echo $total_page; ?>')"><img src="<?php echo base_url(); ?>img/next2.png"></a>
                </p>
            </div>
            
			<?php /* <div class="footer-table">
				<p style="width: 70%;float: left;margin-top: 20px;">
					ทั้งหมด:  รายการ ( หน้า)
				</p>
				<p style="width: 30%;float: left;margin-top: 20px;text-align: right;">
					<img src="<?php echo base_url(); ?>images/table/pev.png" style="margin: -5px 10px 0;">
					<span style="margin-top: 10px;">
						<select style="">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select> / 100</span>
					<a href="<?php echo base_url(); ?>homePRD?paging=">
						<img src="<?php echo base_url(); ?>images/table/next.png" style="margin: -5px 10px 0;">
					</a>
					<img src="<?php echo base_url(); ?>images/table/end.png" style="margin: -5px 10px 0;">
				</p>
			</div> */ ?>
		
            <script>
            	
            	function jump_page(val){
					location='<?php echo $jump_url; ?>/'+val;
				}
				function nextPage(val){
					// debugger;
					var nextpage = parseInt(val)+1;
					if(<?php echo $total_page; ?>==val){
						nextpage = val;
					}
					$("#homeSearch").attr("action","<?php echo base_url().$home_search; ?>/"+nextpage);
					$("#homeSearch").submit();
				}
				function lastPage(val){
					$("#homeSearch").attr("action","<?php echo base_url().$home_search; ?>/"+val);
					$("#homeSearch").submit();
				}
				function prevPage(val){
					var prevpage = parseInt(val)-1;
					$("#homeSearch").attr("action","<?php echo base_url().$home_search; ?>/"+prevpage);
					$("#homeSearch").submit();
				}
				function firstPage(){
					$("#homeSearch").attr("action","<?php echo base_url().$home_search; ?>/1");
					$("#homeSearch").submit();
				}
				
            </script>
            
            
	</div>
</div>