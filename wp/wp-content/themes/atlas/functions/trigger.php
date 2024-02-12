<?php
/**
 * Trigger Elements functions
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * -----------------------------------------------------------------------------
 *  Button Trigger
 * -----------------------------------------------------------------------------
 */
if( ! function_exists( 'th90_trigger_button' ) ) {

	function th90_trigger_button( $trigger = 'search', $atts = array() ) {
		if ( 'search' == $trigger ) {
			$trigger_class = 'search-trigger';
			$trigger_icon = 'search';
			$trigger_text = esc_html( 'Search', 'atlas' );
		} elseif ( 'social' == $trigger ) {
			$trigger_class = 'social-trigger';
			$trigger_icon = 'share';
			$trigger_text = esc_html( 'Follow', 'atlas' );
		} elseif ( 'offcanvas' == $trigger ) {
			$trigger_class = 'offcanvas-trigger';
			$trigger_icon = isset( $atts['icon_offcanvas'] ) ? $atts['icon_offcanvas'] : 'menu';
			$trigger_text = esc_html( 'Menu', 'atlas' );
		} elseif ( 'cart' == $trigger ) {
			$trigger_class = 'cart-trigger';
			$trigger_icon = 'cart';
			$trigger_text = esc_html( 'Cart', 'atlas' );
		} elseif ( 'totop' == $trigger ) {
			$trigger_class = 'totop-trigger';
			$trigger_icon = 'arrow_up_long';
			$trigger_text = esc_html( 'Top', 'atlas' );
		} elseif ( 'dark' == $trigger ) {
			$trigger_class = 'skin-trigger trigger-dark';
			$trigger_icon = 'moon';
			$trigger_text = esc_html( 'Dark', 'atlas' );
		} elseif ( 'light' == $trigger ) {
			$trigger_class = 'skin-trigger trigger-light';
			$trigger_icon = 'sun';
			$trigger_text = esc_html( 'Light', 'atlas' );
		}

        // Defaults ----------
		$atts = wp_parse_args( $atts, array(
			'content'     	=> 'icon',
	        'style'       	=> 'text',
	        'size'        	=> 'medium',
	        'custom_icon' 	=> '',
			'custom_text'   => '',
			'add_class'		=> '',
			'icon_pos'		=> 'left',
		) );

		$classes = array(
			$trigger_class,
			'button',
			'icon' == $atts['content'] ? 'btn-content_icon' : '',
			'icon_text' == $atts['content'] ? 'icon-' .  $atts['icon_pos'] : '',
			$atts['size'] ? 'btn-' . $atts['size'] : '',
			$atts['style'] ? 'btn-' . $atts['style'] : '',
			$atts['add_class'],
		);
		if ( th90_is_amp() ) {
			if ( 'search' == $trigger ) {
				?>
				<a href="<?php echo esc_url( home_url( '/?s' ) ); ?>" title="<?php echo esc_attr( 'Search', 'atlas' ); ?>" class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
				<?php
			} elseif ( 'offcanvas' == $trigger ) {
				?>
				<div on="tap:amp-menu-section.toggle" tabindex="0" class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
				<?php
			} elseif ( 'totop' == $trigger ) {
				?>
				<div on="tap:page.scrollTo(duration=300)" class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
				<?php
			}
		} else {
			if ( 'cart' == $trigger && TH90_WOOCOMMERCE_IS_ACTIVE ) {
				?>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr( 'Cart', 'atlas' ); ?>" class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
				<?php
			} else {
				?>
				<div class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
				<?php
			}
		}


        if ( 'text' != $atts['content'] ) {
            if ( $atts['custom_icon'] ) {
                th90_svg_icon_custom( $atts['custom_icon'] );
            } else {
				th90_svg_icon( $trigger_icon );
            }
        }
        if ( 'icon' != $atts['content'] ) {
			if ( $atts['custom_text'] ) {
                echo '<span class="text-btn">' . $atts['custom_text'] . '</span>';
            } else {
                echo '<span class="text-btn">' . $trigger_text . '</span>';
            }
        }

		if ( th90_is_amp() ) {
			if ( 'search' == $trigger ) {
				?>
				</a>
				<?php
			} elseif ( 'offcanvas' == $trigger || 'totop' == $trigger ) {
				?>
				</div>
				<?php
			}
		} else {
			if ( 'cart' == $trigger && TH90_WOOCOMMERCE_IS_ACTIVE ) {
				if ( is_object( WC()->cart ) ) {
				?>
					<span class="shopping-cart-counter count-<?php echo absint( WC()->cart->get_cart_contents_count() ); ?>">
						<?php echo absint( WC()->cart->get_cart_contents_count() ); ?>
					</span>
				<?php } ?>
				</a>
				<?php
			} else {
				?>
				</div>
				<?php
			}
		}
    }
}
