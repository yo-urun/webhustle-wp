<?php
/**
 * The template for displaying the footer
 *
 * @package Web_Hustle
 */

?>
	<footer id="colophon" class="site-footer bg-primary text-white py-section mt-auto">
		<div class="container mx-auto px-4">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
				<div class="footer-info">
					<h2 class="text-xl font-bold mb-6"><?php bloginfo( 'name' ); ?></h2>
					<p class="text-secondary-foreground/80 text-sm leading-relaxed">
						<?php bloginfo( 'description' ); ?>
					</p>
				</div>
				
				<div class="footer-menu">
					<h3 class="text-sm font-semibold uppercase tracking-wider mb-6">Navigation</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_id'        => 'footer-menu',
							'container'      => false,
							'items_wrap'     => '<ul id="%1$s" class="%2$s space-y-4 text-sm text-gray-400">%3$s</ul>',
							'fallback_cb'    => false,
						)
					);
					?>
				</div>

				<div class="footer-contact">
					<h3 class="text-sm font-semibold uppercase tracking-wider mb-6">Contact</h3>
					<ul class="space-y-4 text-sm text-gray-400">
						<li>Email: hello@webhustle.com</li>
						<li>Follow us on Instagram</li>
					</ul>
				</div>
			</div>

			<div class="border-t border-white/10 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
				<p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
				<div class="mt-4 md:mt-0 space-x-6">
					<a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
					<a href="#" class="hover:text-white transition-colors">Terms of Service</a>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php if ( function_exists( 'WC' ) && WC()->cart ) : ?>
<!-- Side Cart Overlay -->
<div
	x-show="sideCartOpen"
	x-transition:enter="transition ease-out duration-300"
	x-transition:enter-start="opacity-0"
	x-transition:enter-end="opacity-100"
	x-transition:leave="transition ease-in duration-200"
	x-transition:leave-start="opacity-100"
	x-transition:leave-end="opacity-0"
	@click="sideCartOpen = false"
	class="fixed inset-0 bg-black/50 z-[60]"
	style="display: none;"
></div>

<!-- Side Cart Panel -->
<div
	x-show="sideCartOpen"
	x-transition:enter="transition ease-out duration-300 transform"
	x-transition:enter-start="translate-x-full"
	x-transition:enter-end="translate-x-0"
	x-transition:leave="transition ease-in duration-200 transform"
	x-transition:leave-start="translate-x-0"
	x-transition:leave-end="translate-x-full"
	class="fixed right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl z-[70] flex flex-col"
	style="display: none;"
>
	<div class="p-6 border-b border-neutral-200 flex justify-between items-center">
		<h2 class="text-xl font-bold text-neutral-900"><?php esc_html_e( 'Your Cart', 'web-hustle' ); ?></h2>
		<button @click="sideCartOpen = false" class="p-2 hover:bg-neutral-100 rounded-full transition-colors">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
			</svg>
		</button>
	</div>

	<div id="wh-side-cart-content" class="flex-grow overflow-y-auto p-6">
		<?php
		if ( function_exists( 'WC' ) && WC()->cart ) {
			woocommerce_mini_cart();
		}
		?>
	</div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
