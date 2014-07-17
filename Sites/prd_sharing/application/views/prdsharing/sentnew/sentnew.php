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
					<input type="text" class="form-control" name="SendIn_Issue" id="SendIn_Issue" placeholder="" required="required" >
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-11">
					<label >เนื้อหา <span style="color:red; ">*</span></label>
					<textarea class="ckeditor" name="SendIn_Detail" required="required"></textarea>
				</div>
			</div>
			
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
		<?php ///* ?>
		<div class="uploadfile">
			<div class="row file_1">
				<div class="col-lg-12" style="margin-left: 5%; ">
					<span class="label_file" >file แนบเอกสาร 1.)</span>
					<input type="file" class="form-control bt" name="fileattach1" id="fileattach" onchange="check_file_ext('1');" style="width: 40%; " multiple />
					<img src="<?php echo base_url(); ?>images/icon/delete_lock2.png" name="reducemorefile" id="reducemorefile" data-file_id="1" style="width: 20px; margin-left: 15px; cursor: pointer; " />
				</div>
				<!-- <div class="col-lg-6">
					<input class="bt" type="button" name="reducemorefile" id="reducemorefile" data-file_id="1" value="ลด file แนบเอกสาร" style="background-color: #E20000; border: 1px solid #E20000" />
				</div> -->
			</div>
		</div>
		<?php //*/ ?>
		
		<?php /* ?>
		<div id="mulitplefileuploader">Upload</div>
		<div id="status"></div>
		<?php */ ?>
		
		<div class="row">
			<div style="text-align: center; ">
				<!-- <input class="bt" type="button" name="reducemorefile" id="reducemorefile" value="ลด file แนบเอกสาร" style="background-color: #E20000; border: 1px solid #E20000" /> -->
				<input class="bt" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
			</div>
		</div>
	</fieldset>
	<div class="row">
		<div class="col-lg-12" style="text-align: center; float: left;">
			<input class="bt" type="submit" name="share" id="submit" value="บันทึก">
			<input class="bt" type="button" name="share" value="ยกเลิก" onclick="document.location.href = 'manageNewGROV'">
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
	
	$("select#Tar_ID").change(function() {
		$( "select#Tar_ID option#target1:selected" ).each(function() {
			$(".grov_active_col").css("display", "BLOCK");
			$(".prd_active_col").css("display", "BLOCK");
		});
		
		$( "select#Tar_ID option#target2:selected" ).each(function() {
			$(".grov_active_col").css("display", "none");
			$(".prd_active_col").css("display", "BLOCK");
		});
		
		$( "select#Tar_ID option#target0:selected" ).each(function() {
			$(".grov_active_col").css("display", "none");
			$(".prd_active_col").css("display", "none");
		});
	});
	
	var number = 2;
	var count = 1;
	$("input.bt#addmorefile").click(function(){
		var str =""+
		"<div class=\"row file_"+(number)+"\">"+
		"	<div class=\"col-lg-12\" style=\"margin-left: 5%; \">"+
		"		<span class=\"label_file\">file แนบเอกสาร "+(number)+".)</span>"+
		"		<input type=\"file\" class=\"form-control bt\" name=\"fileattach"+(number)+"\" id=\"fileattach\"  onchange=\"check_file_ext('"+(number)+"');\"  style=\"width: 40%; \" multiple />"+
		"		<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number)+"\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />"+
		"	</div>"+
		"	<!--<div class=\"col-lg-6\">"+
		"		<input class=\"bt\" type=\"button\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\""+(number)+"\" value=\"ลด file แนบเอกสาร\" style=\"background-color: #E20000; border: 1px solid #E20000\" />"+
		"	</div> -->"+
		"</div>";
		
		$("div.uploadfile").append(str);
		number++;
		count++;
	});
	
	$("#reducemorefile").live('click', function(){
		var file_id = $(this).attr("data-file_id");
		// var file_id = $(this).data("file_id");
		
		$("div.uploadfile .row.file_"+file_id).remove();
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
		console.log("-----------");
		// count--;
		number--;
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
		if (create_date=null || create_date=="") {
			alert("โปรดใส่ค่า ข่าววันที่");
			return false;
		}
		
		var SendIn_Plan = document.forms["form_sendnew"]["SendIn_Plan"].value;
		if (SendIn_Plan=null || SendIn_Plan=="") {
			alert("โปรดใส่ค่า แผนงานโครงการ/กิจกรรม");
			return false;
		}
		
		var SendIn_Issue = document.forms["form_sendnew"]["SendIn_Issue"].value;
		if (SendIn_Issue=null || SendIn_Issue=="") {
			alert("โปรดใส่ค่า ประเด็นประชาสัมพันธ์");
			return false;
		}
		
		var SendIn_Detail = document.forms["form_sendnew"]["SendIn_Detail"].value;
		if (SendIn_Detail=null || SendIn_Detail=="") {
			alert("โปรดใส่ค่า ประเด็นประชาสัมพันธ์");
			return false;
		}
		
		//For set Maximun File Size Upload
		if(validateFileSize(file,41943040, "valid_msg", "Document size should be less than 64MB !")==false)
		{
				return false;
		}
	}
	
	
	
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