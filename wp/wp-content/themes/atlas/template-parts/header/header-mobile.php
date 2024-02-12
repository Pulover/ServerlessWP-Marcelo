<?php
/**
 * Mobile Header
 *
 * @package Atlas
 */
?>
<div class="mobile-header site-section">
    <?php
    $template = th90_display_elementor_content( th90_opt_override_blank( 'mob_header_template' ) );
    if ( $template ) {
        echo apply_filters( 'th90_print_header_mobile_template', $template );
    } else {
        get_template_part( 'template-parts/header/default', 'mobile' );
    }
    ?>
</div>
