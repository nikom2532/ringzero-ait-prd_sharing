<div id="search-form">

	<div class="row">
		<div class="col-lg-12">
			<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
			<input class="txt-field" type="text" value="" name="news_title"  placeholder="" style=" margin-left: 15px;width: 77%;">
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<label >วันที่</label>
			<input type="text" class="form-control" name="start_date" id="InputKeyword" placeholder="" >
		</div>
		<div class="col-lg-6">
			<label >ถึง</label>
			<input type="text" class="form-control" name="end_date" id="InputKeyword" placeholder="" >
		</div>
	</div>

	<div class="col-lg-12" style="text-align: center;">
		<form name="search_form" action="HomePRD" method="post">
			<input type="hidden" name="news_title" value="" />
			<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:18%;padding: 4px;">
		</form>
	</div>

</div>

<div class="table-list">
	<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">
		News And Information
	</p>