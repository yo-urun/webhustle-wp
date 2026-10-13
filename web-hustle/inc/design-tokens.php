<?php
/**
 * Design tokens and CSS variables injection
 *
 * @package Web_Hustle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add preconnect hints for Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function wh_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://fonts.googleapis.com',
			'crossorigin' => 'anonymous',
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'wh_resource_hints', 10, 2 );

/**
 * Inject CSS variables (design tokens) into wp_head.
 *
 * These variables are the single source of truth for the theme colors and
 * layout. The UnoCSS build maps its `theme` colors to these `--wh-*` variables
 * (see `uno.config.ts`), so the Customizer stays live at runtime.
 */
function wh_inject_design_tokens() {
	// Do not inject design tokens in admin to avoid conflicts with WC Admin/Wizard.
	if ( is_admin() ) {
		return;
	}

	$primary    = get_theme_mod( 'wh_primary_color', '#1a1a1a' );
	$secondary  = get_theme_mod( 'wh_secondary_color', '#4a4a4a' );
	$accent     = get_theme_mod( 'wh_accent_color', '#007bff' );
	$background = get_theme_mod( 'wh_background_color', '#ffffff' );
	$surface    = get_theme_mod( 'wh_surface_color', '#f8f9fa' );
	$font_sans  = get_theme_mod( 'wh_font_sans', "'Inter', 'Plus Jakarta Sans', sans-serif" );
	$container  = get_theme_mod( 'wh_container_max', '1920px' );
	$content    = get_theme_mod( 'wh_content_max', '800px' );
	?>
	<style type="text/css" id="wh-design-tokens">
		:root {
			--wh-primary: <?php echo esc_attr( $primary ); ?>;
			--wh-secondary: <?php echo esc_attr( $secondary ); ?>;
			--wh-accent: <?php echo esc_attr( $accent ); ?>;
			--wh-background: <?php echo esc_attr( $background ); ?>;
			--wh-surface: <?php echo esc_attr( $surface ); ?>;
			--wh-font-sans: <?php echo $font_sans; ?>, ui-sans-serif, system-ui, sans-serif;
			--wh-container-max: <?php echo esc_attr( $container ); ?>;
			--wh-content-max: <?php echo esc_attr( $content ); ?>;
			--wh-section-gap: 4rem;
		}

		body {
			font-family: var( --wh-font-sans );
			background-color: var( --wh-background );
			color: var( --wh-primary );
		}

		/* Container utility (max width is driven by the Customizer). */
		.container {
			width: 100%;
			margin-right: auto;
			margin-left: auto;
			padding-right: 1rem;
			padding-left: 1rem;
			max-width: var( --wh-container-max );
		}
	</style>
	<?php
}
add_action( 'wp_head', 'wh_inject_design_tokens', 1 );
