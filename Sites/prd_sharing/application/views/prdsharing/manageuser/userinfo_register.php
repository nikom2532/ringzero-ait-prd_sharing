<!-- <?php echo validation_errors(); ?> -->

<div id="manage-user" class="table-list">
	<!--<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">News And Information</p>-->
	<form id="form_userinfo" action="register/" method="post">
	<!-- <?php echo form_open('form'); ?> -->
		<input type="hidden" name="register_new_member" value="yes" />
		<div class="row">
			<div class="row" id="gove-title">
				User Information
			</div>
		</div>
		<div class="row">
			<div class="col-left">
				<label class="label">เพศ</label>
			</div>
			<div class="col-right">
				<input type="radio" name="sex" id="sex_male" value="ผู้ชาย" checked="checked">
				<label for="sex_male" class="txt-radio">ผู้ชาย</label>
				<input type="radio" name="sex" id="sex_female" value="ผู้หญิง">
				<label for="sex_female" class="txt-radio">ผู้หญิง</label>
			</div>
		</div>
		<div class="row">
			<div class="col-left">
				<label class="label">คำนำหน้า</label>
			</div>
			<div class="col-right">
				<input type="radio" name="mem_title" value="นาย" id="tname_male" checked="checked" />
				<label for="tname_male" class="txt-radio">นาย</label>
				<input type="radio" name="mem_title" value="นาง" id="tname_female" />
				<label for="tname_female" class="txt-radio">นาง</label>
				<input type="radio" name="mem_title" value="นางสาว" id="tname_girl" />
				<label for="tname_girl" class="txt-radio">นางสาว</label>
				<input type="radio" name="mem_title" value="อื่นๆ" id="tname_other" />
				<label for="tname_other" class="txt-radio">อื่นๆ</label>
				<input type="text" class="form-control" name="tname_other_text" id="tname_other_text" placeholder="" />
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label class="label">ชื่อ (ไทย)</label>
				<input type="text" class="form-control" name="fname" id="fname" placeholder="" />
			</div>
			<div class="col-lg-6">
				<label class="label">นามสกุล (ไทย)</label>
				<input type="text" class="form-control" name="lname" id="lname" placeholder="" />
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >ชื่อ (อังกฤษ)</label>
				<input type="text" class="form-control" name="engfname" id="engfname" placeholder="" />
			</div>
			<div class="col-lg-6">
				<label >นามสกุล (อังกฤษ)</label>
				<input type="text" class="form-control" name="englname" id="englname" placeholder="" />
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >Username</label>
				<input type="text" class="form-control" name="mem_username" id="mem_username" placeholder="" />
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label id="mem_password1">Password</label>
				<input type="password" class="form-control" name="mem_password1" id="mem_password1" placeholder="" required />
			</div>
			<div class="col-lg-6">
				<label id="mem_password2">Confirm Password</label>
				<!-- <input type="password" class="form-control" name="mem_password2" id="mem_password2" placeholder="" required  onkeyup="return check_pass(this.value, document.getElementById('mem_password1').value)" /> -->
				<input type="password" class="form-control" name="mem_password2" id="mem_password2" placeholder="" required  onkeyup="return check_pass(this.value, document.getElementById('mem_password1').value)" />
			</div>
		</div>
			
		<div class="row">
			<div class="col-lg-6">
				<label >รหัสบัตรประชาชน</label>
				<input type="text" class="form-control" name="mem_card_id" id="Mem_CardID" placeholder="" >
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >กระทรวง</label>
				<select name="mem_ministry" id="mem_ministry">
					<option value="">เลือกประเภทตำแหน่ง</option>
<?php
					foreach ($Ministry as $Ministry_item) {
						?><option value="<?php echo $Ministry_item->Minis_ID;?>"><?php echo $Ministry_item->Minis_Name;?></option><?php
					}
?>
				</select>
			</div>
			<div class="col-lg-6">
				<label >กรม</label>
				<select name="mem_department" id="mem_department">
					<option value="">เลือกตำแหน่ง</option>
<?php
					/*
					foreach ($Department as $Department_item) {
						?><option value="<?php echo $Department_item->Dep_ID;?>"><?php echo $Department_item->Dep_Name;?></option><?php
					}
					*/
?>
				</select>
			</div>
		</div>
		
		<script>
			$('select#mem_ministry').change(function(){
				// debugger;
			    var type_id = $('select#mem_ministry').val();
			    if (type_id != ""){
			        var post_url = "<?php echo base_url(); ?>PRD_UserInfo_Register/get_Department/" + type_id;
			    	// debugger;
			    	// alert(post_url);
			        $.ajax({
			            type: "POST",
			             url: post_url,
						 dataType :'json',
			             success: function(subtype)
			              {
			              	// var a = JSON.parse(subtype);
			                $('#mem_department').empty();
			                
			                var text = "<option value=\"\">เลือกกรม</option>";
			                $('#mem_department').append(text);
			                
							$.each(subtype,function(index,val)
							{
								text = ""+
								"<option value=\""+val.Dep_ID+"\">"+val.Dep_Name+"</option>";
								$('#mem_department').append(text);
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
				<label >จังหวัด</label>
				<select name="mem_province" id="mem_province">
					<option value="">เลือกจังหวัด</option>
<?php
						foreach ($CM06_Province as $Province) {
							?><option value="<?php echo $Province->CM06_ProvinceID;?>"><?php echo $Province->CM06_ProvinceName;?></option><?php
						}
?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >อำเภอ</label>
				<select name="mem_ampur" id="mem_ampur">
					<option value="">เลือกอำเภอ</option>
<?php
						/*
						foreach ($CM07_Ampur as $Ampur) {
							?><option value="<?php echo $Ampur->CM07_AmpurID;?>"><?php echo $Ampur->CM07_AmpurName;?></option><?php
						}
						*/
?>
				</select>
			</div>
			<div class="col-lg-6">
				<label >ตำบล</label>
				<select name="mem_tumbon" id="mem_tumbon">
					<option value="">เลือกตำบล</option>
<?php
						/*
						foreach ($CM08_Tumbon as $Tumbon) {
							?><option value="<?php echo $Tumbon->CM08_TumbonID;?>"><?php echo $Tumbon->CM08_TumbonName;?></option><?php
						}
						*/
?>
				</select>
			</div>
		</div>
		
		<script>
			//อำเภอ
			$('select#mem_province').change(function(){
				// debugger;
			    var type_id = $('select#mem_province').val();
			    if (type_id != ""){
			        var post_url = "<?php echo base_url(); ?>PRD_UserInfo_Register/get_CM07_Ampur_Unique/" + type_id;
			    	// debugger;
			    	// alert(post_url);
			        $.ajax({
			            type: "POST",
			             url: post_url,
						 dataType :'json',
			             success: function(subtype)
			              {
			              	// var a = JSON.parse(subtype);
			                $('#mem_ampur').empty();
			                
			                var text = "<option value=\"\">เลือกอำเภอ</option>";
			                $('#mem_ampur').append(text);
			                
							$.each(subtype,function(index,val)
							{
								text = ""+
								"<option value=\""+val.CM07_AmpurID+"\">"+val.CM07_AmpurName+"</option>";
								$('#mem_ampur').append(text);
							});
						} //end success
					}); //end AJAX
			    } else {
			        $('#SubTypeID').empty();
			    }//end if
			}); //end change
			
			//ตำบล
			$('select#mem_ampur').change(function(){
				// debugger;
			    var type_id = $('select#mem_ampur').val();
			    if (type_id != ""){
			        var post_url = "<?php echo base_url(); ?>PRD_UserInfo_Register/get_CM08_Tumbon_Unique/" + type_id;
			    	// debugger;
			    	// alert(post_url);
			        $.ajax({
			            type: "POST",
			             url: post_url,
						 dataType :'json',
			             success: function(subtype)
			              {
			              	// var a = JSON.parse(subtype);
			                $('#mem_tumbon').empty();
			                
			                var text = "<option value=\"\">เลือกอำเภอ</option>";
			                $('#mem_tumbon').append(text);
			                
							$.each(subtype,function(index,val)
							{
								text = ""+
								"<option value=\""+val.CM08_TumbonID+"\">"+val.CM08_TumbonName+"</option>";
								$('#mem_tumbon').append(text);
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
				<label >ที่อยู่</label>
				<textarea rows="4" cols="50" class="txt-area" name="mem_address"></textarea>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<label class="label">Email</label>
					<input type="text" class="form-control" name="mem_email" id="Mem_Email" placeholder="" />
				</div>
				<div class="row">
					<label class="label">รหัสไปรษณีย์</label>
					<input type="text" class="form-control" name="mem_postcode" id="Mem_Postcode" placeholder="" />
				</div>
				<div class="row">
					<label class="label">ชื่อผู้ติดต่อ</label>
					<input type="text" class="form-control" name="mem_nickname" id="Mem_NickName" placeholder="" />
				</div>
				<div class="row">
					<label class="label">เบอร์ที่ทำงาน</label>
					<input type="text" class="form-control" name="mem_tel" id="Mem_Tel" placeholder="" />
				</div>
				<div class="row">
					<label class="label">เบอร์มือถือ</label>
					<input type="text" class="form-control" name="mem_mobile" id="Mem_Mobile" placeholder="" />
				</div>
			</div>
		</div>
		<?php /* ?>
		<div class="row">
			<div class="col-lg-6">
				<label >ระดับผู้ใช้งาน</label>
				<select name="group_member">
					<option value="-1">ระดับผู้ใช้งาน</option>
<?php
						foreach ($GroupMember as $GroupMember_item) {
							?><option value="<?php echo $GroupMember_item->Group_ID;?>"><?php echo $GroupMember_item->Group_Desc;?></option><?php
						}
?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<label >สถานะการใช้งาน</label>
				<select name="mem_status">
					<option value="1">เปิดการใช้งาน</option>
					<option value="0">ปิดการใช้งาน</option>
				</select>
			</div>
		</div>
		<?php */ ?>
		<div class="col-lg-12" style="text-align: center; float: left;">
			<input class="bt" type="submit" name="share" value="บันทึก" />
			<input class="bt" type="button" name="share" value="ยกเลิก" />
		</div>
	</form>
	<script>
		// $( "#form_userinfo" ).validate({
		  // rules: {
		    // mem_password1: {
			    // required: true
		    // },
		    // mem_password2: {
		      // equalTo: "#mem_password1"
// 		      
		    // }
		  // }
		// });
		
		function check_pass(text1, text2){
			
			$('#mem_password2').html(text2);
			
			// mem_password2
		}
		
		/*
		var validator = $("#form_userinfo").validate({
			rules: {        	        		
				mem_password1 :"required",
				mem_password2: function(){
					equalTo: '#mem_password1'
			    }		
	    	},  	                          
		    messages: {
	    		mem_password1 :" Enter Password",
	    		mem_password2 :" Enter Confirm Password Same as Password"
		    }
		});
		if(validator.form()){
			alert('Sucess');
		}
		*/
	</script>
</div><!-- #manage-user -->