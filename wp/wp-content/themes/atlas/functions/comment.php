<?php
/**
 * Comments custom functions
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'th90_comment' ) ) {

	function th90_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="comment-head">
					<?php if( get_avatar( $comment, $args['avatar_size'] ) ): ?>
						<div class="comment-avatar author-ava vcard" data-author="<?php echo esc_attr( mb_substr( get_the_author(), 0, 1 ) ); ?>">
							<?php
							if ( 0 !== $args['avatar_size'] ) {
								echo get_avatar( $comment, $args['avatar_size'] );
							}
							?>
							<?php printf( '<cite class="screen-reader-text fn">%s</cite>', get_comment_author_link() ); ?>
						</div>
					<?php endif; ?>
					<div class="comment-author">
						<?php printf( sprintf( '<strong>%s</strong>', get_comment_author_link() ) ); ?>
						<div class="comment-info">
							<div class="meta-item"><?php printf( esc_html__( '%1$s at %2$s', 'atlas' ), get_comment_date(),  get_comment_time() ); ?></div>
							<div class="meta-item"><?php edit_comment_link( esc_html__( 'Edit', 'atlas' ), '' );?></div>
						</div>
					</div>

				</div>
				<div class="comment-wrap">
					<div class="entry-content comment-content">
						<?php if ( '0' === $comment->comment_approved ) : ?>
							<span class="comment-awaiting-moderation"><em><?php esc_html_e( 'Your comment is awaiting moderation', 'atlas' ); ?></em></span>
						<?php endif; ?>
						<?php comment_text(); ?>
					</div>
					<?php comment_reply_link( array_merge( $args, array(
						'depth' => $depth,
						'max_depth' => $args['max_depth'] ,
						'reply_text' => '<span>' . esc_html( 'Reply', 'atlas' ) . '</span>',
					) ) ); ?>
				</div>
			</div>
		<?php
	}
}
