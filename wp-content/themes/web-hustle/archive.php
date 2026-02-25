<?php
/**
 * The template for displaying archive pages
 *
 * @package Web_Hustle
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-section">

	<?php wh_breadcrumbs(); ?>

	<?php if ( have_posts() ) : ?>

		<header class="page-header mb-16 text-center">
			<?php
			the_archive_title( '<h1 class="text-4xl md:text-5xl font-bold tracking-tight text-[var(--wh-primary)] mb-4">', '</h1>' );
			the_archive_description( '<div class="archive-description text-[var(--wh-secondary)] max-w-2xl mx-auto">', '</div>' );
			?>
		</header>

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'group flex flex-col bg-white border border-[var(--wh-surface)] rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" class="aspect-[16/10] overflow-hidden block">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-700' ) ); ?>
						</a>
					<?php endif; ?>

					<div class="p-8 flex flex-col flex-grow">
						<header class="entry-header mb-4">
							<div class="entry-meta text-[10px] font-bold text-[var(--wh-accent)] uppercase tracking-[0.2em] mb-3">
								<?php the_category( ' ' ); ?>
							</div>
							<?php the_title( '<h2 class="text-xl font-bold leading-tight text-[var(--wh-primary)] group-hover:text-[var(--wh-accent)] transition-colors"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
						</header>

						<div class="entry-content text-[var(--wh-secondary)] text-sm line-clamp-3 mb-8 flex-grow">
							<?php the_excerpt(); ?>
						</div>

						<footer class="entry-footer flex items-center justify-between text-[10px] font-medium text-neutral-400 uppercase tracking-widest pt-6 border-t border-[var(--wh-surface)]">
							<div class="post-date"><?php echo get_the_date(); ?></div>
							<a href="<?php the_permalink(); ?>" class="text-[var(--wh-primary)] font-bold hover:text-[var(--wh-accent)] transition-colors">
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
					'prev_text' => '<span class="px-6 py-3 border border-[var(--wh-surface)] rounded-full hover:bg-[var(--wh-surface)] transition-colors text-sm font-bold">' . esc_html__( 'Previous', 'web-hustle' ) . '</span>',
					'next_text' => '<span class="px-6 py-3 border border-[var(--wh-surface)] rounded-full hover:bg-[var(--wh-surface)] transition-colors text-sm font-bold">' . esc_html__( 'Next', 'web-hustle' ) . '</span>',
					'class'     => 'flex justify-center gap-4',
				)
			);
			?>
		</div>

	<?php else : ?>

		<section class="no-results not-found text-center py-20">
			<h2 class="text-3xl font-bold text-[var(--wh-primary)] mb-6"><?php esc_html_e( 'Nothing Found', 'web-hustle' ); ?></h2>
			<p class="text-[var(--wh-secondary)]"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'web-hustle' ); ?></p>
		</section>

	<?php endif; ?>

</main>

<?php
get_footer();
