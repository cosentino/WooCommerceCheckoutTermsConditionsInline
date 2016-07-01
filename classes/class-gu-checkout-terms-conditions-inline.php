<?php
class GU_Checkout_Terms_Conditions_Inline {

	public $plugin_url;
	public $plugin_path;
	public $version;
	public $token;
	public $text_domain;
	public $library;
	public $shortcode;
	public $admin;
	public $frontend;
	public $template;
	public $ajax;
	private $file;
	public $settings;
	public $options;
	public $dc_wp_fields;

	public function __construct($file) {

		$this->file = $file;
		$this->plugin_url = trailingslashit(plugins_url('', $plugin = $file));
		$this->plugin_path = trailingslashit(dirname($file));
		$this->token = GU_CHECKOUT_TERMS_CONDITIONS_INLINE_PLUGIN_TOKEN;
		$this->version = GU_CHECKOUT_TERMS_CONDITIONS_INLINE_PLUGIN_VERSION;
		$this->options = get_option('dc_dc_checkout_terms_conditions_inline_general_settings_name');
		add_action('init', array(&$this, 'init'), 0);
		
	}
	
	/**
	 * initilize plugin on WP init
	 */
	function init() {

		// Init library
		$this->load_class('library');
		$this->library = new GU_Checkout_Terms_Conditions_Inline_Library();

		if (is_admin()) {
			$this->load_class('admin');
			$this->admin = new GU_Checkout_Terms_Conditions_Inline_Admin();
		}

		if (!is_admin() || defined('DOING_AJAX')) {
			$this->load_class('frontend');
			$this->frontend = new GU_Checkout_Terms_Conditions_Inline_Frontend();
		}

		// DC Wp Fields
		$this->dc_wp_fields = $this->library->load_wp_fields();
	}


	public function load_class($class_name = '') {
		if ('' != $class_name && '' != $this->token) {
			require_once ('class-' . esc_attr($this->token) . '-' . esc_attr($class_name) . '.php');
		} // End If Statement
	}// End load_class()
	
	/** Cache Helpers *********************************************************/

	/**
	 * Sets a constant preventing some caching plugins from caching a page. Used on dynamic pages
	 *
	 * @access public
	 * @return void
	 */
	function nocache() {
		if (!defined('DONOTCACHEPAGE'))
			define("DONOTCACHEPAGE", "true");
		// WP Super Cache constant
	}

}
