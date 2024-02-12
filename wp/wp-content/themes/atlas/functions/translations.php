<?php
/**
 * Theme Translations for deus plugins
 *
 * @package Atlas
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
--------------------------------------------------------------------------------
* Get the translated text
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_translate' ) ) {

	function th90_translate( $text ) {

		$default_text  = th90_texts_translation();

		if ( array_key_exists( $text, $default_text ) ) {
			return $default_text[ $text ];
		} else {
			return $text;
		}
	}
}


/*
--------------------------------------------------------------------------------
* Print the translated text
* ------------------------------------------------------------------------------
*/
if( ! function_exists( 'th90_translate_p' )){

	function th90_translate_p( $text ){
		echo th90_translate( $text );
	}

}

/*
--------------------------------------------------------------------------------
* Translations texts
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_texts_translation' ) ) {

	function th90_texts_translation() {
		return array(
			'By:'         => esc_html__('By:', 'atlas'),
			'Posted By'   => esc_html__('Posted By', 'atlas'),
			'Fans'        => esc_html__('Fans', 'atlas'),
			'Followers'   => esc_html__('Followers', 'atlas'),
			'Subscribers' => esc_html__('Subscribers', 'atlas'),
			'Share'       => esc_html__('Share', 'atlas'),
			'Send'        => esc_html__('Send', 'atlas'),
			'Tweet'       => esc_html__('Tweet', 'atlas'),
			'Pin'         => esc_html__('Pin', 'atlas'),
			'Recent'      => esc_html( 'Recent', 'atlas' ),
			'Popular'     => esc_html( 'Popular', 'atlas' ),
			'Most Views'  => esc_html( 'Most Views', 'atlas' ),
			'Follow Me'   => esc_html( 'Follow Me', 'atlas' ),
		);
	}
}
