<div class="content">
	<div id="share-form">
		<form name="info_depatment_form" action="<?php echo base_url().index_page(); ?>manageInfo_Department" method="post" onsubmit="return validateForm(); " enctype="multipart/form-data" accept-charset="utf-8">
			<input type="hidden" name="info_department_is_add" value="yes" />
			<div class="row" id="gove-title" style="margin-top:5%;">
				รายละเอียดข้อมูล
			</div>
	
			<div id="manage-info">
				<div id="search-form">
					<div class="row">
						<div class="col-lg-12" style="width: 386px; ">
							<label >ชื่อกระทรวง:</label>
							<span class="select-menu" style="width: 250px; background-position: 218px 0; ">
								<span>เลือกชื่อกระทรวง</span>
								<select class="select-opt" name="ministry_id" id="ministry_id">
									<option value="">โปรดเลือก ชื่อกระทรวง</option>
	<?php
									foreach ($ministry as $ministry_item) {
										?><option value="<?php echo $ministry_item->Minis_ID ?>"><?php echo $ministry_item->Minis_Name; ?></option><?php
									}
	?>
								</select>
							</span>
						</div>
						<div class="col-lg-12" style="margin-top: 31px; ">
							<label >ชื่อกรม:</label>
							<input type="text" class="form-control txt-field" name="dep_name" id="dep_name" value="" placeholder="" required="required">
						</div>
						<div class="col-lg-12">
							<label >รายละเอียด:</label>
							<textarea rows="4" cols="50" class="txt-area" name="dep_desc" required="required"></textarea>
						</div>
						<div class="col-lg-12" style="width: 386px; ">
							<label >สถานะการใช้งาน:</label>
							<span class="select-menu" style="width: 250px; background-position: 218px 0; ">
								<span>เลือกชื่อกระทรวง</span>
								<select class="select-opt" name="dep_status" id="dep_status">
									<option value="" >เลือกสถานะการใช้งาน</option>
									<option value="1" >ใช้งานได้</option>
									<option value="0" selected='selected'>ใช้งานไม่ได้</option>
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
			alert("โปรดใส่ค่า รายละเอียด");
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