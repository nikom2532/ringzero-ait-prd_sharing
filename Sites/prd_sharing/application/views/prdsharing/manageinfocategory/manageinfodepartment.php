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
		<form name="form" name="manageinfo_department_form" id="manageinfo_department_form" action="<?php echo base_url().index_page(); ?>manageInfo_Department" method="post">
			<input type="hidden" name="manageInfo_Category_is_search" value="yes" />
			<div id="search-form">
				<div class="row">
					<div class="col-lg-6">
						<label >คำค้นหา</label>
						<input type="text" class="form-control" name="dep_name" id="dep_name" value="<?php if(isset($post_dep_name)){ echo $post_dep_name; } ?>" placeholder="" />
					</div>
					<div class="col-lg-6">
						<label >สถานะ</label>
						<span class="select-menu">
						<span>เลือกสถานะ</span>
						<!-- <input type="text" class="form-control" id="InputKeyword" placeholder="" > -->
						<select name="dep_status" style="">
							<option value="" >เลือกสถานะ</option>
							<option value="1" <?php
								if(isset($post_dep_status)){
									if($post_dep_status == "1"){
										?>selected="selected"<?php
									}
								}
							?>>ใช้งานได้</option>
							<option value="0" <?php
								if(isset($post_dep_status)){
									if($post_dep_status == "0"){
										?>selected="selected"<?php
									}
								}
							?>>ใช้งานไม่ได้</option>
						</select>
						</span>
					</div>
				</div>
	
				<div class="col-lg-12" style="text-align: center;">
					<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:18%;padding: 4px;">
				</div>
			</div>
		</form>
	</div>

	<div id="table-list">
		<div class="row">
			<div class="col-lg-left" style="margin-top: 20px;font-weight: bold;width: 100%;">
				<a href="<?php echo base_url().index_page(); ?>manageInfo_Category">
				<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
					Category
				</p></a>
				<a href="<?php echo base_url().index_page(); ?>manageInfo_Ministry">
				<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
					Ministry
				</p></a>
				<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;text-align:center;float: left;margin-left: 10px;width: 15%;">
					Department
				</p>
				<input class="bt" type="submit" value="เพิ่ม" name="share" style="padding: 4px;float: right; width: 10%;" onclick="location.href='infoDepartmentNew'; ">
			</div>
		</div>

		<div class="row" style="text-align: center;">
			<div class="header-table">
				<p class="col-1" style="width: 5%;float: left; ">
					ลำดับที่
				</p>
				<p class="col-2" style="width: 5%;float: left; ">
					ลบ
				</p>
				<p class="col-2" style="width: 20%;float: left; ">
					รหัสกรม
				</p>
				<p class="col-3" style="width: 30%;float: left; ">
					ชื่อกระทรวง
				</p>
				<p class="col-3" style="width: 30%;float: left; ">
					ชื่อกรม
				</p>
				<p class="col-3" style="width: 10%;float: left; ">
					สถานะใช้งาน
				</p>
			</div>
<?php
			$i = 1;
			foreach ($department as $department_item) {
				
				if($i%2 == 1){
					?><div class="odd" style="text-align: center;"><?php
				}
				else{
					?><div class="event"><?php
				}
?>
						<p class="col-1" style="width: 5%;float: left; ">
							<?php echo $i; ?>
						</p>
						<p class="col-2 DepartmentDelete" data-dep_id="<?php echo $department_item->Dep_ID; ?>" style="width: 5%;float: left; cursor:pointer; " <?php /* onclick="DepartmentDelete('<?php echo $department_item->Dep_ID; ?>')" */ ?>  >
							<img src="<?php echo base_url(); ?>images/icon/delete.png" style="margin: -5px 10px 0;">
						</p>
						<p class="col-2" style="width: 20%;float: left; ">
							<a href="<?php echo base_url().index_page(); ?>infoDepartment?dep_id=<?php echo $department_item->Dep_ID; ?>"><?php echo $department_item->Dep_ID; ?></a>
						</p>
						<p class="col-3" style="width: 30%;float: left; ">
							<?php echo $department_item->Minis_Name; ?>
						</p>
						<p class="col-3" style="width: 30%;float: left; ">
							<?php echo $department_item->Dep_Name; ?>
						</p>
						<p class="col-3" style="width: 10%;float: left; ">
<?php 
							if($department_item->Dep_Status == 1){
								echo "ใช้งานได้"; 
							}
							elseif($department_item->Dep_Status == 0 || $ministry_item->Minis_Status == null || $ministry_item->Minis_Status == ""){
								echo "ใช้งานไม่ได้"; 
							}
?>
						</p>
					</div>
<?php
				$i++;
			}
?>
		</div>
	</div>
</div>
<div class="footer-table" style="background-color: inherit">
	<p style="width: 70%;float: left;margin-top: 20px;">
		<span><?php echo "ทั้งหมด : ".$count_row." รายการ (".$total_page." หน้า )"; ?></span>
	</p>
    
    <p style="width: 30%;float: left;margin-top: 20px;text-align: right;">
    	<a href="javascript:firstPage()"><img src="<?php echo base_url(); ?>img/prew.png"></a><?php
    	if($current_page != 1){
    		?><a href="javascript:prevPage('<?php echo $current_page; ?>')"><img src="<?php echo base_url(); ?>img/prev.png"></a><?php
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
        ?><a href="javascript:lastPage('<?php echo $total_page; ?>')"><img src="<?php echo base_url(); ?>img/next2.png"></a>
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
		$("#manageinfo_department_form").attr("action","<?php echo base_url()."manageInfo_Department"; ?>/"+nextpage);
		$("#manageinfo_department_form").submit();
	}
	function lastPage(val){
		$("#manageinfo_department_form").attr("action","<?php echo base_url()."manageInfo_Department"; ?>/"+val);
		$("#manageinfo_department_form").submit();
	}
	function prevPage(val){
		var prevpage = parseInt(val)-1;
		$("#manageinfo_department_form").attr("action","<?php echo base_url()."manageInfo_Department"; ?>/"+prevpage);
		$("#manageinfo_department_form").submit();
	}
	function firstPage(){
		$("#manageinfo_department_form").attr("action","<?php echo base_url()."manageInfo_Department"; ?>/1");
		$("#manageinfo_department_form").submit();
	}
	
	$(".DepartmentDelete").click( function() {
		var dep_id = $(this).attr("data-dep_id");
		if (confirm("คุณแน่ใจว่าจะลบหรือไม่ "+dep_id) == true) {
	        location.href="manageInfo_Department?del_department=1&dep_id="+dep_id;
	    }
	});
</script>
