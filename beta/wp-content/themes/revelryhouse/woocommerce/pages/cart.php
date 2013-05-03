
<div class="cart-container">
<?php $woocommerce->show_messages(); ?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
<?php do_action( 'woocommerce_before_cart_table' ); ?>
<table class="shop_table cart" cellspacing="0">
	
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>
	
	<!----------------------------COUPON-------------------------->
		<tr>
			<td colspan="6" class="actions">

				<?php if ( get_option( 'woocommerce_enable_coupons' ) == 'yes' && get_option( 'woocommerce_enable_coupon_form_on_cart' ) == 'yes') { ?>
					<div class="coupon-table">

						<label id="label-coupon">Have a discount code?</label> 
						<input name="coupon_code" class="input-code" id="coupon_code" value="" /> 
						<input type="submit" class="update-total" name="apply_coupon" value="<?php _e('UPDATE TOTAL', 'woocommerce'); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>

				<div style="display: none;">
					<input type="submit" class="button" name="update_cart" value="<?php _e('Update Cart', 'woocommerce'); ?>" /> <input type="submit" class="checkout-button button alt" name="proceed" value="<?php _e('Proceed to Checkout &rarr;', 'woocommerce'); ?>" />
				</div>
					<?php do_action('woocommerce_proceed_to_checkout'); ?>

				<?php $woocommerce->nonce_field('cart') ?>
			</td>
		</tr>
		<!-----------------****end of COUPON---------------------->
		
		<?php
		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
					<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">
						
						<!-- The thumbnail -->
						<td class="product-thumbnail">
							<?php
								$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );
								printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							?>
						</td>

						<!-- Product Name -->
						<td class="product-name">
							<?php
								if ( ! $_product->is_visible() || ( $_product instanceof WC_Product_Variation && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

								// Meta data
								echo $woocommerce->cart->get_item_data( $values );

                   				// Backorder notification
                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
                   					echo '<p class="backorder_notification">' . __('Available on backorder', 'woocommerce') . '</p>';
							?>
						</td>

						<!-- Product price -->
						<td class="product-price">
							<?php
								$product_price = get_option('woocommerce_display_cart_prices_excluding_tax') == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();

								echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
							?>
						</td>
						
						<td class="prodQty-seperator">
							<span>x</span>
						</td>
						
						<!-- Quantity inputs -->
						<td class="product-quantity">							
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = '1';
								} else {
									$data_min = apply_filters( 'woocommerce_cart_item_data_min', '', $_product );
									$data_max = ( $_product->backorders_allowed() ) ? '' : $_product->get_stock_quantity();
									$data_max = apply_filters( 'woocommerce_cart_item_data_max', $data_max, $_product );

									$product_quantity = sprintf( '<div class="quantity"><input name="cart[%s][qty]" data-min="%s" data-max="%s" value="%s" size="4" title="Qty" class="input-text qty text" maxlength="12" /></div>', $cart_item_key, $data_min, $data_max, esc_attr( $values['quantity'] ) );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
						</td>

						<!-- Product subtotal -->
						<td class="product-subtotal" style="display:none;">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
							?>
						</td>
					
						<!-- Remove from cart link -->
						<td class="product-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">x</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>

	</tbody>
</table>
<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

</div>


<!---------------------->
<!------STYLE-------->

<style>
.cart-container .coupon-table{
		width: 100%;		
		margin: auto 0;
	}
	
	.cart-container .coupon-table #label-coupon{
		float: left;
		margin-right: 20px;
		margin-bottom: 50px;
		margin-top: 15px;
		font-size: 30px;
	}
	
	.cart-container .coupon-table .input-code{
		border:none;
		border-radius: 0;
		border-bottom: 1px solid;
		font-size: 30px;
		width: 100px;
		margin-right: 60px !important;
	}
	
	.cart-container .coupon-table .update-total{
		padding: 15px;
		font-size: 20px;
		background-color: #a08f64;
		border-radius: 0;
		color: white;
		border: none;
	}
	
	.cart-container .product-thumbnail{
		width: 130px;
		padding: 0;
	}
	.cart-container .product-thumbnail img{
		height: 110px !important;
		width: auto !important;
		margin-right: 30px;	
	}
	
	.cart-container .product-name a{
		width: 250px;		
		font-size: 30px;		
		font-style: italic;
		font-family: Didot W01 Bold;		
	}
	
	.cart-container .prodQty-seperator, .product-price .amount, .qty{
		font-size: 30px;
		margin-right: 15px;
	}
	
	.cart-container .prodQty-seperator,.product-price .amount, .input-code{
		color: #999999;
	}
	
	.cart-container  .qty{
		width: 50px;
		border: none;
		border-bottom: 1px solid;
		border-radius: 0;
		padding: 0;
		font-size:25px;
	}
	
	.cart-container .product-remove .remove{
		font-size: 30px;
		line-height: none;
		color: #ed1c24;
		background: none !important;
		text-indent: 0 !important;
	}
	
	.shop_table{
		border: none !important;
	}
	
	.shop_table td{
		padding: 15px 0 !important;
		border-top: none !important;
		border-bottom: 1px solid #e2ddd0 !important;
	}
	
	.shop_table .actions {
		
	}
</style>	