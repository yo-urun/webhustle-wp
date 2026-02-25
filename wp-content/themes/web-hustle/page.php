<?php
/**
 * The template for displaying all pages
 *
 * @package Web_Hustle
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-section">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<div class="max-w-content mx-auto">
			<?php wh_breadcrumbs(); ?>
		</div>

		<article id="page-<?php the_ID(); ?>" <?php post_class( 'max-w-content mx-auto' ); ?>>
			<header class="entry-header mb-12 text-center">
				<?php the_title( '<h1 class="text-4xl md:text-5xl font-bold tracking-tight text-[var(--wh-primary)]">', '</h1>' ); ?>
			</header>

			<div class="entry-content prose prose-neutral max-w-none text-[var(--wh-secondary)] leading-relaxed">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'web-hustle' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
