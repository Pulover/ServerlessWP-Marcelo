<?php
/**
 * Default Header
 *
 * @package Atlas
 */

$header_classes = array(
    'header-section',
    'is-skin',
    'bg-' . th90_opt_override_blank( 'site_skin' ),
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_filter( $header_classes ) ) ); ?>">
    <div class="container">
        <div class="section-inner<?php echo esc_attr( th90_box() ); ?>">
            <div class="header-elements header-logo menuhover-default">
                <?php
                th90_trigger_button( 'offcanvas', array(
        	        'style'   => 'text',
        		) );
                th90_logo();
                get_template_part( 'template-parts/header/navigation', 'main', array(
                    'menu_parent_indicator' => true,
                    'div_icon_active' => false,
                    'div_icon' => '',
                ) );
                ?>
            </div>
            <div class="header-elements">
                <?php
                if ( TH90_WOOCOMMERCE_IS_ACTIVE ) {
                    th90_trigger_button( 'cart', array(
            	        'style'   => 'text',
                        'size' => 'large',
            		) );
                }
                th90_trigger_button( 'search', array(
        	        'style' => 'text',
                    'size' => 'large',
        		) );

                echo '<div class="div-vertical"><div class="th90-block block-divider"><div class="divider-inner">-</div></div></div>';

                echo '<div class="current-date"><div class="cur-date"><span class="d">' . wp_date( 'd' ) . '</span><span class="my"><span class="m">' . wp_date( 'M' ) . '</span><span class="y">' . wp_date( 'Y' ) . '</span></span></div></div>';
                ?>
            </div>
        </div>
    </div>
</div>
