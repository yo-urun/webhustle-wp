<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * @package Web_Hustle
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( function_exists( 'WC' ) && WC()->cart && ! WC()->cart->is_empty() ) : ?>

	<ul class="woocommerce-mini-cart cart_list product_list_widget space-y-6 <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?> flex gap-4">
					<div class="w-20 h-20 flex-shrink-0 bg-neutral-100 rounded overflow-hidden">
						<?php if ( empty( $product_permalink ) ) : ?>
							<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php else : ?>
							<a href="<?php echo esc_url( $product_permalink ); ?>">
								<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</a>
						<?php endif; ?>
					</div>

					<div class="flex-grow">
						<?php if ( empty( $product_permalink ) ) : ?>
							<span class="text-sm font-medium text-neutral-900 block mb-1"><?php echo wp_kses_post( $product_name ); ?></span>
						<?php else : ?>
							<a href="<?php echo esc_url( $product_permalink ); ?>" class="text-sm font-medium text-neutral-900 hover:text-primary-600 block mb-1">
								<?php echo wp_kses_post( $product_name ); ?>
							</a>
						<?php endif; ?>

						<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						
						<div class="flex justify-between items-center mt-2">
							<span class="text-xs text-neutral-500"><?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							
							<?php
							echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="remove_from_cart_button text-xs text-red-500 hover:text-red-700 underline" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">%s</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									/* translators: %s is the product name */
									esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), $product_name ) ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() ),
									__( 'Remove', 'web-hustle' )
								),
								$cart_item_key
							);
							?>
						</div>
					</div>
				</li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>

	<div class="woocommerce-mini-cart__total total py-6 border-t border-neutral-200 mt-6 flex justify-between items-center">
		<?php
		/**
		 * Hook: woocommerce_widget_shopping_cart_total.
		 *
		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
		 */
		do_action( 'woocommerce_widget_shopping_cart_total' );
		?>
	</div>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="woocommerce-mini-cart__buttons buttons grid grid-cols-2 gap-4">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward flex justify-center items-center px-4 py-3 border border-neutral-300 text-neutral-700 font-bold rounded-lg hover:bg-neutral-50 transition-colors"><?php esc_html_e( 'View cart', 'woocommerce' ); ?></a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward flex justify-center items-center px-4 py-3 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition-colors"><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></a>
	</div>

	<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

<?php else : ?>

	<div class="woocommerce-mini-cart__empty-message text-center py-12">
		<div class="mb-4 flex justify-center">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-neutral-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
			</svg>
		</div>
		<p class="text-neutral-500 mb-8"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>
		<a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="inline-block px-8 py-3 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition-colors">
			<?php esc_html_e( 'Return to shop', 'woocommerce' ); ?>
		</a>
	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
