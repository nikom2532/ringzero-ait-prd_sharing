<script>
	/*
	$(function() {
		$( ".datepicker" ).datepicker({ 
			changeMonth: true,
            changeYear: true,
			dateFormat: 'yy-mm-dd' 
		}).val();
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
	<form name="homeSearch" id="homeSearch" action="<?php echo base_url().index_page(); ?>manageNewGROV" method="post">
		<input type="hidden" name="manageNewGROV_is_submit" value="yes" />
		<div class="row">
			<div class="col-lg-12">
				<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
				<input class="txt-field" type="text" value="<?php 
					if(isset($post_sendin_issue)){
						echo $post_sendin_issue;
					}
				?>" name="sendin_issue" placeholder="" style=" margin-left: 15px;width: 77%;">
			</div>	
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<label >วันที่</label>
				<input type="text" class="form-control datepicker fromdate" name="start_date" id="start_date" readonly="true" value="<?php 
					if(isset($post_start_date)){
						echo $post_start_date;
					}
				?>" placeholder="" >
			</div>
			<div class="col-lg-6">
				<label >ถึง</label>
				<input type="text" class="form-control datepicker todate"name="end_date" id="end_date" readonly="true" value="<?php 
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
				<select name="Ministry_ID" id="Ministry_ID" class="form-control" style="width: 65%;">
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
			</div>
			<div class="col-lg-6">
				<!-- department -->
				<label >กรม</label>
				
				<select name="Dep_ID" id="Dep_ID" class="form-control" style="width: 65%;">
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
				
				
			</div>
		</div>
	
		<div class="row">
			<div class="col-lg-6">
				<!--<label >ผู้สื่อข่าว</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" >-->
			</div>
			<div style="float: right;margin-right: 5%;width: 45%;">
				<label style=" margin-left: 11%;">ไฟล์ประกอบข่าว</label>
				<input type="checkbox" name="vdo" value="0">
				วิดีโอ
				<input type="checkbox" name="sound" value="1">
				เสียง
				<input type="checkbox" name="image" value="2">
				ภาพ
				<input type="checkbox" name="other" value="3">
				อื่นๆ
			</div>
		</div>
	
		<div class="col-lg-12" style="text-align: center;">
			<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:18%;padding: 4px;">
		</div>

</div>

<div class="table-list">
	<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
	<div class="row" style="margin-top: 20px;">
		<a href="<?php echo base_url().index_page(); ?>manageNewPRD">
		<p style=" border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;float: left;border: 1px solid #dcdcdc;">
			PRD NEWS
		</p></a>
		<p style=" border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;width: 15%;text-align:center;float: left;margin-left: 10px;">
			Government Agencies
		</p>
	</div>
	<div class="row">
		<div class="header-table" style="text-align: right;">
			<p class="col-1" style="width: 6%;float: left; "></p>
			<p class="col-2" style="width: 14%;float: left; ">
				เลขที่ข่าว
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				สภานะ
			</p>
			<p class="col-1" style="width: 5%;float: left; ">
				ลบ
			</p>
			<p class="col-1" style="width: 35%;float: left; ">
				ประเด็นประชาสัมพันธ์
			</p>
			<p class="col-1" style="width: 10%;float: left; ">
				วันที่
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
?>
				<p class="col-1" style="width: 6%;float: left; ">
					<?php //echo $i++; ?>
				</p>
				<p class="col-2" style="width: 14%;float: left; ">
					<a href="<?php echo base_url().index_page(); ?>manageNewEditGROV?sendin_id=<?php echo $news_item->SendIn_ID; ?>"><?php echo $news_item->SendIn_ID; ?></a>
				</p>
				<p class="col-1" style="width: 5%;float: left; "><img src="<?php echo base_url(); ?>images/icon/like.png" style="margin: -5px 10px 0;">
				</p>
				
				<p class="col-1 SendInformationDelete" data-sendin_id="<?php echo $news_item->SendIn_ID; ?>" style="width: 5%;float: left; word-wrap: break-word; cursor:pointer; text-align: center; "><?php
					if($news_item->SendIn_Status == -1){
						?><img src="<?php echo base_url(); ?>images/icon/delete_lock.png" style="margin: -5px 10px 0;"><?php
					}
					else{
						?><img src="<?php echo base_url(); ?>images/icon/delete.png" style="margin: -5px 10px 0;"><?php
					}
				?></p>
				
				<p class="col-1" style="width: 35%;float: left; ">
					<?php echo $news_item->SendIn_Issue; ?>
				</p>
				<p class="col-1" style="width: 10%;float: left; "><?php
				
					if($news_item->SendIn_UpdateDate != ""){
						echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_UpdateDate));
					}
					else{
						echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_CreateDate));
					}
					
					// echo $news_item->SendIn_CreateDate;
				?></p>
				<p class="col-3" style="width: 25%;float: left; ">
					<img src="<?php echo base_url(); ?>images/icon/<?php 
						if($news_item->File_Status == '1'){
							?>vdo<?php
						}else{
							?>null<?php
						}
					?>.png" style="margin: -10px 10px 0;">
					
					<img src="<?php echo base_url(); ?>images/icon/<?php 
						if($news_item->File_Status == '2'){
							?>voice_512x512<?php
						}else{
							?>null<?php
						}
					?>.png" style="margin: -10px 10px 0;">
					
					
					<img src="<?php echo base_url(); ?>images/icon/<?php 
						if($news_item->File_Status == '3'){
							?>Document.jpg<?php
						}else{
							?>null.png<?php
						}
					?>" style="margin: -10px 10px 0;">
					
					<img src="<?php echo base_url(); ?>images/icon/<?php
						if($news_item->File_Status == '4'){
							?>like<?php
						}else{
							?>null<?php
						}
					?>.png" style="margin: -10px 10px 0;">
				</p>
			</div>
<?php
		$i++;
	endforeach;
	//End Count News's Row 
	
	if($i == 0){
?>
		<div class="news-form" style="color: red; text-align: center;">ไม่มีข้อความ</div>
<?php
	}
?>
	</div>
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
<script>
	$(".SendInformationDelete").click( function() {
		var sendin_id = $(this).attr("data-sendin_id");
		if (confirm("คุณแน่ใจว่าจะลบรายการ เลขที่ข่าว = "+sendin_id+" หรือไม่ ") == true) {
	        location.href="manageNewGROV?is_del_sendinformation=1&sendin_id="+sendin_id;
	    }
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
		$("#homeSearch").attr("action","<?php echo base_url()."manageNewGROV"; ?>/"+nextpage);
		$("#homeSearch").submit();
	}
	function lastPage(val){
		$("#homeSearch").attr("action","<?php echo base_url()."manageNewGROV"; ?>/"+val);
		$("#homeSearch").submit();
	}
	function prevPage(val){
		var prevpage = parseInt(val)-1;
		$("#homeSearch").attr("action","<?php echo base_url()."manageNewGROV"; ?>/"+prevpage);
		$("#homeSearch").submit();
	}
	function firstPage(){
		$("#homeSearch").attr("action","<?php echo base_url()."manageNewGROV"; ?>/1");
		$("#homeSearch").submit();
	}
	$('select#Ministry_ID').change(function(){
		// debugger;
	    var type_id = $('select#Ministry_ID').val();
		if (type_id != ""){
			var post_url = "<?php echo base_url(); ?>PRD_ManageNewGROV/get_department/" + type_id;
		}
		else{
			var post_url = "<?php echo base_url(); ?>PRD_ManageNewGROV/get_department/";
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
				$('#Dep_ID').empty();
				
				var text = "<option value=\"\">เลือกกรม</option>";
				$('#Dep_ID').append(text);
				
				$.each(subtype,function(index,val)
				{
					var text = ""+
					"<option value=\""+val.Dep_ID+"\">"+val.Dep_Name+"</option>";
					$('#Dep_ID').append(text);
				});
			} //end success
		}); //end AJAX
	}); //end change 
</script>