<?php
/**
 * Category functions
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
--------------------------------------------------------------------------------
* Get the Primary category object
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_get_primary_category' ) ) {

	function th90_get_primary_category() {
		$primary_category = '';

		if ( get_post_type() != 'post' ) {
			return;
		}

		// Get the first assigned category ----------

		$get_the_category = get_the_category();

		if( ! empty( $get_the_category[0] ) ){
			$primary_category = array( $get_the_category[0] );
		}

		if ( ! empty( $primary_category ) ) {
			return $primary_category;
		}

	}
}

/*-----------------------------------------------------------------------------------*/
# Get the Primary category id
/*-----------------------------------------------------------------------------------*/
if( ! function_exists( 'th90_get_primary_category_id' )){

	function th90_get_primary_category_id(){

		$primary_category = th90_get_primary_category();

		if ( is_array( $primary_category ) ) {
			if( ! empty( $primary_category[0]->term_id )){
				return $primary_category[0]->term_id;
			}
		} else {
			if( ! empty( $primary_category->term_id )){
				return $primary_category->term_id;
			}
		}
		return false;
	}

}

/*
--------------------------------------------------------------------------------
* Get the post categories HTML
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_get_category' ) ) {

	function th90_get_category( $style = 'btn', $primary = false, $many_cats =  false ) {

		if ( get_post_type() != 'post' ) {
			return;
		}

		$output  = '';

		// If the primary is true ----------
		if ( ! empty( $primary ) ) {
			$cats = th90_get_primary_category();
		} else {
			// Show all post's categories ----------
			$cats = get_the_category();
		}

		// Display the categories ----------
		if ( ! empty( $cats ) && is_array( $cats ) ) {
			$cats_array = array_slice( $cats,0 ,2 );
			if ( $many_cats ) {
				$cats_array = $cats;
			}
			foreach ( $cats_array as $cat ) {
				$add_style = '';
				$output .= '<a class="post-cat info-text cat-' . esc_attr( $style ) . ' post-cat-' . $cat->term_id . '" href="' . esc_url( get_term_link( $cat->term_id, 'category' ) ) . '">';
				$output .= $cat->name;
				$output .='</a>';
			}
		}

		return $output;
	}
}
