<style>
	.row .col-lg-6 span.select-menu{
		width: 62%;	
	}
	.row .col-lg-6 span.select-menu select,
	#sentnews .col-lg-6 select{
		width: 100%;
	}
	.select-menu:hover {
	    background: url(../images/arrowhover.png) no-repeat 100% 0px #FFFFFF;
	}
	.select-menu {
	    background: url(../images/arrowhover.png) no-repeat 100% 0px #FFFFFF;
	}
	
	.uploadfile_video .col-lg-12,
	.uploadfile_voice .col-lg-12,
	.uploadfile_document .col-lg-12,
	.uploadfile_picture .col-lg-12{
	    border-bottom: 1px dashed #d5d1e0;
	    margin-top: 15px;
	    padding-bottom: 2px;
	    width: 90%;
	    margin-left: 0;
	}
	.uploadfile_video .col-lg-12 input,
	.uploadfile_voice .col-lg-12 input,
	.uploadfile_document .col-lg-12 input,
	.uploadfile_picture .col-lg-12 input{
		border: 0;
	}
	
	input#addmorefile{
		padding: 6px 8px;
	}
	.show_size .clear{
		clear: both;
	}
	.show_size .line1{
		margin-left: 5%; margin-bottom: 40px; color: #cc0000; text-align: center; 
	}
	.show_size .line2{
		margin-left: 5%; margin-bottom: 10px; color: #444444; text-align: center; 
	}
	.show_size .line2-1{
		float: left; width: 40%; text-align: right; 
	}
	.show_size .line2-2{
		float: left; width: 55%; margin-left: 2%; text-align: left; 
	}
	.show_size .line3{
		margin-left: 5%; margin-bottom: 10px; color: #444444; text-align: center; 
	}
	.show_size .line3-1{
		float: left; width: 40%; text-align: right; 
	}
	.show_size .line3-2{
		float: left; width: 55%; margin-left: 2%; text-align: left;
	}
	.show_size .line4{
		 margin-left: 5%; margin-bottom: 40px; color: #444444; text-align: center; 
	}
	.show_size .line4-1{
		float: left; width: 40%; text-align: right; 
	}
	.show_size .line4-2{
		float: left; width: 55%; margin-left: 2%; text-align: left;
	}
	
</style>
<form name="form_sendnew" id="form_sendnew" action="<?php echo base_url().index_page(); ?>sentNew_Upload" method="post" onsubmit="return validateForm(); " enctype="multipart/form-data" accept-charset="utf-8">
	<input type="hidden" name="sentnew_is_add" value="yes" />
	
	<fieldset class="frame-input">
		<legend >
			News Information
		</legend>
		<div id="sentnews" class="table-list">
			<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
			<div class="row">
				<div class="col-lg-6">
					<label >ข่าววันที่ <span style="color:red; ">*</span></label>
					<input type="text" class="form-control datepicker" name="create_date" id="create_date" placeholder="" required="required" value="<?php echo date("Y-m-d"); ?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >กระทรวง</label>
					<span class="select-menu">
						<span>เลือกกระทรวง</span>
						<select name="Minis_ID" id="Minis_ID" style="width: 100%; ">
							<option value="">เลือกกระทรวง</option>
<?php
							foreach ($Ministry as $Ministry_item) {
								?><option data-minis_id="<?php echo $Ministry_item->Minis_ID;?>" value="<?php echo $Ministry_item->Minis_ID;?>"><?php echo $Ministry_item->Minis_Name;?></option><?php
							}
?>
						</select>
					</span>
				</div>
				<div class="col-lg-6">
					<label >กรม</label>
					<span class="select-menu">
						<span>เลือกกรม</span>
						<select name="Dep_ID" id="Dep_ID">
							<option value="">เลือกกรม</option>
<?php
							/*
							// var_dump($Department);
							foreach ($Department as $Department_item) {
								?><option data-minis_id="<?php
									foreach ($Ministry as $Ministry_item) {
										if($Department_item->Ministry_ID == $Ministry_item->Minis_ID){
											echo $Ministry_item->Minis_ID;
										}
									}
								?>" value="<?php echo $Department_item->Dep_ID;?>"><?php echo $Department_item->Dep_Name;?></option><?php
							}
							*/
							/* ?><option value=""></option><?php */
?>
						</select>
					</span>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >นโยบายรัฐบาล</label>
					<span class="select-menu">
						<span>เลือกนโยบายรัฐบาล</span>
						<select name="NT05_PolicyID" id="NT05_PolicyID">
							<option value="">เลือกนโยบาย</option>
	<?php
							foreach ($NT05_Policy as $NT05_Policy_item) {
								?><option value="<?php 
									echo $NT05_Policy_item->NT05_PolicyID;?>"><?php echo $NT05_Policy_item->NT05_PolicyName;
								?></option><?php
							}
	?>
						</select>
					</span>
				</div>
	
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >กลุ่มเป้าหมาย</label>
					<span class="select-menu">
						<span>เลือกกลุ่มเป้าหมาย</span>
						<select name="Tar_ID" id="Tar_ID">
							<option value="-1" id="target0">เลือกกลุ่มเป้าหมาย</option>
	<?php
							$i=1;
							foreach ($TargetGroup as $TargetGroup_item) {
								?><option id="target<?php echo $i; ?>" value="<?php echo $TargetGroup_item->Tar_ID;?>"><?php echo $TargetGroup_item->Tar_Name;?></option><?php
								$i++;
							}
	?>
						</select>
					</span>
				</div>
			</div>
			
			<?php // For toggle กลุ่มเป้าหมาย  ?>
			<style>
				.grov_active_col.row,
				.prd_active_col.row{
					display:none;
				}
			</style>
			
			<div class="row grov_active_col" >
				<div class="col-lg-6">
					<label id="grov_status" >หน่วยงานภาครัฐ</label>
					<span class="select-menu">
						<span>เลือกหน่วยงานภาครัฐ</span>
						<select name="grov_status" id="grov_status">
							<option value="">เลือกหน่วยงานภาครัฐ</option>
	<?php
	/*
							// foreach ($SC07_Department as $Department_item) {
								// ?><option value="<?php echo $Department_item->SC07_DepartmentId;?>"><?php echo $Department_item->SC07_DepartmentName;?></option><?php
							// }
							*/
							foreach ($Ministry as $Ministry_item) {
								?><option value="<?php echo $Ministry_item->Minis_ID;?>"><?php echo $Ministry_item->Minis_Name;?></option><?php
							}
	?>
						</select>
					</span>
				</div>
			</div>
			
			<div class="row prd_active_col" >
				<div class="col-lg-6">
					<label id="prd_status" >หน่วยงานสำนักข่าวกรมประชาสัมพันธ์</label>
					<span class="select-menu">
						<span>เลือกหน่วยงานสำนักข่าวกรมประชาสัมพันธ์</span>
						<select name="prd_status" id="prd_status">
							<option value="">เลือกหน่วยงานสำนักข่าวกรมประชาสัมพันธ์</option>
<?php
							/*
							// foreach ($Ministry as $Ministry_item) {
								// ?><option value="<?php echo $Ministry_item->Minis_ID;?>"><?php echo $Ministry_item->Minis_Name;?></option><?php
							// }
							*/
							foreach ($SC07_Department as $Department_item) {
								?><option value="<?php echo $Department_item->SC07_DepartmentId;?>"><?php echo $Department_item->SC07_DepartmentName;?></option><?php
							}
?>
						</select>
					</span>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-11">
					<label >แผนงานโครงการ/กิจกรรม <span style="color:red; ">*</span></label>
					<input type="text" class="form-control" name="SendIn_Plan" id="SendIn_Plan" placeholder="" required="required" >
				</div>
			</div>
			<div class="row">
				<div class="col-lg-11">
					<label >ประเด็นประชาสัมพันธ์ <span style="color:red; ">*</span></label>
					<input type="text" class="form-control" name="SendIn_Issue" id="SendIn_Issue" placeholder="" />
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-11">
					<label >เนื้อหา <span style="color:red; ">*</span></label>
					<textarea class="ckeditor" name="SendIn_Detail" id="SendIn_Detail"></textarea>
				</div>
			</div>
			
			<!--<div class="col-lg-12" style="text-align: center;    float: left;">
			<input class="bt_gray" type="submit" name="share" value="บันทึก">
			<input class="bt_gray" type="submit" name="share" value="ยกเลิก">
			</div>-->
	
		</div><!-- #sentnews -->
	</fieldset>
	
	<fieldset class="frame-input show_size">
		<legend >
			File Upload
		</legend>
		<div class="line1">
			เอกสาร ขนาด File ทัั้งหมดรวมกันจะต้องไม่เกิน 40 MB
		</div>
		<div class="line2">
			<div class="line2-1">
				จำนวนขนาด File ที่กำลัง Upload : 
			</div>
			<div class="line2-2">
				<span class="total_before_file_size">0</span>
				<span class="total_before_file_unit">Bytes</span>  
				(<span class="total_before_file_size_bytes">0</span>
				<span class="total_before_file_unit_bytes">Bytes</span>)
			</div>
			<div style="clear: both; "></div>
		</div>	
		
		<div class="uploadfile_video uploadfile">
			<div style="margin-left: 5%; color: #000000; float: left; ">
				Video *
			</div>
			<div style="margin-left: 5%; color: #cc0000; ">
				รองรับนามสกุล .mp4, .avi, .wmv, .flv
			</div>
			
			<div class="row file_1" style="margin-bottom: 0; ">
				<div class="col-lg-12" style="margin-left: 5%; ">
					<span class="label_file" >file แนบเอกสาร</span>
					<input type="file" class="form-control" name="fileattach_video1" id="fileattach" onchange="check_file_ext('video', '1');" placeholder="" style="width: 40%; " multiple />
					<img src="<?php echo base_url(); ?>images/icon/delete_lock2.png" name="reducemorefile" id="reducemorefile" data-file_id="1" style="width: 20px; margin-left: 15px; cursor: pointer; " />
				</div>
			</div>
		</div>
		<div class="row uploadfile_video_btn">
			<div style="text-align: center;">
				<input class="bt_gray" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
			</div>
		</div>
		
		<div class="uploadfile_voice uploadfile">
			<div style="margin-left: 5%; color: #000000; float: left; ">
				เสียง *
			</div>
			<div style="margin-left: 5%; color: #cc0000; ">
				รองรับนามสกุล .mp3, .ogg, .wma
			</div>
			<div class="row file_1" style="margin-bottom: 0; ">
				<div class="col-lg-12" style="margin-left: 5%; ">
					<span class="label_file" >file แนบเอกสาร</span>
					<input type="file" class="form-control" name="fileattach_voice1" id="fileattach" onchange="check_file_ext('voice', '1');" placeholder="" style="width: 40%; " multiple />
					<img src="<?php echo base_url(); ?>images/icon/delete_lock2.png" name="reducemorefile" id="reducemorefile" data-file_id="1" style="width: 20px; margin-left: 15px; cursor: pointer; " />
				</div>
				<!-- <div class="col-lg-6">
					<input class="bt_gray" type="button" name="reducemorefile" id="reducemorefile" data-file_id="1" value="ลด file แนบเอกสาร" style="background-color: #E20000; border: 1px solid #E20000" />
				</div> -->
			</div>
		</div>
		<div class="row uploadfile_voice_btn">
			<div style="text-align: center;">
				<input class="bt_gray" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
			</div>
		</div>
		
		<div class="uploadfile_document uploadfile">
			<div style="margin-left: 5%; color: #000000; float: left; ">
				เอกสาร *
			</div>
			<div style="margin-left: 5%; color: #cc0000; ">
				รองรับนามสกุล .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .csv
			</div>
			<div class="row file_1" style="margin-bottom: 0; ">
				<div class="col-lg-12" style="margin-left: 5%; ">
					<span class="label_file" >file แนบเอกสาร</span>
					<input type="file" class="form-control" name="fileattach_document1" id="fileattach" onchange="check_file_ext('document', '1');" placeholder="" style="width: 40%; " multiple />
					<img src="<?php echo base_url(); ?>images/icon/delete_lock2.png" name="reducemorefile" id="reducemorefile" data-file_id="1" style="width: 20px; margin-left: 15px; cursor: pointer; " />
				</div>
			</div>
		</div>
		<div class="row uploadfile_document_btn">
			<div style="text-align: center;">
				<input class="bt_gray" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
			</div>
		</div>
		
		<div class="uploadfile_picture uploadfile">
			<div style="margin-left: 5%; color: #000000; float: left; ">
				รูปภาพ *
			</div>
			<div style="margin-left: 5%; color: #cc0000; ">
				รองรับนามสกุล .jpg, .jpeg, .gif, .png
			</div>
			<div class="row file_1" style="margin-bottom: 0; ">
				<div class="col-lg-12" style="margin-left: 5%; ">
					<span class="label_file" >file แนบเอกสาร</span>
					<input type="file" class="form-control" name="fileattach_picture1" id="fileattach" onchange="check_file_ext('picture', '1');" placeholder="" style="width: 40%; " multiple />
					<img src="<?php echo base_url(); ?>images/icon/delete_lock2.png" name="reducemorefile" id="reducemorefile" data-file_id="1" style="width: 20px; margin-left: 15px; cursor: pointer; " />
				</div>
			</div>
		</div>
		<div class="row uploadfile_picture_btn">
			<div style="text-align: center;">
				<input class="bt_gray" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
			</div>
		</div>
		
	</fieldset>
	
	<div class="row">
		<div class="col-lg-12" style="text-align: center;    float: left;">
			<input class="bt" type="submit" name="share" value="บันทึก">
			<input class="bt" type="button" name="cancel" id="cancel" value="ยกเลิก">
		</div>
	</div>
	
</form>
<script>
	$(function(){
		$(".datepicker").datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeMonth: true,
			changeYear: true,
			minDate: 0
		});
	});
	
	/*
	$("select#Minis_ID").change(function() {
		
		// var minis_id = $(this).attr("data-minis_id");
		// var minis_id = $("select#Minis_ID:selected").attr("data-minis_id");
		
		var minis_id = $(this).find(':selected').data('minis_id');
		
		// if(minis_id == $(select#Dep_ID).data('minis_id')){
// 						
		// }
		
		// $(select#Dep_ID).data('minis_id')
		
		// if(minis_id == )
		// alert(this);
		alert(minis_id);
	});
	*/
	
	$('select#Minis_ID').change(function(){
		// debugger;
	    var type_id = $('select#Minis_ID').val();
	    if (type_id != ""){
	        var post_url = "<?php echo base_url().index_page(); ?>PRD_sentNew/get_Department/" + type_id;
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
						text = ""+
						"<option value=\""+val.Dep_ID+"\">"+val.Dep_Name+"</option>";
						$('#Dep_ID').append(text);
					});
					var selectmenu_txt = $("#Dep_ID").find("option:selected").text();
					$("#Dep_ID").prev("span").text(selectmenu_txt);
				} //end success
			}); //end AJAX
	    } else {
	        $('#SubTypeID').empty();
	    }//end if
	}); //end change 
	// $("select#Tar_ID").text("asdf");
	
	$("select#Tar_ID").change(function(){
		$( "select#Tar_ID option#target0:selected" ).each(function() {
			$(".grov_active_col").css("display", "none");
			$(".prd_active_col").css("display", "none");
		});
		
		$( "select#Tar_ID option#target1:selected" ).each(function() {
			$(".grov_active_col").css("display", "BLOCK");
			$(".prd_active_col").css("display", "BLOCK");
		});
		
		$( "select#Tar_ID option#target2:selected" ).each(function() {
			$(".grov_active_col").css("display", "none");
			$(".prd_active_col").css("display", "BLOCK");
		});
	});
	
	//############################### Video ####################################
	
	var count_input_files = 4;
	
	var number_video = 2;
	$(".uploadfile_video_btn input#addmorefile").live('click', function(){
		var str = "" +
		"<div class=\"row file_"+(number_video)+"\" style=\"margin-bottom: 0;\">"+
		"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
		"		<span class=\"label_file\">file แนบเอกสาร</span>"+
		"		<input type=\"file\" class=\"form-control\" name=\"fileattach_video"+(number_video)+"\" id=\"fileattach\"  onchange=\"check_file_ext('video', '"+(number_video)+"');\" style=\"width: 40%; \" multiple />"+
		"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number_video)+"\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
		"	</div>"+
		"</div>";
		
		$("div.uploadfile_video").append(str);
		number_video++;
		count_input_files++;
	});
	
	$(".uploadfile_video #reducemorefile").live('click', function(){
		var file_id = $(this).attr("data-file_id");
		// var file_id = $(this).data("file_id");
		
		$("div.uploadfile_video .row.file_"+file_id).remove();
		// number--;
		count_input_files--;
	});
	
	//############################### Voice ####################################
	
	var number_voice = 2;
	$(".uploadfile_voice_btn input#addmorefile").live('click', function(){
		var str = "" +
		"<div class=\"row file_"+(number_voice)+"\" style=\"margin-bottom: 0;\">"+
		"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
		"		<span class=\"label_file\">file แนบเอกสาร</span>"+
		"		<input type=\"file\" class=\"form-control\" name=\"fileattach_voice"+(number_voice)+"\" id=\"fileattach\"  onchange=\"check_file_ext('voice', '"+(number_voice)+"');\" style=\"width: 40%; \" multiple />"+
		"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number_voice)+"\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
		"	</div>"+
		"</div>";
		
		$("div.uploadfile_voice").append(str);
		number_voice++;
		count_input_files++;
	});
	
	$(".uploadfile_voice #reducemorefile").live('click', function(){
		var file_id = $(this).attr("data-file_id");
		// var file_id = $(this).data("file_id");
		
		$("div.uploadfile_voice .row.file_"+file_id).remove();
		// number_voice--;
		count_input_files--;
	});
	
	//############################### document ####################################
	
	var number_document = 2;
	$(".uploadfile_document_btn input#addmorefile").live('click', function(){
		var str = "" +
		"<div class=\"row file_"+(number_document)+"\" style=\"margin-bottom: 0;\">"+
		"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
		"		<span class=\"label_file\">file แนบเอกสาร</span>"+
		"		<input type=\"file\" class=\"form-control\" name=\"fileattach_document"+(number_document)+"\" id=\"fileattach\"  onchange=\"check_file_ext('document', '"+(number_document)+"');\" style=\"width: 40%; \" multiple />"+
		"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number_document)+"\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
		"	</div>"+
		"</div>";
		
		$("div.uploadfile_document").append(str);
		number_document++;
		count_input_files++;
	});
	
	$(".uploadfile_document #reducemorefile").live('click', function(){
		var file_id = $(this).attr("data-file_id");
		// var file_id = $(this).data("file_id");
		
		$("div.uploadfile_document .row.file_"+file_id).remove();
		// number_document--;
		count_input_files--;
	});
	
	//################################# picture ##################################
	
	var number_picture = 2;
	$(".uploadfile_picture_btn input#addmorefile").live('click', function(){
		var str = "" +
		"<div class=\"row file_"+(number_picture)+"\" style=\"margin-bottom: 0;\">"+
		"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
		"		<span class=\"label_file\">file แนบเอกสาร</span>"+
		"		<input type=\"file\" class=\"form-control\" name=\"fileattach_picture"+(number_picture)+"\" id=\"fileattach\"  onchange=\"check_file_ext('picture', '"+(number_picture)+"');\" style=\"width: 40%; \" multiple />"+
		"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number_picture)+"\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
		"	</div>"+
		"</div>";
		
		$("div.uploadfile_picture").append(str);
		number_picture++;
		count_input_files++;
	});
	
	$(".uploadfile_picture #reducemorefile").live('click', function(){
		var file_id = $(this).attr("data-file_id");
		// var file_id = $(this).data("file_id");
		
		$("div.uploadfile_picture .row.file_"+file_id).remove();
		
		count_input_files--;
		/*
		var i=0;
		var label_file_id = "";
		for(i = parseInt(file_id)+1; i <= number ; i++){
			console.log("=== i = "+i);
			
			$(".uploadfile .row.file_"+i+" .label_file").html("file แนบเอกสาร "+(i-1)+".)");
			$(".uploadfile .row.file_"+i+" #reducemorefile").data("file_id", (i-1));
			$(".uploadfile .row.file_"+i+" #reducemorefile").removeClass("file_"+i);
			$(".uploadfile .row.file_"+i+" #reducemorefile").addClass("file_"+(i-1));
			
			$(".uploadfile .row.file_"+i).addClass("file_"+(i-1));
			$(".uploadfile .row.file_"+i).removeClass("file_"+i);
			
			// $(".uploadfile .row.file_"+i+" #reducemorefile").toggleClass("file_"+i+" file_"+(i-1));
			// $(this).parent(".file_"+i).next()
		}
		*/
		// console.log("-----------");
		// count--;
		// number_picture--;
	});
	
	//################################################################### 	
	
	var temp_file_size = 0;
	var file_i = 0;
	var file_j = 0;
	
	//Check that cannot upload more that 40 MB
	$(".uploadfile input[type=file]").live("change", function() {
		
		temp_file_size = 0;
		for(file_i = 0; file_i < count_input_files; file_i++){
			for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
				temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
			}
		}
		
		if(temp_file_size > 41943040){
			$(this).val("");
			alert("ตอนนี้ขนาด File รวมกัน เกิน 40 MB ไม่สามารถ Upload เพิ่มได้อีก")
			for(file_i = 0; file_i < count_input_files; file_i++){
				for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
					temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
				}
			}
			$(".total_before_file_size").html(temp_file_size);
		}
		else{
			$(".total_before_file_size_bytes").html(numberWithCommas(temp_file_size));
			
			if(temp_file_size < 1024.0){
				$(".total_before_file_size").html(numberWithCommas(temp_file_size));
				$(".total_before_file_unit").html("Bytes");
			}
			else if(temp_file_size < 1024*1024.0){
				
				var temp_file_size_new = temp_file_size/1024.0;
				temp_file_size_new = temp_file_size_new.toFixed(2)
				
				$(".total_before_file_size").html(numberWithCommas(temp_file_size_new));
				$(".total_before_file_unit").html("KB");
			}
			else if(temp_file_size < (1024*1024*1024.0)){
				
				var temp_file_size_new = temp_file_size/(1024*1024.0);
				temp_file_size_new = temp_file_size_new.toFixed(2)
				
				$(".total_before_file_size").html(numberWithCommas(temp_file_size_new));
				$(".total_before_file_unit").html("MB");
			}
			
		}
	});
	
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
	
	function check_file_ext(type, file_id){
		// var file_id = $(this).attr("data-file_id");
		// var str = $("div.uploadfile div.row.file_1 div.col-lg-6 input#fileattach[name=fileattach1]").val().toUpperCase();
		
		var text = "div.uploadfile_"+type+" div.row.file_"+file_id+" input#fileattach[name=fileattach_"+type+file_id+"]";
		var ext = $(text).val().split('.').pop().toLowerCase();
		
		// ########### Video ############
		if(type == 'video'){
			if($.inArray(
				ext, 
				['mp4','avi','wmv']
			) == -1) {
					alert('นามสกุลเอกสารไม่ใช่ Video โปรดทำใหม่');
					$("div.uploadfile div.row.file_"+file_id+" div.col-lg-12 input#fileattach[name=fileattach_"+type+file_id+"]").val("");
					
					for(file_i = 0; file_i < count_input_files; file_i++){
						for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
							temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
						}
					}
					$(".total_after_file_size").html(temp_file_size);
			}
		}
		
		// ########### Voice ############
		
		if(type == 'voice'){
			if($.inArray(
				ext, 
				['mp3','ogg','wma']
			) == -1) {
					alert('นามสกุลเอกสารไม่ใช่เสียง โปรดทำใหม่');
					$("div.uploadfile div.row.file_"+file_id+" div.col-lg-12 input#fileattach[name=fileattach_"+type+file_id+"]").val("");
					
					for(file_i = 0; file_i < count_input_files; file_i++){
						for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
							temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
						}
					}
					$(".total_after_file_size").html(temp_file_size);
			}
		}
		
		// ########### Document ############
		
		if(type == 'document'){
			if($.inArray(
				ext, 
				['doc','docx','xls','xlsx','ppt','pptx','pdf','csv']
			) == -1) {
					alert('นามสกุลเอกสารไม่ใช่เอกสาร โปรดทำใหม่');
					$("div.uploadfile div.row.file_"+file_id+" div.col-lg-12 input#fileattach[name=fileattach_"+type+file_id+"]").val("");
					
					for(file_i = 0; file_i < count_input_files; file_i++){
						for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
							temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
						}
					}
					$(".total_after_file_size").html(temp_file_size);
			}
		}
		
		// ########### Picture ############
		
		if(type == 'picture'){
			if($.inArray(
				ext, 
				['jpg','jpeg','gif','png']
			) == -1) {
					alert('นามสกุลเอกสารไม่ใช่รูปภาพ โปรดทำใหม่');
					$("div.uploadfile div.row.file_"+file_id+" div.col-lg-12 input#fileattach[name=fileattach_"+type+file_id+"]").val("");
					
					for(file_i = 0; file_i < count_input_files; file_i++){
						for(file_j = 0; file_j < $('input[type=file]').get(file_i).files.length; file_j++){
							temp_file_size = temp_file_size + $('input[type=file]').get(file_i).files[file_j].size;
						}
					}
					$(".total_after_file_size").html(temp_file_size);
			}
		}
	}
	
	$(function(){
        // $(".select-menu > select > option:eq(0)").attr("selected","selected");
        var selectmenu_txt = $("#Minis_ID").find("option:selected").text();
			$("#Minis_ID").prev("span").text(selectmenu_txt);
        selectmenu_txt = $("#Dep_ID").find("option:selected").text();
			$("#Dep_ID").prev("span").text(selectmenu_txt);
		selectmenu_txt = $("#NT05_PolicyID").find("option:selected").text();
			$("#NT05_PolicyID").prev("span").text(selectmenu_txt);
        selectmenu_txt = $("#Tar_ID").find("option:selected").text();
			$("#Tar_ID").prev("span").text(selectmenu_txt);
		selectmenu_txt = $("#grov_status").find("option:selected").text();
			$("#grov_status").prev("span").text(selectmenu_txt);
		selectmenu_txt = $("#prd_status").find("option:selected").text();
			$("#prd_status").prev("span").text(selectmenu_txt);
        
        $(".select-menu > select").live("change",function(){
            var selectmenu_txt = $(this).find("option:selected").text();
            $(this).prev("span").text(selectmenu_txt);
        });
    });
    
	function validateForm() {
		var create_date = document.forms["form_sendnew"]["create_date"].value;
		if (create_date==null || create_date=="") {
			alert("โปรดใส่ค่า ข่าววันที่");
			document.forms["form_sendnew"]["create_date"].focus();
			return false;
		}
		
		var SendIn_Plan = document.forms["form_sendnew"]["SendIn_Plan"].value;
		if (SendIn_Plan==null || SendIn_Plan=="") {
			alert("โปรดใส่ค่า แผนงานโครงการ/กิจกรรม");
			document.forms["form_sendnew"]["SendIn_Plan"].focus();
			return false;
		}
		
		var SendIn_Issue = document.forms["form_sendnew"]["SendIn_Issue"].value;
		if (SendIn_Issue==null || SendIn_Issue=="") {
			alert("โปรดใส่ค่า ประเด็นประชาสัมพันธ์");
			document.forms["form_sendnew"]["SendIn_Issue"].focus();
			return false;
		}
		
		var SendIn_Detail = CKEDITOR.instances.SendIn_Detail.getData();
		if (SendIn_Detail==null || SendIn_Detail=="") {
			alert("โปรดใส่ค่า เนื้อหา");
			CKEDITOR.instances.SendIn_Detail.focus();
			return false;
		}
	}
	
	$("input#cancel").live("click", function(){
		$("select#Minis_ID option:selected").prop("selected", false);
		$("#Minis_ID").prev("span").text($("select#Minis_ID").find("option:selected").text());
		
		$("select#Dep_ID option:selected").prop("selected", false);
		$("#Dep_ID").prev("span").text($("select#Dep_ID").find("option:selected").text());
		
		$("select#NT05_PolicyID option:selected").prop("selected", false);
		$("#NT05_PolicyID").prev("span").text($("select#NT05_PolicyID").find("option:selected").text());
		
		if($("select#Tar_ID").val() == -1){ //target-0
			$(".grov_active_col").css("display", "none");
			$(".prd_active_col").css("display", "none");
		}
		else if($("select#Tar_ID").val() == 3){ //target-1
			$(".prd_active_col select#prd_status option").prop("selected", false);
			$(".prd_active_col select#prd_status").prev("span").text($(".prd_active_col select#prd_status").find("option:selected").text());
			
			$(".grov_active_col select#grov_status option").prop("selected", false);
			$(".grov_active_col select#grov_status").prev("span").text($(".grov_active_col select#grov_status").find("option:selected").text());
			
			$(".grov_active_col").css("display", "none");
			$(".prd_active_col").css("display", "none");
		}
		else if($("select#Tar_ID").val() == 4){ //target-2
			$(".prd_active_col select#prd_status option").prop("selected", false);
			$(".prd_active_col select#prd_status").prev("span").text($(".prd_active_col select#prd_status").find("option:selected").text());
			
			$(".grov_active_col").css("display", "none");
			$(".prd_active_col").css("display", "none");
		}
		
		$("select#Tar_ID option:selected").prop("selected", false);
		$("#Tar_ID").prev("span").text($("select#Tar_ID").find("option:selected").text());
		
		$("#SendIn_Plan").val("");
		$("#SendIn_Issue").val("");
		CKEDITOR.instances.SendIn_Detail.setData("");
		
		$(".show_size .total_before_file_size").html("0");
		$(".show_size .total_before_file_unit").html("Bytes");
		$(".show_size .total_before_file_size_bytes").html("0");
		$(".show_size .total_before_file_unit_bytes").html("Bytes");
		
		
		var str_video = ""+
			"<div style=\"margin-left: 5%; color: #000000; float: left; \">"+
			"	Video * "+
			"</div>"+
			"<div style=\"margin-left: 5%; color: #cc0000; \">"+
			"	รองรับนามสกุล .mp4, .avi, .wmv, .flv "+
			"</div>"+
			
			"<div class=\"row file_1\" style=\"margin-bottom: 0; \">"+
			"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
			"		<span class=\"label_file\" >file แนบเอกสาร</span>"+
			"		<input type=\"file\" class=\"form-control\" name=\"fileattach_video1\" id=\"fileattach\" onchange=\"check_file_ext('video', '1');\" placeholder=\"\" style=\"width: 40%; \" multiple />"+
			"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\"1\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
			"	</div>"+
			"</div>";
		
		$("div.uploadfile_video").html(str_video);
		
		var str_voice = ""+
			"<div style=\"margin-left: 5%; color: #000000; float: left; \">"+
			"	เสียง * "+
			"</div>"+
			"<div style=\"margin-left: 5%; color: #cc0000; \">"+
			"	รองรับนามสกุล .mp3, .ogg, .wma "+
			"</div>"+
			
			"<div class=\"row file_1\" style=\"margin-bottom: 0; \">"+
			"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
			"		<span class=\"label_file\" >file แนบเอกสาร</span>"+
			"		<input type=\"file\" class=\"form-control\" name=\"fileattach_voice1\" id=\"fileattach\" onchange=\"check_file_ext('voice', '1');\" placeholder=\"\" style=\"width: 40%; \" multiple />"+
			"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\"1\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
			"	</div>"+
			"</div>";
		
		$("div.uploadfile_voice").html(str_voice);
		
		var str_document = ""+
			"<div style=\"margin-left: 5%; color: #000000; float: left; \">"+
			"	เสียง * "+
			"</div>"+
			"<div style=\"margin-left: 5%; color: #cc0000; \">"+
			"	รองรับนามสกุล .mp3, .ogg, .wma "+
			"</div>"+
			
			"<div class=\"row file_1\" style=\"margin-bottom: 0; \">"+
			"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
			"		<span class=\"label_file\" >file แนบเอกสาร</span>"+
			"		<input type=\"file\" class=\"form-control\" name=\"fileattach_document1\" id=\"fileattach\" onchange=\"check_file_ext('document', '1');\" placeholder=\"\" style=\"width: 40%; \" multiple />"+
			"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\"1\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
			"	</div>"+
			"</div>";
		
		$("div.uploadfile_document").html(str_document);
		
		var str_document = ""+
			"<div style=\"margin-left: 5%; color: #000000; float: left; \">"+
			"	เอกสาร * "+
			"</div>"+
			"<div style=\"margin-left: 5%; color: #cc0000; \">"+
			"	รองรับนามสกุล .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .csv "+
			"</div>"+
			
			"<div class=\"row file_1\" style=\"margin-bottom: 0; \">"+
			"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
			"		<span class=\"label_file\" >file แนบเอกสาร</span>"+
			"		<input type=\"file\" class=\"form-control\" name=\"fileattach_document1\" id=\"fileattach\" onchange=\"check_file_ext('document', '1');\" placeholder=\"\" style=\"width: 40%; \" multiple />"+
			"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\"1\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
			"	</div>"+
			"</div>";
		
		$("div.uploadfile_document").html(str_document);
		
		var str_picture = ""+
			"<div style=\"margin-left: 5%; color: #000000; float: left; \">"+
			"	รูปภาพ * "+
			"</div>"+
			"<div style=\"margin-left: 5%; color: #cc0000; \">"+
			"	รองรับนามสกุล .jpg, .jpeg, .gif, .png "+
			"</div>"+
			
			"<div class=\"row file_1\" style=\"margin-bottom: 0; \">"+
			"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
			"		<span class=\"label_file\" >file แนบเอกสาร</span>"+
			"		<input type=\"file\" class=\"form-control\" name=\"fileattach_picture1\" id=\"fileattach\" onchange=\"check_file_ext('picture', '1');\" placeholder=\"\" style=\"width: 40%; \" multiple />"+
			"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\"1\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
			"	</div>"+
			"</div>";
		
		$("div.uploadfile_picture").html(str_picture);
	});
	
	/*
	$(document).ready(function()
	{
		$("#fileuploader").uploadFile({
		url:"YOUR_FILE_UPLOAD_URL",
		fileName:"myfile"
		});
	});
	*/
	/*
	$(document).ready(function()
	{
		var settings = {
		    url: "http://localhost:126/upload.php",
		    dragDrop:true,
		    fileName: "myfile",
		    allowedTypes:"jpg,png,gif,doc,pdf,zip",	
		    returnType:"json",
			 onSuccess:function(files,data,xhr)
		    {
		       // alert((data));
		    },
		    showDelete:true,
		    deleteCallback: function(data,pd)
			{
			    for(var i=0;i<data.length;i++)
			    {
			        $.post("http://localhost:126/delete.php",{op:"delete",name:data[i]},
			        function(resp, textStatus, jqXHR)
			        {
			            //Show Message  
			            $("#status").append("<div>File Deleted</div>");
			        });
			     }      
			    pd.statusbar.hide(); //You choice to hide/not.
		
			}
		}
		var uploadObj = $("#mulitplefileuploader").uploadFile(settings);
	});
	*/
</script>