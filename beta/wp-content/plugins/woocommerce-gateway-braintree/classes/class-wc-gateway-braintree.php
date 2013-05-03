<?php
/**
 * WooCommerce Braintree
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Braintree to newer
 * versions in the future. If you wish to customize WooCommerce Braintree for your
 * needs please refer to http://wcdocs.woothemes.com/user-guide/extensions/braintree/ for more information.
 *
 * @package     WC-Braintree/Gateway
 * @author      SkyVerge
 * @copyright   Copyright (c) 2013, SkyVerge
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Braintree Base Class
 *
 * Handles all single purchases and is extended by Subscription class to provide support for Subscriptions
 *
 * @since 1.1
 */
class WC_Gateway_Braintree extends WC_Payment_Gateway {


	/** @var string current environment to post transactions to */
	private $environment;

	/** @var string merchant ID */
	private $merchantid;

	/** @var string public key */
	private $publickey;

	/** @var string private key */
	private $privatekey;

	/** @var string submit transactions for settlement immediately or not*/
	private $settlement;

	/** @var string is vault enabled or not */
	private $vault;

	/** @var string text to use for "Save your Card" section */
	private $vaulttext;

	/** @var string text to use for "Manage Cards" button */
	private $managecards;

	/** @var array card types to show as accepted */
	private $cardtypes;

	/** @var string require user to enter CVV or not */
	private $requirecvv;


	/**
	 * Load payment gateway and related settings
	 *
	 * @since 1.0
	 * @return \WC_Gateway_Braintree
	 */
	public function __construct() {

		$this->id                 = 'braintree';
		$this->method_title       = __( 'Braintree', WC_Braintree::TEXT_DOMAIN );
		$this->method_description = __( 'Allow customers to securely save their credit card to their account for use with single purchases and subscriptions.', WC_Braintree::TEXT_DOMAIN );

		$this->supports = array( 'products' );

		$this->has_fields = true;

		$this->icon = apply_filters( 'wc_braintree_icon', '' );

		// Save settings
		add_action( 'woocommerce_update_options_payment_gateways', array( $this, 'process_admin_options' ) ); // WC < 2.0
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );  // WC >= 2.0

		// Load the form fields
		$this->init_form_fields();

		// Load the settings
		$this->init_settings();

		// Define user set variables
		foreach ( $this->settings as $setting_key => $setting ) {
			$this->$setting_key = $setting;
		}

		// pay page fallback
		add_action( 'woocommerce_receipt_' . $this->id, create_function( '$order', 'echo "<p>" . __( "Thank you for your order.", WC_Braintree::TEXT_DOMAIN ) . "</p>";' ) );
	}


	/**
	 * Initialize payment gateway settings fields
	 *
	 * @since 1.0
	 */
	public function init_form_fields() {

		$this->form_fields = array(

			'enabled' => array(
				'title'       => __( 'Enable', WC_Braintree::TEXT_DOMAIN ),
				'label'       => __( 'Turn on Gateway for WooCommerce', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'checkbox',
				'description' => '',
				'default'     => 'no'
			),

			'environment' => array(
				'title'       => __( 'Environment', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'select',
				'description' => __( 'What environment do you want your transactions posted to?', WC_Braintree::TEXT_DOMAIN ),
				'default'     => 'sandbox',
				'options'     => array(
					'development' => __( 'Development', WC_Braintree::TEXT_DOMAIN ),
					'sandbox'     => __( 'Sandbox', WC_Braintree::TEXT_DOMAIN ),
					'production'  => __( 'Production', WC_Braintree::TEXT_DOMAIN ),
					'qa'          => __( 'Quality Assurance', WC_Braintree::TEXT_DOMAIN ),
				),
			),

			'settlement' => array(
				'title'       => __( 'Submit for Settlement', WC_Braintree::TEXT_DOMAIN ),
				'label'       => __( 'Submit all transactions for settlement immediately.', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'checkbox',
				'description' => '',
				'default'     => 'no'
			),

			'title' => array(
				'title'       => __( 'Title', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'text',
				'description' => __( 'Payment method title that the customer will see on your website.', WC_Braintree::TEXT_DOMAIN ),
				'default'     => __( 'Credit Card by Braintree', WC_Braintree::TEXT_DOMAIN )
			),

			'description' => array(
				'title'       => __( 'Description', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'textarea',
				'description' => __( 'Payment method description that the customer will see on your website.', WC_Braintree::TEXT_DOMAIN ),
				'default'     => 'Pay with your credit card.'
			),

			'card_types' => array(
				'title'       => __( 'Accepted Card Logos', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'multiselect',
				'description' => __( 'Select which card types you accept to display the logos for on your checkout page.  This is purely cosmetic and optional, and will have no impact on the cards actually accepted by your account.', WC_Braintree::TEXT_DOMAIN ),
				'default'     => array( 'VISA', 'MC', 'AMEX', 'DISC' ),
				'options'     => apply_filters( 'wc_braintree_card_types',
					array(
						'VISA' => 'Visa',
						'MC'   => 'MasterCard',
						'AMEX' => 'American Express',
						'DISC' => 'Discover',
					)
				)
			),

			'requirecvv' => array(
				'title'       => __( 'Card Verification (CV2)', WC_Braintree::TEXT_DOMAIN ),
				'label'       => __( 'Require customers to enter credit card verification code (CV2) during checkout.', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'checkbox',
				'default'     => 'no'
			),

			'vault' => array(
				'title'       => __( 'Vault', WC_Braintree::TEXT_DOMAIN ),
				'label'       => sprintf( __( 'Allow customers to save their credit card data to your vault. %sRequires Braintree Vault%s', WC_Braintree::TEXT_DOMAIN ), ' <strong><a href="http://www.braintreepayments.com/pricing" target="_blank">', '</a></strong>' ),
				'type'        => 'checkbox',
				'description' => '',
				'default'     => 'no'
			),

			'vaulttext' => array(
				'title'       => __( 'Checkout Save Card Description', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'textarea',
				'description' => __( 'Text buyers see allowing them to save their credit card to your vault.', WC_Braintree::TEXT_DOMAIN ),
				'default'     => 'Securely Save Card to Account'
			),

			'managecards' => array(
				'title'       => __( 'Checkout Manage Cards Button Text', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'textarea',
				'description' => __( 'Text for manage credit cards button during checkout.', WC_Braintree::TEXT_DOMAIN ),
				'default'     => 'Manage My Credit Cards'
			),

			'merchantid' => array(
				'title'       => __( 'Merchant ID', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'text',
				'description' => __( 'Your Braintree merchant ID.', WC_Braintree::TEXT_DOMAIN ),
				'default'     => ''
			),

			'publickey'  => array(
				'title'       => __( 'Public Key', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'text',
				'description' => __( 'Your Braintree public key.', WC_Braintree::TEXT_DOMAIN ),
				'default'     => ''
			),
			'privatekey' => array(
				'title'       => __( 'Private Key', WC_Braintree::TEXT_DOMAIN ),
				'type'        => 'password',
				'description' => __( 'Your Braintree private key.', WC_Braintree::TEXT_DOMAIN ),
				'default'     => ''
			),
		);
	}


	/**
	 * Display settings page with some additional javascript for hiding conditional fields
	 *
	 * @since  1.1
	 */
	public function admin_options() {
		global $woocommerce;

		parent::admin_options();

		// add inline javascript
		ob_start();
	?>
		$('#woocommerce_braintree_vault').change(function () {
			var saveCardTextRow = $(this).closest('tr').next();
			var manageCardsTextRow = saveCardTextRow.next();

			if ($(this).is(':checked')) {
				saveCardTextRow.show();
				manageCardsTextRow.show();
			} else {
				saveCardTextRow.hide();
				manageCardsTextRow.hide();
			}
		}).change();
	<?php
		$woocommerce->add_inline_js( ob_get_clean() );
	}


	/**
	 * Checks for proper gateway configuration (required fields populated, etc)
	 * and that there are no missing dependencies
	 *
	 * @since 1.0
	 */
	public function is_available() {
		global $wc_braintree;

		// proper configuration
		if ( ! $this->merchantid || ! $this->publickey || ! $this->privatekey )
			return false;

		// are dependencies met?
		if ( count( $wc_braintree->get_missing_dependencies() ) > 0 )
			return false;

		return parent::is_available();
	}


	/**
	 * Add selected card icons to payment method label, defaults to Visa/MC/Amex/Discover
	 *
	 * @since  1.0
	 */
	public function get_icon() {
		global $woocommerce, $wc_braintree;

		$icon = '';

		if ( $this->icon ) :

			// use icon provided by filter
			$icon = '<img src="' . esc_url( $woocommerce->force_ssl( $this->icon ) ) . '" alt="' . esc_attr( $this->title ) . '" />';

		elseif ( ! empty( $this->card_types ) ) :

			// display icons for the selected card types
			foreach ( $this->card_types as $card_type ) {

				if ( file_exists( $wc_braintree->get_plugin_path() . '/assets/card-' . strtolower( $card_type ) . '.png' ) )
					$icon .= '<img src="' . esc_url( $woocommerce->force_ssl( $wc_braintree->get_plugin_url() ) . '/assets/card-' . strtolower( $card_type ) . '.png' ) . '" alt="' . esc_attr( strtolower( $card_type ) ) . '" />';
			}

		endif;

		return apply_filters( 'woocommerce_gateway_icon', $icon, $this->id );
	}


	/**
	 * Display the payment fields on the checkout page
	 *
	 * @since  1.0
	 */
	public function payment_fields() {

		// setup API instance
		$this->setup_api();

		if ( $this->description )
			echo '<p>' . wp_filter_kses( $this->description ) . '</p>';

		if ( $this->is_sandbox() )
			echo '<p>' . __( 'SANDBOX MODE - Use test cards Visa: 4111111111111111 or Amex: 378282246310005', WC_Braintree::TEXT_DOMAIN ) . '</p>';
	?>
	<style type="text/css">#payment ul.payment_methods li label[for='payment_method_braintree'] img:nth-child(n+2) { margin-left:1px; }</style>
	<fieldset>
	<?php
		if ( is_user_logged_in() && 'yes' == $this->vault ) :

			// get card tokens
			$cards = get_user_meta( get_current_user_id() , WC_Braintree::USER_META_PREFIX . 'cc', true );

			// show saved cards if available
			if ( is_array( $cards ) && count( $cards ) > 0 ) : ?>
				<div>
					<p class="form-row form-row-first">
						<?php foreach ( $cards as $card ): $creditCard = Braintree_CreditCard::find( $card ); ?>
						<input type="radio" id="<?php echo esc_attr( $creditCard->token ); ?>" name="braintree_vault_token" style="width:auto;" value="<?php echo esc_attr( $creditCard->token ); ?>" />
						<label style="display:inline;" for="<?php echo esc_attr( $creditCard->token ); ?>"><?php echo ucwords( esc_html( $creditCard->cardType ) ); ?> <?php _e( 'ending in', WC_Braintree::TEXT_DOMAIN ); ?> <?php echo esc_html( $creditCard->last4 ); ?> (<?php echo esc_html( $creditCard->expirationDate ); ?>)</label><br />
						<?php endforeach; ?>
						<input type="radio" id="new" name="braintree_vault_token" style="width:auto;" checked="checked" value="" /><label style="display:inline;" for="new"><?php _e( 'Use Another Credit Card', WC_Braintree::TEXT_DOMAIN ); ?></label>
					</p>
					<p class="form-row form-row-last"><a class="button" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>#my-cards"><?php echo wp_filter_kses( $this->managecards ); ?></a></p>
					<div style="clear:both;"></div>
				</div>
			<?php endif; ?>

			<div class="clear"></div>
	<?php endif; ?>

		<div class="braintree_card_fields">
		<p class="form-row form-row-first">
			<label for="braintree_card_number"><?php _e( 'Card Number', WC_Braintree::TEXT_DOMAIN ); ?> <span class="required">*</span></label>
			<input id="braintree_card_number" name="braintree_card_number" size="30" type="text" maxlength="16" class="input-text" autocomplete="off" placeholder="Credit Card Number" />
		</p>

		<p class="form-row form-row-last">
			<label for="braintree_expiry_month"><?php _e( 'Expires', WC_Braintree::TEXT_DOMAIN ); ?> <span class="required">*</span></label>
			<select id="braintree_expiry_month" name="braintree_expiry_month" style="width:auto;">
				<?php foreach ( range( 1, 12 ) as $month ) : ?>
				<option value="<?php echo $month; ?>"><?php echo sprintf( '%02d', $month ); ?></option>
				<?php endforeach; ?>
			</select>
			<select id="braintree_expiry_year" name="braintree_expiry_year" style="width:auto;">
				<?php foreach ( range( date( 'Y' ), date( 'Y' ) + 6 ) as $year ) : ?>
				<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		<div class="clear"></div>

		<p class="form-row form-row-first">
			<label for="braintree_cvv"><?php _e( 'Card Security Code', WC_Braintree::TEXT_DOMAIN ); ?> <?php echo ( 'yes' === $this->requirecvv ) ? '<span class="required">*</span>' : ''; ?></label>
			<input id="braintree_cvv" name="braintree_cvv" size="8" type="text" maxlength="4" class="input-text" autocomplete="off" placeholder="CVV" />
		</p>
		<div class="clear"></div>

	<?php if ( 'yes' === $this->vault ) : ?>
		<div class="braintree-create-account">
			<p class="form-row">
				<label for="braintree_save_card" style="display:inline;"><?php echo wp_filter_kses( $this->vaulttext ); ?></label>
				<input id="braintree_save_card" name="braintree_save_card" type="checkbox" value="yes" />
			</p>
		</div>
		</div>
	<?php endif; ?>
		</fieldset>

		<script type="text/javascript">
			jQuery(document).ready(function($) {

				// hide card form if selecting a saved card, show otherwise
				$('input[name="braintree_vault_token"]').change(function () {
					if (''===$(this).val()) {
						$('div.braintree_card_fields').slideDown();
					} else {
						$('div.braintree_card_fields').slideUp();
					}
				});

				// hide 'Save Card to Account' checkbox if guest checkout
				$('input[name="createaccount"]').change(function () {
					if ($(this).is(':checked')) {
						$('div.braintree-create-account').show();
					} else {
						$('div.braintree-create-account').hide();
					}
				}).change();
			});
		</script>
	<?php
	}

	/**
	 * Handles payment for guest / registered user checkout
	 *
	 * @since 1.0
	 * @param int $order_id ID of order to charge
	 * @return array|void
	 */
	public function process_payment( $order_id ) {
		global $woocommerce;

		// configure API
		$this->setup_api();

		// get order
		$order = new WC_Order( $order_id );

		// setup braintree order array
		$braintree_order = $this->setup_braintree_order( $order );

		// registered customer checkout (already logged in or creating account at checkout)
		if ( is_user_logged_in() || 0 != $order->user_id ) {

			// add customer ID + token and handle saving card
			$braintree_order = $this->setup_transaction( $braintree_order, $order );

		// guest checkout
		} else {

			// add payment information to order array
			$braintree_order = $this->add_payment_info( $braintree_order, $order );

			// add billing information
			$braintree_order['billing'] = array(
				'firstName' 		=> $order->billing_first_name,
				'lastName' 			=> $order->billing_last_name,
				'company' 			=> $order->billing_company,
				'streetAddress' 	=> $order->billing_address_1,
				'extendedAddress' 	=> $order->billing_address_2,
				'locality'			=> $order->billing_city,
				'region' 			=> $order->billing_state,
				'postalCode' 		=> $order->billing_postcode,
			);
		}

		// Push transaction to Braintree
		$result = Braintree_Transaction::sale( $braintree_order );

		// transaction was successful
		if ( $result->success ) {

			// add order note
			$order->add_order_note( __( 'Credit Card Transaction Approved', WC_Braintree::TEXT_DOMAIN ) );

			// save payment token / customer ID if available
			$this->save_customer_info( $result, $order );

			// mark order as having received payment
			$order->payment_complete();

			$woocommerce->cart->empty_cart();

			return array(
				'result'   => 'success',
				'redirect' => add_query_arg( array( 'key' => $order->order_key, 'order' => $order->id ), get_permalink( get_option( 'woocommerce_thanks_page_id' ) ) )
			);

		// transaction failed
		} else {

			// form decline message
			if ( isset( $result->transaction->status ) && 'processor_declined' == $result->transaction->status )
				$message = sprintf( __( 'Processor Declined : Code [%s] - %s', WC_Braintree::TEXT_DOMAIN ), $result->transaction->processorResponseCode, $result->transaction->processorResponseText );

			elseif ( isset( $result->transaction->status ) && 'gateway_rejected' == $result->transaction->status )
				$message = sprintf( __( 'Gateway Rejected : Reason - %s', WC_Braintree::TEXT_DOMAIN ), $result->transaction->gatewayRejectionReason );

			else
				$message = __( 'Gateway Validation Failure', WC_Braintree::TEXT_DOMAIN );

			// mark order as failed + return error
			$this->mark_order_as_failed( $order, $message, $result );
		}
	}


	/**
	 * Add order amount / ID and shipping information to braintree order array
	 *
	 * @since 1.1
	 * @param object $order WC Order
	 * @return array braintree order array
	 */
	protected function setup_braintree_order( $order ) {

		$braintree_order = array(
			'amount'   => $order->order_total,
			'orderId'  => $order->id,
			'shipping' => array(
				'firstName'       => $order->shipping_first_name,
				'lastName'        => $order->shipping_last_name,
				'company'         => $order->shipping_company,
				'streetAddress'   => $order->shipping_address_1,
				'extendedAddress' => $order->shipping_address_2,
				'locality'        => $order->shipping_city,
				'region'          => $order->shipping_state,
				'postalCode'      => $order->shipping_postcode,
			),
		);

		if ( 'yes' === $this->settlement )
			$braintree_order['options']['submitForSettlement'] = true;

		return $braintree_order;
	}


	/**
	 * Setup registered user transaction, including braintree customer ID and payment tokens
	 *
	 * @since 1.1
	 * @param array $braintree_order braintree order array
	 * @param object $order WC Order
	 * @return array braintree order array
	 */
	protected function setup_transaction( $braintree_order, $order ) {

		// get braintree customer ID
		$customer_id = get_user_meta( $order->user_id, WC_Braintree::USER_META_PREFIX . 'customerid', true );

		// set up a new customer if ID not available
		if ( ! $customer_id ) {

			$braintree_order['customer'] = array(
				'firstName' => $order->billing_first_name,
				'lastName'  => $order->billing_last_name,
				'company'   => $order->billing_company,
				'phone'     => $order->billing_phone,
				'email'     => $order->billing_email,
			);

			// add customer to vault if enabled
			if ( 'yes' === $this->vault )
				$braintree_order['customer']['id'] = sprintf( 'woocommerce_%s_%s', time(), $order->user_id );

		} else {

			// use saved customer ID
			$braintree_order['customerId'] = $customer_id;
		}

		// get payment token
		$token = $this->get_post( 'braintree_vault_token' );

		if ( ! $token ) {

			// add payment info if not using token
			$braintree_order = $this->add_payment_info( $braintree_order, $order );

		} else {

			// or use existing token
			$braintree_order['paymentMethodToken'] = $token;
		}

		// save card if vault is enabled, customer has opted to save card, and a token is not available
		if ( 'yes' === $this->vault && 'yes' === $this->get_post( 'braintree_save_card') && ! $token ) {

			$braintree_order['options']['storeInVault'] = true;
			$braintree_order['options']['addBillingAddressToPaymentMethod'] = true;
		}

		return $braintree_order;
	}


	/**
	 * Add payment info to braintree order array
	 *
	 * @since 1.1
	 * @param array $braintree_order braintree order array
	 * @param object $order WC Order
	 * @return array braintree order array
	 */
	protected function add_payment_info( $braintree_order, $order ) {

		$braintree_order['creditCard'] = array(
			'number' 			=> $this->get_post( 'braintree_card_number' ),
			'expirationDate' 	=> $this->get_post( 'braintree_expiry_month') . '/' . $this->get_post( 'braintree_expiry_year' ),
			'cardholderName' 	=> $order->billing_first_name . ' '. $order->billing_last_name,
			'cvv' 				=> $this->get_post( 'braintree_cvv' ),
		);

		return $braintree_order;
	}


	/**
	 * Update saved cards / braintree customer ID for customer and add any used token as order meta
	 *
	 * @since 1.1
	 * @param object $result braintree transaction result object
	 * @param object $order WC Order
	 */
	protected function save_customer_info( $result, $order ) {

		if ( $result->transaction->creditCardDetails->token ) {

			// get any existing saved cards
			$cards = get_user_meta( $order->user_id, WC_Braintree::USER_META_PREFIX . 'cc', true );

			// merge token with any existing token
			$cards[ $result->transaction->creditCardDetails->token ] = $result->transaction->creditCardDetails->token;

			// save new tokens
			update_user_meta( $order->user_id, WC_Braintree::USER_META_PREFIX . 'cc', $cards );

			// add order note
			$order->add_order_note( __('Credit Card Saved to Account', WC_Braintree::TEXT_DOMAIN ) );

			// update customer ID
			update_user_meta( $order->user_id, WC_Braintree::USER_META_PREFIX . 'customerid', $result->transaction->customerDetails->id );

			// save token used for order
			add_post_meta( $order->id, WC_Braintree::POST_META_PREFIX . 'token', $result->transaction->creditCardDetails->token );
		}
	}


	/**
	 * Validate the payment fields when processing the checkout
	 *
	 * @since 1.1
	 * @return bool true if fields are valid, false otherwise
	 */
	public function validate_fields() {
		global $woocommerce;

		$is_valid = parent::validate_fields();

		// skip validation if using a saved card
		if ( $this->get_post( 'braintree_vault_token' ) )
			return true;

		$card_number      = $this->get_post( 'braintree_card_number' );
		$expiration_month = $this->get_post( 'braintree_expiry_month' );
		$expiration_year  = $this->get_post( 'braintree_expiry_year' );
		$cvv              = $this->get_post( 'braintree_cvv' );

		// CVV check
		if ( 'yes' === $this->requirecvv ) {

			// check security code
			if ( empty( $cvv ) ) {
				$woocommerce->add_error( __( 'Card security code is missing', WC_Braintree::TEXT_DOMAIN ) );
				$is_valid = false;
			}

			// digit check
			if ( ! ctype_digit( $cvv ) ) {
				$woocommerce->add_error( __( 'Card security code is invalid (only digits are allowed)', WC_Braintree::TEXT_DOMAIN ) );
				$is_valid = false;
			}

			// length check
			if ( strlen( $cvv ) < 3 || strlen( $cvv ) > 4 ) {
				$woocommerce->add_error( __( 'Card security code is invalid (must be 3 or 4 digits)', WC_Braintree::TEXT_DOMAIN ) );
				$is_valid = false;
			}
		}

		// check expiration data
		$current_year  = date( 'Y' );
		$current_month = date( 'n' );

		// Expiration date check
		if ( ! ctype_digit( $expiration_month ) || ! ctype_digit( $expiration_year ) ||
		  $expiration_month > 12 ||
		  $expiration_month < 1 ||
		  $expiration_year < $current_year ||
		  ( $expiration_year == $current_year && $expiration_month < $current_month ) ||
		  $expiration_year > $current_year + 20
		) {
			$woocommerce->add_error( __( 'Card expiration date is invalid', WC_Braintree::TEXT_DOMAIN ) );
			$is_valid = false;
		}

		// check card number
		$card_number = str_replace( array( ' ', '-' ), '', $card_number );

		if ( empty( $card_number ) || ! ctype_digit( $card_number ) || ! $this->luhn_check( $card_number ) ) {
			$woocommerce->add_error( __( 'Card number is invalid', WC_Braintree::TEXT_DOMAIN ) );
			$is_valid = false;
		}

		return $is_valid;
	}


	/**
	 * Show the "My Cards" section on the "My Account" page
	 *
	 * @since 1.1
	 */
	public function show_my_cards() {

		// only display my cards if gateway is available and vault is enabled
		if ( ! $this->is_available() || 'no' === $this->vault )
			return;

		// setup API configuration
		$this->setup_api();

		// get cards on file
		$cards = get_user_meta( get_current_user_id(), WC_Braintree::USER_META_PREFIX . 'cc', true );

		// handle card removals
		if( isset( $_POST['delete-card'] ) && isset( $cards[ $_POST['delete-card'] ] ) ) {

			// remove from existing cards
			unset( $cards[ $_POST['delete-card'] ] );

			// update saved cards
			update_user_meta( get_current_user_id(), WC_Braintree::USER_META_PREFIX . 'cc', $cards );

			// delete from braintree
			Braintree_CreditCard::delete( $_POST['delete-card'] );
		}

		?> <h2 id="braintree-my-cards" style="margin-top:40px;"><?php _e( 'Manage My Cards', WC_Braintree::TEXT_DOMAIN ); ?></h2><?php

		if ( ! empty( $cards ) ) :

		?>
		<a name="my-cards"></a>
		<table class="shop_table my-account-cards">

			<thead>
			<tr>
				<th class="card-label"><span class="nobr"><?php _e( 'Card', WC_Braintree::TEXT_DOMAIN ); ?></span></th>
				<th class="card-exp-date"><span class="nobr"><?php _e( 'Expires', WC_Braintree::TEXT_DOMAIN ); ?></span></th>
				<th class="card-actions"><span class="nobr"><?php _e( 'Actions', WC_Braintree::TEXT_DOMAIN ); ?></span></th>
			</tr>
			</thead>

			<tbody>
				<?php foreach ( $cards as $card ) :

				try {

					$creditCard = Braintree_CreditCard::find( $card );

				} catch ( Exception $e ) {

					?><p><?php _e( 'You do not have any saved credit cards.', WC_Braintree::TEXT_DOMAIN ); ?></p><?php
					break;
				}
				?>
			<tr class="card">
				<td class="card-label">
					<?php printf( __( '%s ending in %s', WC_Braintree::TEXT_DOMAIN ), esc_html( $creditCard->cardType ), esc_html( $creditCard->last4 ) ); ?>
				</td>
				<td class="card-exp-date">
					<?php echo esc_html( $creditCard->expirationDate ); ?>
				</td>
				<td class="card-actions">
					<form method="post">
						<input type="hidden" name="delete-card" value="<?php echo esc_attr( $creditCard->token ); ?>" />
						<input type="submit" class="button" value="<?php _e( 'Remove', WC_Braintree::TEXT_DOMAIN ); ?>" />
					</form>
				</td>
			</tr>
				<?php endforeach; ?>
			</tbody>

		</table> <?php

		else :

			?><p><?php _e( 'You do not have any saved credit cards.', WC_Braintree::TEXT_DOMAIN ); ?></p><?php

		endif;
	}


	/**
	 * Mark the given order as failed and set the order note
	 *
	 * @since 1.1
	 * @param \WC_Order $order the order
	 * @param string $error_message a message to display inside the "Credit Card Payment Failed" order note
	 * @param object $result Braintree transaction result object
	 */
	protected function mark_order_as_failed( $order, $error_message, $result ) {
		global $woocommerce;

		$order_note = sprintf( __( 'Credit Card Payment Failed (%s)', WC_Braintree::TEXT_DOMAIN ), $error_message );

		// Mark order as failed if not already set, otherwise, make sure we add the order note so we can detect when someone fails to check out multiple times
		if ( $order->status != 'failed' )
			$order->update_status( 'failed', $order_note );
		else
			$order->add_order_note( $order_note );

		// show generic error message to customer
		$woocommerce->add_error( __( 'An error occurred, please try again or try an alternate form of payment.', WC_Braintree::TEXT_DOMAIN ) );

		// show braintree-specific errors when in non-production environments
		if ( 'production' !== $this->environment ) {

			// show order note error message
			$woocommerce->add_error( $error_message );

			// show any API errors
			foreach( $result->errors->deepall() as $error ) {
				$woocommerce->add_error( $error->message );
			}
		}
	}


	/**
	 * Perform standard luhn check.  Algorithm:
	 *
	 * 1. Double the value of every second digit beginning with the second-last right-hand digit.
	 * 2. Add the individual digits comprising the products obtained in step 1 to each of the other digits in the original number.
	 * 3. Subtract the total obtained in step 2 from the next higher number ending in 0.
	 * 4. This number should be the same as the last digit (the check digit). If the total obtained in step 2 is a number ending in zero (30, 40 etc.), the check digit is 0.
	 *
	 * @since 1.1
	 * @param string $account_number the credit card number to check
	 * @return bool true if $account_number passes the check, false otherwise
	 */
	private function luhn_check( $account_number ) {
		$sum = 0;
		for ( $i = 0, $ix = strlen( $account_number ); $i < $ix - 1; $i++) {
			$weight = substr( $account_number, $ix - ( $i + 2 ), 1 ) * ( 2 - ( $i % 2 ) );
			$sum += $weight < 10 ? $weight : $weight - 9;
		}

		return substr( $account_number, $ix - 1 ) == ( ( 10 - $sum % 10 ) % 10 );
	}


	/**
	 * Safely get and trim data from $_POST
	 *
	 * @since 1.1
	 * @param string $key array key to get from $_POST array
	 * @return string value from $_POST or blank string if $_POST[ $key ] is not set
	 */
	private function get_post( $key ) {

		if ( isset( $_POST[ $key ] ) )
			return trim( $_POST[ $key ] );

		return '';
	}


	/**
	 * Check if current environment is sandbox
	 *
	 * @since 1.1
	 */
	protected function is_sandbox() {

		return 'sandbox' === $this->environment;
	}


	/**
	 * Load Braintree API Library and configure it
	 *
	 * @since 1.1
	 */
	protected function setup_api() {
		global $wc_braintree;

		// Load API
		require_once( $wc_braintree->get_plugin_path() . '/braintree_php/lib/Braintree.php' );

		Braintree_Configuration::environment( $this->environment );
		Braintree_Configuration::merchantId( $this->merchantid );
		Braintree_Configuration::publicKey( $this->publickey );
		Braintree_Configuration::privateKey( $this->privatekey );
	}


} // end \WC_Gateway_Braintree

