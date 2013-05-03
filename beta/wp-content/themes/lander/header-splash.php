<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Header Template
 *
 *
 * @file           header.php
 */
?>
<!doctype html>
<!--[if !IE]>      <html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<title><?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
<link href="<?php echo bloginfo('template_url');?>/css/style.css" rel="stylesheet" type="text/css" />


<?php wp_enqueue_style('responsive-style', get_stylesheet_uri(), false, '1.8.4');?>
<script src="<?php echo bloginfo('template_url');?>/js/jquery.js"></script>
<script src="<?php echo bloginfo('template_url');?>/js/jquery.backstretch.js"></script>
<script src="<?php echo bloginfo('template_url');?>/js/custom.js"></script>
<script src="<?php echo bloginfo('template_url');?>/js/heartcode-canvasloader-min.js"></script>
<?php wp_head(); ?>
</head>

<body class="home blog theme-revelryhouse">  
<script>
  $.backstretch(["<?php echo bloginfo('template_url');?>/images/background.png"]); 
  //$(".theme-revelryhouse").backstretch("<?php echo bloginfo('template_url');?>/images/background.jpg");
</script> 
<?php responsive_container(); // before container hook ?>
<div id="container" class="hfeed">    
	<?php responsive_wrapper(); // before wrapper ?>
    <div id="wrapper" class="clearfix">
    <?php responsive_in_wrapper(); // wrapper hook ?>
