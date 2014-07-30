<div class="content">
	<div id="share-form">
		<form name="form_infoministry" action="<?php echo base_url().index_page(); ?>manageInfo_Ministry" method="post" onsubmit="return validateForm(); " enctype="multipart/form-data" accept-charset="utf-8">
			<input type="hidden" name="info_ministry_is_submit" value="yes" />
<?php
			// var_dump($ministry);
			foreach ($ministry as $ministry_item) {
				// var_dump($ministry_item->Minis_ID);
				
?>
				<input type="hidden" name="minis_id" value="<?php echo $ministry_item->Minis_ID; ?>" />
				<div class="row" id="gove-title">
					รายละเอียดข้อมูล
				</div>
		
				<div id="manage-info">
					<div id="search-form">
						<div class="row">
							<div class="col-lg-12">
								<label >ลำดับที่:</label>
								<span class="number"><?php echo $ministry_item->Minis_ID; ?></span>
							</div>
							<div class="col-lg-12">
								<label >ชื่อกระทรวง: <span style="color: #FF0000; font-family: sans-serif; ">*</span></label>
								<input type="text" class="form-control txt-field" name="minis_name" id="minis_name" value="<?php echo $ministry_item->Minis_Name; ?>" placeholder="" required="required">
							</div>
							<div class="col-lg-12">
								<label >รายละเอียด: <span style="color: #FF0000; font-family: sans-serif; ">*</span></label>
								<textarea rows="4" cols="50" name="minis_desc" class="txt-area" required="required"><?php echo $ministry_item->Minis_Desc; ?></textarea>
							</div>
							<div class="col-lg-12" style="width: 386px; ">
								<label >สถานะการใช้งาน: <span style="color: #FF0000; font-family: sans-serif; ">*</span></label>
								<span class="select-menu" style="width: 250px; background-position: 218px 0; ">
									<span>เลือกหมวดหมู่ข่าว</span>
									<select class="select-opt" name="minis_status" id="minis_status">
										<option value="" >เลือกสถานะการใช้งาน</option>
										<option value="1" <?php if($ministry_item->Minis_Status == "1"){ ?>selected=''<?php } ?>>ใช้งานได้</option>
										<option value="0" <?php if($ministry_item->Minis_Status == "0"){ ?>selected=''<?php } ?>>ใช้งานไม่ได้</option>
									</select>
								</span>
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
		var minis_name = document.forms["form_infoministry"]["minis_name"].value;
		if (minis_name==null || minis_name=="") {
			alert("โปรดใส่ค่า ชื่อกระทรวง");
			return false;
		}
		
		var minis_desc = document.forms["form_infoministry"]["minis_desc"].value;
		if (minis_desc==null || minis_desc=="") {
			alert("โปรดใส่ค่า รายละเอียด");
			return false;
		}
		
		var minis_status = document.forms["form_infoministry"]["minis_status"].value;
		if (minis_status==null || minis_status=="") {
			alert("โปรดเลือกค่า สถานะการใช้งาน");
			return false;
		}
<?php
		foreach ($check_Ministry_Name as $name) {
			if($name->Minis_Name != $ministry_item->Minis_Name){
?>
				if($("#minis_name").val() == "<?php echo $name->Minis_Name; ?>"){
					alert("โปรดใส่ค่า ชื่อกระทรวง เนื่องจาก ชื่อกระทรวงซ้ำกันกับในฐานข้อมูล");
					document.getElementById("minis_name").focus();
					return false;
				}
<?php
			}
		}
?>
	}
	
	$(function(){
        var selectmenu_txt = $("#minis_status").find("option:selected").text();
			$("#minis_status").prev("span").text(selectmenu_txt);
			
        $(".select-menu > select").live("change",function(){
            var selectmenu_txt = $(this).find("option:selected").text();
            $(this).prev("span").text(selectmenu_txt);
        });
    });
</script>
