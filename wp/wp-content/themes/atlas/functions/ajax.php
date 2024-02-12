<?php
/**
 * Block ajax functions
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
--------------------------------------------------------------------------------
* single ajax load next
* ------------------------------------------------------------------------------
*/

if ( ! function_exists( 'th90_single_load_next_redirect' ) ) {
	add_action( 'template_redirect', 'th90_single_load_next_redirect' );
	function th90_single_load_next_redirect() {

		if ( empty( th90_opt( 'single_ajax_post' ) ) ) {
			return;
		}

		global $wp_query;
		if ( ! isset( $wp_query->query_vars['th90_single_ajax'] ) || ! is_single() ) {
			return;
		}

		$file = '/template-parts/article/article-ajax.php';
		$template = locate_template( $file );
		if ( $template ) {
			include( $template );
		}
		exit;
	}
}

/*
--------------------------------------------------------------------------------
* single load next update permalink
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_single_load_next_endpoint' ) ) {
	add_action( 'init', 'th90_single_load_next_endpoint' );
	function th90_single_load_next_endpoint() {
		add_rewrite_endpoint( 'th90_single_ajax', EP_PERMALINK );
		flush_rewrite_rules();
	}
}

/*
--------------------------------------------------------------------------------
* Blocks Ajax Load More
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_blocks_load_more' ) ) {

	add_action( 'wp_ajax_nopriv_th90_blocks_load_more', 'th90_blocks_load_more' );
	add_action( 'wp_ajax_th90_blocks_load_more', 'th90_blocks_load_more' );
	function th90_blocks_load_more() {
		$atts = $_REQUEST['block'];
		$count = 0;

		if ( ! empty( $_REQUEST['page'] ) ) {
			$atts['target_page'] = $_REQUEST['page'];
		}

		if ( ! empty( $atts ) ) {
			foreach ( $atts as $key => $value ) {
				if ( 'false' == $value ) {
					$atts[$key] = false;
				} elseif ( 'true' == $value ) {
					$atts[$key] = true;
				}
			}
		}

		// Run the query ----------
		$query = th90_query( $atts );

		ob_start();

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$count++;
				th90_render_posts_template( $atts, $count, $query );
			}

			$hide_next = $hide_prev = false;

			if ( isset( $query->query_vars['new_max_num_pages'] ) ) {
				if ( $query->query_vars['new_max_num_pages'] == 1 || ( $query->query_vars['new_max_num_pages'] == $query->query_vars['paged'] ) ) {
					$hide_next = true;
				}
			}

			if ( empty( $query->query_vars['paged'] ) || $query->query_vars['paged'] == 1 ) {
				$hide_prev = true;
			}

			wp_send_json( wp_json_encode (
				array(
					'hide_next' => $hide_next,
					'hide_prev' => $hide_prev,
					'code'      => ob_get_clean(),
					'button'    => esc_html__( 'No More', 'atlas' ),
			) ) );
		} else {
			wp_send_json( wp_json_encode (
				array(
					'hide_next' => true,
					'hide_prev' => $hide_prev,
					'code'      => esc_html__( 'No More', 'atlas' ),
					'button'    => esc_html__( 'No More', 'atlas' ),
			) ) );
		}

		die;
	}
}

/*
--------------------------------------------------------------------------------
* Search Ajax
* ------------------------------------------------------------------------------
*/
if( ! function_exists( 'th90_search_ajax' ) ) {
	add_action('wp_ajax_nopriv_th90_search_ajax', 'th90_search_ajax');
	add_action('wp_ajax_th90_search_ajax', 'th90_search_ajax');

	function th90_search_ajax() {
		$supported_post_types = array( 'post' );
		$post_types = th90_opt('search_post_types');
		if ( is_array( $post_types ) && ! empty( $post_types ) ) {
		    $supported_post_types = $post_types;
		}

		$atts = array(
		    'post_type'           => $supported_post_types,
		    'no_found_rows'       => true,
		    'posts_per_page'      => 3,
		    'post_status'         => 'publish',
		    'ignore_sticky_posts' => true,
		    'image_ratio'         => '1_1',
		    'post_info'           => array( 'date' ),
		    'time_format'         => 'modern',
		    'info_position'       => 'bottom',
		    'title_tag'           => '',
		    'post_style'          => 'small',
		);
		$atts = th90_blog_atts_convert( $atts );

		$atts['s'] = $_REQUEST['s'];

		// Run the query ----------
		$query = new WP_Query( $atts );

		ob_start();
		$count = 0;
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$count++;
				get_template_part( 'template-parts/posts/post', 'small1', array(
					'block'     => $atts,
					'count'     => $count,
				) );
			}
			echo '<div class="post-item"><a class="button" href="'. esc_url( home_url('?s=' . urlencode( $atts['s'] ) ) ) .'">'. esc_html__( 'View all results', 'atlas' ) .'</a></div>';

		} else {
			echo '<div class="posts-notfound">' . esc_html__( 'No results found!', 'atlas' ). '</div>';
		}

		wp_send_json( wp_json_encode (
			array(
				'code' => ob_get_clean(),
				'min' => '<div class="posts-notfound">' . esc_html__( 'Enter minimal 3 chars', 'atlas' ) . '</div>',
		) ) );

		die;
	}
}

/*
--------------------------------------------------------------------------------
* Menu Ajax
* ------------------------------------------------------------------------------
*/
if( ! function_exists( 'th90_mega_menu_load_ajax' ) ) {

	add_action('wp_ajax_nopriv_th90_mega_menu_load_ajax', 'th90_mega_menu_load_ajax');
	add_action('wp_ajax_th90_mega_menu_load_ajax', 'th90_mega_menu_load_ajax');
	function th90_mega_menu_load_ajax() {

		$atts = array(
		    'no_found_rows'       => true,
		    'post_status'         => 'publish',
		    'ignore_sticky_posts' => true,
		    'post_info'           => array( 'date', 'review' ),
		    'time_format'         => 'modern',
		    'info_position'       => 'bottom',
		    'title_tag'           => 'small' == $_REQUEST['style'] ? 'h6': 'h5',
			'cat'                 => $_REQUEST['id'],
			'posts_per_page'      => 4,
			'post_style'          => $_REQUEST['style'],
			'image_ratio'         => 'small' == $_REQUEST['style'] ? '1_1': '3_2',
		);
		$atts = th90_blog_atts_convert( $atts );

		// Run the query ----------
		$query = new WP_Query( $atts );

		ob_start();
		$count = 0;
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$count++;
				get_template_part( 'template-parts/posts/post', $_REQUEST['style'] . '1', array(
					'block'     => $atts,
					'count'     => $count,
				) );
			}

		} else {
			echo '<div class="posts-notfound">' . esc_html__( 'No posts found!', 'atlas' ) . '</div>';
		}

		wp_send_json( wp_json_encode (
			array(
				'code' => ob_get_clean(),
		) ) );

		die;
	}

}
