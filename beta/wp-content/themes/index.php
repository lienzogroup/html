<?php
define('WP_USE_THEMES',false);
require_once('beta/wp-load.php'); 
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;
global $wpdb, $user_ID;

/**
 * Home Page
 *
 * Note: You can overwrite home.php as well as any other Template in Child Theme.
 * Create the same file (name) include in /responsive-child-theme/ and you're all set to go!
 * @see            http://codex.wordpress.org/Child_Themes
 *
 * @file           home.php
 */
?>
<?php get_header('splash'); 
require_once('splash/MCAPI.class.php');
require_once('splash/mcapi-min.php');
//require_once('splash/info.php');
//require('splash/mcapi-min.php');
?>
<script>
$(document).ready(function(){
  $("#joinbtn").click(function(){
    $(".splash").fadeOut();
    $(".sign-up").fadeIn();
    });
});
</script>
<?php //displaying check boxs as image ?>
<script src="<?php bloginfo('template_url') ?>/js_image/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js_image/jquery_002.js"></script>
<script type="text/javascript">
	$(function(){
		
		$.imageTick.logging = true;
		
		$("input[name='group_field[]']").imageTick({ 
			custom_button: function($label){
			    $label.hide();
			    return '<div class="my-custom-button">' + $label.text() + '</div>';
			}
		});
	
	});
	
		
</script>

<?php //echo "test"; print_r($_POST) ?>
<div id="featured" class="grid col-940">
<div class="sign-in-sec">
<form name="sign-in" id="sign-in" method="post" enctype="multipart/form-data">   
<div class="sign-in-header">
<div class="logo">
    <img src="<?php bloginfo('template_url') ?>/images/top-logo.png" />
</div>
<div class="line">
    <img src="<?php bloginfo('template_url') ?>/images/vertical.png" />
</div>
</div>
     
<div class="splash">
     <h1>Join the party</h1>
<p>Revelry House makes throwing a party easy,<br /> beautiful, and affordable.</p>

<div class="submit"><input type="button" class="join" name="join" value="Join" id="joinbtn"></div>
</div>
   <!-- end of form join section --> 
  
<div class="sign-up" style="display: none;">
    <h1>Join the party</h1>
    <div id='availability_result'></div>
<div class="make-account">
<h2>Make an account</h2>

<label>email address</label><input type="text" id="useremail" class="textfill" onblur="javascript:if(this.value==''){ this.value='info@revelryhouse.com'; }" onfocus="javascript:if(this.value=='info@revelryhouse.com'){this.value='';}" value="info@revelryhouse.com" name="user_email">
    
<label>Password</label><input type="password" class="password" onblur="javascript:if(this.value==''){ this.value='********'; }" onfocus="javascript:if(this.value=='********'){this.value='';}" value="********" name="pass1" id="pass1">

<label>confirm password</label><input type="password" class="password" onblur="javascript:if(this.value==''){ this.value='00000000'; }" onfocus="javascript:if(this.value=='00000000'){this.value='';}" value="00000000" name="pass2" id="pass2">
</div>

<div class="clever-text">
<h2>Some clever text</h2>
<label>birth date</label>

<input type="text" style="float:left; width: 110px !important;" class="mm" onblur="javascript:if(this.value==''){ this.value='mm'; }" onfocus="javascript:if(this.value=='mm'){this.value='';}" value="mm" name="mm" id="mm">
<input type="text" class="dd" style="float: left; margin: 0 0 39px 23px;width: 110px;" onblur="javascript:if(this.value==''){ this.value='dd'; }" onfocus="javascript:if(this.value=='dd'){this.value='';}" value="dd" name="dd" id="dd">
<input type="text" class="yy" style="float: left; margin: 0 0 39px 23px;width: 122px;" onblur="javascript:if(this.value==''){ this.value='yyyy'; }" onfocus="javascript:if(this.value=='yyyy'){this.value='';}" value="yyyy" name="yyyy" id="yyyy">


<label>zip code</label><input type="text" class="textfill" onblur="javascript:if(this.value==''){ this.value='000000'; }" onfocus="javascript:if(this.value=='000000'){this.value='';}" value="000000" name="zipcode" id="zipcode">

<div class="join">
<input type="button" value="Join" name="join" class="join" id="submitbtn"/></div>
</div>

</div>

 <!-- end of sign in section --> 
 
<div class="things" style="display: none">
<?php 
    
// Show our Interest groups fields if we have them, and they're set to on
if (is_array($igs) && !empty($igs)) {
 foreach ($igs as $ig) {
   if (is_array($ig) && isset($ig['id'])) {
      if ($ig['form_field'] != 'hidden') {
                ?>				
                         <h2>
                                <?php echo esc_html($ig['name']); ?>
                        </h2><!-- /mc_interests_header -->
                        <ul class="celebrate">
                <?php
                }
                else {
                ?>
                        <ul class="celebrate" style="display: none;">
                <?php					
                }
        ?>			

        <?php
                mailchimp_interest_group_field($ig);
        ?>				
        </ul><!-- /mc_interest -->

        <?php
        
     }
  }
}
        ?>
<div class="submit"><input type="submit" class="join" name="join" value="I’m done"></div>
<h4><span id="joinsubmit" style="cursor: pointer">do this later</span></h4>

</div>

<!-- end of things section -->
</form>
</div>
       
</div><!-- end of #featured -->


<?php //get_sidebar('home'); ?>
<?php get_footer(); ?>
