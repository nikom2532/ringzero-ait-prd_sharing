<script src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script>
<script>
    $(function(){
        $(".select-menu > select > option:eq(0)").attr("selected","selected");
        $(".select-menu > select").live("change",function(){
            var selectmenu_txt = $(this).find("option:selected").text();
            $(this).prev("span").text(selectmenu_txt);
        });
        
    });
</script>
<div class="content">
	<div id="share-form">
		<div id="search-form">

			<div class="row">
				<div class="col-lg-12">
					<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
					<input class="txt-field" type="text" value="" name="date-from"  placeholder="" style=" margin-left: 15px;width: 77%;" >
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<label >วันที่</label>
					<input type="text" class="form-control" id="InputKeyword" placeholder="" >
				</div>
				<div class="col-lg-6">
					<label >ถึง</label>
					<input type="text" class="form-control" id="InputKeyword" placeholder="" >
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<label >หมวดหมู่ข่าว</label>
					<span class="select-menu">
					<span>เลือกหมวดหมู่ข่าว</span>
						<select>
							<option></option>
						</select>
					</span>
				</div>
				<div class="col-lg-6">
					<label >หมวดหมู่ข่าวย่อย</label>
					<span class="select-menu">
					<span>เลือกหมวดหมู่ข่าว</span>
						<select>
							<option></option>
						</select>
					</span>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<label >หน่วยงาน</label>
					<span class="select-menu">
					<span>เลือกหน่วยงาน</span>
						<select>
							<option></option>
						</select>
					</span>
				</div>
				  <div class="col-lg-6">
					<label >ชื่อนักข่าว</label>
					<span class="select-menu">
					<span>เลือกนักข่าว</span>
					  <select name="UserId" id="UserId" class="chosen-select" placeholder="">
						<option value="0"> เลือกนักข่าว</option>
					  </select>
					</span>
				</div>
			</div>
			<div class="col-lg-12" style="text-align: center;">
				<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:18%;padding: 4px;">
			</div>

		</div>
	</div>

	<div id="table-list">
		<div class="row">
			<div class="col-lg-left" style="">
				<img src="<?php echo base_url(); ?>images/rss_btn.png" style="" id="makeRss">
				<img src="<?php echo base_url(); ?>images/rss.png" style="">
				<input type="text" class="form-control" id="InputRss" placeholder="" style="margin-top: -30px;
				padding: 20px 18px 0;
				vertical-align: baseline;width:50%">
			</div>
		</div>

		<div class="row">
			<div class="header-table">
				<p class="col-1" style="width: 5%;float: left; ">
					
				</p>
				<p class="col-2" style="width: 5%;float: left; ">
					วันที่ข่าว
				</p>
				<p class="col-3" style="width: 70%;float: left; ">
					หัวข้อข่าว
				</p>
				<p class="col-4" style="width: 20%;float: left; ">
					Icon ไฟล์แนบ
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
					<p class="col-1" style="width: 5%;float: left; ">
						<?php echo ($i+1); ?>
					</p>
					<p class="col-2" style="width: 15%;float: left; ">
						<!-- 03/02/2557</br>00:00:00 -->
<?php
						echo date("d/m/Y", strtotime($news_item->NT01_NewsDate))."<br />".date("h:m:s", strtotime($news_item->NT01_NewsDate));
?>
					</p>
					<p class="col-3" style="width: 60%;float: left; ">
						<a href="<?php echo base_url().index_page(); ?>detail_prd?news_id=<?php echo $news_item->NT01_NewsID; ?>"><?php echo $news_item->NT01_NewsTitle; ?></a>
					</p>
					<p class="col-4" style="width: 20%;float: left;  text-align: center; text-align: center; ">
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
			</div>
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
			// alert(data);
			var url = "<?php echo base_url()?>index.php/prd_rss/view_rss/"+data;
			$("#InputRss").val(url).select();
		 });
	 });
});
</script>