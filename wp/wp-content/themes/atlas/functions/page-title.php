<?php
/**
 * Page Title
 *
 * @package Atlas
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'th90_page_title' ) ) {

	function th90_page_title( $tag = 'h1', $echo = false ) {
		$title = get_the_title();
		$prefix = $subtitle = $title_out = '';

		if ( is_tag() ) {
			$subtitle = esc_html__( 'Browsing Tag', 'atlas' );
			$title = single_tag_title( '', false );
		} elseif ( is_category() ) {
			$subtitle = esc_html__( 'Browsing Category', 'atlas' );
			$title = single_cat_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_day() ) {
			$prefix = esc_html__( 'Day:', 'atlas' );
			$title = get_the_date( esc_html__( 'F j, Y', 'atlas' ) );
		} elseif ( is_month() ) {
			$prefix = esc_html__( 'Month:', 'atlas' );
			$title = get_the_date( esc_html__( 'F Y', 'atlas' ) );
		} elseif ( is_year() ) {
			$prefix = esc_html__( 'Year:', 'atlas' );
			$title = get_the_date( esc_html__( 'Y', 'atlas' ) ) ;
		} elseif ( is_search() ) {
			global $wp_query;
			$posts_found = $wp_query->found_posts;
			$subtitle = sprintf(
				esc_html__( '%1$s results for', 'atlas' ),
				$posts_found,
			);
			$title = esc_html__( 'Results for', 'atlas' ) . '&nbsp;&apos;' . get_search_query() . '&apos;';

		} elseif ( is_tax( 'post_format' ) ) {
			 if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				 $title = esc_html__( 'Asides', 'atlas' );
			 } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				 $title = esc_html__( 'Galleries', 'atlas' );
			 } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				 $title = esc_html__( 'Images', 'atlas' );
			 } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				 $title = esc_html__( 'Videos', 'atlas' );
			 } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				 $title = esc_html__( 'Quotes', 'atlas' );
			 } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				 $title = esc_html__( 'Links', 'atlas' );
			 } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				 $title = esc_html__( 'Statuses', 'atlas' );
			 } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				 $title = esc_html__( 'Audio', 'atlas' );
			 } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				 $title = esc_html__( 'Chats', 'atlas' );
			 }
		 } elseif ( get_post_taxonomies() ) {
			 if ( th90_woo_check_page( 'is_shop' ) ) {
				/* Woocommerce shop title */
				$title = esc_html__( 'Shop', 'atlas' );
			} else {
				$title = single_cat_title( '', false );
			}
		} elseif ( is_post_type_archive() ) {
			$prefix = esc_html__( 'Archives:', 'atlas' );
			$title  = post_type_archive_title( '', false );

		} elseif ( is_tax() ) {
			$queried_object = get_queried_object();
			if ( $queried_object ) {
				$tax    = get_taxonomy( $queried_object->taxonomy );
				$title  = single_term_title( '', false );
				$prefix = sprintf(
					/* translators: %s: Taxonomy singular name. */
					esc_html__( '%s:', 'atlas' ),
					$tax->labels->singular_name
				);
			}
		}

		if ( $prefix ) {
			$title = $prefix . ' ' . $title;
		}

		$title_out .= '<' . $tag . ' class="page-heading">' . $title . '</' . $tag . '>';

		if ( $echo ) {
			echo wp_kses_post( $title_out );
		} else {
			return $title_out;
		}
	}
}
