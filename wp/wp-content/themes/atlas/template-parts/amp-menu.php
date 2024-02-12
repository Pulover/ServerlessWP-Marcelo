<?php
/**
 * Mobile Menu
 *
 * @package Atlas
 */

$classes = array(
    'amp-mobilemenu',
    'is-skin',
    'bg-sec',
    'inherit' !== th90_opt( 'offcanvas_bg' ) ? 'bg-' . th90_opt( 'offcanvas_bg' ) : 'bg-' . th90_opt_override_blank( 'site_skin' ),
);
?>
<amp-sidebar id="amp-menu-section" class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>" layout="nodisplay" side="left">
    <div class="offcanvas-inner">
        <div class="offcanvas-head">
            <div class="offcanvas-logo">
                <?php
                th90_logo( array(
        			'logo_type'           => th90_opt( 'logo_offcanvas_type' ),
        			'logo_id'             => th90_opt_arr( 'logo_offcanvas', 'id' ),
        			'logo_retina_id'      => th90_opt_arr( 'logo_offcanvas_retina', 'id' ),
        			'logo_dark_id'        => th90_opt_arr( 'logo_dark_offcanvas', 'id' ),
        			'logo_dark_retina_id' => th90_opt_arr( 'logo_dark_offcanvas_retina', 'id' ),
        			'logo_svg'            => th90_opt( 'logo_offcanvas_svg' ),
        			'dark_logo_svg'       => th90_opt( 'logo_dark_offcanvas_svg' ),
        		) );
                ?>
            </div>
            <div class="offcanvas-close" id="off-canvas-close-btn" on="tap:amp-menu-section.close">
                <?php th90_svg_icon( 'close' ); ?>
            </div>
        </div>
        <?php
        get_template_part( 'template-parts/header/navigation', 'mobile' );
        ?>

    </div>
</amp-sidebar>
