<div class="content">
	<div id="detail-form">
<?php
	// var_dump($get_grov_fileattach);
		foreach ($news as $news_item) {
?>
			<div class="row" id="gove-title">
				<!-- นายกรัฐมนตรี ย้ำผู้ว่าราชการจังหวัดทั่วประเทศในแนวทางแก้ปัญหาภัยแล้ง ภัยหนาว และอุบัติเหตุในช่วงปีใหม่  -->
<?php 
				echo $news_item->SendIn_Issue; 
				$LeftContainerCount=0;
?>
			</div>
			<div class="row">
				<div class="col-lg-6" >
					<div class="vdo" >
						<!-- <img src="<?php echo base_url(); ?>images/vdo/vdo.png" alt="vdo" style="width:100%;"> -->
<?php
						$file_count = 0;
						foreach ($get_grov_fileattach as $file) {
							if($file->File_Type == "video"){
								?><video width="461" height="358" controls autoplay>
									<source src="<?php echo $file->File_Path; ?>" type="video/mp4">
									<object data="<?php echo $file->File_Path; ?>" width="461" height="358">
										<embed src="<?php echo $file->File_Path; ?>" width="461" height="358">
									</object> 
								</video><?php
								$file_count++;
								$LeftContainerCount++;
							}
						}
						if($file_count == 0){
							?><?php
						}
?>
					</div>
					<div class="image-list">
<?php
						$i=1;
						// var_dump($get_NT01_News_pictures);
						foreach ($get_grov_fileattach as $file) {
							if($file->File_Type == "image"){
								?><img src="<?php echo $file->File_Path; ?>" alt="pic" style="width:30%;<?php
									if($i % 3 == 2){
										?>margin:10px 4% 0;<?php
									}
									else{
										?>margin-top:10px;<?php
									}
								?>"><?php
								$i++;
								$LeftContainerCount++;
							}
						}
?>
						<!-- <img src="<?php echo base_url(); ?>images/pic/p1.png" alt="vdo" style="width:30%;margin-top:10px;">
						<img src="<?php echo base_url(); ?>images/pic/p2.png" alt="vdo" style="width:30%;margin:10px 4% 0;">
						<img src="<?php echo base_url(); ?>images/pic/p4.png" alt="vdo" style="width:30%;margin-top:10px;">
						<img src="<?php echo base_url(); ?>images/pic/p3.png" alt="vdo" style="width:30%;margin-top:10px;"> -->
					</div>
				</div>
				<div class="col-lg-<?php 
					if($LeftContainerCount == 0){
						?>12<?php
					}
					else{
						?>6<?php
					}
				?>" >
					<div id="detail">
						<h1>นโยบายรัฐบาล : <?php echo $news_item->Policy_ID; ?></h1>
						<h1>แผนงานโครงการ &#47; กิจกรรม : <?php echo $news_item->SendIn_Plan; ?></h1>
						<p>
<?php
							if($news_item->SendIn_UpdateDate != ""){
								echo date("d/m/Y", strtotime($news_item->SendIn_CreateDate));
							}
							else{
								echo date("d/m/Y", strtotime($news_item->SendIn_UpdateDate));
							}						
							?> | (<?php
							if($news_item->SendIn_view == "" || $news_item->SendIn_view == null){
								echo "0";
							}
							else {
								echo $news_item->SendIn_view; 
							}
							?> ผู้เข้าชม )
						</p>
						<p>
							<?php echo $news_item->SendIn_Detail; ?>
						</p>
					</div>
					<div class="news-form">
						<h1 style="margin-bottom: 5px;">ข้อมูลข่าวและที่มา</h1>
						<p>
							ผู้เผยแพร่ข่าว : <?php echo $news_item->Mem_Name." ".$news_item->Mem_LasName; ?>
						</p>
						<p>
							กระทรวง : <?php ?>
						</p>
						<p>
							กรม : <?php ?>
						</p>
					</div>
				</div>
			</div>
<?php
		}
?>
	</div>
</div>