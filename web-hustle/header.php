<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-background text-primary font-sans antialiased' ); ?> x-data="{ sideCartOpen: false, mobileMenuOpen: false, searchOpen: false }" @wh-open-side-cart.window="sideCartOpen = true">
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'web-hustle' ); ?></a>

<div id="page" class="site" :class="{ 'overflow-hidden': sideCartOpen || mobileMenuOpen }">
	<header id="masthead" class="site-header bg-white border-b border-surface sticky top-0 z-50">
		<div class="container mx-auto px-4 h-20 flex items-center justify-between">
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) :
					the_custom_logo();
				else :
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-2xl font-bold tracking-tight text-primary">
						<?php bloginfo( 'name' ); ?>
					</a>
					<?php
				endif;
				?>
			</div>

			<nav id="site-navigation" class="main-navigation hidden md:flex items-center space-x-8">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'items_wrap'     => '<ul id="%1$s" class="%2$s flex space-x-8 text-sm font-medium">%3$s</ul>',
						'fallback_cb'    => false,
					)
				);
				?>
				
				<div class="header-actions flex items-center space-x-2 md:space-x-4">
					<button @click="searchOpen = true" class="p-2 text-secondary hover:text-primary transition-colors" aria-label="<?php esc_attr_e( 'Search', 'web-hustle' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
						</svg>
					</button>

					<?php if ( class_exists( 'WooCommerce' ) && function_exists( 'WC' ) && WC()->cart ) : ?>
						<button @click="sideCartOpen = true" class="relative p-2 text-secondary hover:text-primary transition-colors" aria-label="<?php esc_attr_e( 'View Cart', 'web-hustle' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
							</svg>
							<span id="wh-cart-count" class="absolute top-0 right-0 bg-accent text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
								<?php echo ( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '0'; ?>
							</span>
						</button>
					<?php endif; ?>

					<!-- Mobile Menu Toggle -->
					<button class="md:hidden p-2 text-secondary hover:text-primary transition-colors" @click="mobileMenuOpen = true" aria-label="<?php esc_attr_e( 'Open Menu', 'web-hustle' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
						</svg>
					</button>
				</div>
			</nav>
		</div>
	</header>

	<!-- Mobile Navigation Menu -->
	<div
		x-show="mobileMenuOpen"
		x-transition:enter="transition ease-out duration-300"
		x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100"
		x-transition:leave="transition ease-in duration-200"
		x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0"
		@click="mobileMenuOpen = false"
		class="fixed inset-0 bg-black/50 z-[60]"
		style="display: none;"
	></div>

	<div
		x-show="mobileMenuOpen"
		x-transition:enter="transition ease-out duration-300 transform"
		x-transition:enter-start="-translate-x-full"
		x-transition:enter-end="translate-x-0"
		x-transition:leave="transition ease-in duration-200 transform"
		x-transition:leave-start="translate-x-0"
		x-transition:leave-end="-translate-x-full"
		class="fixed left-0 top-0 h-full w-full max-w-xs bg-white shadow-2xl z-[70] flex flex-col"
		style="display: none;"
	>
		<div class="p-6 border-b border-surface flex justify-between items-center">
			<span class="text-xl font-bold tracking-tight text-primary"><?php bloginfo( 'name' ); ?></span>
			<button @click="mobileMenuOpen = false" class="p-2 hover:bg-surface rounded-full transition-colors">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
		</div>
		<nav class="flex-grow overflow-y-auto p-6">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '<ul class="space-y-6 text-lg font-medium text-primary">%3$s</ul>',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
	</div>

	<!-- Search Overlay -->
	<div
		x-show="searchOpen"
		x-transition:enter="transition ease-out duration-300"
		x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100"
		x-transition:leave="transition ease-in duration-200"
		x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0"
		class="fixed inset-0 bg-white z-[100] flex flex-col"
		style="display: none;"
		@keydown.escape.window="searchOpen = false"
	>
		<div class="container mx-auto px-4 h-20 flex items-center justify-end">
			<button @click="searchOpen = false" class="p-2 text-secondary hover:text-primary transition-colors">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
				</svg>
			</button>
		</div>
		<div class="flex-grow flex items-center justify-center px-4">
			<div class="w-full max-w-3xl">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label class="block">
						<span class="sr-only"><?php echo _x( 'Search for:', 'label', 'web-hustle' ); ?></span>
						<input type="search" class="w-full bg-transparent border-b-2 border-surface focus:border-accent outline-none py-4 text-3xl md:text-5xl font-bold placeholder-neutral-300 transition-colors" placeholder="<?php echo esc_attr_x( 'Type to search...', 'placeholder', 'web-hustle' ); ?>" value="<?php echo get_search_query(); ?>" name="s" x-init="$el.focus()" />
					</label>
					<button type="submit" class="mt-8 px-8 py-4 bg-primary text-white font-bold rounded-xl hover:opacity-90 transition-opacity">
						<?php echo esc_html_x( 'Search', 'submit button', 'web-hustle' ); ?>
					</button>
				</form>
			</div>
		</div>
	</div>
