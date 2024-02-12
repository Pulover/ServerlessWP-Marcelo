<?php
/**
 * Default Footer
 *
 * @package Atlas
 */

$classes = array(
    'footer-section',
    'is-skin',
    'bg-' . th90_opt_override_blank( 'site_skin' ),
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
    <div class="container">
        <div class="section-inner">
            <?php echo '<div class="default-copyright">' . do_shortcode( th90_opt( 'copyright_text' ) ) . '</div>'; ?>
            <?php
            if ( th90_opt( 'scroll_top' ) && th90_is_amp() ) {
                th90_trigger_button( 'totop', array(
					'content'     	=> 'icon',
					'style'       	=> 'white',
					'size'        	=> 'tiny',
				) );
            }
            ?>
        </div>
    </div>
</div>
