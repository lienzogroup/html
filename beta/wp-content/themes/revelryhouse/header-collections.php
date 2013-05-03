<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
  
  <head>
	
  	<title>
  		<?php
		/*
		 Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
		wp_title( '-', false, 'right' ); 
		// Add the blog name.
		bloginfo( 'name' );
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' - ' . sprintf( __('Page %s', 'reboot'), max( $paged, $page ) );
		?>
	</title>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
	
    <!-- <meta name="viewport" content="width=device-width, initial-scale=0, maximum-scale=1"> -->
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link type="text/css" rel="stylesheet" href="http://fast.fonts.com/cssapi/89a6af6d-1247-4ffe-8bd9-db1c539d22a1.css"/>
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link type="image/x-icon" rel="shortcut icon" href="<?php echo bloginfo('template_url');?>/img/favicon.ico" />
    <!-- Favicons and touch icons (for use on Apple devices) -->
    
    
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php get_template_directory_uri(); ?>/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php get_template_directory_uri(); ?>/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php get_template_directory_uri(); ?>/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php get_template_directory_uri(); ?>/ico/apple-touch-icon-57-precomposed.png">

    <?php wp_head(); ?>
  	
  	<?php wp_enqueue_script('scrollto-js', get_template_directory_uri() .'/js/jquery.scrollTo-1.4.3.1-min.js'); ?>
	<?php wp_enqueue_script('localscroll-js', get_template_directory_uri() .'/js/jquery.localscroll-1.2.7-min.js'); ?>
	<?php wp_enqueue_script('custom-js', get_template_directory_uri() .'/js/custom.js'); ?>
	

<script type="text/javascript" src="http://fast.fonts.com/jsapi/89a6af6d-1247-4ffe-8bd9-db1c539d22a1.js"></script>
 		
  </head>
  
  <body <?php body_class(); ?> >

<?php include('woocommerce/user_toolbar.php'); ?>
 
<?php include('main-menu.php'); ?>  
	
	
	
	
	
	<div class="container">
		