<?php
class GU_Checkout_Terms_Conditions_Inline_Settings {
  
  private $tabs = array();
  
  private $options;
  
  /**
   * Start up
   */
  public function __construct() {
    // Admin menu

    //add_action( 'admin_init', array( $this, 'settings_page_init' ) );
    add_action( 'woocommerce_settings_tabs_conditions_inline_settings_tab', array($this, 'terms_settings_tab') );
    add_action( 'woocommerce_update_options_conditions_inline_settings_tab', array($this,'update_settings') );
    
    // Settings tabs
    //add_action('settings_page_dc_checkout_terms_conditions_inline_general_tab_init', array(&$this, 'general_tab_init'), 10, 1);
    
  }


  /**
   *Add woocommerce Setting tabs.
   *
   */
  public function add_conditions_inline_settings_tab($settings_tabs) {
  	global $GU_Checkout_Terms_Conditions_Inline;
  	$settings_tabs['conditions_inline_settings_tab'] = __( 'Terms Conditions Inline Settings', $GU_Checkout_Terms_Conditions_Inline->text_domain );
  	return $settings_tabs;  	
  }
  
  
  /**
   *
   *
   */
  public function terms_settings_tab() {
  	global $GU_Checkout_Terms_Conditions_Inline;
  	woocommerce_admin_fields( $this->get_settings() );  	
  }
  
  public function get_settings() {
  	global $GU_Checkout_Terms_Conditions_Inline;
  	?>
  	<?php
  	 $settings = array(  	 	 
		'section_title' => array(
			'name' => __( 'Terms and Conditions inline settings', $GU_Checkout_Terms_Conditions_Inline->text_domain ),
			'type' => 'title',
			'desc' => '',
			'id' => 'wc_settings_tab_demo_section_title'
		),
		
		'terms_conditions_inline_is_enable' => array(
			'name' => __( 'Is Enable', $GU_Checkout_Terms_Conditions_Inline->text_domain ),
			'type' => 'checkbox',
			'desc' => __( 'Enable the functionality', $GU_Checkout_Terms_Conditions_Inline->text_domain ),
			'id' => 'terms_conditions_inline_is_enable'
		),

		'terms_conditions_inline_pre_text' => array(
			'name' => __( 'Enter the text which will be appear in front page', $GU_Checkout_Terms_Conditions_Inline->text_domain ),
			'type' => 'text',
			'desc' => __( 'Enter your custom text which will be shown in the checkout page.', $GU_Checkout_Terms_Conditions_Inline->text_domain ),
			'id' => 'terms_conditions_inline_pre_text'
		),

	 	'terms_conditions_inline_div_height' => array(
			'name' => __( 'Enter textarea height in pixel', $GU_Checkout_Terms_Conditions_Inline->text_domain ),
			'type' => 'number',
			'class' => 'text',
			'desc' => __( 'Enter textarea height in pixel, only numeric value allowed here.', $GU_Checkout_Terms_Conditions_Inline->text_domain ),
			'id' => 'terms_conditions_inline_div_height'
		),

		'section_end' => array(
			'type' => 'sectionend',
			'id' => 'wc_settings_tab_demo_section_end'
		)
	 );
	  return apply_filters( 'wc_settings_tab_conditions_inline_settings_tab', $settings );
  	
  }
  

	public function update_settings() {
		woocommerce_update_options( $this->get_settings() );
	}

}
