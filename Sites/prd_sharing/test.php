<script>
		$(function(){
	 $("#login").click(function(){
		 console.log('onclick');
		 var post_url = "http://111.223.32.9/prdservice/api/authenticate";
		 $.ajax({
			type: 'POST',
			url: 'http://111.223.32.9/prdservice/api/authenticate',
			crossDomain: true,
			data: { username:$("#username").val(), password:$("#password").val() },
			dataType: 'json',
			success: function(responseData) {
				console.log(responseData);
				var UserID = responseData.UserID;
				var Authen = responseData.Authenticated;
				var Username = responseData.UserName;
				var redirectURL = '<?php echo base_url()?>rss/login';
				redirect(redirectURL,UserID,Authen,Username);
			},
			error: function (responseData) {
				alert('POST failed.');
			}
		});
	 });
});
function redirect(page,value,authen,username)
{
	$.ajax({
		type: 'POST',
		url: page,
		data: {UserId: value , Authenticated: authen , Username: username},
		success:function(rs){
			if(rs == 'Success')
			{
				window.location="<?php echo base_url();?>rss/sharing";
			}
			else
			{
				//alert(rs);
				$("#error").show();
			}
		}
	});
}

</script>