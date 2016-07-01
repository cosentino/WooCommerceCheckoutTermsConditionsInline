<?php
/*
Plugin Name: Woocommerce Checkout Terms Conditions Inline
Description: WooCommerce plugin that shows the terms and conditions text right above the acceptance checkbox.
Author: Marcello Cosentino
Version: 1.0.0
*/

if ( ! class_exists( 'WC_Dependencies_terms_conditions' ) ) {
require_once trailingslashit(dirname(__FILE__)).'includes/class-gu-dependencies-terms-conditions.php';
}
require_once trailingslashit(dirname(__FILE__)).'includes/gu-checkout-terms-conditions-inline-core-functions.php';
require_once trailingslashit(dirname(__FILE__)).'config.php';
if(!defined('ABSPATH')) exit; // Exit if accessed directly
if(!defined('GU_CHECKOUT_TERMS_CONDITIONS_INLINE_PLUGIN_TOKEN')) exit;
if(!defined('GU_CHECKOUT_TERMS_CONDITIONS_INLINE_TEXT_DOMAIN')) exit;

if(! WC_Dependencies_terms_conditions::woocommerce_active_check()) {
  add_action( 'admin_notices', 'woocommerce_terms_conditions_alert_notice' );
}
else {

	/**
	 * Plugin page links
	 */
	function checkout_terms_conditions_inline_plugin_links( $links ) {
		$plugin_links = array(
			'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=conditions_inline_settings_tab' ) . '">' . __( 'Settings', GU_CHECKOUT_TERMS_CONDITIONS_INLINE_TEXT_DOMAIN ) . '</a>',
		);
		return array_merge( $plugin_links, $links );
	}
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'checkout_terms_conditions_inline_plugin_links' );

	if(!class_exists('GU_Checkout_Terms_Conditions_Inline')) {
		require_once( trailingslashit(dirname(__FILE__)).'classes/class-gu-checkout-terms-conditions-inline.php' );
		global $GU_Checkout_Terms_Conditions_Inline;
		$GU_Checkout_Terms_Conditions_Inline = new GU_Checkout_Terms_Conditions_Inline( __FILE__ );
		$GLOBALS['GU_Checkout_Terms_Conditions_Inline'] = $GU_Checkout_Terms_Conditions_Inline;
	}
}
?>
