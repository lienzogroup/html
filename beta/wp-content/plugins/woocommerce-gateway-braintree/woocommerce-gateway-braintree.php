<?php
/**
 * Plugin Name: WooCommerce Braintree Payment Gateway
 * Plugin URI: http://www.woothemes.com/products/braintree/
 * Description: Adds the Braintree payment gateway to your WooCommerce website. Requires an SSL certificate.
 * Author: SkyVerge
 * Author URI: http://www.skyverge.com
 * Version: 1.1
 * Text Domain: wc-braintree
 * Domain Path: /languages/
 *
 * Copyright: (c) 2013 SkyVerge
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package     WC-Gateway-Braintree
 * @author      SkyVerge
 * @Category    Payment-Gateways
 * @copyright   Copyright (c) 2013, SkyVerge
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Plugin Setup
 *
 * @since 1.0
 */

// Required functions
if ( ! function_exists( 'woothemes_queue_update' ) )
	require_once( 'woo-includes/woo-functions.php' );

// Plugin updates
woothemes_queue_update( plugin_basename( __FILE__ ), '880788043990c91aa0b164aa971f78a3', '18659' );

// Check if WooCommerce is active and deactivate extension if it's not
if ( ! is_woocommerce_active() )
	return;

/**
 * The WC_Braintree global object
 * @name $wc_braintree
 * @global WC_Braintree $GLOBALS['wc_braintree']
 */
$GLOBALS['wc_braintree'] = new WC_Braintree();

/**
 * Main Plugin Class
 *
 * @since 1.0
 */
class WC_Braintree {


	/** options table prefix */
	const POST_META_PREFIX = '_braintree_';

	/** post/user meta prefix */
	const USER_META_PREFIX = 'woocommerce_braintree_';

	/** plugin text domain */
	const TEXT_DOMAIN = 'wc-braintree';

	/** plugin version number */
	const VERSION = '1.1.0';

	/** @var string class to load as gateway, can be base or subscriptions class */
	public $gateway_class_name = 'WC_Gateway_Braintree';

	/** @var array PHP dependencies for extension */
	public $dependencies = array( 'curl', 'dom', 'hash', 'openssl', 'SimpleXML', 'xmlwriter' );

	/** @var string plugin file path without trailing slash */
	private $plugin_path;

	/** @var string plugin url without trailing slash */
	private $plugin_url;

	/** @var object WC_Logger instance */
	private $logger;


	/**
	 * Setup main plugin class
	 *
	 * @since 1.0
	 * @return \WC_Braintree
	 */
	public function __construct() {

		// Load gateway
		add_action( 'plugins_loaded', array( $this, 'load_classes' ) );

		// Add the 'Manage My Cards' on the 'My Account' page
		add_action( 'woocommerce_after_my_account', array( $this, 'add_my_cards' ) );

		// Admin
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {

			// dependency check
			add_action( 'admin_notices', array( $this, 'check_dependencies' ) );

			// add a 'Configure' link to the plugin action links
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_configure_link' ) );

			// install
			$this->install();
		}

		// Load translation files
		add_action( 'init', array( $this, 'load_translation' ) );
	}


	/**
	 * Load required classes
	 *
	 * @since 1.1
	 */
	public function load_classes() {

		// Gateway classes
		require_once( 'classes/class-wc-gateway-braintree.php' );

		// Add class to WC Payment Methods
		add_filter( 'woocommerce_payment_gateways', array( $this, 'load_gateway' ) );
	}


	/**
	 * Add Braintree to the list of available payment gateways
	 *
	 * @since 1.1
	 * @param array $gateways
	 * @return array $gateways
	 */
	public function load_gateway( $gateways ) {

		$gateways[] = $this->gateway_class_name;

		return $gateways;
	}


	/**
	 * Helper to add the 'My Cards' section to the 'My Account' page
	 *
	 * @since 1.1
	 */
	public function add_my_cards() {

		$wc_braintree = new WC_Gateway_Braintree();

		$wc_braintree->show_my_cards();
	}


	/**
	 * Checks if required PHP extensions are loaded and SSL is enabled. Adds an admin notice if either check fails
	 *
	 * @since 1.1
	 */
	public function check_dependencies() {

		$missing_extensions = $this->get_missing_dependencies();

		if ( count( $missing_extensions ) > 0 ) {

			$message = sprintf(
				_n( 'WooCommerce Braintree Gateway requires the %s PHP extension to function.  Contact your host or server administrator to configure and install the missing extension.',
					'WooCommerce Braintree Gateway requires the following PHP extensions to function: %s.  Contact your host or server administrator to configure and install the missing extensions.',
					count( $missing_extensions ), self::TEXT_DOMAIN ),
			  '<strong>' . implode( ', ', $missing_extensions ) . '</strong>'
			);

			echo '<div class="error"><p>' . $message . '</p></div>';
		}

		// SSL check
		if ( 'no' == get_option( 'woocommerce_force_ssl_checkout' ) )
			printf( __( "%sWooCommerce is not being forced over SSL; your customer's credit card data is at risk.%s", self::TEXT_DOMAIN ), '<div class="error"><p>', '</p></div>' );
	}


	/**
	 * Gets the string name of any required PHP extensions that are not loaded
	 *
	 * @since 1.1
	 * @return array
	 */
	public function get_missing_dependencies() {

		$missing_extensions = array();

		foreach ( $this->dependencies as $ext ) {

			if ( ! extension_loaded( $ext ) )
				$missing_extensions[] = $ext;
		}

		return $missing_extensions;
	}


	/**
	 * Return the plugin action links. This will only be called if the plugin
	 * is active.
	 *
	 * @since 1.1
	 * @param array $actions associative array of action names to anchor tags
	 * @return array associative array of plugin action links
	 */
	public function plugin_configure_link( $actions ) {

		$manage_url = admin_url( 'admin.php?page=woocommerce_settings&tab=payment_gateways' );

		if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 )
			$manage_url = add_query_arg( array( 'section' => $this->gateway_class_name ), $manage_url ); // WC 2.0+
		else
			$manage_url = add_query_arg( array( 'subtab' => 'gateway-braintree' ), $manage_url ); // WC 1.6.6-

		// add a 'Configure' link to the front of the actions list for this plugin
		return array_merge( array( 'configure' => '<a href="' . $manage_url . '">' . __( 'Configure', self::TEXT_DOMAIN ) . '</a>' ), $actions );
	}


	/**
	 * Load plugin text domain
	 *
	 * @since 1.1
	 */
	public function load_translation() {

		load_plugin_textdomain( self::TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	}


	/**
	 * Handles version checking
	 *
	 * @since 1.1
	 */
	private function install() {

		$installed_version = get_option( self::USER_META_PREFIX . 'version' );

		// installed version lower than plugin version?
		if ( version_compare( $installed_version, self::VERSION ) === - 1 ) {

			$this->upgrade( $installed_version );

			// new version number
			update_option( self::USER_META_PREFIX . 'version', self::VERSION );
		}
	}


	/**
	 * Handles upgrades
	 *
	 * @since  1.1
	 * @param string $installed_version
	 */
	private function upgrade( $installed_version ) {

		// upgrade code
	}


	/**
	 * Saves errors or messages to WooCommerce Log
	 * /wp-content/plugins/woocommerce/logs/braintree.txt
	 *
	 * @since 1.1
	 * @param string $message error or message to save to log
	 */
	public function log( $message ) {
		global $woocommerce;

		if ( ! is_object( $this->logger ) )
			$this->logger = $woocommerce->logger();

		$this->logger->add( 'braintree', $message );
	}


	/**
	 * Returns the plugin's path without a trailing slash
	 *
	 * @since 1.1
	 * @return string
	 */
	public function get_plugin_path() {

		if ( $this->plugin_path )
			return $this->plugin_path;

		return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
	}


	/**
	 * Returns the plugin's url without a trailing slash
	 *
	 * @since 1.1
	 * @return string
	 */
	public function get_plugin_url() {

		if ( $this->plugin_url )
			return $this->plugin_url;

		return $this->plugin_url = plugins_url( basename( plugin_dir_path(__FILE__) ), basename( __FILE__ ) );
	}


} // end \WC_Braintree class
