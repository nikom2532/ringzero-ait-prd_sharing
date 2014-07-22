<style>
	.select-menu{
		margin-bottom: inherit;
	}
</style>
<div id="search-form">
	<form name="homeSearch" id="homeSearch" action="<?php echo base_url().index_page(); ?>reportGOVE" method="post">
		<input type="hidden" name="reportGROV_is_submit" value="yes" />
		<div class="row">
			<div class="col-lg-12">
				<p style="text-align: center;">
					รายงานการยื่นยันการเผยแพร่
				</p>
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >ช่วงวันที่เผยแพร่</label>
				<input type="text" class="form-control datepicker fromdate" name="start_date" id="start_date" value="<?php 
					if(isset($post_start_date)){
						echo $post_start_date;
					}
				?>" placeholder="" >
			</div>
			<div class="col-lg-6">
				<label >ถึง</label>
				<input type="text" class="form-control datepicker todate"name="end_date" id="end_date" value="<?php 
					if(isset($post_end_date)){
						echo $post_end_date;
					}
				?>" placeholder="" >
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<!-- Ministry  -->
				<label >กระทรวง</label>
				<span class="select-menu">
					<span>เลือกกระทรวง</span>
					<select name="Ministry_ID" id="Ministry_ID" class="form-control" style="width: 100%;">
						<option value="" >เลือกกระทรวง</option><?php
						foreach ($ministry as $ministry_item) {
							?><option value="<?php echo $ministry_item->Minis_ID; ?>" <?php 
								if(isset($post_Ministry_ID)){
									if($ministry_item->Minis_ID == $post_Ministry_ID){
										?>selected='selected'<?php
									}
								}
							?>><?php echo $ministry_item->Minis_Name; ?></option><?php
						}
					?></select>
				</span> 
			</div>
			<div class="col-lg-6">
				<!-- department -->
				<label >กรม</label>
				<span class="select-menu">
					<span>เลือกกรม</span>
					<select name="Dep_ID" id="Dep_ID" class="form-control" style="width: 100%;">
						<option value="" >เลือกกรม</option><?php
						foreach ($department as $department_item) {
							?><option value="<?php echo $department_item->Dep_ID; ?>"  <?php 
								if(isset($post_Dep_ID)){
									if($department_item->Dep_ID == $post_Dep_ID){
										?>selected='selected'<?php
									}
								}
							?>><?php echo $department_item->Dep_Name; ?></option><?php
						}
					?></select>
				</span> 
				
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >สถานะ</label>
				<span class="select-menu">
				  <span>เลือกสถานะ</span>
					<select name="SendIn_Status" id="SendIn_Status" class="form-control">
						<option selected="selected" value="" <?php
							if(isset($post_SendIn_Status)){
								if($post_SendIn_Status == ""){
									?>selected='selected'<?php
								}
							}
						?>>เลือกสถานะ</option>
						<option selected="selected" value="0" <?php
							if(isset($post_SendIn_Status)){
								if($post_SendIn_Status == "0"){
									?>selected='selected'<?php
								}
							}
						?>>ไม่ได้เผยแพร่</option>
						<option selected="selected" value="1" <?php
							if(isset($post_SendIn_Status)){
								if($post_SendIn_Status == "1"){
									?>selected='selected'<?php
								}
							}
						?>>เผยแพร่</option>
					</select>
				</span> 
			</div>
		</div>
	
		<div class="col-lg-12" style="text-align: center;">
			<input class="bt" type="submit" value="ค้นหา" name="share" style="width:18%;padding: 4px; margin-top: 20px;">
		</div>
	</form>
</div>

<div class="table-list">
	<div class="row">
		<a href="<?php echo base_url().index_page(); ?>reportPRD">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;float: left;border: 1px solid #dcdcdc; ">
			PRD NEWS DATA CENTER
		</p></a>
		<p style="margin-left: 10px;border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;">
			Government Agencies
		</p>
	</div>
	<div class="row" style="width: 1000px; overflow-y: hidden; overflow-x: auto; ">
		<div class="header-table" style="text-align: right; width: 1400px; ">
			<p class="col-1" style="width: 5%;float: left; ">
				ลำดับที่
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				เลขที่ข่าว
			</p>
			<p class="col-1" style="width: 7%;float: left; ">
				วันที่ข่าว
			</p>
			<p class="col-2" style="width: 20%;float: left; ">
				ประเดนข่าว
			</p>
			<p class="col-2" style="width: 20%;float: left; ">
				เนื้อหาข่าว
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				ผู้เผยแพร่ข่าว
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				สถานะเผยแพร่
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				จำนวนผู้เข้าชม
			</p>
			<p class="col-2" style="width: 13%;float: left; ">
				icon ไฟล์แนบ
			</p>
		</div>
<?php
		$i = 0;
		// var_dump($news);
		foreach($news as $news_item){
			if($i % 2 == 0){
				?><div class="odd" style="width: 1400px; "><?php
			}
			elseif($i % 2 == 1){
				?><div class="event" style="width: 1400px; "><?php
			}
?>
					<p class="col-1" style="width: 3.5%; padding-left:1.5%; float: left; ">
						<?php echo $news_item->RowNumber; ?>
					</p>
					<p class="col-1" style="width: 10%; text-align: center; float: left; ">
						<a href="<?php echo base_url().index_page(); ?>reportDetailGROV?sendinformation_id=<?php echo $news_item->SendIn_ID; ?>"><?php echo $news_item->SendIn_ID; ?></a>
					</p>
					<p class="col-1" style="width: 7%;float: left; ">
<?php
						if($news_item->SendIn_UpdateDate != ""){
							echo date("d/m/Y", strtotime($news_item->SendIn_UpdateDate))."<br/>".
							date("h:m:s", strtotime($news_item->SendIn_UpdateDate))
							;
						}
						else{
							echo date("d/m/Y", strtotime($news_item->SendIn_CreateDate))."<br/>".
							date("h:m:s", strtotime($news_item->SendIn_CreateDate));
						}
?>
					</p>
					<p class="col-2" style="width: 20%;float: left; ">
<?php 
						$SendIn_Issue = $news_item->SendIn_Issue;
						if(mb_strlen($SendIn_Issue)>=50){
							$SendIn_Issue = mb_substr($SendIn_Issue, 0, 30, 'UTF-8')."...";
						}
						echo $SendIn_Issue;
?>
					</p>
					<p class="col-2" style="width: 20%;float: left; ">
<?php 
						$strSendIn_Detail = str_replace("<p>", "", $news_item->SendIn_Detail);
						$strSendIn_Detail = str_replace("</p>", "", $strSendIn_Detail);
						
						if(mb_strlen($strSendIn_Detail)>=30){
							$strSendIn_Detail = mb_substr($strSendIn_Detail, 0, 30, 'UTF-8')."...";
						}
						
						echo $strSendIn_Detail;
?>
					</p>
					<p class="col-1" style="width: 10%;float: left; ">
<?php 
						$reporter = $news_item->Mem_Name." ".$news_item->Mem_LasName;
						if(mb_strlen($reporter)>=30){
							$reporter = mb_substr($reporter, 0, 30, 'UTF-8')."...";
						}
						echo $reporter;
?>
					</p>
					<p class="col-1" style="width: 10%;float: left; text-align: center; ">
<?php 
						if($news_item->SendIn_Status == "1"){
							echo "เผยแพร่";
						}
						else if($news_item->SendIn_Status == "0" || $news_item->SendIn_Status = "" || $news_item->SendIn_Status == null || $news_item->SendIn_Status == "-1"){
							echo "ไม่ได้เผยแพร่";
						}
?>
					</p>
					<p class="col-1" style="width: 5%;float: left; text-align: center; ">
						<?php 
						if($news_item->SendIn_view != "" || $news_item->SendIn_view != null){
							echo $news_item->SendIn_view; 
						}
						else{
							echo "0";
						}
						?>
					</p>
					<p class="col-2" style="width: 13%;float: left; ">
<?php
						/*
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
						*/
?>
						<img src="<?php echo base_url(); ?>images/icon/<?php 
							// if($file_vdo_status == '1'){
							if($news_item->File_Type_video == 1){
								?>vdo<?php
							}else{
								?>null<?php
							}
						?>.png" width="17" style="margin: -10px 10px 0;">
						
						<img src="<?php echo base_url(); ?>images/icon/<?php 
							// if($file_voice_status == '1'){
							if($news_item->File_Type_voice == 1){
								?>voice_512x512<?php
							}else{
								?>null<?php
							}
						?>.png" width="17" style="margin: -10px 10px 0;">
						
						
						<img src="<?php echo base_url(); ?>images/icon/<?php 
							// if($file_other_status == '1'){
							if($news_item->File_Type_document == 1){
								?>Document.jpg<?php
							}else{
								?>null.png<?php
							}
						?>" width="17" style="margin: -10px 10px 0;">
						
						<img src="<?php echo base_url(); ?>images/icon/<?php
							// if($file_image_status == '1'){
							if($news_item->File_Type_image == 1){
								?>pic<?php
							}else{
								?>null<?php
							}
						?>.png" width="17" style="margin: -10px 10px 0;">
					</p>
			</div>
<?php
			$i++;
		}
		if($i == 0){
?>
			<div class="news-form" style="width: 1400px; padding: 15px 0; color: red; text-align: center;">ไม่มีข้อความ</div>
<?php
		}
?>
	</div>
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
	
</div>
<script>
	$(function(){
		$(".fromdate").datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeMonth: true,
			changeYear: true,
				onSelect: function(selected) {
					$(".todate").datepicker("option","minDate", selected)
			}
		});
		$(".todate").datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeMonth: true,
			changeYear: true,
			onSelect: function(selected) {
				$(".fromdate").datepicker("option","maxDate", selected)
			}
		});
	});
    $(function(){
        // $(".select-menu > select > option:eq(0)").attr("selected","selected");
        $(".select-menu > select").live("change",function(){
            var selectmenu_txt = $(this).find("option:selected").text();
            $(this).prev("span").text(selectmenu_txt);
        });
        
		var selectmenu_txt = $("#Ministry_ID").find("option:selected").text();
			$("#Ministry_ID").prev("span").text(selectmenu_txt);
		
		var selectmenu_txt = $("#Dep_ID").find("option:selected").text();
			$("#Dep_ID").prev("span").text(selectmenu_txt);
		
		var selectmenu_txt = $("#SendIn_Status").find("option:selected").text();
			$("#SendIn_Status").prev("span").text(selectmenu_txt);
    });
    
    function jump_page(val){
		location='<?php echo $jump_url; ?>/'+val;
	}
	function nextPage(val){
		// debugger;
		var nextpage = parseInt(val)+1;
		if(<?php echo $total_page; ?>==val){
			nextpage = val;
		}
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."reportGOVE"; ?>/"+nextpage);
		$("#homeSearch").submit();
	}
	function lastPage(val){
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."reportGOVE"; ?>/"+val);
		$("#homeSearch").submit();
	}
	function prevPage(val){
		var prevpage = parseInt(val)-1;
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."reportGOVE"; ?>/"+prevpage);
		$("#homeSearch").submit();
	}
	function firstPage(){
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."reportGOVE"; ?>/1");
		$("#homeSearch").submit();
	}
</script>