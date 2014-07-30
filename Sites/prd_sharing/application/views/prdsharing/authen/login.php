<div class="wrapper">
	<!-- <form id="authen_form" action="<?php echo base_url().index_page(); ?>authen_proc" method="post" accept-charset="utf-8"> -->
	<form id="authen_form" action="<?php echo base_url().index_page(); ?>authen_proc2" method="post" onsubmit="return validateForm(); " enctype="multipart/form-data" accept-charset="utf-8" >
		<?php /*
		<!-- <input type="hidden" name="prd_UserID" id="prd_UserID" value="" /> -->
		<!-- <input type="hidden" name="prd_Authen" id="prd_Authen" value="" /> -->
		<!-- <input type="hidden" name="prd_Username" id="prd_Username" value="" /> -->
		*/ ?>
		
		<input type="hidden" name="username" id="username_temp" value="" />
		<input type="hidden" name="password" id="password_temp" value="" />
	</form>
	<div class="content">
		<div id="login-form">
			<ul>
				<li style="text-align:center;margin-bottom: 20px;">
					<p style="font-weight: bold;">
						<span style="color: #0808A7;">login to</span><span style="color: #0404F5"> PRD Data Center</span>
					</p>
				</li>
				<li style="text-align:center;">
					<input class="txt-field" type="text" value="" name="username" id="username" value="NNT_tester" placeholder="Username" style="width: 30%" />
				</li>
				<li style="margin-top:15px;text-align:center;">
					<input class="txt-field" type="password" value="" name="password" id="password" value="123456" placeholder="Password" style="width: 30%" />
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
				<input class="bt" type="button" value="Login" name="submit" id="submit" style="width:10%;padding: 4px;">
				<input class="bt" type="button" value="Register" name="register" id="register" style="width:10%;padding: 4px;">
			</div>
		</div>
	</div>

	<!--<div style="border-top: 1px dotted #000; margin-top: 20px; padding-top: 20px;text-align: center;">
	<input class="bt" type="submit" value="Login" name="submit" style="width:10%;padding: 4px;">
	<input class="bt" type="submit" value="Register" name="submit" style="width:10%;padding: 4px;">
	</div>-->
</div>
<script>
	function validateForm() {
		var username = document.getElementById("username").value;
		if (username==null || username=="") {
			alert("โปรดใส่ค่า username");
			document.getElementById("username").focus();
			return false;
		}
		
		var password = document.getElementById("password").value;
		if (password==null || password=="") {
			alert("โปรดใส่ค่า password");
			document.getElementById("password").focus();
			return false;
		}
		
	}
	
	$("#register").click(function() {
		document.location.href = "<?php echo base_url().index_page(); ?>register";
	}); 
	
	$(function(){
		
	    $('#username').keydown(function(event) {
	        if (event.keyCode == 13) {
	        	// PRD_Authen();
	        	$("form#authen_form #username_temp").val(($("#username").val()));
				$("form#authen_form #password_temp").val(($("#password").val()));
	            $("form#authen_form").submit();
	            // return false;
	         }
	    });
	    
	    $('#password').keydown(function(event) {
	        if (event.keyCode == 13) {
	        	// PRD_Authen();
	        	$("form#authen_form #username_temp").val(($("#username").val()));
				$("form#authen_form #password_temp").val(($("#password").val()));
	            $("form#authen_form").submit();
	            // return false;
	         }
	    });
	    
		// $("form#authen_form").submit(function(){
		$("#submit").click(function(){
			// PRD_Authen();
			$("form#authen_form #username_temp").val(($("#username").val()));
			$("form#authen_form #password_temp").val(($("#password").val()));
			$("form#authen_form").submit();
		});
	});
	
<?php
	/*
	function PRD_Authen(){
		// console.log('onclick');
		var post_url = "http://111.223.32.9/prdservice/api/authenticate";
		$.ajax({
			type: 'POST',
			url: 'http://111.223.32.9/prdservice/api/authenticate',
			crossDomain: true,
			data: { username:$("#username").val(), 	password:$("#password").val() },
			dataType: 'json',
			success: function(responseData) {
				// console.log(responseData);
				var UserID = responseData.UserID;
				var Authen = responseData.Authenticated;
				var Username = responseData.UserName;
				var redirectURL = '<?php echo base_url()?>rss/login';
				
				$("#prd_UserID").val(UserID);
				$("#prd_Authen").val(Authen);
				$("#prd_Username").val(Username);
				
				$("form#authen_form #username_temp").val(($("#username").val()));
				$("form#authen_form #password_temp").val(($("#password").val()));
				
				$("form#authen_form").submit();
			},
			error: function(request, status, error) {
				console.log("Cannot Use Ajax Function");
				$("#authen_form").attr("action", "<?php echo base_url().index_page(); ?>prd_authen_normal_1");
				$("#authen_form").submit();
			}
		});
	}
	
	//Return True Authen
	//array(5) { ["prd_UserID"]=> string(10) "2000200117" ["prd_Authen"]=> string(4) "true" ["prd_Username"]=> string(10) "nnt_tester" ["username"]=> string(10) "NNT_tester" ["password"]=> string(6) "123456" }
	
	// alert(UserID);
	//redirect(redirectURL,UserID,Authen,Username);
	// $("#authen_form").submit();
	*/
?>
	
</script>
</div>
</body>
</html>