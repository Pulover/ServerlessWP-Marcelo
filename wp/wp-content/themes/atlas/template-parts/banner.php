<?php
/**
 * Banner / Advertisement
 *
 * @package Atlas
 */

if ( 'image' == $args['block']['b_type'] ) {
    if ( ! isset( $args['block']['b_image']['id'] ) ) {
        return;
    }

    if ( ! $args['block']['b_image']['id'] ) {
        return;
    }

    $max_width = 0;
    $image = wp_get_attachment_image_src( $args['block']['b_image']['id'], 'full' );
    if ( ! empty( $image ) ) {
        $max_width = $image[1];
    }
    ?>
    <div class="post-item">
        <div class="banner-box">
            <div class="banner-box-inner" style="max-width:<?php echo absint( $max_width ); ?>px">
                <?php
                if ( $args['block']['b_heading'] ) {
                    ?>
                    <div class="ads-heading"><span><?php echo esc_html( $args['block']['b_heading'] ); ?></span></div>
                    <?php
                }
                th90_the_add_lazyload( wp_get_attachment_image( $args['block']['b_image']['id'], 'full' ), $args['block']['b_image']['id'] );

                if ( ! empty( $args['block']['b_link']['url'] ) ) {
                    $link_atts = array();
                    $link_atts['class'] = 'banner-url';

            		$allowed_protocols = array_merge( wp_allowed_protocols(), [ 'skype', 'viber' ] );
                    $link_atts['href'] = esc_url( $args['block']['b_link']['url'], $allowed_protocols );

                    if ( ! empty( $args['block']['b_link']['is_external'] ) ) {
                        $link_atts['target'] = '_blank';
                    }
                    if ( ! empty( $args['block']['b_link']['nofollow'] ) ) {
                        $link_atts['rel'] = 'nofollow';
                    }
                    ?>
                    <a <?php echo th90_stringify_attributes( $link_atts ); ?>></a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
} elseif ( 'codes' == $args['block']['b_type'] ) {
    if ( ! isset( $args['block']['b_codes'] ) ) {
        return;
    }

    if ( empty( $args['block']['b_codes'] ) ) {
        return;
    }
    ?>
    <div class="post-item">
        <div class="banner-box">
            <div class="banner-box-inner">
                <?php
                if ( $args['block']['b_heading'] ) {
                    ?>
                    <div class="ads-heading"><span><?php echo esc_html( $args['block']['b_heading'] ); ?></span></div>
                    <?php
                }
                echo do_shortcode( $args['block']['b_codes'] );
                ?>
            </div>
        </div>
    </div>
    <?php
}
