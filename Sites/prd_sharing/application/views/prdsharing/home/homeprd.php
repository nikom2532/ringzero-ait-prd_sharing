	<div class="row">
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;">
			PRD NEWS
		</p>
		<a href="<?php echo base_url().index_page(); ?>homeGOVE">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
			Government Agencies
		</p></a>
	</div>
	<div class="row">
		<table width="100%">
			<tr class="header-table" style="text-align: right;">
				<td>
					<img src="<?php echo base_url(); ?>images/rss.png" style="margin: 10px 10px 0;text-align: right; cursor: pointer; " id="makeRss">
				</td>
			</tr>
			<?php
				$countNews=0;
				foreach ($news as $news_item) {
			?>
			<tr class="odd">
				<td>
					<p class="col-1" style="width: 18%; float: left; padding-left: 2%; "><?php echo date("d/m/Y h:m:s", strtotime($news_item->NT01_NewsDate));?></p>
					<p class="col-2" style="width: 80%;float: left; ">
			<?php
					$i=0;
					foreach ($New_News as $New_News_item) {
						if(
							$New_News_item->News_OldID ==  $news_item->NT01_NewsID &&
							$New_News_item->News_UpdateID > 0
						){
								// echo $New_News_item->News_Title;
								
								$News_Title = $New_News_item->News_Title;
								if(mb_strlen($News_Title)>=150){
									$News_Title = mb_substr($News_Title, 0, 150, 'UTF-8')."...";
								}
								echo $News_Title;
								$i++;
						}
					}
					if($i == 0){
						// echo $news_item->NT01_NewsTitle; 
						
						$News_Title = $news_item->NT01_NewsTitle;
						if(mb_strlen($News_Title)>=150){
							$News_Title = mb_substr($News_Title, 0, 150, 'UTF-8')."...";
						}
						echo $News_Title;
						$i++;
					}
				?>
				</p>
				</td>
			</tr>
			<tr class="event">
				<td>
					<p class="col-1" style="width: 18%;float: left; padding-left: 2%; ">
					<?php
					foreach ($New_News as $New_News_item) {
						if($New_News_item->News_OldID == $news_item->NT01_NewsID){
							
							if($New_News_item->News_View == 0 || $New_News_item->News_View == "" || $New_News_item->News_View == null){
								$views = 0;
							}
							else{
								$views = $New_News_item->News_View;
							}
						
						}
					}

					if($views <= 0){
						$star_count = 0;
					}
					elseif($views <= 20){
						$star_count = 1;
					}
					elseif($views <= 40){
						$star_count = 2;
					}
					elseif($views <= 60){
						$star_count = 3;
					}
					elseif($views <= 80){
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
						echo $views;
				?></p>
				<p class="col-4" style="width: 20%;float: left; ">
					<a href="<?php echo base_url().index_page(); ?>detail_prd?news_id=<?php echo $news_item->NT01_NewsID; ?>" target="_blank">open new link</a>
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
				</td>
			</tr>
			<?php		
				}
			?>
		</table>
	</div>
<?php
		//Start to count News's rows
		// var_dump($news);
		$countNews=0;
		// var_dump($news);
		foreach($news as $news_item):	
?>
			
			
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
			<div class="footer-table">
            	<p style="width: 70%;float: left;margin-top: 20px;">
					<span><?php echo "ทั้งหมด : ".$count_row." รายการ (".$total_page." หน้า )"; ?></span>
				</p>
                
                <p style="width: 30%;float: left;margin-top: 20px;text-align: right;">
                	<a href="javascript:firstPage()"><img src="<?php echo base_url(); ?>img/prew.png"></a><?php
                	if($current_page != 1){
                		?> <a href="javascript:prevPage('<?php echo $current_page; ?>')"><img src="<?php echo base_url(); ?>img/prev.png"></a><?php
					}
                    ?><span style="margin-top: 10px;">
						<!-- <span><?php //echo $current_page; ?></span> -->
						<select onchange="jump_page(this.value)">
<?php 
							// var_dump($page_url);
							foreach ($page_url as $item) {
								?><option value="<?php echo $item['value']; ?>" <?php echo $item['selected']; ?>><?php echo $item['value']; ?></option><?php
							}
?>
						</select> / <?php echo $total_page; ?>
                    </span><?php
                    if($current_page != $total_page) {
						?><a href="javascript:nextPage('<?php echo $current_page; ?>')"><img src="<?php echo base_url(); ?>img/next.png"></a><?php
					}
					?> <a href="javascript:lastPage('<?php echo $total_page; ?>')"><img src="<?php echo base_url(); ?>img/next2.png"></a>
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
					<a href="<?php echo base_url().index_page(); ?>homePRD?paging=">
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
					$("#homeSearch").attr("action","<?php echo base_url().index_page().$home_search; ?>/"+nextpage);
<?php
					if($post_is_homePRD_search == ""){
?>
						$("#homeSearch input[name=is_homePRD_search]").val("");
<?php
					}
?>
					$("#homeSearch").submit();
				}
				function lastPage(val){
					$("#homeSearch").attr("action","<?php echo base_url().index_page().$home_search; ?>/"+val);
<?php
					if($post_is_homePRD_search == ""){
?>
						$("#homeSearch input[name=is_homePRD_search]").val("");
<?php
					}
?>
					$("#homeSearch").submit();
				}
				function prevPage(val){
					var prevpage = parseInt(val)-1;
					$("#homeSearch").attr("action","<?php echo base_url().index_page().$home_search; ?>/"+prevpage);
<?php
					if($post_is_homePRD_search == ""){
?>
						$("#homeSearch input[name=is_homePRD_search]").val("");
<?php
					}
?>
					$("#homeSearch").submit();
				}
				function firstPage(){
					$("#homeSearch").attr("action","<?php echo base_url().index_page().$home_search; ?>/1");
<?php
					if($post_is_homePRD_search == ""){
?>
						$("#homeSearch input[name=is_homePRD_search]").val("");
<?php
					}
?>
					$("#homeSearch").submit();
				}
            </script>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$("#makeRss").click(function(){
		var url="<?php echo base_url().index_page(); ?>PRD_HomePRD/rss_feed_home_prd";
		//alert(url);
		var dataSet={ search: $("input#news_title").val(), start_date: $("input.fromdate").val(), end_date: $("input.todate").val()};
		$.post(url,dataSet,function(data){
			//alert(data);
			var url = "<?php echo base_url().index_page(); ?>prd_rss/view_rss/"+data;
			window.open(url);
			//$("#InputRss").val(url).select();
		});
	});
	
	
	//FOr CApture
	// $("#makeRss").
	
});
</script>