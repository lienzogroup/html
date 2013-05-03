<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"<!--<![endif]-->
  
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
	
    <meta name="viewport" content="width=device-width, initial-scale=0, maximum-scale=0">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

    <link rel="profile" href="http://gmpg.org/xfn/11" />
	<link type="image/x-icon" rel="shortcut icon" href="<?php echo bloginfo('template_url');?>/img/favicon.ico" />
	
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <link type="text/css" rel="stylesheet" href="http://fast.fonts.com/cssapi/89a6af6d-1247-4ffe-8bd9-db1c539d22a1.css"/>

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
	
	
	
    <?php wp_head(); ?>
  
  </head>
  
  <body <?php body_class(); ?> >

<?php include('woocommerce/user_toolbar.php'); ?>
  		
<?php include('main-menu.php'); ?>

	<div>
	</div>
	<div class="container">
  

     