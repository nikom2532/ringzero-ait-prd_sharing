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
			$i=1;
			foreach ($category_old as $catalog_old_item) {
				if($i%2 == 1){
					?><div class="odd"><?php
				}
				else{
					?><div class="event"><?php
				}
				
						$typeName = $catalog_old_item->NT02_TypeName;
						$tick = $catalog_old_item->NT02_Status;
						foreach ($category_new as $category_new_item){
							if($catalog_old_item->NT02_TypeID == $category_new_item->Cate_OldID){
								$print = $catalog_new_item->CateName;
								$tick = $catalog_new_item->Cate_Status;
							}
						}
						
						// echo $catalog_old_item->NT02_TypeID == $category_new_item->Cate_OldID;
?>
						<span class="col-1" style="width: 20%;float: left; text-align: center;">
							<input type="checkbox" name="vehicle" value="Car" <?php
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
			<div class="footer-table">
				<p style="width: 70%;float: left;margin-top: 20px;">
					ทั้งหมด: 73 รายการ (4หน้า)
				</p>
				<p style="width: 30%;float: left;margin-top: 20px;text-align: right;">
					<img src="images/table/pev.png" style="margin: -5px 10px 0;">
					<span style="margin-top: 10px;">
						<select style="">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select> / 100</span>
					<img src="images/table/next.png" style="margin: -5px 10px 0;">
					<img src="images/table/end.png" style="margin: -5px 10px 0;">
				</p>
			</div>
		</div>
	</div>
</div>