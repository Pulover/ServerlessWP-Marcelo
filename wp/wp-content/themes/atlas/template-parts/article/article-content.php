<?php
/**
 * Template for displaying single post title
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$share_position = th90_opt( 'social_shares_pos' );
if ( th90_is_amp() ) {
	$share_position = 'bottom';
}
$social_shares_args = array(
	'options_sufix' => 'post',
	'style' => th90_opt( 'social_shares_style' ),
);
?>
<div class="content-wrap<?php echo esc_attr( ! empty( th90_social_shares ( $social_shares_args ) ) && 'sticky' == $share_position ? ' have-share_sticky' : '' ); ?>">
	<div class="single-content">
		<div class="entry-content article-content">
		    <?php
		    do_action( 'th90_above_post' );

		    the_content();

		    do_action( 'th90_below_post' );
		    ?>
		</div>

		<div class="clearfix"></div>

		<?php
		wp_link_pages( array(
			'before'      => '<div class="page-links-wrap"><div class="page-links"><span class="page-links-title screen-reader-text">' . esc_html__( 'Pages:', 'atlas' ) . '</span>',
			'after'       => '</div></div>',
		    'link_before' => '<span>',
		    'link_after'  => '</span>',
		    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'atlas' ) . ' </span>%',
		    'separator'   => '',
		) );

		if ( ( has_tag() && th90_opt( 'post_tags' ) ) ) {
		    echo '<div class="single-tags">';
				if ( has_tag() && th90_opt( 'post_tags' ) ) {
					echo '<div class="entry-tags-head">' . esc_html__( 'Tags:', 'atlas' ) . '</div>';
					echo '<div class="entry-tags">';
						the_tags( '', '' );
			        echo '</div>';
				}
		    echo '</div>';

		}
		if ( th90_opt( 'post_cats' ) && sizeOf( get_the_category() ) > 2 ) {
			echo '<div class="single-tags">';
				if ( has_tag() && th90_opt( 'post_tags' ) ) {
					echo '<div class="entry-tags-head">' . esc_html__( 'Cats:', 'atlas' ) . '</div>';
					echo '<div class="entry-cats">' . th90_get_category( th90_opt( 'post_cats_style' ), false, true ) . '</div>';
				}
		    echo '</div>';

		}
		?>
	</div>

	<?php
	if ( ! empty( th90_social_shares ( $social_shares_args ) ) && ( 'sticky' == $share_position || 'bottom' == $share_position ) ) {
		echo '<div class="single-shares_' . $share_position . '">';
			echo '<div class="head-shares">' . esc_html__( 'Shares:', 'atlas' ). '</div>';
			th90_the_social_shares( $social_shares_args );
		echo '</div>';
	}
	?>
</div>
