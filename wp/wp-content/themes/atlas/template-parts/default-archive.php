<?php
/**
 * Default Archive Blog Layout
 *
 * @package Atlas
 */

 $atts = array(
     'sticky_sign' => true,
     'grid_columns' => '1',
     'grid_columns_masonry' => 'no',
     'have_number' => 'no',
     'post_style' => 'list1',
     'post_vertical_center' => false,
     'image_ratio' => '4_3',
     'thumbnail_type' => 'image',
     'title_tag' => 'h4',
     'meta_modern' => false,
     'post_info' => array( 'date', 'author', 'first_cat', 'readmore', 'review' ),
     'info_icon' => 'no',
     'author_avatar' => 'yes',
     'info_position' => 'bottom',
     'first_cat_loc' => 'title',
     'time_format' => 'modern',
     'excerpt' => 'yes',
     'post_center' => 'no',
     'readmore' => 'no',
     'readtime' => 'yes',
     'post_ads' => 'no',
     'post_ads_pos' => 0,
 );

/* Blog Classes */
$wrapper_classes = array(
    'posts-archive',
    'posts-columns columns' . $atts['grid_columns'],
    'yes' == $atts['grid_columns_masonry'] ? 'columns-masonry' : '',
);

$atts = th90_blog_atts_convert( $atts );
?>
<div class="<?php echo esc_attr( implode( ' ', array_filter( $wrapper_classes ) ) ); ?>">
    <div class="posts-archive-container post_sep-yes">
        <?php
        if ( th90_is_amp() && th90_is_builder_page() ) {
            $wp_query = th90_query( array( 'pagi' => true ) );
            th90_render_posts_loop( $wp_query, $atts );
        } else {
            global $wp_query;
            th90_render_posts_loop( $wp_query, $atts, true );
        }
        ?>
    </div>
</div>
<?php
if ( th90_is_amp() && th90_is_builder_page() ) {
    $wp_query = th90_query( array( 'pagi' => true ) );
    th90_numeric_pagination( $wp_query, '<div class="nav-wrap nav-wrap-numeric"><div class="nav-wrap-inner">', '</div></div>' );
} else {
    global $wp_query;
    th90_numeric_pagination( false, '<div class="nav-wrap nav-wrap-numeric"><div class="nav-wrap-inner">', '</div></div>' );
}
?>
