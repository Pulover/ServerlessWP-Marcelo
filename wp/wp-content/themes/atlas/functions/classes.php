<?php
/**
 * Classes Element
 *
 * @package Atlas
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
--------------------------------------------------------------------------------
* Get Post Classes
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_get_post_class' ) ) {

	function th90_get_post_class( $classes = false, $post_id = null, $standard = false ) {

		$post = get_post( $post_id );

		if ( $standard ) {
			 $classes = join( ' ', get_post_class( $classes ) );
			 $classes = str_replace( 'hentry', '', $classes );
		}

		// Post Format
		if ( post_type_supports( $post->post_type, 'post-formats' ) ) {

			$post_format = get_post_format( $post->ID );

			if ( ! empty( $classes ) ) {
				$classes .= ' ';
			}

			if ( $post_format && ! is_wp_error( $post_format )  ) {

				$classes .= 'format-' . sanitize_html_class( $post_format );
			} else {

				$classes .= 'format-standard';
			}
		}

		// Sticky
		if ( is_sticky( $post_id ) && is_home() && ! is_paged() ) {

			if ( ! empty( $classes ) ) {
				$classes .= ' ';
			}

			$classes .= 'sticky';
		}

		if ( ! empty( $classes ) ) {
			return $classes;
		}
	}
}

/*
--------------------------------------------------------------------------------
* Print Post Classes
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_post_class' ) ) {

	function th90_post_class( $classes = false, $post_id = null, $standard = false ) {

		$classes = th90_get_post_class( $classes, $post_id, $standard );

		if ( ! empty( $classes ) ) {
			echo 'class="post-layout ' . $classes . '"';
		}
	}
}

/*
--------------------------------------------------------------------------------
* Body classes
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_body_class' ) ) {

	function th90_body_class( $classes ) {

		$post = get_post();
		$classes[] = 's-front';
		$classes[] = ! is_singular() ? 'hfeed' : '';
		$classes[] = 'site-skin';
		$classes[] = 'site-' . th90_opt_override_blank( 'site_skin' );
		$classes[] = 'box-' . th90_opt( 'box_style' );
		$classes[] = ! th90_opt( 'box_active' ) ? 's-nobox' : '';
		$classes[] = 'wheading-' . th90_opt( 'wheading_style' );
		$classes[] = th90_opt( 'wheading_center' ) ? 'center-wheading' : '';
		$classes[] = th90_lazyload_check() ? 'is-lazyload' : '';
		$classes[] = th90_opt( 'skin_trigger' ) ? 'have-skin-trigger' : '';
		$classes[] = th90_is_sticky_header() ? 'sticky-header-active' : '';
		$classes[] = is_singular('post') && th90_opt( 'reading_indicator' ) ? 'reading-indicator-' . th90_opt( 'reading_indicator_pos' ) : '';
		$classes[] = is_singular('post') ? 'linkstyle-' . th90_opt( 'link_content' ) : '';
		$classes[] = th90_opt( 'disable_lazyload_img_placeholder' ) ? 'lazy-no-placeholder' : 'lazy-is-placeholder';
		return $classes;
	}
}
add_filter( 'body_class', 'th90_body_class' );

/*
--------------------------------------------------------------------------------
* Content classes
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_content_class' ) ) {

	function th90_content_class( $class = '' ) {
		$classes = array(
			'site-content',
			! th90_is_builder_page() ? 'is-skin' : '',
			! th90_is_builder_page() ? 'bg-' . th90_opt_override_blank( 'site_skin' ) : '',
			$class,
		);

		echo 'id="content" class="'. implode( ' ', array_filter( $classes ) ) .'"';
	}
}

/*
--------------------------------------------------------------------------------
* Box classes
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_box_class' ) ) {

	function th90_box_class( $atts ) {
		$heading = isset( $atts['_heading_active'] ) && 'yes' == $atts['_heading_active'] ? true : false;
		$class = array();
		$box = isset( $atts['box_active'] ) && 'yes' == $atts['box_active'] ? true : false;

		if ( $box ) {
			$class[] = 'box-wrap';
		} else {
			$class[] = 'box-wrap box-disable';
		}
		if ( $heading ) {
			$class[] = 'have-heading';
		}

		return $class;
	}
}

/*
--------------------------------------------------------------------------------
* Box Active
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_box' ) ) {
	function th90_box( $echo = true ) {
		if ( $echo ) {
			if ( th90_opt( 'box_active' ) ) {
				echo ' box-wrap';
			} else {
				echo ' box-wrap box-disable';
			}
		} else {
			if ( th90_opt( 'box_active' ) ) {
				return ' box-wrap';
			} else {
				return ' box-wrap box-disable';
			}
		}
	}
}
/*
--------------------------------------------------------------------------------
* Box Heading
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_box_heading' ) ) {
	function th90_box_heading( $atts ) {
		$heading = isset( $atts['_heading_active'] ) && 'yes' == $atts['_heading_active'] ? true : false;

		if ( $heading ) {
			?>
			<div class="widget-heading">
				<h4 class="title"><?php echo esc_html( $atts['_heading'] ); ?></h4>
				<?php
				if ( ( isset( $atts['_sort'] ) && 'yes' == $atts['_sort'] ) || ( isset( $atts['_heading_nav'] ) && $atts['_heading_nav'] ) || ( $atts['_heading_viewall'] ) ) {
					?>
					<div class="heading-elm">
						<?php
						/* Render Module Sort */
						if ( isset( $atts['_sort'] ) && 'yes' == $atts['_sort'] ) {
							$atts['orderby'] = 'date';
							?>
							<div class="module-sorts">
								<a href="#" data-sort="date" class="module-sort active"><?php esc_html_e( 'Recent', 'atlas' ); ?></a>
								<?php if ( 'yes' == $atts['_sort_popular'] ): ?>
									<a href="#" data-sort="popular" class="module-sort"><?php esc_html_e( 'Popular', 'atlas' ); ?></a>
								<?php endif; ?>
								<?php if ( 'yes' == $atts['_sort_views'] ): ?>
									<a href="#" data-sort="views" class="module-sort"><?php esc_html_e( 'Most Views', 'atlas' ); ?></a>
								<?php endif; ?>
								<?php if ( 'yes' == $atts['_sort_reviews'] ): ?>
									<a href="#" data-sort="best" class="module-sort"><?php esc_html_e( 'Best Reviews', 'atlas' ); ?></a>
								<?php endif; ?>
							</div>
							<?php
						}

						/* Render Slider Arrow */
						if ( isset( $atts['_heading_nav'] ) && $atts['_heading_nav'] ) {
							echo '<div class="slider-arrow"></div>';
						}

						/* Render Show More */
						if ( $atts['_heading_viewall'] ) {
							if ( ! empty( $atts['_heading_viewall_url']['url'] ) ) {
				                $link_atts = array();
				                $link_atts['class'] = 'viewAll';

				        		$allowed_protocols = array_merge( wp_allowed_protocols(), [ 'skype', 'viber' ] );
				                $link_atts['href'] = esc_url( $atts['_heading_viewall_url']['url'], $allowed_protocols );

				                if ( ! empty( $atts['_heading_viewall_url']['is_external'] ) ) {
				                    $link_atts['target'] = '_blank';
				                }
				                if ( ! empty( $atts['_heading_viewall_url']['nofollow'] ) ) {
				                    $link_atts['rel'] = 'nofollow';
				                }
				                ?>
				                <a <?php echo th90_stringify_attributes( $link_atts ); ?>>
									<?php echo esc_html( $atts['_heading_viewall'] ); ?>
								</a>
				                <?php
				            } else {
								?>
								<div class="viewAll">
									<?php echo esc_html( $atts['_heading_viewall'] ); ?>
								</div>
								<?php
							}
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}
