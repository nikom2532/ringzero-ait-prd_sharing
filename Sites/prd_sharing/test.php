			<div style=\"margin-left: 5%; color: #000000; float: left; \">
				Video *
			</div>
			<div style=\"margin-left: 5%; color: #cc0000; \">
				ลองรับนามสกุล .mp4, .avi, .wmv, .flv
			</div>
			
			<div class=\"row file_1\" style=\"margin-bottom: 0; \">
				<div class=\"col-lg-12\" style=\"margin-left: 5%; \">
					<span class=\"label_file\" >file แนบเอกสาร</span>
					<input type=\"file\" class=\"form-control\" name=\"fileattach_video1\" id=\"fileattach\" onchange=\"check_file_ext('video', '1');\" placeholder=\"\" style=\"width: 40%; \" multiple />
					<img src=\"<?php echo base_url(); ?>images/icon/delete_lock2.png\" name=\"reducemorefile\" id=\"reducemorefile\" data-file_id=\"1\" style=\"width: 20px; margin-left: 15px; cursor: pointer; \" />
				</div>
			</div>