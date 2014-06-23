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
	
</script>

<form name="form_sendnew" id="form_sendnew" action="sentNew_Upload" method="post" enctype="multipart/form-data">
	<input type="hidden" name="sentnew_is_add" value="yes" />
	
	<fieldset class="frame-input">
		<legend >
			News Information
		</legend>
		<div id="sentnews" class="table-list">
			<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
			<div class="row">
				<div class="col-lg-6">
					<label >ข่าววันที่</label>
					<input type="text" class="form-control datepicker" name="create_date" id="create_date" placeholder="" >
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >กระทรวง</label>
					<select name="Minis_ID" id="Minis_ID">
						<option value="">เลือกกระทรวง</option>
<?php
						foreach ($Ministry as $Ministry_item) {
							?><option data-minis_id="<?php echo $Ministry_item->Minis_ID;?>" value="<?php echo $Ministry_item->Minis_ID;?>"><?php echo $Ministry_item->Minis_Name;?></option><?php
						}
?>
					</select>
				</div>
				<div class="col-lg-6">
					<label >กรม</label>
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
				</div>
			</div>
			
			<script>
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
				        var post_url = "<?php echo base_url(); ?>PRD_sentNew/get_Department/" + type_id;
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
							} //end success
						}); //end AJAX
				    } else {
				        $('#SubTypeID').empty();
				    }//end if
				}); //end change 
			</script>

			<div class="row">
				<div class="col-lg-6">
					<label >นโยบายรัฐบาล</label>
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
				</div>
	
			</div>
			<div class="row">
				<div class="col-lg-6">
					<label >กลุ่มเป้าหมาย</label>
					<select name="Tar_ID" id="Tar_ID">
						<option value="" id="target0">เลือกกลุ่มเป้าหมาย</option>
<?php
						$i=1;
						foreach ($TargetGroup as $TargetGroup_item) {
							?><option id="target<?php echo $i; ?>" value="<?php echo $TargetGroup_item->Tar_ID;?>"><?php echo $TargetGroup_item->Tar_Name;?></option><?php
							$i++;
						}
?>
					</select>
				</div>
			</div>
			
			<?php // For toggle กลุ่มเป้าหมาย  ?>
			<style>
				.grov_active_col.row,
				.prd_active_col.row{
					display:none;
				}
			</style>
			<script>
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
				
				$("#form_sendnew #submit")
				
			</script>
			
			
			<div class="row grov_active_col" >
				<div class="col-lg-6">
					<label id="grov_active" >หน่วยงานภาครัฐ</label>
					<select name="grov_active" id="grov_active">
						<option value="">เลือกเผยแพร่</option>
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
				</div>
			</div>
			
			<div class="row prd_active_col" >
				<div class="col-lg-6">
					<label id="prd_active" >หน่วยงานสำนักข่าวกรมประชาสัมพันธ์</label>
					<select name="prd_active" id="prd_active">
						<option value="">เลือกเผยแพร่</option>
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
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-11">
					<label >แผนงานโครงการ/กิจกรรม</label>
					<input type="text" class="form-control" name="SendIn_Plan" id="SendIn_Plan" placeholder="" >
				</div>
			</div>
			<div class="row">
				<div class="col-lg-11">
					<label >ประเด็นประชาสัมพันธ์</label>
					<input type="text" class="form-control" name="SendIn_Issue" id="SendIn_Issue" placeholder="" >
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-11">
					<label >เนื้อหา</label>
					<textarea class="ckeditor" name="SendIn_Detail"></textarea>
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
			<div class="row">
				<div class="col-lg-6">
					<label >file แนบเอกสาร 1.) </label>
					<!-- <input type="file" class="form-control bt" name="fileattach" id="fileattach" placeholder="" /> -->
					<input type="file" class="form-control bt" name="fileattach1" id="fileattach" placeholder="" multiple />
					<!-- <input type="file" name="file[]" multiple /> -->
				</div>
			</div>
		</div>
		<?php //*/ ?>
		
		<?php /* ?>
		<div id="mulitplefileuploader">Upload</div>
		<div id="status"></div>
		<?php */ ?>
		
		<div class="row">
			<div style="text-align: center;">
				<input class="bt" type="button" name="addmorefile" id="addmorefile" value="เพิ่ม file แนบเอกสาร" />
			</div>
		</div>
	</fieldset>
	<script>
		var number = 2;
		
		$("input.bt#addmorefile").click(function(){
			
			var str =""+
			"<div class=\"row\">"+
			"	<div class=\"col-lg-6\">"+
			"		<label >file แนบเอกสาร "+(number)+".) </label>"+
			"		<input type=\"file\" class=\"form-control bt\" name=\"fileattach"+(number)+"\" id=\"fileattach\" placeholder=\"\" multiple />"+
			"	</div>"+
			"</div>";
			
			$("div.uploadfile").append(str);
			number++;
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
	<div class="row">
		<div class="col-lg-12" style="text-align: center; float: left;">
			<input class="bt" type="submit" name="share" id="submit" value="บันทึก">
			<input class="bt" type="button" name="share" value="ยกเลิก" onclick="document.location.href = 'manageNewGROV'">
		</div>
	</div>

</form>