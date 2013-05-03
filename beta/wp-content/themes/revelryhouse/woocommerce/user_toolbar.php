<!-- Modal Contailer -->
<script>
	var apiURL = '<?=get_bloginfo("template_url");?>/woocommerce/functions.php?a=';
	var homeURL = '<?=get_home_url();?>';
	var accessPage = '';
</script>
<div id="loading_modal" style="display: none;">
	<img src="<?=get_stylesheet_directory_uri()?>/woocommerce/img/ajax-loader.gif" style="opacity:1;">
</div>
<script src="<?=get_stylesheet_directory_uri()?>/woocommerce/js/toolbar.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?=get_stylesheet_directory_uri()?>/woocommerce/css/style.css" >
<?php
/*************************************************************/
	global $current_user;
	//get_currentuserinfo();
?> 
	<img src="<?=get_bloginfo("template_url");?>/img/condensed_main_logo.png" style="display:none;" />
	<div id="rt_user_header">
		<div>
				<?php			
				if(is_user_logged_in()) { ?>
					<!-- My Profile and Logout -->
					<div id="option">
						<a href="<?php echo get_home_url();?>/profile" id="profile">My Profile</a>
						<!-- <a href="<?php echo get_home_url();?>/change_password">Change Password</a> -->
						<a href="#" id="logout">Logout</a>
					</div>
					<!-- Display Name -->
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
					<a href="#" onclick="return false;" id="display_name">Hello, <?=$display_name?></a>	
				
				<?php } else { ?> 
				<!-- Login-->
					<a id="login" href="<?php echo get_home_url(); ?>/login">Login</a>
				
				<?php }	?>
			<a href="<?php echo get_home_url();?>/cart/" id="cart">
				<?php
					// GET NUMBER OF ITEMS IN CART
					global $woocommerce;
					//$items =  sizeof( $woocommerce->cart->get_cart() );
					$items = $woocommerce->cart->cart_contents_count;
				?>
				<span id="items"><?php echo $items?></span> Cart</a>
		</div>
		
		<!-- Cart Notification Message -->
		<div id="cart_notification_container" style="">
			<p id="cart_notification_message" style="color: white">Item Added to Cart</p>
		</div>
		<!-- End of Cart Notification Message -->
	</div>