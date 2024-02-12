<?php
/**
 * Sticky Header
 *
 * @package Atlas
 */

$template = th90_display_elementor_content( th90_opt_override_blank( 'sticky_template' ) );

if ( ! th90_is_sticky_header() || ! $template ) {
    return;
}

$classes = array(
    'site-section',
    'sticky-header',
    is_singular('post') ? 'sticky-show-both' : 'sticky-show-' . th90_is_sticky_header(),
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
    <?php echo apply_filters( 'th90_print_header_sticky_template', $template ); ?>
</div>
