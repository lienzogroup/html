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
 *
 * @file           home.php
 */
//echo $siteurl=site_url();
?>
<!doctype html>
<!--[if !IE]>      <html class="no-js non-ie" dir="ltr" lang="en-US"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" dir="ltr" lang="en-US"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" dir="ltr" lang="en-US"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" dir="ltr" lang="en-US"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" dir="ltr" lang="en-US"> <!--<![endif]-->
<head>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<title>Revelry House</title>


<link href="splash/css/style.css" rel="stylesheet" type="text/css" />
<script src="splash/js/jquery.js"></script>
<script src="splash/js/jquery.backstretch.js"></script>
<script src="splash/js/custom.js"></script>
<script src="splash/js/heartcode-canvasloader-min.js"></script>

<link rel='stylesheet' id='responsive-style-css'  href='splash/style.css' type='text/css' media='all' />
<link type='image/x-icon' href='splash/images/favicon.ico' rel='Shortcut Icon'>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38342585-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</head>

<body class="home blog theme-revelryhouse">  
<script>
  $.backstretch(["splash/images/background.jpg"]);  
</script> 
<div id="container" class="hfeed">    
	    <div id="wrapper" class="clearfix">
<?php //get_header('splash'); 
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
<script src="splash/js_image/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="splash/js_image/jquery_002.js"></script>
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
 
<script type="text/javascript" src="http://fast.fonts.com/jsapi/89a6af6d-1247-4ffe-8bd9-db1c539d22a1.js"></script>

<?php //echo "test"; print_r($_POST) ?>
<div id="featured" class="grid col-940">
<div class="sign-in-sec">
<form name="sign-in" id="sign-in" method="post" enctype="multipart/form-data">   
<div class="sign-in-header">
<div class="logo">
    <a href="http://revelryhouse.com"><img src="splash/images/top-logo.png" /></a>
</div>
<div class="line">
    <img src="splash/images/vertical.png" />
</div>
</div>
    
<div class="splash">
     <h1>Throwing a Party?</h1>
<p>Revelry House makes it easy. We deliver beautiful, curated products and the recipes, tips and tricks that you need - all in one box.</p>
<p>R.S.V.P. now for the official launch!</p>

<div class="submit"><input type="button" class="join" name="join" value="Join The Party" id="joinbtn"></div>
</div>
   <!-- end of form join section --> 
  
<div class="sign-up" style="display: none;">
    <h1 style="padding:0;">Join the party</h1>
    <div id='availability_result'></div> 
<div class="make-account">

<label>email address</label><input type="text" id="useremail" class="textfill" onblur="javascript:if(this.value==''){ this.value='info@revelryhouse.com'; }" onfocus="javascript:if(this.value=='info@revelryhouse.com'){this.value='';}" value="info@revelryhouse.com" name="user_email" autocomplete="off">
    
<label>Password</label><input type="password" class="password" onblur="javascript:if(this.value==''){ this.value='********'; }" onfocus="javascript:if(this.value=='********'){this.value='';}" value="********" name="pass1" id="pass1" autocomplete="off">

<label>confirm password</label><input type="password" class="password" onblur="javascript:if(this.value==''){ this.value='00000000'; }" onfocus="javascript:if(this.value=='00000000'){this.value='';}" value="00000000" name="pass2" id="pass2" autocomplete="off">
</div>

<div class="clever-text">
    <label>Full Name</label><input type="text" id="userename" class="textfill" onblur="javascript:if(this.value==''){ this.value='revelryhouse'; }" onfocus="javascript:if(this.value=='revelryhouse'){this.value='';}" value="revelryhouse" name="user_name" autocomplete="off" maxlength="30">
<label>birth date</label>

<input type="text" class="mm" onblur="javascript:if(this.value==''){ this.value='mm'; }" onfocus="javascript:if(this.value=='mm'){this.value='';}" value="mm" name="mm" id="mm" autocomplete="off" maxlength="2">
<input type="text" class="dd" onblur="javascript:if(this.value==''){ this.value='dd'; }" onfocus="javascript:if(this.value=='dd'){this.value='';}" value="dd" name="dd" id="dd" autocomplete="off" maxlength="2">
<input type="text" class="yy" onblur="javascript:if(this.value==''){ this.value='yyyy'; }" onfocus="javascript:if(this.value=='yyyy'){this.value='';}" value="yyyy" name="yyyy" id="yyyy" autocomplete="off" maxlength="4">


<label>zip code</label><input type="text" class="textfill" onblur="javascript:if(this.value==''){ this.value='000000'; }" onfocus="javascript:if(this.value=='000000'){this.value='';}" value="000000" name="zipcode" id="zipcode" autocomplete="off" maxlength="6">

</div>

<div class="join">
<input type="button" value="Let's Go!" name="join" class="join" id="submitbtn"/></div>
</div>

 <!-- end of sign in section --> 
 
<div class="things" style="display: none">
    <div id="canvasloader-container" class="canvasloader"></div> 
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
<div class="submit"><input type="submit" class="join" name="join" value="I’m done" id="join-submit"></div>

</div>

<!-- end of things section -->
</form>
</div>
       
</div><!-- end of #featured -->


<?php //get_sidebar('home'); ?>
<?php //get_footer(); ?>
</div><!-- end of #wrapper -->
    </div><!-- end of #container -->
  
<div id="footer" class="footer clearfix">
<div class="foot-cont" id="footer-wrapper">
<div class="foot-left">
<a href="#">party@revelryhouse.com </a>
</div>

<ul class="foot-right">
<li><a href="http://pinterest.com/revelryhouse/" target="_blank"><img src="splash/images/last.png" /></a></li>
<li><a href="http://revelryhouse.tumblr.com/" target="_blank"><img src="splash/images/t.png" /></a></li>
<li><a href="https://twitter.com/RevelryHouse" target="_blank"><img src="splash/images/twitt.png" /></a></li>
<li><a href="http://www.facebook.com/RevelryHouse" target="_blank"><img src="splash/images/fb-img.png" /></a></li>
</ul>
</div>
</div><!-- end #footer -->
<!-- This script creates a new CanvasLoader instance and places it in the canvasloader div -->
	<script type="text/javascript">
		var cl = new CanvasLoader('canvasloader-container');
		cl.show(); // Hidden by default
		
		// This bit is only for positioning - not necessary
		  var loaderObj = document.getElementById("canvasLoader");
  		loaderObj.style.position = "absolute";
  		loaderObj.style["top"] = cl.getDiameter() * -0.5 + "px";
  		loaderObj.style["left"] = cl.getDiameter() * -0.5 + "px";
    </script>

 
</body>
</html>

