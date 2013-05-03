<?php
/**
 *
 * Template Name: Process Order Template
 *
 */
 ?>

<?php
/**************************************************************/
/* PAGE SLUG VALUE */
	$slug = basename(get_permalink());
	do_action('before_slug', $slug);
	$slug = apply_filters('slug_filter', $slug);
	$item_number =  sizeof( $woocommerce->cart->get_cart() );
	/* CONFIRMATION PAGE */
	if(trim(strtolower($slug)) == 'confirmation') {
		$include = 'woocommerce/pages/confirmation.php';
		$title = "You're Done!";
		$total_page = true;
	}
	/* SHIPPING PAGE */
	elseif(trim(strtolower($slug)) == 'shipping') {
		$title = 'Ben Franklins';
		$include = 'woocommerce/pages/shipping.php';
		$total_page = false;
	}
	/* PAYMENT PAGE */
	elseif(trim(strtolower($slug)) == 'payment') {
		$include = 'woocommerce/pages/payment.php';
		$title = 'Ben Franklins';
		$total_page = true;
	}
	/* EMPTY CART PAGE*/
	elseif($item_number == 0) {
		$include = 'woocommerce/pages/cart_empty.php';
		$title = 'Your party';
		$total_page = false;
	}
	/* CART PAGE */
	elseif(trim(strtolower($slug)) == 'cart') {
		$include = 'woocommerce/pages/cart.php';
		$title = 'Your party';
		$total_page = true;
	}
	/* LOGIN PAGE */
	elseif(!is_user_logged_in() || trim(strtolower($slug)) == 'login') {
		$include = 'woocommerce/pages/login.php';
		$title = 'Login';
		$total_page = false;
	}
	/* CHECKOUT PAGE */
	elseif(trim(strtolower($slug)) == 'checkout') {
		$include = 'woocommerce/pages/checkout.php';
		$title = 'Get there fast';
		$total_page = true;
	}
/**************************************************************/
?>

<?php 
// Check if the request of page is AJAX
$request = isset($_GET['r']) ? $_GET['r'] : '';
if(trim(strtolower($request)) != 'ajax') { ?>
	<?php include('woocommerce/process_header.php'); ?>
	<div id="process_container">
<?php } ?>

		<div id="title">
			<h1><?php echo $title;?></h1>
			<?php
			if(trim(strtolower($slug)) == 'confirmation') { ?>
				<a href="<?php echo get_home_url();?>" id="gohome" >Go Home</a>
			<?php } ?>
		</div>
		
		<div id="content">
			<?php if($total_page == true) { ?>
			
				<div id="left">
					<div id="sliderContainer">
						<p id="errmsg" style="text-align:center;"></p>
						<?php 
						if ( have_posts() ) : 
							while ( have_posts() ) : the_post();
								the_content(); 
							endwhile;  
						endif; 
						?>
						<?php //include($include);?>
					</div>
				</div>
				<div id="right">
					<?php include('woocommerce/process_total.php'); ?>
				</div>
				
			<?php } else { 
			
					if(!is_user_logged_in()) { ?>
						<script>
							accessPage = 'checkout';
						</script> <?php
					}
					
					if($slug == 'cart' || !is_user_logged_in() || $slug == 'login' ||  $slug == 'join') {
						include($include); 
					}
					else {
						if ( have_posts() ) : 
							while ( have_posts() ) : the_post();
								the_content(); 
							endwhile;  
						endif; 
					}
			} ?>
		</div>
		<div style="clear:both"></div>
		

<?php 
if(trim(strtolower($request)) != 'ajax') { ?>
	</div>
	<?php get_footer(); ?>
<?php } ?>

	<!-- JS AND CSS -->
	<script src="<?=get_stylesheet_directory_uri()?>/woocommerce/js/ajax.js" type="text/javascript"></script>
	<script src="<?=get_stylesheet_directory_uri()?>/woocommerce/js/user.js" type="text/javascript"></script>
	
	<style>
		
		a#gohome {
			background: none repeat scroll 0 0 #A08F64;
			color: #FFFFFF;
			font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
			left: 300px;
			letter-spacing: 0;
			padding: 10px 15px;
			position: relative;
			text-transform: uppercase;
			top: -10px;
		}
	</style>
<script>
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