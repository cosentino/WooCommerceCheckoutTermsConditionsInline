<?php
/*
Plugin Name: Woocommerce Checkout Terms Conditions Inline
Plugin URI: http://dualcube.com
Description: This is a woocommerce plugin which show the terms and conditions inline in checkout page, Here admin can change the text of Terms and conditions as well as link text. admin can also configure the size of popup and text of popup button. Popup will be fully responsive in any device.
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
	if(!class_exists('GU_Checkout_Terms_Conditions_Inline')) {
		require_once( trailingslashit(dirname(__FILE__)).'classes/class-gu-checkout-terms-conditions-inline.php' );
		global $GU_Checkout_Terms_Conditions_Inline;
		$GU_Checkout_Terms_Conditions_Inline = new GU_Checkout_Terms_Conditions_Inline( __FILE__ );
		$GLOBALS['GU_Checkout_Terms_Conditions_Inline'] = $GU_Checkout_Terms_Conditions_Inline;
	}
}
?>
