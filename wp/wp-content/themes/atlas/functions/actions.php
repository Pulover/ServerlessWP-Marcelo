<?php
/**
 * Site Actions
 *
 * @package Atlas
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
--------------------------------------------------------------------------------
* Footer Actions
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_footer_actions' ) ) {
	function th90_footer_actions() {
		if ( ! th90_is_amp() ) {
			get_template_part( 'template-parts/popup', 'search' );

			get_template_part( 'template-parts/offcanvas' );

			th90_breadcrumbs();

			if( is_singular('post') && th90_opt( 'reading_indicator' ) ) {
		        echo '<div class="reading-indicator"></div>';
		    }

		} else {
			get_template_part( 'template-parts/amp', 'menu' );
		}
    }
}
add_action( 'wp_footer', 'th90_footer_actions' );

if ( ! function_exists( 'th90_site_footer_actions' ) ) {
	function th90_site_footer_actions() {
		if ( ! th90_is_amp() ) {

			/* Scroll to Top */
			if ( th90_opt( 'scroll_top' ) ) {
				echo '<div class="fly-trigger totop-fly">';
					th90_trigger_button( 'totop', array(
						'content'     	=> 'icon',
				        'style'       	=> 'white',
				        'size'        	=> 'tiny',
					) );
				echo '</div>';
			}

			/* Skin Switcher */
			if ( th90_opt( 'skin_switcher' ) && 'light' == th90_opt_override_blank( 'site_skin' ) ) {
				echo '<div class="fly-trigger skin-fly">';
					echo '<div class="skin-btn">';
						th90_trigger_button( 'dark', array(
					        'style'       	=> 'color',
					        'size'        	=> 'tiny',
						) );
						th90_trigger_button( 'light', array(
					        'style'       	=> 'color',
					        'size'        	=> 'tiny',
						) );
					echo '</div>';
				echo '</div>';
			}
		}
    }
}
add_action( 'th90_site_footer', 'th90_site_footer_actions' );

/**
 * -------------------------------------------------------------------------
 *  Body Open Actions
 * -------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_body_open_actions' ) ) {
	function th90_body_open_actions() {}
}
add_action( 'wp_body_open', 'th90_body_open_actions' );
