<form id="authen_form" action="http://111.223.32.9/prdservice/api/authenticate" method="post" accept-charset="utf-8">
	<input type="hidden" name="username" id="username_temp" value="<?php echo $username; ?>" />
	<input type="hidden" name="password" id="password_temp" value="<?php echo $password; ?>" />
</form>
<script>
	$("#register").click(function() {
	}); 
	
	$(function(){
        $("form#authen_form").submit();
	});
</script>