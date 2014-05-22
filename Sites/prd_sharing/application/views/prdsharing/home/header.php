<script>
	$(function() {
		$( ".datepicker" ).datepicker();
	});
</script>
<div id="search-form">

	<form name="search_form" action="<?php echo $home_search; ?>" method="post">
		<div class="row">
			<div class="col-lg-12">
				<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
				<input class="txt-field" type="text" value="" name="news_title"  placeholder="" style=" margin-left: 15px;width: 60%;">
				<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:10%;padding: 4px;margin-left:5px;">
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-6-search">
				<div class="label width14">
					<label >วันที่</label>
				</div>
				<div class="input">
					<input type="text" class="form-control datepicker" name="start_date"  placeholder="" >
				</div>
			</div>
			<div class="col-lg-6-search">
				<div class="label">
					<label >ถึง</label>
				</div>
				<div class="input">
					<input type="text" class="form-control datepicker" name="end_date"  placeholder="" >
				</div>
			</div>
		</div>
	</form>

</div>

<div class="table-list">
	<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">
		News And Information
	</p>