<style>
	.select-menu{
		margin-bottom: inherit;
	}
</style>
<div id="search-form">
	<form name="homeSearch" id="homeSearch" action="<?php echo base_url().index_page(); ?>manageNewGROV" method="post">
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
					<select name="TypeID" id="TypeID" class="form-control">
						<option selected="selected" value="0">เลือกสถานะ</option>
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
		foreach($news as $news_item){
			if($i % 2 == 0){
				?><div class="odd" style="width: 1400px; "><?php
			}
			elseif($i % 2 == 1){
				?><div class="event" style="width: 1400px; "><?php
			}
?>
					<p class="col-1" style="width: 5%;float: left; ">
						<?php echo $i; ?>
					</p>
					<p class="col-1" style="width: 10%;float: left; ">
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
						<?php echo mb_substr($news_item->SendIn_Issue, 0, 50, 'UTF-8'); ?>
					</p>
					<p class="col-2" style="width: 20%;float: left; ">
<?php 
						$strSendIn_Detail = mb_substr($news_item->SendIn_Detail, 0, 50, 'UTF-8');
						$strSendIn_Detail = str_replace("<p>", "", $strSendIn_Detail);
						$strSendIn_Detail = str_replace("</p>", "", $strSendIn_Detail);
						echo $strSendIn_Detail;
						// echo mb_substr($news_item->SendIn_Detail, 0, 50, 'UTF-8'); 
?>
					</p>
					<p class="col-1" style="width: 10%;float: left; ">
						<?php echo $news_item->Mem_Name." ".$news_item->Mem_LasName; ?>
					</p>
					<p class="col-1" style="width: 10%;float: left; text-align: center; ">
<?php 
						if($news_item->SendIn_Status == "1"){
							echo "เผยแพร่";
						}
						else if($news_item->SendIn_Status == "0"){
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
		}
?>
	</div>
	<div class="footer-table">
		<p style="width: 70%;float: left;margin-top: 20px;">
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
		</p>
	</div>
	
</div>
<script>
    $(function(){
        $(".select-menu > select > option:eq(0)").attr("selected","selected");
        $(".select-menu > select").live("change",function(){
            var selectmenu_txt = $(this).find("option:selected").text();
            $(this).prev("span").text(selectmenu_txt);
        });
        
    });
</script>