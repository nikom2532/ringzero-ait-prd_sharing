<div class="wrapper">
	<form action="<?php echo base_url().index_page(); ?>authen_proc" method="post" accept-charset="utf-8">
		<div class="content">
			<div id="login-form">
				<ul>
					<li style="text-align:center;margin-bottom: 20px;">
						<p style="font-weight: bold;">
							<span style="color: #0808A7;">login to</span><span style="color: #0404F5"> PRD Data Center</span>
						</p>
					</li>
					<li style="text-align:center;">
						<input class="txt-field" type="text" value="" name="username"  placeholder="Username" style="width: 30%">
					</li>
					<li style="margin-top:15px;text-align:center;">
						<input class="txt-field" type="password" value="" name="password"  placeholder="Password" style="width: 30%">
					</li>
					<?php 
						if(isset($error)){
							?><li style="margin-top:15px;text-align:center;">
								<span style="color: red"><?php echo $error; ?></span>
							</li><?php
						}
					?>
				</ul>
				<div style="border-top: 1px dotted #000; margin-top: 20px; padding-top: 20px;text-align: center;">
					<input class="bt" type="submit" value="Login" name="submit" style="width:10%;padding: 4px;">
					<input class="bt" type="button" value="Register" name="register" id="register" style="width:10%;padding: 4px;">
				</div>
			</div>
		</div>

		<!--<div style="border-top: 1px dotted #000; margin-top: 20px; padding-top: 20px;text-align: center;">
		<input class="bt" type="submit" value="Login" name="submit" style="width:10%;padding: 4px;">
		<input class="bt" type="submit" value="Register" name="submit" style="width:10%;padding: 4px;">
		</div>-->
	</form>
</div>
<script>
	$("#register").click(function() {
		document.location.href = "register";
	}); 
</script>
</div>
</body>
</html>