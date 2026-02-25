<?php
/**
 * The template for displaying product content within loops
 *
 * @package Web_Hustle
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'group relative flex flex-col bg-white border border-neutral-200 rounded-lg overflow-hidden transition-all duration-300 hover:shadow-xl', $product ); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	// We'll handle the link manually for better control over Tailwind classes
	?>
	
	<div class="relative aspect-square overflow-hidden bg-neutral-100">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		
		// Custom Sale Flash
		if ( $product->is_on_sale() ) {
			echo '<span class="absolute top-4 left-4 z-10 bg-primary-600 text-white text-xs font-bold px-2 py-1 rounded uppercase tracking-wider">' . esc_html__( 'Sale', 'web-hustle' ) . '</span>';
		}

		// Custom Thumbnail
		$image_id = $product->get_image_id();
		if ( $image_id ) {
			echo wp_get_attachment_image( $image_id, 'woocommerce_thumbnail', false, array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' ) );
		} else {
			echo wc_placeholder_img( 'woocommerce_thumbnail', array( 'class' => 'w-full h-full object-cover' ) );
		}
		?>

		<div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300"></div>
		
		<div class="absolute bottom-4 left-4 right-4 translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			// We'll customize the add to cart button via filters or direct output
			woocommerce_template_loop_add_to_cart();
			?>
		</div>
	</div>

	<div class="p-6 flex flex-col flex-grow">
		<a href="<?php the_permalink(); ?>" class="block mb-2">
			<h2 class="text-lg font-semibold text-neutral-900 group-hover:text-primary-600 transition-colors">
				<?php the_title(); ?>
			</h2>
		</a>

		<?php
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		// Already handled above
		?>

		<div class="mt-auto">
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			woocommerce_template_loop_rating();
			woocommerce_template_loop_price();
			?>
		</div>
	</div>
</li>
