<?php
/**
 * The main template file
 *
 * @package Web_Hustle
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-section">

	<?php wh_breadcrumbs(); ?>

	<?php if ( have_posts() ) : ?>

		<header class="mb-12">
			<h1 class="text-4xl font-bold tracking-tight text-primary">
				<?php
				if ( is_home() && ! is_front_page() ) :
					single_post_title();
				else :
					esc_html_e( 'Latest Posts', 'web-hustle' );
				endif;
				?>
			</h1>
		</header>

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'group bg-white border border-surface rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="aspect-video overflow-hidden">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="p-6">
						<header class="entry-header mb-4">
							<div class="text-xs font-medium text-accent uppercase tracking-wider mb-2">
								<?php the_category( ', ' ); ?>
							</div>
							<?php the_title( '<h2 class="text-xl font-bold leading-tight text-primary group-hover:text-accent transition-colors"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
						</header>

						<div class="entry-content text-secondary text-sm line-clamp-3 mb-6">
							<?php the_excerpt(); ?>
						</div>

						<footer class="entry-footer flex items-center justify-between text-xs text-gray-400 border-t border-surface pt-4">
							<div class="post-date"><?php echo get_the_date(); ?></div>
							<div class="post-author">By <?php the_author(); ?></div>
						</footer>
					</div>
				</article>
				<?php
			endwhile;
			?>
		</div>

		<div class="mt-12">
			<?php
			the_posts_pagination(
				array(
					'prev_text' => '<span class="px-4 py-2 border border-surface rounded-lg hover:bg-surface transition-colors">' . esc_html__( 'Previous', 'web-hustle' ) . '</span>',
					'next_text' => '<span class="px-4 py-2 border border-surface rounded-lg hover:bg-surface transition-colors">' . esc_html__( 'Next', 'web-hustle' ) . '</span>',
					'class'     => 'flex justify-center space-x-4',
				)
			);
			?>
		</div>

	<?php else : ?>

		<section class="no-results not-found text-center py-20">
			<h2 class="text-2xl font-bold text-primary mb-4"><?php esc_html_e( 'Nothing Found', 'web-hustle' ); ?></h2>
			<p class="text-secondary"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'web-hustle' ); ?></p>
		</section>

	<?php endif; ?>

</main>

<?php
get_footer();
