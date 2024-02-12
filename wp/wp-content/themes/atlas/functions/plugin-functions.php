<?php
/**
 * Function from plugins
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'th90_social_shares' ) ) {
    function th90_social_shares( $args = '' ) {
        if ( TH90_ATLAS_CORE_ACTIVE ) {
            return th90_core_social_shares( $args );
        }
        return;
    }
}

if ( ! function_exists( 'th90_the_social_shares' ) ) {
    function th90_the_social_shares( $args = '' ) {
        if ( TH90_ATLAS_CORE_ACTIVE ) {
            return th90_core_the_social_shares( $args );
        }
        return;
    }
}

if ( ! function_exists( 'th90_the_add_lazyload' ) ) {
    function th90_the_add_lazyload( $img_html, $img_id = null ) {
        if ( TH90_ATLAS_CORE_ACTIVE ) {
            return th90_core_the_add_lazyload( $img_html, $img_id );
        }
        return;
    }
}

if ( ! function_exists( 'th90_the_add_lazyload_iframe' ) ) {
    function th90_the_add_lazyload_iframe( $iframe_html ) {
        if ( TH90_ATLAS_CORE_ACTIVE ) {
            return th90_core_the_add_lazyload_iframe( $iframe_html );
        }
        return;
    }
}
