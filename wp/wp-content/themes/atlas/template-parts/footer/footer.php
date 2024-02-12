<?php
/**
 * Footer
 *
 * @package Atlas
 */

if ( ! th90_multi_checkbox( th90_field( 'disable_templates' ), 'footer' ) ) {
?>
    <div class="site-section site-footer">
        <?php
        $footer_template = th90_display_elementor_content( th90_opt_override_blank( 'footer_template' ) );
        if ( $footer_template ) {
            echo apply_filters( 'th90_print_footer_template', $footer_template );
        } else {
            get_template_part( 'template-parts/footer/default', 'footer' );
        }
        ?>
    </div>
<?php
}
