<script>
	/*
	$(function() {
		$( ".datepicker" ).datepicker({
			changeMonth: true,
            changeYear: true,
			dateFormat: 'yy-mm-dd' 
		}).val();
	});
	*/
	
	$(function(){
		$(".fromdate").datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeMonth: true,
			changeYear: true,
				onSelect: function(selected) {
					$(".todate").datepicker("option","minDate", selected)
			}
		});
	});
	$(function(){
		$(".todate").datepicker({
			dateFormat: 'yy-mm-dd',
			numberOfMonths: 1,
			changeMonth: true,
			changeYear: true,
			onSelect: function(selected) {
				$(".fromdate").datepicker("option","maxDate", selected)
			}
		});
	});
	
	
</script>
<div id="search-form">

	<form name="search_form" action="<?php echo $home_search; ?>" method="post">
		<div class="row">
			<div class="col-lg-12">
				<label style="float: left;text-align: right;width: 14%;">SEARCH</label>
				<input class="txt-field" type="text" value="<?php 
					if(isset($post_news_title)){
						echo $post_news_title;
					}
				?>" name="news_title"  placeholder="" style=" margin-left: 15px;width: 60%;">
				<input class="bt" type="submit" value="ค้นหาข่าว" name="share" style="width:10%;padding: 4px;margin-left:5px;">
			</div>
		</div>	
		
		<div class="row">
			<div class="col-lg-6-search">
				<div class="label width14">
					<label >วันที่</label>
				</div>
				<div class="input">
					<input type="text" class="form-control datepicker fromdate" name="start_date" placeholder="" readonly="true" value="<?php 
						if(isset($post_start_date)){
							echo $post_start_date;
						}
					?>">
				</div>
			</div>
			<div class="col-lg-6-search">
				<div class="label">
					<label >ถึง</label>
				</div>
				<div class="input">
					<input type="text" class="form-control datepicker todate" name="end_date" placeholder="" readonly="true" value="<?php 
						if(isset($post_end_date)){
							echo $post_end_date;
						}
					?>">
				</div>
			</div>
		</div>
	</form>

</div>

<div class="table-list">
	<p style="color:#0404F5;font-weight: bold;font-size: large;margin: 20px 0;">
		News And Information
	</p>