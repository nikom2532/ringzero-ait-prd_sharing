<?php
	// var_dump($category_new);
?>
<div class="content">
	<div id="share-form">
		<div id="search-form">
			<form name="form" action="manageInfo_Category" method="post">
				<input type="hidden" name="manageInfo_Category_is_search" value="yes" />
				<div class="row">
					<div class="col-lg-6">
						<label >คำค้นหา</label>
						<input type="text" class="form-control" name="NT02_TypeName" id="NT02_TypeName" placeholder="" >
					</div>
					<div class="col-lg-6">
						<label >สถานะ</label>
						<!-- <input type="text" class="form-control" id="InputKeyword" placeholder="" > -->
						
						<select name="NT02_Status" style="">
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
						
					</div>
				</div>
	
				<div class="col-lg-12" style="text-align: center;">
					<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:18%;padding: 4px;">
				</div>
			</form> 
		</div>
	</div>

	<div id="table-list">
		<div class="row">
			<div class="col-lg-left" style="margin-top: 20px;font-weight: bold;width:100%">
				<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;text-align:center;float: left;width: 15%;">
					Category
				</p>
				<a href="manageInfo_Ministry">
				<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
					Ministry
				</p></a>
				<a href="manageInfo_Department">
				<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
					Department
				</p></a>
			</div>
		</div>

		<div class="row">
			<div class="header-table">
				<p class="col-1" style="width: 20%;float: left; ">
					สถานะใช้งาน
				</p>
				<p class="col-2" style="width: 80%;float: left; ">
					ประเภทข่าว
				</p>
			</div>
<?php
			// var_dump($category_old);
			
			$i=1;
			foreach ($category_old as $catagory_old_item) {
				if($i%2 == 1){
					?><div class="odd"><?php
				}
				else{
					?><div class="event"><?php
				}
						$typeName = $catagory_old_item->NT02_TypeName;
						$tick = $catagory_old_item->NT02_Status;
						
						foreach ($category_new as $category_new_item){
							if($catagory_old_item->NT02_TypeID == $category_new_item->Cate_OldID){
								$print = $category_new_item->CateName;
								$tick = $category_new_item->Cate_Status;
							}
						}
						
						// echo $catagory_old_item->NT02_TypeID == $category_new_item->Cate_OldID;
?>
						<span class="col-1" style="width: 20%;float: left; text-align: center;">
							<input type="checkbox" name="cate_oldid" id="cate_oldid" onclick="set_Category_box('<?php echo $catagory_old_item->NT02_TypeID; ?>'); " value="<?php echo $catagory_old_item->NT02_TypeID; ?>" <?php
								if($tick == "Y"){ ?>checked='checked'<?php } ?> />
						</span>
						<p class="col-2" style="width: 80%;float: left;text-align: center; "><?php
							echo $typeName;
						?></p>
					</div>
<?php
				$i++;
			}
			
			// cate_oldid
			
?>
<!-- <input type="button" id="aaaaa" value="aaaa" /> -->
		<script>
		
		function set_Category_box(cate_oldid) {
			
			// alert(mem_update_id);
			
		    
		    if (cate_oldid != ""){
		        var post_url = "<?php echo base_url(); ?>PRD_ManageInfo_Category/set_category/" + cate_oldid;
		        
		        // alert(post_url);
		        
		        $.ajax({
		            type: "POST",
		             url: post_url,
					 dataType :'json',
		             success: function(subtype)
		              {
		              	
					} //end success
				}); //end AJAX
				
				
				
		    } else {
		        $('#SubTypeID').empty();
		    }//end if
			
		}
		
		// $(document).ready(function() {
		/*
			$('#cate_oldid').click(function () {
			    $("#txtAge").toggle(this.checked);
			});
			
			
			
			$('#cate_oldid').click(function(){
				
				alert("asdf");
				// if($(this).is(":checked")) {
		        // }
		        // $('#textbox1').val($(this).is(':checked'));    
				
				// var type_id = $('#cate_oldid').val();
				// alert(type_id);
				
			});
			
		// });
		*/
		</script>
		</div>
	</div>
</div>