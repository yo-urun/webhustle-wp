<?php
/**
 * The template for displaying all single posts
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

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-content mx-auto' ); ?>>
			<header class="entry-header mb-12 text-center">
				<div class="entry-meta text-xs font-medium text-[var(--wh-accent)] uppercase tracking-wider mb-4 flex justify-center gap-4">
					<span class="posted-on"><?php echo get_the_date(); ?></span>
					<span class="cat-links"><?php the_category( ', ' ); ?></span>
				</div>
				<?php the_title( '<h1 class="text-4xl md:text-5xl font-bold tracking-tight text-[var(--wh-primary)] mb-6">', '</h1>' ); ?>
				<div class="author-meta text-sm text-[var(--wh-secondary)]">
					<?php esc_html_e( 'By', 'web-hustle' ); ?> <?php the_author(); ?>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="featured-image mb-12 rounded-2xl overflow-hidden shadow-2xl">
					<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto' ) ); ?>
				</div>
			<?php endif; ?>

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

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

			<footer class="entry-footer mt-16 pt-8 border-t border-[var(--wh-surface)]">
				<div class="tags-links text-sm text-[var(--wh-secondary)]">
					<?php the_tags( esc_html__( 'Tags: ', 'web-hustle' ), ', ' ); ?>
				</div>
			</footer>

			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="text-xs text-secondary uppercase tracking-widest block mb-2">' . esc_html__( 'Previous Post', 'web-hustle' ) . '</span><span class="text-lg font-bold text-primary group-hover:text-accent transition-colors">%title</span>',
					'next_text' => '<span class="text-xs text-secondary uppercase tracking-widest block mb-2">' . esc_html__( 'Next Post', 'web-hustle' ) . '</span><span class="text-lg font-bold text-primary group-hover:text-accent transition-colors">%title</span>',
					'class'     => 'post-navigation mt-20 grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-surface pt-12',
				)
			);
			?>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
