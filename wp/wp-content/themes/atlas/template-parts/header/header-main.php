<?php
/**
 * Main Header
 *
 * @package Atlas
 */
?>
<div class="site-section main-header">
    <?php
    $template = th90_display_elementor_content( th90_opt_override_blank( 'header_template' ) );
    if ( $template ) {
        echo apply_filters( 'th90_print_header_main_template', $template );
    } else {
        get_template_part( 'template-parts/header/default', 'header' );
    }
    ?>
</div>
