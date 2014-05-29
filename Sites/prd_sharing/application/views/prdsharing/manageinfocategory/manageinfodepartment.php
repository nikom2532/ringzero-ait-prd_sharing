<div class="content">
	<div id="share-form">
		<form name="form" action="manageInfo_Department" method="post">
			<input type="hidden" name="manageInfo_Category_is_search" value="yes" />
			<div id="search-form">
				<div class="row">
					<div class="col-lg-6">
						<label >คำค้นหา</label>
						<input type="text" class="form-control" name="dep_name" id="dep_name" value="<?php if(isset($post_dep_name)){ echo $post_dep_name; } ?>" placeholder="" />
					</div>
					<div class="col-lg-6">
						<label >สถานะ</label>
						<!-- <input type="text" class="form-control" id="InputKeyword" placeholder="" > -->
						<select name="dep_status" style="">
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
			</div>
		</form>
	</div>

	<div id="table-list">
		<div class="row">
			<div class="col-lg-left" style="margin-top: 20px;font-weight: bold;width: 100%;">
				<a href="manageInfo_Category">
				<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
					Category
				</p></a>
				<a href="manageInfo_Ministry">
				<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
					Ministry
				</p></a>
				<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;text-align:center;float: left;margin-left: 10px;width: 15%;">
					Department
				</p>
				<input class="bt" type="submit" value="เพิ่ม" name="share" style="padding: 4px;float: right; width: 10%;" onclick="location.href='infoDepartmentNew'; ">
			</div>
		</div>

		<div class="row" style="text-align: center;">
			<div class="header-table">
				<p class="col-1" style="width: 5%;float: left; ">
					ลำดับที่
				</p>
				<p class="col-2" style="width: 5%;float: left; ">
					ลบ
				</p>
				<p class="col-2" style="width: 20%;float: left; ">
					รหัสกรม
				</p>
				<p class="col-3" style="width: 30%;float: left; ">
					ชื่อกระทรวง
				</p>
				<p class="col-3" style="width: 30%;float: left; ">
					ชื่อกรม
				</p>
				<p class="col-3" style="width: 10%;float: left; ">
					สถานะใช้งาน
				</p>
			</div>
<?php
			$i = 1;
			foreach ($department as $department_item) {
				
				if($i%2 == 1){
					?><div class="odd" style="text-align: center;"><?php
				}
				else{
					?><div class="event"><?php
				}
?>
						<p class="col-1" style="width: 5%;float: left; ">
							<?php echo $i; ?>
						</p>
						<p class="col-2 DepartmentDelete" data-dep_id="<?php echo $department_item->Dep_ID; ?>" style="width: 5%;float: left; cursor:pointer; " <!-- onclick="DepartmentDelete('<?php echo $department_item->Dep_ID; ?>')" -->  >
							<img src="images/icon/delete.png" style="margin: -5px 10px 0;">
						</p>
						<p class="col-2" style="width: 20%;float: left; ">
							<a href="infoDepartment?dep_id=<?php echo $department_item->Dep_ID; ?>"><?php echo $department_item->Dep_ID; ?></a>
						</p>
						<p class="col-3" style="width: 30%;float: left; ">
							<?php echo $department_item->Minis_Name; ?>
						</p>
						<p class="col-3" style="width: 30%;float: left; ">
							<?php echo $department_item->Dep_Name; ?>
						</p>
						<p class="col-3" style="width: 10%;float: left; ">
<?php 
							if($department_item->Dep_Status == 1){
								echo "ใช้งานได้"; 
							}
							elseif($department_item->Dep_Status == 0 || $ministry_item->Minis_Status == null || $ministry_item->Minis_Status == ""){
								echo "ใช้งานไม่ได้"; 
							}
?>
						</p>
					</div>
<?php
				$i++;
			}
?>
		</div>
	</div>
</div>

<script>
	
	$(".DepartmentDelete").click( function() {
		
		var dep_id = $(this).attr("data-dep_id");
		// alert(id);
		
		
		if (confirm("คุณแน่ใจว่าจะลบหรือไม่ "+dep_id) == true) {
	        location.href="manageInfo_Department?del_department=1&dep_id="+dep_id;
	    }
	    else {
	    	
	    }
		
		
	});
	
	
	// function DepartmentDelete(dep_id) {
	    // if (confirm("คุณแน่ใจว่าจะลบหรือไม่ "+dep_id) == true) {
	        // location.href="manageInfo_Department?del_department=1&dep_id="+dep_id;
	    // }
	    // else {
// 	    	
	    // }
	// }
	
</script>
