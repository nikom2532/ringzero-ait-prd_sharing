<div class="content">
	<div id="share-form">
		<form name="info_depatment_form" action="<?php echo base_url().index_page(); ?>manageInfo_Department" method="post" onsubmit="return validateForm(); " enctype="multipart/form-data" accept-charset="utf-8" />
<?php
			foreach ($department as $department_item) {
				
?>
				<input type="hidden" name="info_department_is_submit" value="yes" />
				<input type="hidden" name="dep_id" value="<?php echo $department_item->Dep_ID; ?>" />
				<div class="row" id="gove-title" style="margin-top:5%;">
					รายละเอียดข้อมูล
				</div>
		
				<div id="manage-info">
					<div id="search-form">
						<div class="row">
							<div class="col-lg-12">
								<label >ลำดับที่:</label>
								<span class="number"><?php echo $department_item->Dep_ID; ?></span>
							</div>
							<div class="col-lg-12" style="width: 386px; ">
								<label >ชื่อกระทรวง: <span style="color: #FF0000; font-family: sans-serif; ">*</span></label>
								<span class="select-menu" style="width: 250px; background-position: 218px 0; ">
									<span>เลือกชื่อกระทรวง</span>
									<select class="select-opt" name="ministry_id" id="ministry_id">
<?php
										foreach ($ministry as $ministry_item) {
											?><option value="<?php echo $ministry_item->Minis_ID ?>" <?php
												
												if($ministry_item->Minis_ID == $department_item->Ministry_ID){
													?>selected='selected'<?php
												}
												
											?>><?php echo $ministry_item->Minis_Name; ?></option><?php
										}
?>
									</select>
								</span>
							</div>
							<div class="col-lg-12" style="margin-top: 31px; ">
								<label >ชื่อกรม: <span style="color: #FF0000; font-family: sans-serif; ">*</span></label>
								<input type="text" class="form-control txt-field" name="dep_name" id="dep_name" value="<?php echo $department_item->Dep_Name; ?>" placeholder="" required="required">
							</div>
							<div class="col-lg-12">
								<label >รายละเอียด: <span style="color: #FF0000; font-family: sans-serif; ">*</span></label>
								<textarea rows="4" cols="50" class="txt-area" name="dep_desc" required="required"><?php echo $department_item->Dep_Desc; ?></textarea>
							</div>
							<div class="col-lg-12">
								<label >สถานะการใช้งาน: <span style="color: #FF0000; font-family: sans-serif; ">*</span></label>
								<select class="select-opt" name="dep_status">
									<option value="1" <?php if($department_item->Dep_Status == "1"){ ?>selected='selected'<?php } ?>>ใช้งานได้</option>
									<option value="0" <?php if($department_item->Dep_Status == "0"){ ?>selected='selected'<?php } ?>>ใช้งานไม่ได้</option>
								</select>
							</div>
						</div>
		
						<!--<div class="col-lg-12" style="text-align: center;">
						<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:18%;padding: 4px;">
						</div>-->
		
					</div>
		
					<div class="col-lg-12" style="text-align: center;">
						<input class="bt" type="submit" value="บันทึก" name="share">
					</div>
				</div><!-- #manage-info -->
<?php
			}
?>
		</form>
	</div>
</div>
<script>
	function validateForm() {
		var ministry_id = document.forms["info_depatment_form"]["ministry_id"].value;
		if (ministry_id==null || ministry_id=="") {
			alert("โปรดใส่ค่า ชื่อกระทรวง");
			return false;
		}
		
		var dep_name = document.forms["info_depatment_form"]["dep_name"].value;
		if (dep_name==null || dep_name=="") {
			alert("โปรดใส่ค่า ชื่อกรม");
			return false;
		}
		
		var dep_desc = document.forms["info_depatment_form"]["dep_desc"].value;
		if (dep_desc==null || dep_desc=="") {
			alert("โปรดใส่ค่า รายละเอียด");
			return false;
		}
		
		var dep_status = document.forms["info_depatment_form"]["dep_status"].value;
		if (dep_status==null || dep_status=="") {
			alert("โปรดลือกค่า สถานะการใช้งาน");
			return false;
		}
<?php
		foreach ($check_Department_Name as $name) {
			if($name->Dep_Name != $department_item->Dep_Name){
?>
				if(document.forms["info_depatment_form"]["dep_name"].value == "<?php echo $name->Dep_Name; ?>"){
					alert("โปรดใส่ค่า ชื่อกรม ใหม่ เนื่องจาก ชื่อกรมซ้ำกันกับในฐานข้อมูล");
					document.getElementById("dep_name").focus();
					return false;
				}
<?php
			}
		}
?>
	}
	
	$(function(){
        var selectmenu_txt = $("#ministry_id").find("option:selected").text();
			$("#ministry_id").prev("span").text(selectmenu_txt);
		
		var selectmenu_txt = $("#dep_status").find("option:selected").text();
			$("#dep_status").prev("span").text(selectmenu_txt);
		
        $(".select-menu > select").live("change",function(){
            var selectmenu_txt = $(this).find("option:selected").text();
            $(this).prev("span").text(selectmenu_txt);
        });
    });
</script>