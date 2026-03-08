<?php
/**
 * The template for displaying comments
 *
 * @package Web_Hustle
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area mt-20 pt-12 border-t border-surface">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title text-2xl font-bold text-primary mb-10">
			<?php
			$wh_comment_count = get_comments_number();
			if ( '1' === $wh_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'web-hustle' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $wh_comment_count, 'comments title', 'web-hustle' ) ),
					number_format_i18n( $wh_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<ol class="comment-list space-y-8">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 48,
					'callback'   => 'wh_comment_callback',
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation(
			array(
				'prev_text' => esc_html__( 'Older Comments', 'web-hustle' ),
				'next_text' => esc_html__( 'Newer Comments', 'web-hustle' ),
				'class'     => 'flex justify-between mt-10 text-sm font-bold text-accent',
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments mt-10 text-center text-secondary italic">
				<?php esc_html_e( 'Comments are closed.', 'web-hustle' ); ?>
			</p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	$wh_commenter = wp_get_current_commenter();
	$wh_req       = get_option( 'require_name_email' );
	$wh_aria_req  = ( $wh_req ? " aria-required='true'" : '' );

	comment_form(
		array(
			'class_form'         => 'comment-form mt-12 space-y-6',
			'title_reply'        => esc_html__( 'Leave a Reply', 'web-hustle' ),
			'title_reply_to'     => esc_html__( 'Leave a Reply to %s', 'web-hustle' ),
			'class_submit'       => 'submit px-8 py-4 bg-primary text-white font-bold rounded-xl hover:opacity-90 transition-opacity cursor-pointer',
			'comment_field'      => '<div class="comment-form-comment"><label for="comment" class="block text-sm font-medium text-primary mb-2">' . _x( 'Comment', 'noun', 'web-hustle' ) . '</label><textarea id="comment" name="comment" rows="5" class="w-full px-4 py-3 bg-surface border border-transparent focus:border-accent rounded-xl outline-none transition-colors" required></textarea></div>',
			'fields'             => array(
				'author' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-6"><div class="comment-form-author"><label for="author" class="block text-sm font-medium text-primary mb-2">' . esc_html__( 'Name', 'web-hustle' ) . ( $wh_req ? ' <span class="required">*</span>' : '' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $wh_commenter['comment_author'] ) . '" class="w-full px-4 py-3 bg-surface border border-transparent focus:border-accent rounded-xl outline-none transition-colors"' . $wh_aria_req . ' /></div>',
				'email'  => '<div class="comment-form-email"><label for="email" class="block text-sm font-medium text-primary mb-2">' . esc_html__( 'Email', 'web-hustle' ) . ( $wh_req ? ' <span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="email" value="' . esc_attr( $wh_commenter['comment_author_email'] ) . '" class="w-full px-4 py-3 bg-surface border border-transparent focus:border-accent rounded-xl outline-none transition-colors"' . $wh_aria_req . ' /></div></div>',
			),
		)
	);
	?>

</div>
