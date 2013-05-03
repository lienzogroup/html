<?php
/**
 *
 * Template Name: User Details Template
 *
 */
/**************************************************************/
		/* PAGE SLUG VALUE */
			$slug = basename(get_permalink());
			do_action('before_slug', $slug);
			$slug = apply_filters('slug_filter', $slug);
		/* PAGE SLUG VALUE */

		/* SET PAGE INCLUDE FILE = SLUG */
			$page = trim(strtolower($slug));
			$include = 'woocommerce/pages/'.$page.'.php';
		/* SET PAGE INCLUDE FILE = SLUG */

		/* IF REQUEST PAGE IS AJAX */
			$request = isset($_GET['r']) ? trim(strtolower($_GET['r'])) : ''; 
			if($request == 'ajax') {
				include($include);
				exit;
			}
		/* IF REQUEST PAGE IS AJAX */
/**************************************************************/
?>



<?php get_header(); ?>

<div id="user_container">

	<?php 
	/* NO USER LOGON GOTO LOGIN PAGE */
	if(!is_user_logged_in()) {
		include('woocommerce/pages/login.php');
		
		/* SET ACCESS PAGE VARIABLE */ ?>
		<script>
			accessPage = 'profile';
		</script>
	<?php
	}
	else { ?>
		
		<div id="title">
			<div>
					<?php 
					$display_name = $current_user->display_name;
					$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
					if(preg_match($regex, $display_name)) {
						$display_name = '';
					}
					else {
						$d = explode(" ",$display_name);
						$display_name = isset($d[0]) ? $d[0] : '';
					}
					
					// get Billing First Name if display_name is empty
					if(trim($display_name) == '') {
						$meta = get_user_meta($current_user->ID);
						$display_name = (isset($meta['billing_first_name'][0])) ? $meta['billing_first_name'][0] : $meta['first_name'][0];
					}
					?>
				<h1>Hello, <?php echo $display_name;?></h1>
				<?php include('woocommerce/user_menu.php');?>
			</div>
		</div>
		
		<div id="content">
			<div id="sliderContainer">
				<div id="profile" style="display:block;">	
					<?php /* PROFILE PAGE */
					if($page == 'profile') {
						include($include);  ?>
						<style>
							#user_container #content #sliderContainer { left: 0px;}
						</style>
					<?php	
					} ?>
				</div>
				
				<div id="billing" style="display: block">
					<?php  /* BILLING PAGE */
					if($page == 'edit-address' && isset($_GET['address']) && strtolower($_GET['address']) == 'billing') { 
						include($include);  ?>
						<style>
							#user_container #content #sliderContainer { left: -960px;}
						</style>
					<?php	
					} ?>
				</div>
						
				<div id="shipping" style="display: block">
					<?php /* SHPPING PAGE */
					if($page == 'edit-address' && isset($_GET['address']) && strtolower($_GET['address']) == 'shipping') {  
						include($include); ?>
						<style>
							#user_container #content #sliderContainer { left: -1920px;}
						</style>
					<?php	
					} ?>
				</div>
				
				<div id="orders" style="display:block;">	
					<?php /* ORDERS LIST PAGE */
					if($page == 'orders') { 
						include($include);  ?>
						<style>
							#user_container #content #sliderContainer { left: -2880px;}
						</style>
					<?php	
					} ?>
				</div>
				
				<div id="orders_details" style="display:block;">	
					<?php /* ORDERS LIST PAGE */
					if($page == 'order_details') { 
						include($include);  ?>
						<style>
							#user_container #content #sliderContainer { left: -3840px;}
						</style>
					<?php	
					} ?>
				</div>
				
				<div style="clear: both"></div>
			</div>
		</div>
	<?php } ?>
	
</div>

<?php	get_footer(); ?>

<!-- JS AND CSS -->
<script src="<?=get_stylesheet_directory_uri()?>/woocommerce/js/ajax.js" type="text/javascript"></script>
<script src="<?=get_stylesheet_directory_uri()?>/woocommerce/js/user.js" type="text/javascript"></script>