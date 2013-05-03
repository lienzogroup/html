<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>

<div id="cart_container" class="empty">
	<h2><?php _e('Your cart is empty', 'woocommerce') ?></h2>
	<a href="<?php echo get_site_url().'/collections/';?>">Start planning your next party</a>
</div>
<?php do_action('woocommerce_cart_is_empty'); ?>

<!--
	<p><a class="button" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e('&larr; Return To Shop', 'woocommerce') ?></a></p>
-->