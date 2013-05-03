<!doctype html>  
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
	<title>
	<?php echo $title; ?>
	</title>
	<?php wp_head(); ?>
	<link type="text/css" rel="stylesheet" href="http://fast.fonts.com/cssapi/89a6af6d-1247-4ffe-8bd9-db1c539d22a1.css"/>
<link type="image/x-icon" rel="shortcut icon" href="<?php echo bloginfo('template_url');?>/img/favicon.ico" />
</head>
<body <?php body_class(); ?> >
  
	<?php include('user_toolbar.php'); ?>
	
	<!-- Adding main Menu -->
		<?php include(get_template_directory().'/main-menu.php'); ?>
		<style>
			.process_logo { display: none; }
			.top-logo#big { }
			#process_nav {margin-top: 76px; }
		</style>
	<!-- Adding main Menu -->
	
	<?php include('process_menu.php'); ?>

	<div class="container">