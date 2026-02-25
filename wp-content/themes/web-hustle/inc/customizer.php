<?php
/**
 * Theme Customizer functionality
 *
 * @package Web_Hustle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wh_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Add Theme Options Panel
	$wp_customize->add_panel( 'wh_theme_options', array(
		'title'       => esc_html__( 'Theme Design Tokens', 'web-hustle' ),
		'description' => esc_html__( 'Configure your theme vibe here.', 'web-hustle' ),
		'priority'    => 160,
	) );

	// Colors Section
	$wp_customize->add_section( 'wh_colors', array(
		'title' => esc_html__( 'Colors', 'web-hustle' ),
		'panel' => 'wh_theme_options',
	) );

	$colors = array(
		'wh_primary_color'    => array( 'label' => __( 'Primary Color', 'web-hustle' ), 'default' => '#1a1a1a' ),
		'wh_secondary_color'  => array( 'label' => __( 'Secondary Color', 'web-hustle' ), 'default' => '#4a4a4a' ),
		'wh_accent_color'     => array( 'label' => __( 'Accent Color', 'web-hustle' ), 'default' => '#007bff' ),
		'wh_background_color' => array( 'label' => __( 'Background Color', 'web-hustle' ), 'default' => '#ffffff' ),
		'wh_surface_color'    => array( 'label' => __( 'Surface Color', 'web-hustle' ), 'default' => '#f8f9fa' ),
	);

	foreach ( $colors as $id => $data ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $data['default'],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
			'label'   => $data['label'],
			'section' => 'wh_colors',
		) ) );
	}

	// Typography Section
	$wp_customize->add_section( 'wh_typography', array(
		'title' => esc_html__( 'Typography', 'web-hustle' ),
		'panel' => 'wh_theme_options',
	) );

	$wp_customize->add_setting( 'wh_font_sans', array(
		'default'           => "'Inter', 'Plus Jakarta Sans', sans-serif",
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'wh_font_sans', array(
		'label'       => esc_html__( 'Sans Font Family', 'web-hustle' ),
		'description' => esc_html__( 'CSS font-family string', 'web-hustle' ),
		'section'     => 'wh_typography',
		'type'        => 'text',
	) );

	// Layout Section
	$wp_customize->add_section( 'wh_layout', array(
		'title' => esc_html__( 'Layout', 'web-hustle' ),
		'panel' => 'wh_theme_options',
	) );

	$wp_customize->add_setting( 'wh_container_max', array(
		'default'           => '1280px',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'wh_container_max', array(
		'label'   => esc_html__( 'Container Max Width', 'web-hustle' ),
		'section' => 'wh_layout',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wh_content_max', array(
		'default'           => '800px',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'wh_content_max', array(
		'label'   => esc_html__( 'Content Max Width (Narrow)', 'web-hustle' ),
		'section' => 'wh_layout',
		'type'    => 'text',
	) );
}
add_action( 'customize_register', 'wh_customize_register' );
