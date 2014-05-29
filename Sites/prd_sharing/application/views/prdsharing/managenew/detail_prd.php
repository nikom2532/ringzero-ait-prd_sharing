<div class="content">
	<div id="detail-form">
		<div class="row">
			<div class="col-lg-6">
				<div class="vdo">
					<!-- <img src="images/vdo/vdo.png" alt="vdo" style="width:100%;">
					<img src="<?php
						echo $news[3]->NT10_VDOPath;
					?>" alt="vdo" style="width:100%;"> -->
<?php
					foreach ($get_NT01_News_videos as $videos) {
						if(isset($videos->NT10_VDOPath)){
?>
							<video width="461" height="358" controls autoplay>
								<source src="http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=<?php echo $videos->NT10_VDOPath; ?>" type="video/mp4">
								<object data="http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=<?php echo $videos->NT10_VDOPath; ?>" width="461" height="358">
									<embed src="http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=<?php echo $videos->NT10_VDOPath; ?>" width="461" height="358">
								</object>
							</video>
<?php
						}
					}
?>
				</div>
				<div class="image-list">
<?php
					$i=1;
					// var_dump($get_NT01_News_pictures);
					foreach ($get_NT01_News_pictures as $image) {
						
						// var_dump($image);
						
						if(isset($image->NT11_PicPath)){
							
						?><img src="http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=<?php echo $image->NT11_PicPath; ?>" alt="pic" style="width:30%;<?php
							if($i % 3 == 2){
								?>margin:10px 4% 0;<?php
							}
							else{
								?>margin-top:10px;<?php
							}
						?>"><?php
						$i++;
						
						}
					}
?>
					<!-- <img src="images/pic/p1.png" alt="vdo" style="width:30%;margin-top:10px;">
					<img src="images/pic/p2.png" alt="vdo" style="width:30%;margin:10px 4% 0;">
					<img src="images/pic/p4.png" alt="vdo" style="width:30%;margin-top:10px;">
					<img src="images/pic/p3.png" alt="vdo" style="width:30%;margin-top:10px;"> -->
				</div>
			</div>
			<div class="col-lg-6" ><?php
				
				foreach ($news as $news_item) {
				
					?><div id="detail">
						<h1><?php 
								echo $news_item->NT01_NewsTitle;
						?></h1>
						<p><?php 
							if($news_item->NT01_UpdDate == ""){
								echo date("d/m/Y", strtotime($news_item->NT01_CreDate));
							}
							else{
								echo date("d/m/Y", strtotime($news_item->NT01_UpdDate));
							}
							?>  |  (<?php
								if($news_item->NT01_ViewCount == 0 || $news_item->NT01_ViewCount == ""){
									echo "0";
								}
								else{
									echo $news_item->NT01_ViewCount; 
								}
							?> ผู้เข้าชม)
						</p>
						<p><?php
							echo $news_item->NT01_NewsDesc;
						?></p>
					</div>
					<div class="news-form">
						<h1 style="margin-bottom: 5px;">ข้อมูลข่าวและที่มา</h1>
						<p>
							ผู้สื่อข่าว : <?php echo $news_item->NT01_ReporterID; ?>
						</p>
						<p>
							Rewriter : <?php 
								foreach ($get_NT01_News_ReWriteName as $reWriteName) {
									echo $reWriteName->ReWriteName;
								}
							?>
						</p>
						<p>
							แหล่งที่มา : <?php 
							$news_item->NT01_NewsSource;
							// if($news_item->NT01_NewsReferance != ""){
								// echo " : ".$news_item->NT01_NewsReferance;;
							// }
							?>
						</p>
					</div>
<?php
				}
?>
			</div>
		</div>
	</div>
</div>