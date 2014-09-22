<html>
<head>
	<title>TEST CURL</title>
	<script type="text/javascript" href="<?php echo base_url();?>js/jquery-1.8.3.min.js"></script>
</head>
<body>
	<form action="<?php echo base_url();?>index.php/testplayer/signin" method="post">
		username : <input type="text" name="username"><br/>
		password : <input type="password" name="password"><br/>
		<input type="submit" name="submit" value="Login">
	</form>
</body>
</html>