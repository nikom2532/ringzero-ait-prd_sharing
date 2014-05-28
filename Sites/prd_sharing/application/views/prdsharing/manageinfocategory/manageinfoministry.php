<div class="content">
	<div class="col-lg-6">
<?php
		if(isset($ministry_is_save)){
			if($ministry_is_save == "yes"){
				?>Ministry is saved.<?php
			}
		} 
?>
	</div>
	<div id="share-form"> 	
		<div id="search-form">
			<form name="manageinfo_ministry_form" id="manageinfo_ministry_form" action="manageInfo_Ministry" method="post">
				<input type="hidden" name="manageinfo_ministry_is_search" value="" />
				<div class="row">
					<div class="col-lg-6">
						<label >คำค้นหา</label>
						<input type="text" class="form-control" name="minis_name" id="InputKeyword" value="<?php if(isset($post_minis_name)){ echo $post_minis_name; } ?>" placeholder="" >
					</div>
					<div class="col-lg-6">
						<label >สถานะ</label>
						<!-- <input type="text" class="form-control" id="InputKeyword" placeholder="" > -->
						<select name="minis_status" style="">
							<option value="1" <?php
								if(isset($post_minis_status)){
									if($post_minis_status == "1"){
										?>selected="selected"<?php
									}
								}
							?>>ใช้งานได้</option>
							<option value="0" <?php
								if(isset($post_minis_status)){
									if($post_minis_status == "0"){
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
				<a href="manageInfo_Category">
				<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
					Category
				</p></a>
				<p style="border-radius: 15px;padding: 15px;color:#fff;background-color:#0404F5;text-align:center;float: left;margin-left: 10px;width: 15%;">
					Ministry
				</p>
				<a href="manageInfo_Department">
				<p style="border-radius: 15px;padding: 15px;background-color:#EDEDED;width: 15%;text-align:center;margin-left: 10px;float: left;border: 1px solid #dcdcdc;">
					Department
				</p></a>
					<input class="bt" type="submit" value="เพิ่ม" name="share" style="padding: 4px;float: right; width: 10%;" onclick="location.href='infoMinistry'; ">
			</div>
		</div>

		<div class="row" style="text-align: center;">
			<div class="header-table">
				<p class="col-1" style="width: 10%;float: left; ">
					ลำดับที่
				</p>
				<p class="col-2" style="width: 10%;float: left; ">
					ลบ
				</p>
				<p class="col-2" style="width: 20%;float: left; ">
					รหัสกระทรวง
				</p>
				<p class="col-3" style="width: 30%;float: left; ">
					ชื่อกระทรวง
				</p>
				<p class="col-3" style="width: 30%;float: left; ">
					สถานะใช้งาน
				</p>
			</div>
<?php
			$i=1;
			foreach ($ministry as $ministry_item) {
				if($i%2 == 1){
					?><div class="odd" style="text-align: center;"><?php
				}
				else{
					?><div class="event"><?php
				}
?>
						<p class="col-1" style="width: 10%;float: left; ">
							<!-- ลำดับที่ -->
							<?php echo $i; ?>
						</p>
						<p class="col-2" style="width: 10%;float: left; "><img src="images/icon/delete.png" style="margin: -5px 10px 0;">
						</p>
						<p class="col-2" style="width: 20%;float: left; ">
							<!-- <a href="infoMinistry" >รหัสกระทรวง</a> -->
							<a href="infoMinistry?minis_id=<?php echo $ministry_item->Minis_ID; ?>"><?php echo $ministry_item->Minis_ID; ?></a>
						</p>
						<p class="col-3" style="width: 30%;float: left; ">
							<!-- ชื่อกระทรวง -->
							<?php echo $ministry_item->Minis_Name; ?>
						</p>
						<p class="col-3" style="width: 30%;float: left; ">
							<!-- สถานะใช้งาน -->
<?php 
							if($ministry_item->Minis_Status == 1){
								echo "ใช้งานได้"; 
							}
							elseif($ministry_item->Minis_Status == 0 || $ministry_item->Minis_Status == null || $ministry_item->Minis_Status == ""){
								echo "ใช้งานไม่ได้"; 
							}
?>
						</p>
					</div>
<?php
			}
?>
		</div>
	</div>
</div>

<script>
	
</script>