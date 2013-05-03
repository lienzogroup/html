
<form action="" method="post" id="profile" class="user-profile">
	<input type="hidden" name="user_id" value="<?php echo $current_user->ID?>" />
	<p id="errmsg" style="display:none;">aw</p>
	<p>
		<label>EMAIL ADDRESS</label>
		<input type="input" class="input-text" name="user_email" value="<?php echo $current_user->user_email?>" />
	</p>
	<p>
		<label>CURRENT PASSWORD</label>
		<input type="password" class="input-text" name="user_pass" />
	</p>
	
	<p>
		<label>NEW PASSWORD</label>
		<input type="password" class="input-text" name="new_pass" />
	</p>
	<p>
		<label >RE-TYPE PASSWORD</label>
		<input type="password" class="input-text" name="confirm_pass" />
	</p>
	<div id="newsletter-check">
	<input type="checkbox" name="newsletter" class="newsletter" id="newsletter-checkbox" />
	<label for="newsletter-checkbox"></label>
	</div>
	<div id="checkbox_description">
		<span id="send-newsletter">Send me The Revelry House newsletter!</span><br/>
		<span id="news-desc">Not too often and we'll never give away your address.</span>
	</div>
	
	<div class="clear"></div>

	<p><input type="submit" class="change_password" name="change_password" value="SAVE MY CHANGES" /></p>
	
	<input type="hidden" name="action" value="change_password" />	

</form>

<style>
#profile .change_password{
	font-size: 26px;
	font-weight: lighter;
	letter-spacing: 3px;
	background-color: #a08f64;
	color: white;
	padding: 15px;
	border-radius: 0;
	margin: 30px 0;
}

#profile label{
	font-family: 'UniversLTW01-49LightUlt';
	color: #a08f64;
	font-size: 19px;
	letter-spacing: 1px;	
}

#profile .input-text{
	border: none;
	border-bottom: 1px solid;
	border-radius: 0;
	font-size: 32px;
	font-family: 'Didot W01 Bold';
	width: 500px;
	color: #000;
}
#newsletter-check{
	border: 1px solid #A08F64;
	height:24px;
	width:24px;
	float:left;
}
#profile #newsletter-check input[type="checkbox"]:checked + label {
    opacity: 1;
}
#profile #newsletter-check label{
	background: none repeat scroll 0 0 #A08F64;
    cursor: pointer;
    height: 20px;
    left: 2px;
    opacity: 0;
    position: relative;
    top: 2px;
    width: 20px;
    margin-top:0px;
}

#newsletter-check input[type="checkbox"] {
    visibility: hidden;
}
#profile .newsletter{	
	height: 50px;
	width: 50px;
	float: left;
}

#profile #checkbox_description{	    
	    float: left;
    position: relative;
    text-align: left !important;
    top: 4px;
    left: 10px;
}
#profile #send-newsletter{
	font-size: 20px;
}

#profile #news-desc{
	font-size: 13px;
	color: #999999;
}


</style>

<script>
	jQuery(function() {
		jQuery('input').attr('autocomplete','off');
	})
// Auto Clear	
// var lastInputValue = '';
// jQuery(function(){ 
	// jQuery('input[type=input],input[type=text]').focus(function() { 
		// lastInputValue = jQuery(this).val();
		// jQuery(this).val('');
	// });
	// jQuery('input[type=input],input[type=text]').focusout(function() {
		// var current_val = jQuery.trim(jQuery(this).val());
		// if(current_val == '') {
			// jQuery(this).val(lastInputValue);
		// }
	// });
// });
</script>