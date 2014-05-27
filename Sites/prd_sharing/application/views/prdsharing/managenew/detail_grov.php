<div class="content">
	<div id="detail-form">
<?php
	// var_dump($get_grov_fileattach);
		foreach ($news as $news_item) {
?>
			<div class="row" id="gove-title">
				<!-- นายกรัฐมนตรี ย้ำผู้ว่าราชการจังหวัดทั่วประเทศในแนวทางแก้ปัญหาภัยแล้ง ภัยหนาว และอุบัติเหตุในช่วงปีใหม่  -->
				<?php echo $news_item->SendIn_Issue; ?>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="vdo">
						<!-- <img src="images/vdo/vdo.png" alt="vdo" style="width:100%;"> -->
<?php
						foreach ($get_grov_fileattach as $file) {
							if($file->File_Type == "video"){
								?><video width="461" height="358" controls autoplay>
									<source src="<?php echo $file->File_Path; ?>" type="video/mp4">
									<object data="<?php echo $file->File_Path; ?>" width="461" height="358">
										<embed src="<?php echo $file->File_Path; ?>" width="461" height="358">
									</object> 
								</video><?php
							}
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
							}
						}
?>
						<!-- <img src="images/pic/p1.png" alt="vdo" style="width:30%;margin-top:10px;">
						<img src="images/pic/p2.png" alt="vdo" style="width:30%;margin:10px 4% 0;">
						<img src="images/pic/p4.png" alt="vdo" style="width:30%;margin-top:10px;">
						<img src="images/pic/p3.png" alt="vdo" style="width:30%;margin-top:10px;"> -->
					</div>
				</div>
				<div class="col-lg-6" >
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
							นายกรัฐมนตรี ย้ำผู้ว่าราชการจังหวัดทั่วประเทศในแนวทางแก้ปัญหาภัยแล้ง ภัยหนาว และอุบัติเหตุใน
							ช่วงปีใหม่ โดยให้ทุกฝ่ายที่เกี่ยวข้องบูรณาการร่วมกันพร้อมเน้นในการจัดทำยุทธศาสตร์จังหวัดให้ต่อ
							เนื่องสอดคล้องกับภัยพิบัติต่างๆ ในพื้นที่
						</p>
						<p>
							นางสาวยิ่งลักษณ์ ชินวัตร นายกรัฐมนตรีและรัฐมนตรีว่าการกระทรวงกลาโหม เป็นประธานประชุมติด
							ตามแก้ปัญหาความเดือดร้อนของประชาชนในภาคตะวันออกเฉียงเหนือ ร่วมกับผู้ว่าราชการจังหวัดทั้ง
							20 จังหวัดและ 11 กระทรวงที่เกี่ยวข้อง ที่ศาลากลางจังหวัดร้อยเอ็ด เพื่อเตรียมความพร้อมป้องกัน
							แก้ไขปัญหาและให้การช่วยเหลือผู้ประสบภัยทั้งภัยหนาว ภัยแล้งและอุบัติเหตุในช่วงเทศกาลปีใหม่
							โดยประชุมผ่านระบบวีดีโอคอนเฟอร์เร้นซ์กับผู้ว่าราชการทั่วประเทศ
						</p>
						<p>
							นายกรัฐมนตรี ได้เน้นย้ำให้ป้องกันและบรรเทาสาธารณภัยจังหวัดและหน่วยงานที่เกี่ยวข้องบริหารจัด
							การภัยพิบัติในรูปแบบ Single Command Center นำหลัก 2 พี 2 อาร์ มาปฏิบัติโดยกำหนดมาตรการ
							รองรับและแก้ไขปัญหาให้สอดคล้องกับสภาพความเสี่ยง ระดับความรุนแรงในพื้นที่ พร้อมเร่งช่วยเหลือ
							ผู้ประสบภัยให้รวดเร็วทั่วถึง ครอบคลุมในทุกพื้นที่ โดยเฉพาะพื้นที่ห่างไกล ขณะที่เรื่องอุบัติเหตุช่วงปี
							ใหม่ขอให้ทุกฝ่ายช่วยกันป้องกันและรณรงค์ ซึ่งเป็นสิ่งที่รัฐบาลอยากเห็นการลดอุบัติเหตุและสูญเสีย
							ให้น้อยลงในทุกๆปี
						</p>
						<p>
							นอกจากนี้ นายกรัฐมนตรี ย้ำผู้ว่าราชการจังหวัดทุกจังหวัด ในการจัดทำยุทธศาสตร์จังหวัดให้ต่อเนื่อง
							สอดคล้องกับภัยพิบัติต่างๆ ในพื้นที่ และให้วางแผนล่วงหน้าก่อนที่จะเกิดภัยพิบัติขึ้น โดยประเมินจาก
							ประสบการณ์ที่ผ่านมาในอดีต
						</p>
					</div>
					<div class="news-form">
						<h1 style="margin-bottom: 5px;">ข้อมูลข่าวและที่มา</h1>
						<p>
							ผู้สื่อข่าว : สมมติ  นามสกุล
						</p>
						<p>
							Rewriter : สมมติ  นามสกุล
						</p>
						<p>
							แหล่งที่มา : สำนักงานประชาสัมพันธ์เชียงใหม่
						</p>
						<p>
							สำนักข่าวแห่งชาติ กรมประชาสัมพันธ์ : http;//thainews.prd.go.th
						</p>
					</div>
				</div>
			</div>
<?php
		}
?>
	</div>
</div>