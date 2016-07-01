<?php
class GU_Checkout_Terms_Conditions_Inline_Admin {
  
  public $settings;

	public function __construct() {
		//admin script and style
		add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_script'));
		$this->load_class('settings');
		$this->settings = new GU_Checkout_Terms_Conditions_Inline_Settings();
	}

	function load_class($class_name = '') {
	  global $GU_Checkout_Terms_Conditions_Inline;
		if ('' != $class_name) {
			require_once ($GU_Checkout_Terms_Conditions_Inline->plugin_path . '/admin/class-' . esc_attr($GU_Checkout_Terms_Conditions_Inline->token) . '-' . esc_attr($class_name) . '.php');
		} // End If Statement
	}// End load_class()

	/**
	 * Admin Scripts
	 */

	public function enqueue_admin_script() {
		global $GU_Checkout_Terms_Conditions_Inline;
		$screen = get_current_screen();
		
		// Enqueue admin script and stylesheet from here
		if (in_array( $screen->id, array( 'toplevel_page_gu-checkout-terms-conditions-inline-setting-admin' ))) :
		  wp_enqueue_style('admin_css',  $GU_Checkout_Terms_Conditions_Inline->plugin_url.'assets/admin/css/admin.css', array(), $GU_Checkout_Terms_Conditions_Inline->version);
	  	endif;
	}
}