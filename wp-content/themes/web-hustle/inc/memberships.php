<?php
/**
 * WooCommerce Memberships compatibility
 *
 * @package Web_Hustle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add "Member Only" badge to products in loop
 */
function wh_memberships_add_member_badge() {
	if ( ! function_exists( 'wc_memberships_is_post_content_restricted' ) ) {
		return;
	}

	if ( wc_memberships_is_post_content_restricted() ) {
		echo '<span class="wh-member-badge absolute top-4 left-4 z-10 bg-accent text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider shadow-sm">' . esc_html__( 'Member Only', 'web-hustle' ) . '</span>';
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'wh_memberships_add_member_badge', 15 );

/**
 * Add "Member Only" badge to single product/post titles
 */
function wh_memberships_title_badge( $title, $id = null ) {
	// Skip in admin, REST API, or if not in the loop to avoid breaking data structures.
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ! in_the_loop() || ! function_exists( 'wc_memberships_is_post_content_restricted' ) ) {
		return $title;
	}

	if ( wc_memberships_is_post_content_restricted( $id ) ) {
		$badge = '<span class="inline-block bg-accent/10 text-accent text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider ml-2 align-middle">' . esc_html__( 'Member Only', 'web-hustle' ) . '</span>';
		return $title . $badge;
	}

	return $title;
}
add_filter( 'the_title', 'wh_memberships_title_badge', 10, 2 );

/**
 * Style the restriction message
 */
function wh_memberships_restriction_message( $message, $restriction_reason, $post_id ) {
	return '<div class="wh-restriction-message bg-surface border border-surface p-8 rounded-2xl text-center my-8 shadow-sm">
		<div class="mb-4 flex justify-center">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0h-2v-2m0 0V9m0 0V7m0 0h2m-2 0h-2v2m0 0v2m6 4h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2" />
			</svg>
		</div>
		<h3 class="text-xl font-bold text-primary mb-2">' . esc_html__( 'Exclusive Content', 'web-hustle' ) . '</h3>
		<div class="text-secondary leading-relaxed mb-6">' . $message . '</div>
		<a href="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '" class="inline-block px-8 py-3 bg-primary text-white font-bold rounded-xl hover:opacity-90 transition-opacity">' . esc_html__( 'Join Now to Unlock', 'web-hustle' ) . '</a>
	</div>';
}
add_filter( 'wc_memberships_get_content_restriction_message', 'wh_memberships_restriction_message', 10, 3 );
