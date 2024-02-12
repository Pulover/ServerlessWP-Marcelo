<?php
/**
 * This template used for slider thumbnails 2
 *
 * @package Atlas
 */

?>
<div <?php echo th90_stringify_attributes( $args['slider_thumb_atts'] ); ?> data-settings='<?php echo esc_attr( wp_json_encode( th90_slider_config_default( $args['slider_thumb_config'] ) ) ); ?>'>
    <?php
    /* Render Posts */
    echo '<div class="slider-wrap">';
    $count = 0;
    $block_query = th90_query( $args['block'] );
    if ( $block_query->have_posts() ) {
        echo '<div class="slick-slider">';
            while ( $block_query->have_posts() ) {
                $block_query->the_post();
                $count++;
                if ( 1 < $count ) {
                    ?>
                    <div class="slider-item">
                        <?php
                        $small_block = array(
                            'article_class' => '',
                            'image_ratio_s' => '1_1',
                            'date_s' => true,
                            'time_format_s' => $args['block']['time_format_b'],
                            'info_position_s' => 'bottom',
                        );
                        $small_block = th90_post_block_atts_default( $small_block, '_s' );
                        get_template_part( 'template-parts/posts/post', 'small1', array(
                            'block' => $small_block,
                            'count' => $count,
                            'sufix' => '_s',
                        ) );
                        ?>
                    </div>
                    <?php
                }
                // Do not duplicate posts ----------
                if ( isset( $args['block']['not_show_duplicate'] ) && 'yes' == $args['block']['not_show_duplicate'] ) {
                    th90_do_not_duplicate( get_the_ID() );
                }
            } wp_reset_postdata();
        echo '</div>';
    }
    echo '</div>';
    ?>
</div>
