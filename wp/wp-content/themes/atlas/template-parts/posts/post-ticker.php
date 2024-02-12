<?php
/**
 * This template used for post small layout
 *
 * @package Atlas
 */

/* Avoid not set block args */
$args['block'] = th90_post_block_atts_default( $args['block'] );
?>
<div class="post-item post-ticker cat-<?php echo esc_attr( th90_get_primary_category_id() ); ?>">
	<?php
    if ( 'yes' == $args['block']['first_cat'] && th90_get_category( 'text', true ) ) {
        echo '<div class="entry-cats">';
            echo th90_get_category( 'text', true );
        echo '</div>';
    }

    th90_post_thumbnail( '1_1', array(
        'before'		=> '<div class="ticker-thumb thumbnail-circle"><div class="entry-thumbnail">',
        'after'			=> '</div></div>',
        'count'		    => '',
        'format_icon'   => false,
    ) );
	?>
    <div class="entry-header">
		<h3 class="entry-title <?php echo esc_attr( $args['block']['title_tag'] ? th90_convert_tag( $args['block']['title_tag' . $sufix] ) : 'head6' ); ?>">
			<a class="title-text" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php th90_the_title(); ?></a>
		</h3>
	</div>
</div>
