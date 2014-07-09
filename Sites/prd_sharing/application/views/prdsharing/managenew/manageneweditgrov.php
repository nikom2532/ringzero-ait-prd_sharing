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
	.row .col-lg-6 span.select-menu select{
		width: 100% !important;
	}
</style>
<form name="formManageNewGROV" action="<?php echo base_url().index_page(); ?>manageNewEditGROV" method="post" enctype="multipart/form-data">
<?php
//Start to count News GROV's rows
foreach($news as $news_item):
?>
	<input type="hidden" name="manageNewEditGROV_record" value="yes" />
	<input type="hidden" name="SendIn_ID" value="<?php echo $news_item->SendIn_ID; ?>" />
<fieldset class="frame-input">
	<legend >
		News Information
	</legend>
	<div id="sentnews" class="table-list">
		<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
		<div class="row">
			<div class="col-lg-6">
				<label >ช่วงวันที่</label>
				<label ><?php 
					if($news_item->SendIn_UpdateDate != ""){
						echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_UpdateDate));
					}
					else{
						echo date("d/m/Y h:m:s", strtotime($news_item->SendIn_CreateDate));
					} 
				?></label>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >กระทรวง</label>
				<span class="select-menu">
					<span>เลือกกระทรวง</span>
					<select name="Minis_ID" id="Minis_ID">
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
					<select name="NT05_PolicyID">
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
						<option value="" id="target0">เลือกกลุ่มเป้าหมาย</option>
	<?php
						$i=1;
						$target_selected = 0;
						//Check TargetGroup selected
						if($news_item->PRD_Status == 1 && $news_item->GOVE_Status == 1){
							$target_selected = 3;
						}
						elseif($news_item->PRD_Status == 1 && $news_item->GOVE_Status == 0){
							$target_selected = 4;
						}
						elseif($news_item->PRD_Status == 0 && $news_item->GOVE_Status == 0){
							$target_selected = 0;
						}
						
						foreach ($TargetGroup as $TargetGroup_item) {
							?><option id="target<?php echo $TargetGroup_item->Tar_ID; ?>" value="<?php echo $TargetGroup_item->Tar_ID;?>" <?php
								if($TargetGroup_item->Tar_ID == null || $TargetGroup_item->Tar_ID == "" || $TargetGroup_item->Tar_ID == 0){
									$TargetGroup_item->Tar_ID = 0;
								}
								if($TargetGroup_item->Tar_ID == $target_selected){
									?>selected='selected'<?php
								}
							?>><?php echo $TargetGroup_item->Tar_Name;?></option><?php
							$i++;
						}
	?>
					</select>
				</span>
			</div>
		</div>
<?php 
		// For toggle กลุ่มเป้าหมาย
		if($target_selected == 0){
?>
			<style>
				.grov_active_col.row,
				.prd_active_col.row{
					display:none;
				}
			</style>
<?php
		}
		elseif($target_selected == 3){
?>
			<style>
				.grov_active_col.row,
				.prd_active_col.row{
					display: BLOCK;
				}
			</style>
<?php
		}
		elseif($target_selected == 4){
?>
			<style>
				.prd_active_col.row{
					display: BLOCK;
				}
				.grov_active_col.row{
					display: none;
				}
			</style>
<?php
		}
?>
		
		<div class="row grov_active_col" >
			<div class="col-lg-6">
				<label id="grov_active" >หน่วยงานภาครัฐ</label>
				<span class="select-menu">
					<span>เลือกหน่วยงานภาครัฐ</span>
					<select name="grov_active" id="grov_active">
						<option value="">เลือกหน่วยงานภาครัฐ</option>
	<?php
						/*
						foreach ($SC07_Department as $Department_item) {
							?><option value="<?php echo $Department_item->SC07_DepartmentId;?>"><?php echo $Department_item->SC07_DepartmentName;?></option><?php
						}
						*/
						foreach ($Ministry as $Ministry_item) {
							?><option value="<?php echo $Ministry_item->Minis_ID;?>" <?php
								if($Ministry_item->Minis_ID == $news_item->GOVE_Active){
									?>selected='selected'<?php
								}
							?>><?php echo $Ministry_item->Minis_Name;?></option><?php
						}
	?>
					</select>
				</span>
			</div>
		</div>
		
		<div class="row prd_active_col" >
			<div class="col-lg-6">
				<label id="prd_active" >หน่วยงานสำนักข่าวกรมประชาสัมพันธ์</label>
				<span class="select-menu">
					<span>เลือกหน่วยงานสำนักข่าวกรมประชาสัมพันธ์</span>
					<select name="prd_active" id="prd_active">
						<option value="">เลือกหน่วยงานสำนักข่าวกรมประชาสัมพันธ์</option>
	<?php
						/*
						foreach ($Ministry as $Ministry_item) {
							?><option value="<?php echo $Ministry_item->Minis_ID;?>"><?php echo $Ministry_item->Minis_Name;?></option><?php
						}
						*/
						foreach ($SC07_Department as $Department_item) {
							?><option value="<?php echo $Department_item->SC07_DepartmentId;?>" <?php
								if($Department_item->SC07_DepartmentId == $news_item->PRD_Active){
									?>selected='selected'<?php
								}
							?>><?php echo $Department_item->SC07_DepartmentName;?></option><?php
						}
	?>
					</select>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11">
				<label >แผนงานโครงการ/กิจกรรม</label>
				<input type="text" class="form-control" name="SendIn_Plan" id="SendIn_Plan" placeholder="" value="<?php echo $news_item->SendIn_Plan; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11">
				<label >ประเด็นประชาสัมพันธ์</label>
				<input type="text" class="form-control" name="SendIn_Issue" id="SendIn_Issue" placeholder="" value="<?php echo $news_item->SendIn_Issue; ?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-11" style="width: 80%; margin: 0 auto; ">
				<label >เนื้อหา</label>
				<textarea class="ckeditor" name="SendIn_Detail"><?php echo $news_item->SendIn_Detail; ?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >สถานะ</label>
				<span class="select-menu">
					<span>เลือกสถานะ</span>
					<select name="sendin_status" id="sendin_status" class="form-control" style="width: 65%;">
						<option value="0"<?php 
							if($news_item->SendIn_Status == '0' || $news_item->SendIn_Status == ''){
								?> selected='selected'<?php
							}
						?>>ไม่อนุมัติ</option>
						<option value="1"<?php 
							if($news_item->SendIn_Status == '1'){
								?> selected='selected'<?php
							}
						?>>อนุมัติ</option>
					</select>
				</span>	
			</div>
		</div>
<?php 
		$row = 0;
		foreach ($FileAttach as $FileAttach_item){
			
			?><div class="row" style="margin-bottom: 0; padding: 10px 0; <?php
				if($row % 2 == 0){
					?>background-color: #fbfaf6<?php
				}
				else{
					?>background-color: #ededed<?php
				}
			?>"> 
				<div style="float: left; width: 20%; padding-left: 10%; ">
					<a style="text-decoration:none; text-decoration:none; " href="<?php echo base_url()."uploads/".$FileAttach_item->File_Name; ?>"><?php 
						?><img src="<?php echo base_url(); ?>images/icon/<?php
						if(
							strtolower($FileAttach_item->File_Extension) == ".png" ||
							strtolower($FileAttach_item->File_Extension) == ".jpg" ||
							strtolower($FileAttach_item->File_Extension) == ".jpeg" ||
							strtolower($FileAttach_item->File_Extension) == ".bmp" ||
							strtolower($FileAttach_item->File_Extension) == ".tiff" ||
							strtolower($FileAttach_item->File_Extension) == ".gif"
						){
							?>pic.png<?php
						}
						elseif(
							strtolower($FileAttach_item->File_Extension) == ".mp3" ||
							strtolower($FileAttach_item->File_Extension) == ".ogg" ||
							strtolower($FileAttach_item->File_Extension) == ".wma"
						){
							?>voice_512x512.png<?php
						}
						elseif(
							strtolower($FileAttach_item->File_Extension) == ".avi" ||
							strtolower($FileAttach_item->File_Extension) == ".mpg" ||
							strtolower($FileAttach_item->File_Extension) == ".mpg4" ||
							strtolower($FileAttach_item->File_Extension) == ".mp4" ||
							strtolower($FileAttach_item->File_Extension) == ".wmv"
						){
							?>vdo.png<?php
						}
						elseif(
							strtolower($FileAttach_item->File_Extension) == ".doc" ||
							strtolower($FileAttach_item->File_Extension) == ".docs"
						){
							?>Document.jpg<?php
						}
						else{
							?>Document.jpg<?php
						}
						?>" style="margin-right: 10px; " width="17"><?php 
						echo $FileAttach_item->File_Name; 
					?></a>
				</div>
				<div style="float: left; width: 70%; "> 
					<a href="#" class="FileAttachDelete" data-File_ID="<?php echo $FileAttach_item->File_ID; ?>">
						<img src="<?php echo base_url(); ?>images/icon/delete.png" style="margin: -5px 10px 0; padding-top: 1%;">
					</a>
				</div>
			</div><?php
			$row++;
		}
?>
		
		<!--<div class="col-lg-12" style="text-align: center;    float: left;">
		<input class="bt" type="submit" name="share" value="บันทึก">
		<input class="bt" type="submit" name="share" value="ยกเลิก">
		</div>-->

	</div><!-- #sentnews -->
</fieldset>

<fieldset class="frame-input">
	<legend >
		File Upload
	</legend>
	<div class="uploadfile">
		<div class="row file_1">
			<div class="col-lg-6">
				<label >file แนบเอกสาร 1.) </label>
				<!-- <input type="file" class="form-control bt" name="fileattach" id="fileattach" placeholder="" /> -->
				<input type="file" class="form-control bt" name="fileattach1" id="fileattach" placeholder="" onchange="check_file_ext('1');" multiple />
				<!-- <input type="file" name="file[]" multiple /> -->
			</div>
			<div class="col-lg-6">
				<input class="bt" type="button" name="reducemorefile" id="reducemorefile" data-file_id="1" value="ลด file แนบเอกสาร" style="background-color: #E20000; border: 1px solid #E20000" />
			</div>
		</div>
	</div>
	<div class="row">
		<div style="text-align: center;">
			<input class="bt" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
		</div>
	</div>
</fieldset>

<script>
	var selectmenu_txt = $("#sendin_status").find("option:selected").text();
	$("#sendin_status").prev("span").text(selectmenu_txt);
	
	function push_mem_department(id){
		// debugger;
	    if(id != ""){
	    	var type_id = id;
	    }
	    else{
	    	var type_id = $('select#mem_ministry').val();
	    }
	    
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
	}
	$( document ).ready(function() {
		$('select#Minis_ID').change(function(){
			push_mem_department('');
			
			$('#Dep_ID').empty();
            var text = "<option value=\"\" selected='selected'>เลือกกรม</option>";
            $('#Dep_ID').append(text);
            
            var selectmenu_txt = $("#Dep_ID").find("option:selected").text();
			$("#Dep_ID").prev("span").text(selectmenu_txt);
		});
	});
	
	// $("select#Tar_ID").text("asdf");
			
	$("select#Tar_ID").live("change",function() {
		$( "select#Tar_ID option#target3:selected" ).each(function() {
			$(".prd_active_col").css("display", "BLOCK");
			$(".grov_active_col").css("display", "BLOCK");
		});
		
		$( "select#Tar_ID option#target4:selected" ).each(function() {
			$(".prd_active_col").css("display", "BLOCK");
			$(".grov_active_col").css("display", "none");
		});
		
		$( "select#Tar_ID option#target0:selected" ).each(function() {
			$(".prd_active_col").css("display", "none");
			$(".grov_active_col").css("display", "none");
		});
	});
	
	var number = 2;
	$("input.bt#addmorefile").click(function(){
		var str =""+
		"<div class=\"row file_"+(number)+"\">"+
		"	<div class=\"col-lg-6\">"+
		"		<label >file แนบเอกสาร "+(number)+".) </label>"+
		"		<input type=\"file\" class=\"form-control bt\" name=\"fileattach"+(number)+"\" id=\"fileattach\" placeholder=\"\" onchange=\"check_file_ext('"+(number)+"');\" multiple />"+
		"	</div>"+
		"	<div class=\"col-lg-6\">"+
		"		<input class=\"bt\" type=\"button\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number)+"\" value=\"ลด file แนบเอกสาร\" style=\"background-color: #E20000; border: 1px solid #E20000\" />"+
		"	</div>"+
		"</div>";
		
		$("div.uploadfile").append(str);
		number++;
	});
	
	$("input.bt#reducemorefile").live('click', function(){
		var file_id = $(this).attr("data-file_id");
		$("div.uploadfile .row.file_"+file_id).remove();
	});
	
	function check_file_ext(file_id){
		// var file_id = $(this).attr("data-file_id");
		// var str = $("div.uploadfile div.row.file_1 div.col-lg-6 input#fileattach[name=fileattach1]").val().toUpperCase();
		
		var ext = $("div.uploadfile div.row.file_"+file_id+" div.col-lg-6 input#fileattach[name=fileattach"+file_id+"]").val().split('.').pop().toLowerCase();
		
		if($.inArray(
			ext, 
			['jpg','jpeg','gif','png','doc','docx','xls','xlsx','ppt','pptx','pdf','csv','mp3','ogg','mp4','avi','wmv']
		) == -1) {
			    alert('invalid extension!');
			    $("div.uploadfile div.row.file_"+file_id+" div.col-lg-6 input#fileattach[name=fileattach"+file_id+"]").val("");
		}
	}
	
	$(".FileAttachDelete").click( function() {
		var file_ID = $(this).attr("data-File_ID");
		if (confirm("คุณแน่ใจว่าจะลบรายการ เลขที่เอกสาร = "+file_ID+" หรือไม่ ") == true) {
	        location.href="manageNewEditGROV?is_del_fileattach=1&File_ID="+file_ID;
	    }
	});
	
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
    
</script>

<div class="row">
	<div class="col-lg-12" style="text-align: center;    float: left;">
		<input class="bt" type="submit" name="share" value="บันทึก">
		<input class="bt" type="submit" name="share" value="ยกเลิก">
	</div>
</div>
<?php
endforeach;
//End Count News GROV's Row 
?>
</form>