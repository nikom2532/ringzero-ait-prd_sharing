<script>
	$(function() {
		$( ".datepicker" ).datepicker();
	});
</script>
<div id="search-form">

	<form name="search_form" action="homePRD" method="post">

		<div class="row">
			<div class="col-lg-12">
				<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
				<input class="txt-field" type="text" value="" name="news_title"  placeholder="" style=" margin-left: 15px;width: 77%;">
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<label >วันที่</label>
				<input type="text" class="form-control datepicker" name="start_date" id="InputKeyword" placeholder="" >
			</div>
			<div class="col-lg-6">
				<label >ถึง</label>
				<input type="text" class="form-control datepicker" name="end_date" id="InputKeyword" placeholder="" >
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<label >หมวดหมู่ข่าว</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" >
			</div>
			<div class="col-lg-6">
				<label >หมวดหมู่ข่าวย่อย</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" >
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<label >หน่วยงาน</label>
				<input type="text" class="form-control" id="InputKeyword" placeholder="" >
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-6">
				<div style="float: left;width: 30%;">
					<label style="width: 100%;" >ผู้สื่อข่าว</label>
				</div>
				<div style="margin-left: 2%;float: left;">
					<img src="<?php echo base_url(); ?>images/icon/sh.png" style="margin: -5px 10px 0;">
					<img src="<?php echo base_url(); ?>images/icon/delete.png" style="margin: -5px 10px 0;">
				</div>
			</div>
			<div class="col-lg-6">
				<label style="margin-left: 11%;">ไฟล์ประกอบข่าว</label>
				<input type="checkbox" name="vdo" value="0">
				วิดีโอ
				<input type="checkbox" name="sound" value="1">
				เสียง
				<input type="checkbox" name="image" value="2">
				ภาพ
				<input type="checkbox" name="other" value="3">
				อื่นๆ
			</div>
		</div>
		
		<div class="col-lg-12" style="text-align: center;">
			<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:18%;padding: 4px;">
		</div>
	</form>

</div>

<div class="table-list">
	<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">
		News And Information
	</p>
