<?php
/**
 * Enqueue scripts and styles
 *
 * @package Web_Hustle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Returns the Google Fonts URL.
 *
 * @return string
 */
function wh_google_fonts_url() {
	$fonts_url = '';
	$font_families = array();

	// Modern default: Inter and Plus Jakarta Sans.
	$font_families[] = 'Inter:wght@400;500;600;700';
	$font_families[] = 'Plus+Jakarta+Sans:wght@400;500;600;700';

	$query_args = array(
		'family'  => implode( '|', $font_families ),
		'display' => 'swap',
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function wh_enqueue_scripts() {
	// Do not enqueue theme assets in admin or during AJAX requests to avoid conflicts with WC Admin/Wizard.
	if ( is_admin() || wp_doing_ajax() ) {
		return;
	}

	// Google Fonts.
	wp_enqueue_style( 'wh-fonts', wh_google_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'wh-style', get_stylesheet_uri(), array(), WH_THEME_VERSION );

	// Tailwind CSS v4 via CDN.
	wp_enqueue_script( 'wh-tailwind', 'https://cdn.tailwindcss.com/4', array(), '4.0.0', false );

	// Alpine.js v3.x via CDN.
	wp_enqueue_script( 'wh-alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array(), '3.x.x', true );
}
add_action( 'wp_enqueue_scripts', 'wh_enqueue_scripts' );
