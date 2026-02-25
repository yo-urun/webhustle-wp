<?php
/**
 * The template for displaying search results pages
 *
 * @package Web_Hustle
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-section">

	<?php if ( have_posts() ) : ?>

		<header class="page-header mb-16 text-center">
			<h1 class="text-4xl md:text-5xl font-bold tracking-tight text-primary mb-4">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'web-hustle' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
		</header>

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'group flex flex-col bg-white border border-surface rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" class="aspect-[16/10] overflow-hidden block">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-700' ) ); ?>
						</a>
					<?php endif; ?>

					<div class="p-8 flex flex-col flex-grow">
						<header class="entry-header mb-4">
							<div class="entry-meta text-[10px] font-bold text-accent uppercase tracking-[0.2em] mb-3">
								<?php the_category( ' ' ); ?>
							</div>
							<?php the_title( '<h2 class="text-xl font-bold leading-tight text-primary group-hover:text-accent transition-colors"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
						</header>

						<div class="entry-content text-secondary text-sm line-clamp-3 mb-8 flex-grow">
							<?php the_excerpt(); ?>
						</div>

						<footer class="entry-footer flex items-center justify-between text-[10px] font-medium text-neutral-400 uppercase tracking-widest pt-6 border-t border-surface">
							<div class="post-date"><?php echo get_the_date(); ?></div>
							<a href="<?php the_permalink(); ?>" class="text-primary font-bold hover:text-accent transition-colors">
								<?php esc_html_e( 'Read More', 'web-hustle' ); ?>
							</a>
						</footer>
					</div>
				</article>
				<?php
			endwhile;
			?>
		</div>

		<div class="mt-20">
			<?php
			the_posts_pagination(
				array(
					'prev_text' => '<span class="px-6 py-3 border border-surface rounded-full hover:bg-surface transition-colors text-sm font-bold">' . esc_html__( 'Previous', 'web-hustle' ) . '</span>',
					'next_text' => '<span class="px-6 py-3 border border-surface rounded-full hover:bg-surface transition-colors text-sm font-bold">' . esc_html__( 'Next', 'web-hustle' ) . '</span>',
					'class'     => 'flex justify-center gap-4',
				)
			);
			?>
		</div>

	<?php else : ?>

		<section class="no-results not-found text-center py-20">
			<h2 class="text-3xl font-bold text-primary mb-6"><?php esc_html_e( 'Nothing Found', 'web-hustle' ); ?></h2>
			<p class="text-secondary mb-12"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'web-hustle' ); ?></p>
			<div class="max-w-md mx-auto">
				<?php get_search_form(); ?>
			</div>
		</section>

	<?php endif; ?>

</main>

<?php
get_footer();
