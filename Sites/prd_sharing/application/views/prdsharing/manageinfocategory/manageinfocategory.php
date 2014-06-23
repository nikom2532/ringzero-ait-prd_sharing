<?php
	// var_dump($category_new);
?>
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
		<div id="search-form">
			<form name="form" id="homeSearch" action="manageInfo_Category" method="post">
				<input type="hidden" name="manageInfo_Category_is_search" value="yes" />
				<div class="row">
					<div class="col-lg-6">
						<label >คำค้นหา</label>
						<input type="text" class="form-control" name="NT02_TypeName" id="NT02_TypeName" placeholder="" value="<?php
							if(isset($post_NT02_TypeName)){
								if($post_NT02_TypeName != ""){
									echo $post_NT02_TypeName;
								}
							}
						?>">
					</div>
					<div class="col-lg-6">
						<label >สถานะ</label>
						<!-- <input type="text" class="form-control" id="InputKeyword" placeholder="" > -->
						<span class="select-menu">
						<span>เลือกสถานะ</span>
						
						<select name="NT02_Status" style="">
							<option value="" <?php
								if(isset($post_NT02_Status)){
									if($post_NT02_Status == "1"){
										?>selected="selected"<?php
									}
								}
							?>>เลือกสถานะ</option>
							<option value="Y" <?php
								if(isset($post_NT02_Status)){
									if($post_NT02_Status == "Y"){
										?>selected="selected"<?php
									}
								}
							?>>ใช้งานได้</option>
							<option value="N" <?php
								if(isset($post_NT02_Status)){
									if($post_NT02_Status == "N"){
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
			</form> 
		</div>
	</div>

	<div id="table-list">
		<div class="row">
			<div class="col-lg-left" style="margin-top: 20px;font-weight: bold;width:100%">
				<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;text-align:center;float: left;width: 15%;">
					Category
				</p>
				<a href="<?php echo base_url(); ?>manageInfo_Ministry">
				<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
					Ministry
				</p></a>
				<a href="<?php echo base_url(); ?>manageInfo_Department">
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
?>
		</div>
		
		<div class="footer-table" style="background-color: inherit">
        	<p style="width: 70%;float: left;margin-top: 20px;">
				<span><?php echo "ทั้งหมด : ".$count_row." รายการ (".$total_page." หน้า )"; ?></span>
			</p>
            
            <p style="width: 30%;float: left;margin-top: 20px;text-align: right;">
            	<a href="javascript:firstPage()"><img src="<?php echo base_url(); ?>img/prew.png"></a>
            	<a href="javascript:prevPage('<?php echo $current_page; ?>')"><img src="<?php echo base_url(); ?>img/prev.png"></a>
                <span style="margin-top: 10px;">
					<!-- <span><?php //echo $current_page; ?></span> -->
					<select onchange="jump_page(this.value)">
<?php 
						// var_dump($page_url);
						foreach ($page_url as $item) {
							?><option value="<?php echo $item['value']; ?>" <?php echo $item['selected']; ?>><?php echo $item['value']; ?></option><?php
						}
?>
					</select> / <?php echo $total_page; ?>
                </span>
                <a href="javascript:nextPage('<?php echo $current_page; ?>')"><img src="<?php echo base_url(); ?>img/next.png"></a>
                <a href="javascript:lastPage('<?php echo $total_page; ?>')"><img src="<?php echo base_url(); ?>img/next2.png"></a>
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
				$("#homeSearch").attr("action","<?php echo base_url()."manageInfo_Category"; ?>/"+nextpage);
				$("#homeSearch").submit();
			}
			function lastPage(val){
				$("#homeSearch").attr("action","<?php echo base_url()."manageInfo_Category"; ?>/"+val);
				$("#homeSearch").submit();
			}
			function prevPage(val){
				var prevpage = parseInt(val)-1;
				$("#homeSearch").attr("action","<?php echo base_url()."manageInfo_Category" ?>/"+prevpage);
				$("#homeSearch").submit();
			}
			function firstPage(){
				$("#homeSearch").attr("action","<?php echo base_url()."manageInfo_Category"; ?>/1");
				$("#homeSearch").submit();
			}
			
			function set_Category_box(cate_oldid) {
			    if (cate_oldid != ""){
			        var post_url = "<?php echo base_url(); ?>PRD_ManageInfo_Category/set_category/" + cate_oldid;
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