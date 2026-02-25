<?php
/**
 * Web Hustle functions and definitions
 *
 * @package Web_Hustle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'WH_THEME_VERSION', '1.0.0' );
define( 'WH_THEME_DIR', get_template_directory() );
define( 'WH_THEME_URI', get_template_directory_uri() );

/**
 * Modular Logic Includes
 */
require_once WH_THEME_DIR . '/inc/enqueue.php';
require_once WH_THEME_DIR . '/inc/design-tokens.php';
require_once WH_THEME_DIR . '/inc/template-tags.php';
require_once WH_THEME_DIR . '/inc/customizer.php';

// Only include WooCommerce setup if the plugin is active or we are in the process of activating it.
if ( class_exists( 'WooCommerce' ) ) {
	require_once WH_THEME_DIR . '/inc/woocommerce-setup.php';
}

// WooCommerce Memberships integration.
if ( class_exists( 'WC_Memberships' ) ) {
	require_once WH_THEME_DIR . '/inc/memberships.php';
}

/**
 * Theme Setup
 */
function wh_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Add support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Add WooCommerce support here to ensure it's always declared.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Register Navigation Menus
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'web-hustle' ),
			'footer'  => esc_html__( 'Footer Menu', 'web-hustle' ),
		)
	);
}
add_action( 'after_setup_theme', 'wh_setup' );
