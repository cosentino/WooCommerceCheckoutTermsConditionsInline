<?php
class GU_Checkout_Terms_Conditions_Inline_Frontend {
	
	public $terms_conditions_inline_is_enable ;
	public $terms_conditions_inline_pre_text ;
	public $terms_conditions_inline_div_height;

	public function __construct() {
		$this->terms_conditions_inline_is_enable = get_option('terms_conditions_inline_is_enable');
		$this->terms_conditions_inline_pre_text = get_option('terms_conditions_inline_pre_text');
		$this->terms_conditions_inline_div_height = get_option('terms_conditions_inline_div_height');
		if($this->terms_conditions_inline_is_enable == "yes") {
			//add_action('woocommerce_checkout_order_review', array($this, 'add_termtext'), 30);
			add_action('woocommerce_checkout_before_terms_and_conditions', array($this, 'add_termtext'), 30);
		}
	}

	function add_termtext() {
		global $GU_Checkout_Terms_Conditions_Inline;

		if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) {
			$pre_text = $this->terms_conditions_inline_pre_text;
			$woocommerce_terms_page_id = get_option('woocommerce_terms_page_id');
			?>
			<link rel="stylesheet" type="text/css" href="<?php echo $GU_Checkout_Terms_Conditions_Inline->plugin_url;?>assets/frontend/css/terms-conditions-inline.css" media="screen" />
			<style type="text/css">
				#checkouttermsconditions-inlinetext { <?php if(isset($this->terms_conditions_inline_div_height) && $this->terms_conditions_inline_div_height != '' ) { ?> height: <?php echo $this->terms_conditions_inline_div_height;?>px; <?php } ?> }
			</style>
			<?php if (!empty($pre_text)) { ?>
			<div class="checkouttermsconditions-pre"><?= $pre_text ?></div>
			<?php }	?>
			<div class="checkouttermsconditions-inlinetext" >
				<div class="checkouttermsconditions-inlinetext-content">
					<?php echo get_post_field('post_content',$woocommerce_terms_page_id); ?>
				</div>
			</div>
			<?php
		}
	}

}
