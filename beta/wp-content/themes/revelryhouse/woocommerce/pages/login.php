<div id="user_login_background"></div>
<div id='user_login'>
	<div>
		<div id="close">x</div>
		<form id="login"  method="post">
			<div>
				<div>
					<table>
						<tbody>
							<tr>
								<th colspan="2" align="center"><img src="<?=get_template_directory_uri();?>/img/logo.png" width="70px" /></th>
							</tr>
							<tr>
								<th align="center">
									<h1>Did you miss us?<br />
									<i>Welcome Back</i></h1>
								</th>
							</tr>
							<tr id="errmsg" text-align="center">
								<td>Invalid Email and Password.</td>
							</tr>
							<tr>
								<td><label>Email Address</label></td>
							</tr>
							<tr>
								<td><input type='text' name='email' /></td>
							</tr>
							<tr>
								<td><label>Password</label></td>
							</tr>
							<tr>
								<td><input type='password' name='password' /></td>
							</tr>
							<tr id="forgot_password">
								<td colspan="2" align="center"><a href="/" id="forgot">forgot your password?</a></td>
							</tr>
							<tr>
								<td align="center" align="center" colspan="2">
									<input type='submit' value="Sign in" name='login' />
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</form>
		<div id="sign_up">
			Not a member? <a href="#" id="goto_signup">Sign up</a>
		</div>
		<!--
		<form id="join" method="post" action="<?php echo get_home_url()?>/join">
			<table>
				<tr>
					<th align="center"><h1>Join</h1></th>
				</tr>
				<tr id="errmsg" text-align="center">
					<td>Email and password required.</td>
				</tr>
				<tr>
					<td><label>Email</label></td>
				</tr>
				<tr>
					<td><input type='text' name='email' /></td>
				</tr>
				<tr>
					<td><label>Password</label></td>
				</tr>
				<tr>
					<td><input type='password' name='password' /></td>
				</tr>
				<tr>
					<td align="center" align="center" colspan="2">
						<input type='submit' value="Join" name='join' />
					</td>
				</tr>
			</table>
		</form>
		-->
	</div>
</div>

<style>
	div#sign_up { 
		color: #FFFFFF;
		padding: 20px;
		text-align: center;
	}
	div#sign_up a{ color: #A08F64;}
	#user_login_background {
		background: none repeat scroll 0 0 #000000;
		height: 100%;
		left: 0;
		opacity: 0.7;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: 99999;
		display: none;
	}
	#user_login {
		position: fixed;
		top: 0;
		left: 0;
		background: transparent;
		width: 100%;
		height: 200%;
		z-index: 99999;
		display: none;
	}
	#user_login > div{
		width: 960px;
		height: 100%;
		margin: 0 auto;
	}
	#user_login #close{
		color: #FFFFFF;
		cursor: pointer;
		float: right;
		font-size: 30px;
		font-weight: bold;
		margin: -3px 254px 0px;
	}
	#user_login form{
		background: none repeat scroll 0 0 #FFFFFF;
		border: 1px solid gray;
		margin: 80px auto 0;
		padding: 5px;
		width: 400px;
	}
	#user_login form > div{
		border: 5px solid #000000;
		padding: 1px;
	}
	#user_login form > div > div{
		border: 2px solid gray;
		 padding: 20px;
	}
	#user_login form > div > div table{
		margin: 0 auto;
	}
	#user_login form > div > div table tr#forgot_password a{
		 color: gray;
    display: block;
    padding: 10px 0 30px;
    text-decoration: underline;
	}
	#user_login form#join{
		opacity: 0.4;
	}
	#user_login table h1{
		color: #000000;
    font-family: 'Didot W01 Bold';
    font-size: 22px;
    margin: 10px 0;
    text-transform: none;
	}
	#user_login table tr#errmsg{    
		color: #000;
		padding-bottom: 20px;
		text-align: center;
		display: none;
	}
	#user_login table tr#errmsg td{
		 padding-bottom: 10px;
	}
	#user_login label{
		text-transform: uppercase;
		margin-bottom: 10px;
		color: #A08F64;
		font-family: 'UniversLTW01-49LightUlt';
		font-size: 18px;
	}
	#user_login input[type=text],#user_login input[type=password]{
		letter-spacing: 1px;
		font-family: 'Didot W01 Bold';
		border-radius: 0;
		border: none;
		border-bottom: 1px solid #000;
		color: #000;
		background: transparent;
		width: 300px;
	}
	#user_login input[type=submit]{
		letter-spacing: 2px;
		text-transform: uppercase;
		color: #FFF !important;
		width: 150px;
		border-radius: 0;
		padding: 10px 0;
		font-size: 28px;
		border: none;
		background: #A08F64;
	}
</style>

<script>
jQuery(function() {

	/* DISPLAY LOGIN FORM */
	jQuery("#user_login,#user_login_background").fadeIn(1500);
	
/* SHOW USER LOGIN ******************************************/

		/* LOGIN AND JOIN DIM AND DARK*/
		jQuery("#user_login form").click(function() {
				var id = jQuery(this).attr('id');
				if(id == 'join') {
					jQuery(this).css('opacity',1);
					jQuery('#user_login form#login').css('opacity',.4);
				}
				else {
					jQuery(this).css('opacity',1);
					jQuery('#user_login form#join').css('opacity',.4);
				}
			});
			
		/* LOGIN PAGE CLOSE */		
		jQuery("#user_login #close").click(function() {
			
			jQuery("#user_login,#user_login_background").fadeOut();
				
			/* FROM PROFILE PAGE */
			if(accessPage == 'profile') {
				window.location = homeURL + '/collections';
			}
			/* FROM CHECKOUT PAGE */
			else if(accessPage == 'checkout') {
				window.location = homeURL + '/cart';
			}
		});
	
		/* USER LOGIN / JOIN FORM SUBMIT */
		jQuery("#user_login form").submit(function() {
			// FORM ID
			var form = jQuery(this).attr("id");
			var formAction = jQuery(this).attr("action");
			// GET EMAIL AND PASSWORD
			var email = jQuery("#"+form+" input[name=email]");
			var password = jQuery("#"+form+" input[name=password]");
			// INVALID EMAIL
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			if(!re.test(email.val()) && email.val() != 'admin'){
				jQuery("#"+form+" #errmsg td").html("Invalid email.");
				jQuery("#"+form+" #errmsg").slideDown(1000);
				email.focus();
			}
			// EMPTY FIELDS
			else if(jQuery.trim(email.val().toLowerCase()) == "" ||jQuery.trim(password.val().toLowerCase()) == "") {
				jQuery("#"+form+" #errmsg td").html("Email and password required.");
				jQuery("#"+form+" #errmsg").slideDown(1000);
				email.focus();
			}
			else {
				jQuery("#"+form+" #errmsg").slideUp(1000);
					
								jQuery("#"+form+" #errmsg td").html('Checking email and password.');
								jQuery("#"+form+" #errmsg").slideDown(1000);
								
				if(form == 'login') {
								
							/* REQUEST LOGIN */
							jQuery.ajax({
								type: "POST",
								url: apiURL + "login",
								data: jQuery(this).serialize(),
								dataType: "html"
							}).done(function(data) {
								if(data == 1) {
									data = 'Login Success';
									
									/* FROM PROFILE PAGE */
									if(accessPage == 'profile') {
										window.location = homeURL + '/profile';
									}
									/* FROM CHECKOUT PAGE */
									else if(accessPage == 'checkout') {
										window.location = homeURL + '/checkout';
									}
									else {
										window.location = homeURL;
									}
								}
								jQuery("#"+form+" #errmsg td").html(data);
								jQuery("#"+form+" #errmsg").slideDown(1000);
								return false;
							});
					
				}
				else {
					joinPage(email,password,form,formAction);
				}
			}
			return false;
		});
		
		/* SHOW JOIN PAGE */
		function joinPage(email,password,form,href) {
			var mainContainer  = 'user_join';
			/* CHECK IF THE CONTAINER EXIST */
			var checkContainer = jQuery("#"+mainContainer).css('display');
			if(checkContainer) {
			
						// add data
						// jQuery("#user_join form input[name=user_email]").val(email.val());
						// jQuery("#user_join form input[name=user_pass]").val(password.val());
						
				jQuery("#user_login,#user_login_background").fadeOut(1000);
				jQuery("#"+mainContainer).fadeIn(1500);
			}
			else {
				/* SHOW MODAL */
				showModal();
				/* REQUEST PAGE */
				jQuery.ajax({
					type: "POST",
					url: href + "?r=ajax",
					/* data: {"field": field,"sort":sort}, */
					dataType: "html"
				}).done(function(data) {
					jQuery("#user_login,#user_login_background").fadeOut(1000);
						
						jQuery("body").append(data);
						
						// add data
						// jQuery("#user_join form input[name=user_email]").val(email.val());
						// jQuery("#user_join form input[name=user_pass]").val(password.val());
						
						/* SHOW PAGE */
						jQuery("#"+mainContainer).fadeIn(1500);
						
					/* HIDE MODAL*/
					hideModal();
					return false;
				});
			}
		}
		
		/* SIGN UP */
		jQuery("div#sign_up a").click(function() {
			var email = '';
			var password = '';
			var form = 'join';
			var formAction = homeURL+'/join';
			joinPage(email,password,form,formAction);
			return false;
		});

		/* SIGN UP */
		jQuery("#forgot_password a").click(function() {
			return false;
		});
/* SHOW USER LOGIN ******************************************/
	
	
	
	jQuery("#forgot_password a#forgot").click(function(){
		
			var email = jQuery("#user_login form input[name=email]");// INVALID EMAIL
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			// EMPTY FIELDS
			if(jQuery.trim(email.val().toLowerCase()) == "") {
				jQuery("#user_login form #errmsg td").html("Email required.");
				jQuery("#user_login form #errmsg").slideDown(1000);
				email.focus();
			}
			else if(!re.test(email.val()) && email.val() != 'admin'){
				jQuery("#user_login form #errmsg td").html("Invalid email.");
				jQuery("#user_login form #errmsg").slideDown(1000);
				email.focus();
			}
			else {
				jQuery("#user_login form #errmsg td").html("Checking email.");
				jQuery("#user_login form #errmsg").slideDown(1000);
				
				/* REQUEST LOGIN */
				jQuery.ajax({
					type: "POST",
					url: apiURL + "check_user_login",
					data: { 'email': email.val() },
					dataType: "html"
				}).done(function(data) {
					if(data == 1) {
						changePasswordLink(email);
					}
					else {
						jQuery("#user_login form #errmsg td").html(data);
						jQuery("#user_login form #errmsg").slideDown(1000);
					}
					return false;
				});
			}
	});

	function changePasswordLink(email) {
		jQuery.ajax({
			type: "POST",
			url: homeURL + "/wp-login.php?action=lostpassword",
			data: { 'user_login': email.val(),'redirect_to':homeURL+'/wp-login.php?checkemail=confirm','wp-submit': 'Get New Password'},
			dataType: "html"
		}).done(function(data) {
			
			data = 'Check your e-mail for the confirmation link.';
			jQuery("#user_login form #errmsg td").html(data);
			jQuery("#user_login form #errmsg").slideDown(1000);
			return false;
		});
	}
	
});
</script>