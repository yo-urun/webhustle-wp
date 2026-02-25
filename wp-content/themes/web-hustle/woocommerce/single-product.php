<?php
/**
 * The Template for displaying all single products
 *
 * @package Web_Hustle
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked wh_woocommerce_wrapper_start - 10 (outputs opening <main>)
 */
do_action( 'woocommerce_before_main_content' );
?>

<div class="single-product-container">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<?php wc_get_template_part( 'content', 'single-product' ); ?>

	<?php endwhile; // end of the loop. ?>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked wh_woocommerce_wrapper_end - 10 (outputs closing </main>)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
