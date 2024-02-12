<?php
/**
 * Logo functions
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * -----------------------------------------------------------------------------
 *  Logo
 * -----------------------------------------------------------------------------
 */
 if ( ! function_exists( 'th90_logo' ) ) {
 	function th90_logo( $atts = array() ) {

		$atts = wp_parse_args( $atts, array(
			'logo_type'           => th90_opt( 'logo_type' ),
			'logo_id'             => th90_opt_arr( 'logo', 'id' ),
			'logo_retina_id'      => th90_opt_arr( 'logo_retina', 'id' ),
			'logo_dark_id'        => th90_opt_arr( 'logo_dark', 'id' ),
			'logo_dark_retina_id' => th90_opt_arr( 'logo_dark_retina', 'id' ),
			'logo_svg'            => th90_opt( 'logo_svg' ),
			'dark_logo_svg'       => th90_opt( 'logo_dark_svg' ),
			'logo_text'           => get_bloginfo( 'name' ),
			'link'                => 'href="' . esc_url( home_url( '/' ) ) . '"',
		) );

		$logo_attr = array(
			'class' => 'logo-img',
			'alt' => esc_attr( get_bloginfo( 'name' ) ),
		);

		if ( 'image' == $atts['logo_type'] ) {
			if ( $atts['logo_id'] ) {
				$logo = wp_get_attachment_image_src( $atts['logo_id'], 'full' );
				$logo_attr['src'] = esc_url( $logo[0] );
				$logo_attr['width'] = absint( $logo[1] );
				$logo_attr['height'] = absint( $logo[2] );

				if ( $atts['logo_retina_id'] ) {
					$logo_retina = wp_get_attachment_image_src( $atts['logo_retina_id'], 'full' );
					$logo_attr['srcset'] = esc_url( $logo[0] ) . ' 1x, ' . esc_url( $logo_retina[0] ) . ' 2x';
				}

				echo '<a ' . $atts['link'] . ' class="logo-site logo" title="' . esc_attr( get_bloginfo( 'name' ) ) . '"><img ' . th90_stringify_attributes( $logo_attr ) . '></a>';
			}
			if ( $atts['logo_dark_id'] ) {
				$logo = wp_get_attachment_image_src( $atts['logo_dark_id'], 'full' );
				$logo_attr['src'] = esc_url( $logo[0] );
				$logo_attr['width'] = absint( $logo[1] );
				$logo_attr['height'] = absint( $logo[2] );

				if ( $atts['logo_dark_retina_id'] ) {
					$logo_retina = wp_get_attachment_image_src( $atts['logo_dark_retina_id'], 'full' );
					$logo_attr['srcset'] = esc_url( $logo[0] ) . ' 1x, ' . esc_url( $logo_retina[0] ) . ' 2x';
				}

				echo '<a ' . $atts['link'] . ' class="logo-site logo_dark" title="' . esc_attr( get_bloginfo( 'name' ) ) . '"><img ' . th90_stringify_attributes( $logo_attr ) . '></a>';
			}
		} elseif ( 'svg' == $atts['logo_type'] ) {
			if ( $atts['logo_svg'] ) {
				echo '<a ' . $atts['link'] . ' class="logo-site logo-site-svg logo" title="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . $atts['logo_svg'] . '</a>';
			}
			if ( $atts['dark_logo_svg'] ) {
				echo '<a ' . $atts['link'] . ' class="logo-site logo-site-svg logo_dark" title="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . $atts['dark_logo_svg'] . '</a>';
			}
		} else {
			echo '<a ' . $atts['link'] . ' class="logo-site logo-site-text" title="' . esc_attr( get_bloginfo( 'name' ) ) . '"><span class="logo-text">' . $atts['logo_text'] . '</span>' . '</a>';
		}
 	}
 }
