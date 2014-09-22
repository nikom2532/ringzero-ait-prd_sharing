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
<?php
	// var_dump($get_grov_fileattach);
		foreach ($news as $news_item) {
?>
			<div class="row" id="gove-title">
<?php 
				echo $news_item->SendIn_Issue; 
				$LeftContainerCount=0;
				$url = base_url()."Uploads\\";
?>
			</div>
			<div class="row hide-print">
				<div class="col-lg-6" >
					<div class="vdo hide-print" >
						<!-- <img src="<?php echo base_url(); ?>images/vdo/vdo.png" alt="vdo" style="width:100%;"> -->
<?php
						$file_count = 0;
						foreach ($get_grov_fileattach as $file) {
							if($file->File_Type == "video"){
								?><video width="461" height="358" controls autoplay>
									<source src="<?php echo $url.$file->File_Name; ?>" type="video/mp4">
									<object data="<?php echo $url.$file->File_Name; ?>" width="461" height="358">
										<embed src="<?php echo $url.$file->File_Name; ?>" width="461" height="358">
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
								?><a href="<?php echo $url.$file->File_Name; ?>" class="fancybox" data-fancybox-group="gallery"><img src="<?php echo $url.$file->File_Name; ?>" alt="pic" style="width:30%;<?php
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
					$voice_count = 0;
					foreach ($get_grov_fileattach as $file) {
						// var_dump($voice);
						if($file->File_Type == "voice"){
							if($voice_count == 0){
								?><div class="voice-list" style="width: 100%;float: left;margin-top: 30px; text-align: right; margin-bottom: 30px; "><?php
							}
									?>
									<!-- <script src="<?php echo base_url(); ?>js/flowplayer546_embed.min.js">
									<audio width="482" height="270" controls>
										<source src="<?php echo $voice->Url; ?>" type="audio/mpeg">
									</audio>
									</script> -->
									
									<a id="mb" style="display:block;width:482;height:30px;" href="<?php echo $url.$file->File_Name; ?>">
										<object width="100%" height="100%" id="mb_api" name="mb_api" data="http://releases.flowplayer.org/swf/flowplayer-3.2.18.swf" type="application/x-shockwave-flash">
											<param name="allowfullscreen" value="true">
											<param name="allowscriptaccess" value="always">
											<param name="quality" value="high">
											<param name="bgcolor" value="#000000">
											<param name="flashvars" value="config={&quot;plugins&quot;:{&quot;controls&quot;:{&quot;fullscreen&quot;:false,&quot;height&quot;:30,&quot;autoHide&quot;:false}},&quot;clip&quot;:{&quot;autoPlay&quot;:false,&quot;url&quot;:&quot;<?php echo $voice->Url; ?>&quot;},&quot;playerId&quot;:&quot;mb&quot;,&quot;playlist&quot;:[{&quot;autoPlay&quot;:false,&quot;url&quot;:&quot;<?php echo $voice->Url; ?>&quot;}]}">
											<audio width="482" height="30" controls>
												<source src="<?php echo $url.$file->File_Name; ?>" type="audio/mpeg">
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
					foreach ($get_grov_fileattach as $file) {
						// var_dump($voice);
						if($file->File_Type == "otherfile"){
							if($voice_count == 0){
								?><div class="otherfiles-list" style="margin-top: 30px; text-align: right; "><?php
							}
									?><a href="<?php echo $url.$file->File_Name; ?>" style="text-decoration:none;text-decoration:none; "><?php echo $OtherFile->File_Name; ?>&nbsp;&nbsp;<img src="<?php echo base_url(); ?>images/icon/download.png" ></a><?php
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