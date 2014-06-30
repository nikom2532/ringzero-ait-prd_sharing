	<div class="row">
		<a href="<?php echo base_url().index_page(); ?>homePRD">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;float: left;border: 1px solid #dcdcdc;">
			PRD NEWS
		</p></a>
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;margin-left: 10px;">
			Government Agencies
		</p>
	</div>
	<div class="row">
		<div class="header-table" style="text-align: right;">
			<img src="<?php echo base_url(); ?>images/rss.png" style="margin: 10px 10px 0;text-align: right;" id="makeRss">
		</div>
<?php
		// var_dump($news); 
		
		$countNews=0;
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
					echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_CreateDate));
				}
				
			?></p>
			<p class="col-2" style="width: 80%;float: left; ">
				<?php echo $news_item->SendIn_Issue; ?>
			</p>
		</div>
		<div class="event">
			<p class="col-1" style="width: 20%;float: left; ">
<?php
				//Remove the star out
				/*
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
					?><img src="<?php echo base_url(); ?>images/icon/star-on-big.png" width="16" />&nbsp;<?php
				}
				for ($i=0; $i < $star_count_less; $i++) { 
					?><img src="<?php echo base_url(); ?>images/icon/star-off-big.png" width="16" />&nbsp;<?php
				}
				*/
?>
			</p>
			<p class="col-2" style="width: 20%;float: left; ">
				<img src="<?php echo base_url(); ?>images/icon/people.png" style="margin: -10px 10px 0;">
				ผู้สื่อข่าว: <?php echo $news_item->Mem_Name." ".$news_item->Mem_LasName; ?>
			</p>
			<p class="col-3" style="width: 20%;float: left; ">
				<img src="<?php echo base_url(); ?>images/icon/view.png" style="margin: -10px 10px 0;">
				views:  <?php 
					echo $news_item->SendIn_view;
			?></p>
			<p class="col-4" style="width: 20%;float: left; ">
				<a href="<?php echo base_url().index_page(); ?>detail_grov?sendinformation_id=<?php echo $news_item->SendIn_ID; ?>">open new link</a>
			</p>
			<p class="col-5" style="width: 20%;float: left;  text-align: center;">
<?php
				$file_vdo_status = 0;
				$file_voice_status = 0;
				$file_other_status = 0;
				$file_image_status = 0;
				foreach ($get_grov_fileattach as $file) {
					if($news_item->SendIn_ID == $file->SendIn_ID){
						
						if($file->File_Type == "vdo"){
							$file_vdo_status = 1;
						}
						if($file->File_Type == "voice"){
							$file_voice_status = 1;
						}
						if($file->File_Type == "other"){
							$file_other_status = 1;
						}
						if($file->File_Type == "image"){
							$file_image_status = 1;
						}
					}
					
				}
?>
				
				<img src="<?php echo base_url(); ?>images/icon/<?php 
					if($file_vdo_status == '1'){
						?>vdo<?php
					}else{
						?>null<?php
					}
				?>.png" style="margin: -10px 10px 0;">
				
				<img src="<?php echo base_url(); ?>images/icon/<?php 
					if($file_voice_status == '1'){
						?>voice_512x512<?php
					}else{
						?>null<?php
					}
				?>.png" style="margin: -10px 10px 0;">
				
				
				<img src="<?php echo base_url(); ?>images/icon/<?php 
					if($file_other_status == '1'){
						?>Document.jpg<?php
					}else{
						?>null.png<?php
					}
				?>" style="margin: -10px 10px 0;">
				
				<img src="<?php echo base_url(); ?>images/icon/<?php
					if($file_image_status == '1'){
						?>pic<?php
					}else{
						?>null<?php
					}
				?>.png" style="margin: -10px 10px 0;">
			</p>
		</div>
<?php
		$countNews++;
		//End Count News's Row 
		} // endforeach;
		
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
				$("#homeSearch").submit();
			}
			function lastPage(val){
				$("#homeSearch").attr("action","<?php echo base_url().index_page().$home_search; ?>/"+val);
				$("#homeSearch").submit();
			}
			function prevPage(val){
				var prevpage = parseInt(val)-1;
				$("#homeSearch").attr("action","<?php echo base_url().index_page().$home_search; ?>/"+prevpage);
				$("#homeSearch").submit();
			}
			function firstPage(){
				$("#homeSearch").attr("action","<?php echo base_url().index_page().$home_search; ?>/1");
				$("#homeSearch").submit();
			}
			
        </script>
	</div>
</div>
</div>
<script type="text/javascript">
$(function(){
	 $("#makeRss").click(function(){
		 var url="<?php echo base_url()?>index.php/prd_rss/rss_feed";
		 //alert(url);
		 var dataSet={ search: $("input#search").val(), start_date: $("input#fromdate").val(), end_date: $("input#todate").val() 
		 ,type: $("#TypeID").val(),subtype: $("#SubTypeID").val(),department: $("#DepartmentID").val(),reporter: $("#UserId").val()};
		 $.post(url,dataSet,function(data){
			//alert(data);
			var url = "<?php echo base_url()?>index.php/prd_rss/view_rss/"+data;
			window.open(url);
			//$("#InputRss").val(url).select();
		 });
	 });
});
</script>