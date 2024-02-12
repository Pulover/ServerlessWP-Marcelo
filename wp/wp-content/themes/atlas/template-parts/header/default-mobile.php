<?php
/**
 * Default Header Mobile
 *
 * @package Atlas
 */

$classes = array(
    'header-section',
    'mob_header-section',
    'is-skin',
    'bg-' . th90_opt_override_blank( 'site_skin' ),
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
    <div class="container">
        <div class="section-inner<?php echo esc_attr( th90_box() ); ?>">
            <div class="mob_header-logo header-elements">
                <?php
                th90_logo( array(
        			'logo_type'           => th90_opt( 'logo_mobile_type' ),
        			'logo_id'             => th90_opt_arr( 'logo_mobile', 'id' ),
        			'logo_retina_id'      => th90_opt_arr( 'logo_mobile_retina', 'id' ),
        			'logo_dark_id'        => th90_opt_arr( 'logo_dark_mobile', 'id' ),
        			'logo_dark_retina_id' => th90_opt_arr( 'logo_dark_mobile_retina', 'id' ),
        			'logo_svg'            => th90_opt( 'logo_mobile_svg' ),
        			'dark_logo_svg'       => th90_opt( 'logo_dark_mobile_svg' ),
        		) );
                ?>
            </div>
            <div class="header-elements">
                <?php
                if ( TH90_WOOCOMMERCE_IS_ACTIVE && !th90_is_amp() ) {
                    th90_trigger_button( 'cart', array(
            	        'style'   => 'text',
                        'size' => 'large',
            		) );
                }
                th90_trigger_button( 'search', array(
        	        'style' => 'text',
                    'size' => 'large',
        		) );

                th90_trigger_button( 'offcanvas', array(
        	        'style' => 'text',
                    'size' => 'large',
        		) );

                /*echo '<div class="div-vertical"><div class="th90-block block-divider"><div class="divider-inner">-</div></div></div>';

                echo '<div class="current-date"><div class="cur-date"><span class="d">' . wp_date( 'd' ) . '</span><span class="my"><span class="m">' . wp_date( 'M' ) . '</span><span class="y">' . wp_date( 'Y' ) . '</span></span></div></div>';
                */?>
            </div>
        </div>
    </div>
</div>
