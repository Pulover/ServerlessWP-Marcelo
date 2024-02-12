<?php
/**
 * Template for displaying single post title
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$classes = array(
    'entry-header',
    'entry-header-article',
	th90_opt_override( 'override_post_layout', 'post_title_center' ) ? 'text-center' : 'text-left',
);
?>

<header class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">

	<?php
	if ( th90_opt( 'post_cats' ) || th90_opt( 'breadcrumbs' ) ) {
		$havecats = '';
		if ( th90_opt( 'post_cats' ) ) {
			$havecats = ' have-cats';
		}
		echo '<div class="entry-cats-wrap' . $havecats . '">';
			if ( th90_opt( 'breadcrumbs' ) ) {
				th90_breadcrumbs( true );
			}
			if ( th90_opt( 'post_cats' ) ) {
				echo '<div class="entry-cats">' . th90_get_category( th90_opt( 'post_cats_style' ) ) . '</div>';
			}
		echo '</div>';
	}
    ?>

    <div class="page-title">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </div>

	<?php
	$args_meta = array(
		'modern'       	=> th90_opt( 'post_meta_modern' ),
		'time_format'  	=> th90_opt( 'meta_time_format' ),
		'avatar'       	=> true,
        'author' 		=> th90_opt_arr( 'post_meta', 'author' ),
        'date'   		=> th90_opt_arr( 'post_meta', 'date' ),
		'last_update'  	=> th90_opt_arr( 'post_meta', 'last_update' ),
		'reading_time' 	=> th90_opt_arr( 'post_meta', 'reading_time' ),
		'comments'     	=> th90_opt_arr( 'post_meta', 'comments' ),
		'views'        	=> th90_opt_arr( 'post_meta', 'views' ),
		'shares'		=> 'meta' == th90_opt( 'social_shares_pos' ) ? true : false,
    );

	if ( th90_get_post_info( $args_meta )) {
		th90_the_post_info( $args_meta );
	}

	if ( has_excerpt() && ! isset( $args['excerpt'] ) ) {
		echo '<div class="single-excerpt">' . get_the_excerpt() . '</div>';
	}
    ?>
</header><!-- .entry-header -->
