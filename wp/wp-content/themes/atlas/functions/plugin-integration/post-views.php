<?php
/**
 * Post Views Counter integration
 *
 * @package Atlas Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	 exit; // Exit if accessed directly
}

if ( TH90_POSTVIEWS_IS_ACTIVE ) {

	if( ! function_exists( 'th90_post_views_position' ) ){
		function th90_post_views_position() {
			return 'manual';
		}
	}
	add_filter( 'pvc_shortcode_filter_hook', 'th90_post_views_position');

	if ( ! function_exists( 'th90_post_views_dequeue' ) ) {

		function th90_post_views_dequeue() {

			wp_dequeue_style( 'dashicons' );
			wp_dequeue_style( 'post-views-counter-frontend' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'th90_post_views_dequeue' );
}
