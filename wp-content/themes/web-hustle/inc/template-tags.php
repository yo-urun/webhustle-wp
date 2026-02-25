<?php
/**
 * Custom template tags for this theme
 *
 * @package Web_Hustle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Custom callback for comments.
 */
function wh_comment_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class( 'mb-8 last:mb-0' ); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="flex gap-4 md:gap-6">
			<div class="flex-shrink-0">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'rounded-full border border-surface' ) ); ?>
			</div>

			<div class="flex-grow">
				<header class="flex justify-between items-center mb-2">
					<div>
						<cite class="font-bold text-primary not-italic"><?php echo get_comment_author_link(); ?></cite>
						<div class="text-xs text-secondary mt-1">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="hover:text-accent transition-colors">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php printf( esc_html__( '%1$s at %2$s', 'web-hustle' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
						</div>
					</div>
					<div class="reply">
						<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below' => 'comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<span class="text-xs font-bold text-accent uppercase tracking-wider hover:opacity-70 transition-opacity">',
									'after'     => '</span>',
								)
							)
						);
						?>
					</div>
				</header>

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation text-xs italic text-accent mb-2"><?php esc_html_e( 'Your comment is awaiting moderation.', 'web-hustle' ); ?></p>
				<?php endif; ?>

				<div class="comment-content prose prose-sm max-w-none text-secondary leading-relaxed">
					<?php comment_text(); ?>
				</div>
			</div>
		</article>
	<?php
}

/**
 * Breadcrumbs implementation.
 */
function wh_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}

	// Support for Yoast SEO breadcrumbs.
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<nav class="wh-breadcrumbs text-xs font-medium text-secondary mb-8" aria-label="Breadcrumb">', '</nav>' );
		return;
	}

	// Support for Rank Math breadcrumbs.
	if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
		echo '<nav class="wh-breadcrumbs text-xs font-medium text-secondary mb-8" aria-label="Breadcrumb">';
		rank_math_the_breadcrumbs();
		echo '</nav>';
		return;
	}

	echo '<nav class="wh-breadcrumbs text-xs font-medium text-secondary mb-8 flex items-center gap-2 overflow-x-auto whitespace-nowrap pb-2 md:pb-0" aria-label="Breadcrumb">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="hover:text-primary transition-colors">' . esc_html__( 'Home', 'web-hustle' ) . '</a>';
	echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-neutral-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>';

	if ( is_category() || is_single() || is_tax() ) {
		$taxonomy = is_tax() ? get_queried_object()->taxonomy : 'category';
		if ( is_singular( 'product' ) || is_tax( 'product_cat' ) ) {
			$taxonomy = 'product_cat';
		}

		$terms = get_the_terms( get_the_ID(), $taxonomy );
		
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			$term = $terms[0];
			echo '<a href="' . esc_url( get_term_link( $term ) ) . '" class="hover:text-primary transition-colors">' . esc_html( $term->name ) . '</a>';
			
			if ( is_single() ) {
				echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-neutral-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>';
				echo '<span class="text-primary truncate max-w-[200px]">' . esc_html( get_the_title() ) . '</span>';
			}
		}
	} elseif ( is_page() ) {
		echo '<span class="text-primary">' . esc_html( get_the_title() ) . '</span>';
	} elseif ( class_exists( 'WooCommerce' ) && is_shop() && function_exists( 'woocommerce_page_title' ) ) {
		echo '<span class="text-primary">' . esc_html( woocommerce_page_title( false ) ) . '</span>';
	} elseif ( is_archive() ) {
		echo '<span class="text-primary">' . wp_kses_post( get_the_archive_title() ) . '</span>';
	} elseif ( is_search() ) {
		echo '<span class="text-primary">' . sprintf( esc_html__( 'Search results for: %s', 'web-hustle' ), esc_html( get_search_query() ) ) . '</span>';
	}

	echo '</nav>';
}
