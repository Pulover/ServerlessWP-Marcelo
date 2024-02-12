<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Atlas
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() || ( is_singular( 'post' ) && ! th90_opt( 'post_comment' ) ) || ( ! have_comments() && ! comments_open() ) ) {
	return;
}

if ( th90_opt( 'post_comment_collapse' ) && ! th90_is_amp() ) {
	?>
	<div class="collapse-wrap">
		<div class="comment-collapse button">
			<?php echo sprintf( esc_html__( 'Show Comments (%1$s)', 'atlas' ), number_format_i18n( get_comments_number() ) ); ?>
		</div>
	</div>
	<?php
}
?>

<div class="element-article article-comments<?php echo esc_attr( th90_box() ); ?>">
	<?php if ( get_comments_number() >= 1 ): ?>
		<div class="widget-heading">
			<h4 class="title">
				<?php
				if ( get_comments_number() > 1 ) {
					$comments_number_output = str_replace( '%', number_format_i18n( get_comments_number() ), esc_html__( '% Comments', 'atlas' ) );
				} else {
					$comments_number_output = esc_html__( '1 Comment', 'atlas' );
				}
				?>
				<?php echo esc_html( $comments_number_output ); ?>
			</h4>
		</div>
	<?php endif; ?>

	<div id="comments" class="entry-comments">

		<?php if ( have_comments() ) : ?>


			<ul class="comment-list">
				<?php
					wp_list_comments( array(
						'style'       => 'ul',
						'short_ping'  => true,
						'avatar_size' => 42,
						'callback' => 'th90_comment',
					) );
				?>
			</ul>

			<?php
				the_comments_navigation( array(
					'prev_text' => esc_html__( 'Older comments', 'atlas' ),
					'next_text' => esc_html__( 'Newer comments', 'atlas' ),
				) );
			?>

		<?php endif; ?>

		<?php // If comments are closed and there are comments, let's leave a little note, shall we? ?>
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed', 'atlas' ); ?></p>
		<?php endif; ?>

		<?php
			$commenter = wp_get_current_commenter();
			$req      = get_option( 'require_name_email' );
    		$html_req = ( $req ? " required='required'" : '' );
			$form_fields = array(
				'author' => sprintf(
		            '<p class="comment-form-author">%1$s</p>',
		            sprintf(
		                '<input id="author" name="author" type="text" value="%1$s" placeholder="%2$s%3$s" size="30" maxlength="245"%4$s />',
		                esc_attr( $commenter['comment_author'] ),
						esc_html__( 'Your Name', 'atlas' ),
						( $req ? ' *' : '' ),
						$html_req
		            )
		        ),
		        'email'  => sprintf(
		            '<p class="comment-form-email">%1$s</p>',
		            sprintf(
		                '<input id="email" name="email" %1$s value="%2$s" placeholder="%3$s%4$s" size="30" maxlength="100" aria-describedby="email-notes"%5$s />',
		                'type="text"',
		                esc_attr( $commenter['comment_author_email'] ),
						esc_html__( 'Your Email', 'atlas' ),
						( $req ? ' *' : '' ),
		                $html_req
		            )
		        ),
			);
			$form_args = array(
				'title_reply_before' => '<div id="reply-title" class="comment-reply-title widget-heading"><h4 class="title">',
				'title_reply_after' => '</h4></div>',
				'fields'            => apply_filters( 'comment_form_default_fields', $form_fields ),
				'comment_field'     => sprintf(
		            '<p class="comment-form-comment">%s</p>',
					sprintf(
		                 '<textarea id="comment" name="comment" placeholder="%1$s" cols="45" rows="8" maxlength="65525" required="required"></textarea>',
		                esc_html__( 'Your Comment *', 'atlas' ),
		            )
		        ),
			);
			comment_form( $form_args );
		?>

	</div>

</div>
