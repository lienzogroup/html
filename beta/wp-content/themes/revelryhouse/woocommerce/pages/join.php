
<div id="user_join">
	<form method="post" action="">
		<div id="close">x</div>
		<table id="join">
			<thead>
				<tr>
					<td id="logo" colspan="2" align="center">
						<img src="http://s159842.gridserver.com/beta/wp-content/themes/revelryhouse/woocommerce/img/splash_rh-logo.png">
					</td>
				</tr>
				<tr>
					<td id="vertical" colspan="2" align="center">
						<img src="http://s159842.gridserver.com/beta/wp-content/themes/revelryhouse/woocommerce/img/vertical-line.png" style="height:50px">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<h1>JOIN THE PARTY</h1>
					</td>
				</tr>
			</thead>
			<tbody id="form">
				<tr>
					<td align="ceter">
						<h2>Make an account</h2>
					</td>
					<td align="ceter">
						<h2>Some clever text</h2>
					</td>
				</tr>
				<tr id="errmsg" style="display:none">
					<td colspan="2" align="center">aw</td>
				</tr>
				<tr>
					<td>
						<label>Email Address</label>
						<input type="text" name="user_email" value="lauren@revelryhouse.com"/>
					</td>
					<td>
						<label>Name</label>
						<input type="text" name="user_name" value="first and last name" />
					</td>
				</tr>
				<tr>
					<td>
						<label>Password</label>
						<input type="password" name="user_pass" value="123456789"/>
					</td>
					<td id="bday">
						<label>Date of Birth</label>
						<input type="text" name="month" value="mm" /> / <input type="text" name="day" value="dd" /> / <input type="text" name="year" value="yyyy" />
					</td>
				</tr>
				<tr>
					<td>
						<label>Confirm Password</label>
						<input type="password" name="confirm_pass"  value="123456789"/>
					</td>
					<td>
						<label>Zip Code</label>
						<input type="text" name="zipcode" value="123456"/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td align="center">
						<input type="submit" name="join" value="join" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>

<style>
	#user_join {
		background: url("http://s159842.gridserver.com/beta/wp-content/themes/revelryhouse/woocommerce/img/splash_page-bg-1400x800.jpg") #000;
		height: 100%;
		left: 0;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: 9999;
	}
	#user_join form {
		margin: 30px auto 0;
		width: 960px;
	}
	#user_join #close{
		color: #FFFFFF;
		cursor: pointer;
		float: right;
		font-size: 30px;
		font-weight: bold;
	}
	#user_join table {
		width: 70%;
		margin: 0 auto;
	}
	#user_join table td{
		color: #FFFFFF;
		min-height: 200px;
		padding: 0 20px 0 30px;
	}
	#user_join table #logo img{
		margin: 0 0 10px;
		width: 50px;
	}
	#user_join table #vertical{
	}
	#user_join table h1{    
		color: #FFFFFF;
		font-size: 40px;
	}
	#user_join table h2{
		color: #FFFFFF;
		font-size: 22px;
		color: #FFF;
		text-align: center;
	}
	#user_join table label{
		text-transform: uppercase;
		margin-bottom: 10px;
		color: #A08F64;
		font-family: 'UniversLTW01-49LightUlt';
		font-size: 18px;
	}
	#user_join table input[type=text],
	#user_join table input[type=password]{
		background: none repeat scroll 0 0 transparent;
		border: none;
		border-bottom: 1px solid #FFF;
		border-radius: 0;
		width: 300px;
		color: #FFF;
	}
	#user_join table #bday input[type=text] {
		width: 86px;
	}
	#user_join table input[type=submit]{
		letter-spacing: 2px;
		text-transform: uppercase;
		color: #FFF;
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

	/* DISPLAY REGISTRATION FORM */
	jQuery("#user_join").fadeIn(1500);
	
/* SHOW USER LOGIN ******************************************/
	
		/* JOIN PAGE CLOSE */
		jQuery("#user_join #close").click(function() {
		
				jQuery("#user_join").fadeOut();
				
			/* FROM PROFILE PAGE */
			if(accessPage == 'profile') {
				window.location = homeURL + '/collections';
			}
			/* FROM CHECKOUT PAGE */
			else if(accessPage == 'checkout') {
				window.location = homeURL + '/cart';
			}
		});
		
		/* JOIN PAGE SUBMIT */
		jQuery("#user_join form").submit(function() {
				var user_email = jQuery("#user_join form input[name=user_email]").val();
				var user_login = jQuery("#user_join form input[name=user_login]").val();
				var user_pass = jQuery("#user_join form input[name=user_pass]").val();
				var confirm_pass = jQuery("#user_join form input[name=confirm_pass]").val();
					var month = jQuery("#user_join form input[name=month]").val();
					var day = jQuery("#user_join form input[name=day]").val();
					var year = jQuery("#user_join form input[name=year]").val();
				var zipcode = jQuery("#user_join form input[name=zipcode]").val();
				
				/* Validation */
					var errmsg = '';
					if(user_email == '' || user_email == 'lauren@revelryhouse.com') {
						var errmsg = 'Email address is required.';
					}
					else if(user_login == '' || user_login == 'first and last name') {
						var errmsg = 'Name is required.';
					}
					else if(user_pass == '' || user_pass == '123456789') {
						var errmsg = 'Password is required.';
					}
					else if(user_pass != confirm_pass) {
						var errmsg = 'Password and confirm password not match.';
					}
					else if(month == '' || month == 'mm') {
						var errmsg = 'Month is required..';
					}
					else if(day == '' || day == 'dd') {
						var errmsg = 'Day is required..';
					}
					else if(year == '' || year == 'yyyy') {
						var errmsg = 'Year is required..';
					}
					else if(zipcode == '' || zipcode == '123456') {
						var errmsg = 'Zipcode is required..';
					}
				if(errmsg) {
					jQuery("#user_join form tr#errmsg td").html(errmsg);
					jQuery("#user_join form tr#errmsg").fadeIn();
				}
				else {
					jQuery("#user_join form tr#errmsg td").html('Checking email');
					jQuery("#user_join form tr#errmsg").fadeIn();
					/* REQUEST LOGIN */
					jQuery.ajax({
						type: "POST",
						url: apiURL + "join",
						data: jQuery(this).serialize(),
						dataType: "html"
					}).done(function(data) {
						if(data == 1) {
							data = 'Registration Success..';
									
							/* FROM PROFILE PAGE */
							if(accessPage == 'profile') {
								window.location = homeURL + '/profile';
							}
							/* FROM CHECKOUT PAGE */
							else if(accessPage == 'checkout') {
								window.location = homeURL + '/checkout';
							}
							else {
								window.location = window.location;
							}
						}
						jQuery("#user_join form tr#errmsg td").html(data);
						jQuery("#user_join form tr#errmsg").fadeIn();
						return false;
					});
				}


				return false;
			});

		/* JOIN USER PAGE */
		jQuery("#user_join form input").focus(function() {
			var name = jQuery(this).attr("name");
			if(name == 'user_email' && jQuery(this).val() == 'lauren@revelryhouse.com') {
					jQuery(this).val("");
			}
			else if(name == 'user_name' && jQuery(this).val() == 'first and last name') {
					jQuery(this).val("");
			}
			else if((name == 'user_pass' || name == 'confirm_pass') && jQuery(this).val() == '123456789') {
					jQuery(this).val("");
			}
			else if(name == 'month' && jQuery(this).val() == 'mm') {
					jQuery(this).val("");
			}
			else if(name == 'day' && jQuery(this).val() == 'dd') {
					jQuery(this).val("");
			}
			else if(name == 'year' && jQuery(this).val() == 'yyyy') {
					jQuery(this).val("");
			}
			else if(name == 'zipcode' && jQuery(this).val() == '123456') {
					jQuery(this).val("");
			}
		});		
		jQuery("#user_join form input").focusout(function() {
			var name = jQuery(this).attr("name");
			if(name == 'user_email' && jQuery(this).val() == '') {
					jQuery(this).val("lauren@revelryhouse.com");
			}
			else if(name == 'user_login' && jQuery(this).val() == '') {
					jQuery(this).val("first and last name");
			}
			else if((name == 'user_pass' || name == 'confirm_pass') && jQuery(this).val() == '') {
					jQuery(this).val("123456789");
			}
			else if(name == 'month' && jQuery(this).val() == '') {
					jQuery(this).val("mm");
			}
			else if(name == 'day' && jQuery(this).val() == '') {
					jQuery(this).val("dd");
			}
			else if(name == 'year' && jQuery(this).val() == '') {
					jQuery(this).val("yyyy");
			}
			else if(name == 'zipcode' && jQuery(this).val() == '') {
					jQuery(this).val("123456");
			}
		});			
		
/* SHOW USER LOGIN ******************************************/

})
</script>