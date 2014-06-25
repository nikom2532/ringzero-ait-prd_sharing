<div id="search-form">
	<form name="search_form" id="homeSearch" action="<?php echo base_url().index_page(); ?>reportPRD" method="post">
		<input type="hidden" name="reportprd_is_search" value="yes" />
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
				<input type="text" class="form-control fromdate" name="start_date" id="start_date" placeholder="" value="<?php
					if(isset($post_start_date)){
						echo $post_start_date;
					}
				?>">
			</div>
			<div class="col-lg-6">
				<label>ถึง</label>
				<input type="text" class="form-control todate" name="end_date" id="end_date" placeholder="" value="<?php 
					if(isset($post_end_date)){
						echo $post_end_date;
					}
				?>">
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >หน่วยงาน</label>
				<span class="select-menu">
				  <span>เลือกหน่วยงาน</span>
					<select name="grov_active" id="grov_active">
						<option value="">เลือกหน่วยงาน</option>
	<?php
						foreach ($SC07_Department as $Department_item) {
							?><option value="<?php echo $Department_item->SC07_DepartmentId;?>" <?php 
								if($Department_item->SC07_DepartmentId == $post_grov_active){
									?>selected='selected'<?php
								}
							?>><?php echo $Department_item->SC07_DepartmentName; ?></option><?php
						}
	?>
					</select>
				</span> 
			</div>
			<div class="col-lg-6">
				<label >หมวดหมู่ข่าว</label>
				<span class="select-menu">
				  <span>เลือกหมวดหมู่ข่าว</span>
					<select name="NewsTypeID" id="NewsTypeID" class="form-control" style="width: 100%;">
						<option value="">เลือกหมวดหมู่ข่าว</option><?php
						// var_dump($NT02_NewsType);
						foreach ($NT02_NewsType as $newType_item) {
							?><option value="<?php echo $newType_item->NT02_TypeID; ?>" <?php 
								if($newType_item->NT02_TypeID == $post_News_type_id){
									?>selected='selected'<?php
								}
							?>><?php echo $newType_item->NT02_TypeName; ?></option><?php
						}
					?></select>
				</span> 
			</div>
		</div>
	
		<div class="row">
			<div style="float:left; width: 50%">
			<!-- <div class="col-lg-6"> -->
				<label style="margin-left: 11%;">ไฟล์ประกอบข่าว</label>
				<input style="margin-left: 30px; " type="checkbox" name="filter_vdo" id="filter_vdo" value="1" <?php 
					if(isset($post_filter_vdo)){
						if($post_filter_vdo == "1"){
							?>checked='checked'<?php
						}
					}
				?> />
				<label for="filter_vdo" >วิดีโอ</label>
				
				<input type="checkbox" name="filter_sound" id="filter_sound" value="1" <?php 
					if(isset($post_filter_sound)){
						if($post_filter_sound == "1"){
							?>checked='checked'<?php
						}
					} 
				?> />
				<label for="filter_sound" >เสียง</label>
				
				<input type="checkbox" name="filter_image" id="filter_image" value="1" <?php 
					if(isset($post_filter_image)){
						if($post_filter_image == "1"){
							?>checked='checked'<?php
						}
					} 
				?> />
				<label for="filter_image" >ภาพ</label>
				
				<input type="checkbox" name="filter_other" id="filter_other" value="1" <?php 
					if(isset($post_filter_other)){
						if($post_filter_other == "1"){
							?>checked='checked'<?php
						}
					} 
				?> />
				<label for="filter_other" >อื่นๆ</label>
			</div>
			<div class="col-lg-6">
				<label >หมวดหมู่ข่าวย่อย</label>
				<span class="select-menu">
					<span>เลือกหมวดหมู่ข่าวย่อย</span>
					<select name="NewsSubTypeID" id="NewsSubTypeID" class="form-control" style="width: 100%;">
						<option value="">เลือกหมวดหมู่ข่าวย่อย</option><?php
						foreach ($NT03_NewsSubType as $newType_item) {
							// if($newType_item->NT02_TypeID == $post_News_type_id){
								?><option value="<?php echo $newType_item->NT03_SubTypeID; ?>" <?php
									if($post_News_subtype_id != ""){
										?>selected='selected'<?php
									}
								?>><?php echo $newType_item->NT03_SubTypeName; ?></option><?php
							// }
						}
					?></select>
				</span> 
			</div>
		</div>
	
		<div class="col-lg-12" style="text-align: center;">
			<input class="bt" type="submit" value="ค้นหา" name="share" style="width:18%;padding: 4px;">
		</div>
	</form>
</div>

<div class="table-list">
	<div class="row">
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;">
			PRD NEWS DATA CENTER
		</p>
		<a href="<?php echo base_url().index_page(); ?>reportGOVE">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
			Government Agencies
		</p></a>
	</div>
	
	<div class="row" style="width: 1000px; overflow-y: hidden; overflow-x: auto; ">
		<div class="header-table" style="text-align: center; width: 1300px; ">
			<p class="col-1" style="width: 4%;float: left; ">
				ลำดับที่
			</p>
			<p class="col-1" style="width: 11%;float: left; ">
				เลขที่ข่าว
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				วันที่ข่าว
			</p>
			<p class="col-2" style="width: 20%;float: left; ">
				หัวข้อข่าว
			</p>
			<p class="col-1" style="width: 15%;float: left; ">
				ผู้สื่อข่าว
			</p>
			<p class="col-1" style="width: 15%;float: left; ">
				หน่วยงาน
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				จำนวนผู้เข้าชม
			</p>
			<p class="col-2" style="width: 15%;float: left; ">
				icon ไฟล์แนบ
			</p>
		</div>
		
		<?php
			//Start to count News's rows
			$i=0;
			foreach($news as $news_item){
				
				if($i % 2 == 0){
					?><div class="odd" style="width: 1300px; "><?php
				}
				elseif($i % 2 == 1){
					?><div class="event" style="width: 1300px; "><?php
				}
	?>
						<p class="col-1" style="width: 4%;float: left; ">
							1
						</p>
						<p class="col-1" style="width: 11%;float: left; ">
							<a href="<?php echo base_url().index_page(); ?>reportDetailPRD?news_id=<?php echo $news_item->NT01_NewsID; ?>"><?php echo $news_item->NT01_NewsID; ?></a>
						</p>
						<p class="col-1" style="width: 10%;float: left; "><?php
							// if($news_item->NT01_UpdDate == ""){
								// echo date("d/m/Y h:m:s", strtotime($news_item->NT01_CreDate));
							// }
							// else{
								// echo date("d/m/Y h:m:s", strtotime($news_item->NT01_UpdDate));
							// }
							
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
						<p class="col-2" style="width: 20%;float: left; ">
	<?php 
							
							$i_item=0;
							foreach ($New_News as $New_News_item) {
								if(
									$New_News_item->News_OldID ==  $news_item->NT01_NewsID &&
									$New_News_item->News_UpdateID > 0
								){
										// echo strlen(mb_substr($New_News_item->News_Title, 0, 100, 'UTF-8'));
										echo mb_substr($New_News_item->News_Title, 0, 100, 'UTF-8');
										$i_item++;
								}
							}
							if($i_item == 0){
								echo mb_substr($news_item->NT01_NewsTitle, 0, 60, 'UTF-8'); 
							}
	?>
						</p>
						<p class="col-1" style="width: 15%;float: left; ">
<?php
							echo $news_item->SC03_FName." ".$news_item->SC03_LName;
?>
						</p>
						<p class="col-1" style="width: 15%;float: left; ">
<?php
							echo $news_item->SC07_DepartmentName;
?>
						</p>
						<p class="col-1" style="width: 10%;float: left; ">
							xxxxxxxxx
						</p>
						<p class="col-2" style="width: 15%;float: left; ">
							<img src="<?php echo base_url(); ?>images/icon/<?php
								if($news_item->NT10_FileStatus == "Y"){ //Video
									?>vdo<?php
								}else{
									?>null<?php
								}
							?>.png" width="17" style="margin: -10px 5px 0;">
							
							<img src="<?php echo base_url(); ?>images/icon/<?php 
								if($news_item->NT12_FileStatus == 'Y'){ //Voice
									?>voice_512x512<?php
								}else{
									?>null<?php
								}
							?>.png" width="17" style="margin: -10px 5px 0;">
							
							
							<img src="<?php echo base_url(); ?>images/icon/<?php 
								if($news_item->NT13_FileStatus == 'Y'){ //Document
									?>Document.jpg<?php
								}else{
									?>null.png<?php
								}
							?>" width="17" style="margin: -10px 5px 0;">
							
							<img src="<?php echo base_url(); ?>images/icon/<?php
								if($news_item->NT11_FileStatus == 'Y'){ //Picture
									?>pic<?php
								}else{
									?>null<?php
								}
							?>.png" width="17" style="margin: -10px 5px 0;">
						</p>
					</div>
	<?php
				$i++;
			}
			//End Count News's Row 
			
			if($i == 0){
	?>
				<div class="news-form" style="color: red; text-align: center;">ไม่มีข้อความ</div>
	<?php
			}
	?>
			<!-- </div> -->
		
		</div>
	</div>
	<div class="footer-table">
		<!-- <p style="width: 70%;float: left;margin-top: 20px;">
			ทั้งหมด: 73 รายการ (4หน้า)
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
			<img src="<?php echo base_url(); ?>images/table/next.png" style="margin: -5px 10px 0;">
			<img src="<?php echo base_url(); ?>images/table/end.png" style="margin: -5px 10px 0;">
		</p> -->
		
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
<script type="text/javascript">
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
	});
	$(function(){
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
	$('select#NewsTypeID').change(function(){
		// debugger;
	    var type_id = $('select#NewsTypeID').val();
		if (type_id != ""){
			var post_url = "<?php echo base_url().index_page(); ?>PRD_ManageNewPRD/get_NT02_TypeID/" + type_id;
		}
		else{
			var post_url = "<?php echo base_url().index_page(); ?>PRD_ManageNewPRD/get_NT02_TypeID/";
		}
		// debugger;
		// alert(post_url);
		$.ajax({
			type: "POST",
			url: post_url,
			dataType :'json',
			success: function(subtype)
			{
				// var a = JSON.parse(subtype);
				$('#NewsSubTypeID').empty();
				
				var text = "<option value=\"\">เลือกหมวดหมู่ข่าวย่อย</option>";
				$('#NewsSubTypeID').append(text);
				
				$.each(subtype,function(index,val)
				{
					var text = ""+
					"<option value=\""+val.NT03_SubTypeID+"\">"+val.NT03_SubTypeName+"</option>";
					$('#NewsSubTypeID').append(text);
				});
				var selectmenu_txt = $("#NewsSubTypeID").find("option:selected").text();
				$("#NewsSubTypeID").prev("span").text(selectmenu_txt);
				
			} //end success
		}); //end AJAX
	}); //end change 
	$(function(){
        $(".select-menu > select > option:eq(0)").attr("selected","selected");
        $(".select-menu > select").live("change",function(){
            var selectmenu_txt = $(this).find("option:selected").text();
            $(this).prev("span").text(selectmenu_txt);
        });
        
    });
	function jump_page(val){
		location='<?php echo $jump_url; ?>/'+val;
	}
	function nextPage(val){
		debugger;
		var nextpage = parseInt(val)+1;
		if(<?php echo $total_page; ?>==val){
			nextpage = val;
		}
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."reportPRD"; ?>/"+nextpage);
		$("#homeSearch").submit();
	}
	function lastPage(val){
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."reportPRD"; ?>/"+val);
		$("#homeSearch").submit();
	}
	function prevPage(val){
		var prevpage = parseInt(val)-1;
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."reportPRD"; ?>/"+prevpage);
		$("#homeSearch").submit();
	}
	function firstPage(){
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."reportPRD"; ?>/1");
		$("#homeSearch").submit();
	}
</script>