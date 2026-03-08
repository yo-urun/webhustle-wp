<?php
/**
 * WooCommerce compatibility and setup
 *
 * @package Web_Hustle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WooCommerce Setup
 */
function wh_woocommerce_setup() {
	// Support is now handled in functions.php to avoid activation issues.
}

/**
 * Fix for WooCommerce Setup Wizard infinite loading.
 * This filter allows skipping the onboarding wizard if it's stuck.
 */
add_filter( 'woocommerce_admin_onboarding_profile_skipped', '__return_true' );

/**
 * Ensure REST API works correctly by flushing rewrites if needed.
 * This is a common cause for WC Admin (React) hanging.
 */
function wh_woocommerce_fix_wizard_rest_api() {
	if ( is_admin() && isset( $_GET['page'] ) && 'wc-admin' === $_GET['page'] ) {
		if ( ! get_option( 'wh_wc_wizard_fixed' ) ) {
			flush_rewrite_rules();
			update_option( 'wh_wc_wizard_fixed', 1 );
		}
	}
}
add_action( 'admin_init', 'wh_woocommerce_fix_wizard_rest_api' );

/**
 * Remove default WooCommerce styles to use Tailwind instead.
 * Only on frontend to avoid breaking Admin/Setup Wizard.
 */
function wh_woocommerce_dequeue_styles( $enqueue_styles ) {
	if ( is_admin() ) {
		return $enqueue_styles;
	}
	return array();
}
add_filter( 'woocommerce_enqueue_styles', 'wh_woocommerce_dequeue_styles' );

/**
 * Disable WooCommerce default wrappers and breadcrumbs.
 */
if ( ! is_admin() ) {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
}

/**
 * Add custom wrappers.
 */
function wh_woocommerce_wrapper_start() {
	echo '<main id="main" class="site-main container mx-auto px-4 py-section">';
	if ( function_exists( 'wh_breadcrumbs' ) ) {
		wh_breadcrumbs();
	}
}
add_action( 'woocommerce_before_main_content', 'wh_woocommerce_wrapper_start', 10 );

function wh_woocommerce_wrapper_end() {
	echo '</main>';
}
add_action( 'woocommerce_after_main_content', 'wh_woocommerce_wrapper_end', 10 );

/**
 * Customize Product Loop Start/End
 */
function wh_woocommerce_product_loop_start() {
	return '<ul class="products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">';
}
add_filter( 'woocommerce_product_loop_start', 'wh_woocommerce_product_loop_start' );

function wh_woocommerce_product_loop_end() {
	return '</ul>';
}
add_filter( 'woocommerce_product_loop_end', 'wh_woocommerce_product_loop_end' );

/**
 * Customize Add to Cart Button Class
 */
function wh_woocommerce_loop_add_to_cart_args( $args, $product ) {
	if ( isset( $args['class'] ) ) {
		$args['class'] .= ' w-full flex justify-center items-center px-6 py-3 bg-primary-600 text-white font-bold rounded-lg shadow-lg hover:bg-primary-700 transition-colors duration-300';
	}
	return $args;
}
add_filter( 'woocommerce_loop_add_to_cart_args', 'wh_woocommerce_loop_add_to_cart_args', 10, 2 );

/**
 * Single Product Customizations
 */

// Remove default title and add custom styled one
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
function wh_woocommerce_template_single_title() {
	echo '<h1 class="product_title entry-title text-4xl font-bold text-neutral-900 mb-4">' . esc_html( get_the_title() ) . '</h1>';
}
add_action( 'woocommerce_single_product_summary', 'wh_woocommerce_template_single_title', 5 );

// Style Price
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
function wh_woocommerce_template_single_price() {
	global $product;
	echo '<div class="text-3xl font-semibold text-primary-600 mb-6">' . wp_kses_post( $product->get_price_html() ) . '</div>';
}
add_action( 'woocommerce_single_product_summary', 'wh_woocommerce_template_single_price', 10 );

// Style Add to Cart Button (Single)
function wh_woocommerce_single_add_to_cart_button_class( $class ) {
	return $class . ' flex justify-center items-center px-8 py-4 bg-primary-600 text-white font-bold rounded-lg shadow-lg hover:bg-primary-700 transition-colors duration-300';
}
add_filter( 'woocommerce_single_add_to_cart_button_class', 'wh_woocommerce_single_add_to_cart_button_class' );

/**
 * AJAX Fragments for Side Cart
 */
function wh_woocommerce_header_add_to_cart_fragment( $fragments ) {
	if ( ! class_exists( 'WooCommerce' ) || ! function_exists( 'WC' ) || ! WC()->cart ) {
		return $fragments;
	}

	ob_start();
	?>
	<span id="wh-cart-count" class="absolute top-0 right-0 bg-accent text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
		<?php echo WC()->cart->get_cart_contents_count(); ?>
	</span>
	<?php
	$fragments['#wh-cart-count'] = ob_get_clean();

	ob_start();
	?>
	<div id="wh-side-cart-content" class="flex-grow overflow-y-auto p-6">
		<?php woocommerce_mini_cart(); ?>
	</div>
	<?php
	$fragments['#wh-side-cart-content'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'wh_woocommerce_header_add_to_cart_fragment' );

/**
 * Open Side Cart on Add to Cart
 */
function wh_woocommerce_add_to_cart_script() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	?>
	<script type="text/javascript">
		jQuery( function($) {
			$(document.body).on('added_to_cart', function() {
				// Dispatch event to Alpine.js
				if (window.Alpine) {
					// We need to find the element with the x-data that has sideCartOpen
					// Since it's on the body, we can just dispatch to window or document
					window.dispatchEvent(new CustomEvent('wh-open-side-cart'));
				}
			});
		});
	</script>
	<?php
}
add_action( 'wp_footer', 'wh_woocommerce_add_to_cart_script' );
