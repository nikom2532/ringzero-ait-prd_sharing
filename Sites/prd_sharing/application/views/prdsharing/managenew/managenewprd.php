<meta charset="utf-8" />

<script>
	/*
	$(function() {
		$( ".datepicker" ).datepicker();
	});
	*/
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
</script>
<div id="search-form">
	<form name="search_form" id="homeSearch" action="<?php echo base_url().index_page(); ?>manageNewPRD" method="post">
		<input type="hidden" name="managenewsprd_is_search" value="yes" />
		<div class="row">
			<div class="col-lg-12">
				<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
				<input class="txt-field" type="text" value="<?php 
					if($post_news_title != ""){
						echo $post_news_title;
					}
				?>" name="news_title"  placeholder="" style=" margin-left: 15px;width: 77%;">
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-6">
				<label >วันที่</label>
				<input type="text" class="form-control datepicker fromdate" name="start_date" id="fromdate" placeholder="" value="<?php 
					if($post_start_date != ""){
						echo $post_start_date;
					}
				?>">
			</div>
			<div class="col-lg-6">
				<label >ถึง</label>
				<input type="text" class="form-control datepicker todate" name="end_date" id="todate" placeholder="" value="<?php 
					if($post_end_date != ""){
						echo $post_end_date;
					}
				?>">
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >หมวดหมู่ข่าว</label>
				<!-- <input type="text" class="form-control" id="InputKeyword" placeholder="" > -->
				
				
				<select name="NewsTypeID" id="NewsTypeID" class="form-control" style="width: 65%;">
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
				
				<?php //echo $post_News_type_id; ?>
			</div>
			<div class="col-lg-6">
				<label >หมวดหมู่ข่าวย่อย</label>
				<!-- <input type="text" class="form-control" id="InputKeyword" placeholder="" > -->
				
				
				<select name="NewsSubTypeID" id="NewsSubTypeID" class="form-control" style="width: 65%;">
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
				
				
			</div>
		</div>
		<div class="row">
			<!-- <div class="col-lg-6">
				<div style="float: left;width: 30%;">
					<label style="width: 100%;" >ผู้สื่อข่าว</label>
				</div>
				<div style="margin-left: 20%;float: left;">
					<!-- <img src="<?php echo base_url(); ?>images/icon/sh.png" style="margin: -5px 10px 0;">
					<img src="<?php echo base_url(); ?>images/icon/delete.png" style="margin: -5px 10px 0;"> -->
				<!--</div>
			</div> -->
			
			<div style="float:left; width: 50%">
				<div style="float:left; width: 25%; text-align: right;">ผู้สื่อข่าว</div>
				<div style="float:left; width: 60%; margin-left: 30px;">
					<select name="reporter_id" class="reporter_id_chosen" style="width:100%;">
						<option value="">โปรดเลือก...</option>
<?php
						foreach ($SC03_User as $SC03_User_item) {
							?><option value="<?php echo $SC03_User_item->SC03_UserId; ?>" <?php
								if($post_reporter_id != ""){
									?>selected='selected'<?php
								}
							?>><?php echo $SC03_User_item->ReporterName; ?></option><?php
						}
?>
					</select>
					<script>
						jQuery(document).ready(function(){
							jQuery(".reporter_id_chosen").chosen({});
						});
						
						var config = {
		     				'.chosen-select'           : {},
						    '.chosen-select-deselect'  : {allow_single_deselect:true},
						    '.chosen-select-no-single' : {disable_search_threshold:10},
						    '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
						    '.chosen-select-width'     : {width:"95%"}
						}
						for (var selector in config) {
							$(selector).chosen(config[selector]);
						}
					</script>
				</div>
			</div>
			
			<div style="float:left; width: 50%">
				<div style="float: left;margin-right: 5%;margin-left:30px;-moz-binding; width: 100%">
					<label style="margin-left: 5%; margin-right: 5%;">ไฟล์ประกอบข่าว</label>
					<input type="checkbox" name="filter_vdo" id="filter_vdo" value="1" />
					<label for="filter_vdo" >วิดีโอ</label>
					
					<input type="checkbox" name="filter_sound" id="filter_sound" value="1" />
					<label for="filter_sound" >เสียง</label>
					
					<input type="checkbox" name="filter_image" id="filter_image" value="1" />
					<label for="filter_image" >ภาพ</label>
					
					<input type="checkbox" name="filter_other" id="filter_other" value="1" />
					<label for="filter_other" >อื่นๆ</label>
					
				</div>
			</div>
		</div>
		
		<div class="col-lg-12" style="text-align: center;">
			<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:18%;padding: 4px;">
		</div>
	</form>
</div>

<div class="table-list">
	<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
	<div class="row" style="margin-top: 20px;">
		<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;">
			PRD NEWS
		</p>
		<a href="<?php echo base_url().index_page(); ?>manageNewGROV">
		<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
			Government Agencies
		</p></a>
	</div>
	<div class="row">
		<div class="header-table" style="text-align: right;">
			<p class="col-1" style="width: 4%;float: left; "></p>
			<p class="col-2" style="width: 16%;float: left; ">
				เลขที่ข่าว
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				สภานะ
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				ลบ
			</p>
			<p class="col-1" style="width: 35%;float: left; ">
				หัวข้อข่าว
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				วันที่ข่าว
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				แหล่งข่าว
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				สายข่าว
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				ผู้สื่อข่าว
			</p>
		</div>
<?php
		//Start to count News's rows
		$i=0;
		foreach($news as $news_item){
			if($i % 2 == 0){
				?><div class="odd"><?php
			}
			elseif($i % 2 == 1){
				?><div class="event"><?php
			}
?>
					<p class="col-1" style="width: 4%;float: left; word-wrap: break-word;">
						<?php echo $i+1; ?>
					</p>
					<p class="col-2" style="width: 16%;float: left; word-wrap: break-word;">
						<a href="<?php echo base_url().index_page(); ?>manageNewEditPRD?news_id=<?php echo $news_item->NT01_NewsID; ?>"><?php echo $news_item->NT01_NewsID; ?></a>
					</p>
					<p class="col-1" style="width: 5%;float: left; word-wrap: break-word; text-align: center; "><?php 
						if($news_item->NT01_Status == 'Y'){
							?><img src="<?php echo base_url(); ?>images/icon/like.png" style="margin: -5px 10px 0;"><?php
						}
						else{
							?>-<?php
						}
					?></p>
					
					<p class="col-1 PRDNewsDelete" data-oldnews_id="<?php echo $news_item->NT01_NewsID; ?>" style="width: 5%;float: left; word-wrap: break-word; cursor:pointer; text-align: center; "><?php
						$New_News_delete = 0; //Use for show query only 1 record	
						foreach ($New_News as $New_News_item) {
							if(
								$New_News_item->News_OldID ==  $news_item->NT01_NewsID
							){
									if($New_News_item->News_Delete == 1){
										if($New_News_delete == 0){
											?><img src="<?php echo base_url(); ?>images/icon/delete_lock.png" style="margin: -5px 10px 0;"><?php
											$New_News_delete++;
										}
									}
									else{
										if($New_News_delete == 0){
											?><img src="<?php echo base_url(); ?>images/icon/delete.png" style="margin: -5px 10px 0;"><?php
											$New_News_delete++;
										}
									}
							}
						}
						// echo $New_News_delete;
					?></p>
					<p class="col-1" style="width: 35%;float: left; word-wrap: break-word;">
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
							echo mb_substr($news_item->NT01_NewsTitle, 0, 100, 'UTF-8'); 
						}
?>
					</p>
					<p class="col-1" style="width: 10%;float: left; word-wrap: break-word;"><?php
						// if($news_item->NT01_UpdDate == ""){
							// echo date("d/m/Y h:m:s", strtotime($news_item->NT01_CreDate));
						// }
						// else{
							// echo date("d/m/Y h:m:s", strtotime($news_item->NT01_UpdDate));
						// }
						
						
						/*
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
						*/
						echo date("d/m/Y h:m:s", strtotime($news_item->NT01_NewsDate));
					?></p>
					<p class="col-1" style="width: 10%;float: left; word-wrap: break-word;">
<?php
						$i_item=0;
						foreach ($New_News as $New_News_item) {
							if(
								$New_News_item->News_OldID ==  $news_item->NT01_NewsID &&
								$New_News_item->News_UpdateID > 0
							){
									echo $New_News_item->News_Resource;
									$i_item++;
							}
						}
						if($i_item == 0){
							$news_item->NT01_NewsSource;
						}
?>
					</p>
					<p class="col-1" style="width: 5%;float: left; word-wrap: break-word;">
<?php 
						$i_item=0;
						foreach ($New_News as $New_News_item) {
							if(
								$New_News_item->News_OldID ==  $news_item->NT01_NewsID &&
								$New_News_item->News_UpdateID > 0
							){
									echo $New_News_item->News_Reference;
									$i_item++;
							}
						}
						if($i_item == 0){
							$news_item->NT01_NewsReferance;
						}
?>
					</p>
					<p class="col-1" style="width: 10%;float: left; word-wrap: break-word;"><?php 
						echo $news_item->SC03_FName." ".$news_item->SC03_LName;
						// if($news_item->NT01_UpdUserID == ""){
							// echo $news_item->NT01_CreUserID;
						// }
						// else{
							// echo $news_item->NT01_UpdUserID;
						// }
					?></p>
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
</div>
<script>
	function jump_page(val){
		location='<?php echo $jump_url; ?>/'+val;
	}
	function nextPage(val){
		debugger;
		var nextpage = parseInt(val)+1;
		if(<?php echo $total_page; ?>==val){
			nextpage = val;
		}
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageNewPRD"; ?>/"+nextpage);
		$("#homeSearch").submit();
	}
	function lastPage(val){
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageNewPRD"; ?>/"+val);
		$("#homeSearch").submit();
	}
	function prevPage(val){
		var prevpage = parseInt(val)-1;
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageNewPRD"; ?>/"+prevpage);
		$("#homeSearch").submit();
	}
	function firstPage(){
		$("#homeSearch").attr("action","<?php echo base_url().index_page()."manageNewPRD"; ?>/1");
		$("#homeSearch").submit();
	}
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
			} //end success
		}); //end AJAX
	}); //end change 
	
	$(".PRDNewsDelete").click( function() {
		var oldnews_id = $(this).attr("data-oldnews_id");
		if (confirm("คุณแน่ใจว่าจะลบรายการ เลขที่ข่าว = "+oldnews_id+" หรือไม่ ") == true) {
	        location.href="<?php echo base_url().index_page(); ?>manageNewPRD?is_del_oldnews=1&oldnews_id="+oldnews_id;
	    }
	});
</script>