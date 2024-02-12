<?php
/**
 * Top Header
 *
 * @package Atlas
 */

if ( ! th90_multi_checkbox( th90_field( 'disable_templates' ), 'top_header' ) ) {
    $template = th90_display_elementor_content( th90_opt_override_blank( 'topheader_template' ) );
    if ( $template ) {
        echo '<div class="site-section">' . apply_filters( 'th90_print_topheader_main_template', $template ) . '</div>';
    }
}
?>
