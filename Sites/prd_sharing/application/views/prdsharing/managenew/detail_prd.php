<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
</script>
<style type="text/css">
	.fancybox-custom .fancybox-skin {
		box-shadow: 0 0 50px #222;
	}
</style>

<div class="content">
	<div id="detail-form">
		<div class="row">
			<?php $LeftContainerCount=0; ?>
			<div class="col-lg-6">
				<div class="vdo">
					<!-- <img src="<?php echo base_url(); ?>images/vdo/vdo.png" alt="vdo" style="width:100%;">
					<img src="<?php
						echo $news[3]->Url;
					?>" alt="vdo" style="width:100%;"> -->
					
					<?php // <div class="news-form" style="color: red;">ไม่มี File Video</div> ?>
<?php
					//ไม่มี File Video
					foreach ($get_NT01_News_videos as $videos) {
						if($videos->Url != ""){
?>
							<!-- <script src="//embed.flowplayer.org/5.4.6/embed.min.js"> -->
							<script src="<?php echo base_url(); ?>js/flowplayer546_embed.min.js">
							<div class="flowplayer" style="width: 461px; height: 358px;">
								<video>
									<source type="video/webm" src="<?php echo $videos->Url; ?>" type="video/mp4">
								</video>
							</div></script>
							
							<?php /* <video width="461" height="358" controls autoplay>
								<source src="http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=<?php echo $videos->Url; ?>" type="video/mp4">
								<object data="http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=<?php echo $videos->Url; ?>" width="461" height="358">
									<embed src="http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=<?php echo $videos->Url; ?>" width="461" height="358">
								</object>
							</video> */ ?>
<?php
							$LeftContainerCount++;
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
						if($image->Url != ""){
							
							?><a href="<?php echo $image->Url; ?>" class="fancybox" data-fancybox-group="gallery"><img src="<?php echo $image->Url; ?>" alt="pic" style="width:30%;<?php
								if($i % 3 == 2){
									?>margin:10px 4% 0;<?php
								}
								else{
									?>margin-top:10px;<?php
								}
							?>"></a><?php
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
<?php
					foreach ($get_NT01_News_videos as $videos) {
						echo $videos->Url;
						if($videos->Url != ""){
							?><div class="voice-list" style="width: 100%;float: left;margin-top: 30px; text-align: right;"><a style="text-decoration:none; text-decoration:none; " href="<?php echo $videos->Url; ?>">Download Video &nbsp;&nbsp;<img src="<?php echo base_url(); ?>images/icon/download.png"></a></div><?php
						}
					}

					$voice_count = 0;
					foreach ($get_NT01_News_Voice as $voice) {
						// var_dump($voice);
						if($voice->Url != ""){
							if($voice_count == 0){
								?><div class="voice-list" style="width: 100%;float: left;margin-top: 30px; text-align: right;"><?php
							}
									?>
									<!-- <script src="<?php echo base_url(); ?>js/flowplayer546_embed.min.js">
									<audio width="482" height="270" controls>
										<source src="<?php echo $voice->Url; ?>" type="audio/mpeg">
									</audio>
									</script> -->
									
									<a id="mb" style="display:block;width:482;height:30px;" href="<?php echo $voice->Url; ?>">
										<object width="100%" height="100%" id="mb_api" name="mb_api" data="http://releases.flowplayer.org/swf/flowplayer-3.2.18.swf" type="application/x-shockwave-flash">
											<param name="allowfullscreen" value="true">
											<param name="allowscriptaccess" value="always">
											<param name="quality" value="high">
											<param name="bgcolor" value="#000000">
											<param name="flashvars" value="config={&quot;plugins&quot;:{&quot;controls&quot;:{&quot;fullscreen&quot;:false,&quot;height&quot;:30,&quot;autoHide&quot;:false}},&quot;clip&quot;:{&quot;autoPlay&quot;:false,&quot;url&quot;:&quot;<?php echo $voice->Url; ?>&quot;},&quot;playerId&quot;:&quot;mb&quot;,&quot;playlist&quot;:[{&quot;autoPlay&quot;:false,&quot;url&quot;:&quot;<?php echo $voice->Url; ?>&quot;}]}">
											<audio width="482" height="30" controls>
												<source src="<?php echo $voice->Url; ?>" type="audio/mpeg">
											</audio>
										</object>
									</a>
									
									
									<script>
										head.js("http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js", "http://cdn.jquerytools.org/1.2.6/all/jquery.tools.min.js", "http://releases.flowplayer.org/js/flowplayer-3.2.13.min.js", function() {
										});
										head.ready(function() {
											// install flowplayer into container
											$f("mb", "http://releases.flowplayer.org/swf/flowplayer-3.2.18.swf", {
									
												// fullscreen button not needed here
												plugins : {
													controls : {
														fullscreen : false,
														height : 30,
														autoHide : false
													}
												},
									
												clip : {
													autoPlay : false,
													// optional: when playback starts close the first audio playback
													onBeforeBegin : function() {
														$f("player").close();
													}
												}
									
											});
									
										}); 
									</script>
									
									<?php
									/*
									?><a href="http://thainews.prd.go.th/centerapp/Common/GetFile.aspx?FileUrl=<?php echo $voice->url; ?>" style="text-decoration:none; text-decoration:none; "><?php echo $voice->NT12_VoiceName; ?><img src="<?php echo base_url(); ?>images/icon/download.png"></a><?php
									*/
							if($voice_count == 0){
								?></div><?php
							}
							$voice_count++;
							$LeftContainerCount++;
						}
					}
					$OtherFile_count = 0;
					foreach ($get_NT01_News_OtherFile as $OtherFile) {
						// var_dump($voice);
						if($OtherFile->Url != ""){
							if($voice_count == 0){
								?><div class="otherfiles-list" style="margin-top: 30px;"><?php
							}
									?><a href="<?php echo $OtherFile->Url; ?>" style="text-decoration:none;text-decoration:none; "><?php echo $OtherFile->FileName; ?>&nbsp;&nbsp;<img src="<?php echo base_url(); ?>images/icon/download.png" ></a><?php
							if($voice_count == 0){
								?></div><?php
							}
							$OtherFile_count++;
							$LeftContainerCount++;
						}
					}
?>
			</div>
			<div class="col-lg-<?php 
					if($LeftContainerCount == 0){
						?>12<?php
					}
					else{
						?>6<?php
					}
				?>" ><?php
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
							ผู้สื่อข่าว : <?php 
							if($news_item->NT01_ReporterID != ""){
								echo $news_item->ReporterName; 
							}
							else{
								?>-<?php
							}
							?>
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
							if($news_item->NT01_NewsSource != ""){
								echo $news_item->NT01_NewsSource;
							}
							else{
								echo "-";
							}
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