<?php
/**
 * Offcanvas
 *
 * @package Atlas
 */

$offcanvas_classes = array(
    'offcanvas',
    'is-skin',
    'bg-sec',
    'inherit' !== th90_opt( 'offcanvas_bg' ) ? 'bg-' . th90_opt( 'offcanvas_bg' ) : 'bg-' . th90_opt_override_blank( 'site_skin' ),
);
?>
<aside class="<?php echo esc_attr( implode( ' ', array_filter( $offcanvas_classes ) ) ); ?>">
    <div class="offcanvas-inner">
        <div class="offcanvas-head">
            <div class="offcanvas-logo">
                <?php
                if ( th90_opt( 'show_offcanvas_logo' ) ) {
                    th90_logo( array(
            			'logo_type'           => th90_opt( 'logo_offcanvas_type' ),
            			'logo_id'             => th90_opt_arr( 'logo_offcanvas', 'id' ),
            			'logo_retina_id'      => th90_opt_arr( 'logo_offcanvas_retina', 'id' ),
            			'logo_dark_id'        => th90_opt_arr( 'logo_dark_offcanvas', 'id' ),
            			'logo_dark_retina_id' => th90_opt_arr( 'logo_dark_offcanvas_retina', 'id' ),
            			'logo_svg'            => th90_opt( 'logo_offcanvas_svg' ),
            			'dark_logo_svg'       => th90_opt( 'logo_dark_offcanvas_svg' ),
            		) );
                }
                ?>
            </div>
            <div class="offcanvas-close">
                <?php th90_svg_icon( 'close' ); ?>
            </div>
        </div>
        <?php
        get_template_part( 'template-parts/header/navigation', 'mobile' );

        $template = th90_display_elementor_content( th90_opt( 'offcanvas_template' ) );
        if ( $template ) {
            echo apply_filters( 'th90_print_offcanvas_template', $template );
        }
        ?>
    </div>
</aside>
<div class="offcanvas-overlay"></div>
