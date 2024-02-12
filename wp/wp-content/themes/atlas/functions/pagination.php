<?php
/**
 * Pagination
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
--------------------------------------------------------------------------------
* Numeric Navigation
* Based on WP-PageNavi plugin - by Lester 'GaMerZ' Chan - http://lesterchan.net
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_numeric_pagination' ) ) {

	function th90_numeric_pagination( $query = false, $before = '', $after = '' ) {

		if ( is_single() && ! is_admin()) {
            return;
		}

		if ( ! empty( $query ) ) {
			$request = $query->request;
			$numposts = ! empty( $query->query_vars['new_found_posts'] ) ? $query->query_vars['new_found_posts']   : $query->found_posts;
			$max_page = ! empty( $query->query_vars['new_max_num_pages'] ) ? $query->query_vars['new_max_num_pages'] : $query->max_num_pages;
			$posts_per_page = intval( $query->query_vars['posts_per_page'] );
		} else {
			global $wp_query;

			if ( $wp_query->max_num_pages <= 1 ) {
                return;
			}

			$request 		  = $wp_query->request;
			$numposts 		  = $wp_query->found_posts;
			$max_page 		  = $wp_query->max_num_pages;
			$posts_per_page = intval( get_query_var( 'posts_per_page' ) );
		}

		$pagenavi_options = array();
		$pagenavi_options['current_text']	 = '%PAGE_NUMBER%';
		$pagenavi_options['page_text']		 = '%PAGE_NUMBER%';
		$pagenavi_options['first_text'] 	 = th90_get_svg_icon( is_rtl() ? 'arrow-right-double' : 'arrow-left-double' );
		$pagenavi_options['last_text'] 		 = th90_get_svg_icon( is_rtl() ? 'arrow-left-double' : 'arrow-right-double' );
		$pagenavi_options['next_text'] 		 = th90_get_svg_icon( is_rtl() ? 'arrow-left' : 'arrow-right' );
		$pagenavi_options['prev_text'] 		 = th90_get_svg_icon( is_rtl() ? 'arrow-right' : 'arrow-left' );
		$pagenavi_options['larger_page_numbers_multiple'] = 10;

		$paged   = intval( get_query_var( 'paged' ) );
		$paged_2 = intval( get_query_var( 'page' ) );

		if ( empty( $paged ) && ! empty( $paged_2 ) ) {
			$paged = $paged_2;
		}

		if ( empty( $paged ) || $paged == 0 ) {
			$paged = 1;
		}

		$pages_to_show         = ($max_page > 20 ) ? 3 : 3;
		$larger_page_to_show   = 2;
		$larger_page_multiple  = 10;
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start       = floor( $pages_to_show_minus_1 / 2 );
		$half_page_end         = ceil( $pages_to_show_minus_1 / 2 );
		$start_page            = $paged - $half_page_start;
		$show_long_pages       = false;

		if ( $start_page <= 0 ) {
			$start_page = 1;
		}

		$end_page = $paged + $half_page_end;
		if ( ($end_page - $start_page) != $pages_to_show_minus_1 ) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}

		if ( $end_page > $max_page ) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page   = $max_page;
		}

		if ( $start_page <= 0 ) {
			$start_page = 1;
		}

		$larger_per_page         = $larger_page_to_show * $larger_page_multiple;
		$larger_start_page_start = ( th90_nav_n_round( $start_page, 10 ) + $larger_page_multiple ) - $larger_per_page;
		$larger_start_page_end   = th90_nav_n_round( $start_page, 10 ) + $larger_page_multiple;
		$larger_end_page_start   = th90_nav_n_round( $end_page, 10 ) + $larger_page_multiple;
		$larger_end_page_end     = th90_nav_n_round( $end_page, 10 ) + ( $larger_per_page );

		if ( $larger_start_page_end - $larger_page_multiple == $start_page ) {
			$larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
			$larger_start_page_end   = $larger_start_page_end - $larger_page_multiple;
		}

		if ( $larger_start_page_start <= 0 ) {
			$larger_start_page_start = $larger_page_multiple;
		}

		if ( $larger_start_page_end > $max_page ) {
			$larger_start_page_end = $max_page;
		}

		if ( $larger_end_page_end > $max_page ) {
			$larger_end_page_end = $max_page;
		}

		if ( $max_page > 1 ) {

			echo wp_kses_post( $before );

			echo '<nav class="pages-numbers pagination">' . "\n";

			if ( $start_page >= 2 && $pages_to_show < $max_page ) {
				echo '<a class="pagi-item pagi-item-first" aria-label="First" href="' . esc_url( get_pagenum_link() ) . '">' . $pagenavi_options['first_text'] . '</a>';
				echo '<span class="pagi-item pagi-item-dot">' . th90_get_svg_icon( 'three-dots' ) . '</span>';
			}

			if ( $show_long_pages && $larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page ) {
				for ( $i = $larger_start_page_start; $i < $larger_start_page_end; $i += $larger_page_multiple ) {
					$page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $pagenavi_options['page_text'] );
					echo '<a class="pagi-item" href="' . esc_url( get_pagenum_link( $i ) ) . '" title="' . $page_text . '">' . $page_text . '</a>';
				}
			}

			if ( get_previous_posts_link( '' ) ) {
				echo get_previous_posts_link( $pagenavi_options['prev_text'] );
			}

			for ( $i = $start_page; $i <= $end_page; $i++ ) {
				if ( $i == $paged ) {
					$current_page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $pagenavi_options['current_text'] );
					echo '<span class="pagi-item pagi-item-current">' . $current_page_text . '</span>';
				} else {
					$page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $pagenavi_options['page_text'] );
					echo '<a class="pagi-item" href="' . esc_url( get_pagenum_link( $i ) ) . '" title="' . $page_text . '">' . $page_text . '</a>';
				}
			}

			if ( get_next_posts_link( '' ) ) {
				echo get_next_posts_link( $pagenavi_options['next_text'] );
			}

			if ( $show_long_pages && $larger_page_to_show > 0 && $larger_end_page_start < $max_page ) {
				for ( $i = $larger_end_page_start; $i <= $larger_end_page_end; $i += $larger_page_multiple ) {
					$page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $pagenavi_options['page_text'] );
					echo '<a class="pagi-item" href="' . esc_url( get_pagenum_link( $i ) ) . '" title="' . $page_text . '">' . $page_text . '</a>';
				}
			}

			if ( $end_page < $max_page ) {
				echo '<span class="pagi-item pagi-item-dot">' . th90_get_svg_icon( 'three-dots' ) . '</span>';
				echo '<a class="pagi-item pagi-item-last" aria-label="Last" href="' . esc_url( get_pagenum_link( $max_page ) ) . '">' . $pagenavi_options['last_text'] . '</a>';
			}

			echo '</nav>' . "\n";

			echo wp_kses_post( $after );
		}
	}
}

/*
--------------------------------------------------------------------------------
* Add class to nav next/prev
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_nav_n_round' ) ) {
	function th90_posts_link_prev_attributes() {
	    return 'class="pagi-item pagi-item-prev" aria-label="Prev"';
	}
	add_filter('previous_posts_link_attributes', 'th90_posts_link_prev_attributes');
}

if ( ! function_exists( 'th90_nav_n_round' ) ) {
	function th90_posts_link_next_attributes() {
	    return 'class="pagi-item pagi-item-next" aria-label="Next"';
	}
	add_filter('next_posts_link_attributes', 'th90_posts_link_next_attributes');
}

/*
--------------------------------------------------------------------------------
* Round To The Nearest Value
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_nav_n_round' ) ) {

	function th90_nav_n_round( $num, $tonearest ) {
		return floor( $num / $tonearest ) * $tonearest;
	}
}
?>
