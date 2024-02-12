<?php
/**
 * Advertisement
 *
 * @package Atlas
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Render Ads */
if( ! function_exists( 'th90_render_ads' ) ) {
	function th90_render_ads( $ads_id ) {
		if ( $ads_id ) {
			if ( th90_field_single( 'ad_activate', $ads_id ) ) {
				$ads_args = array(
					'b_heading' => th90_field_single( 'ad_title', $ads_id ),
					'b_type' => th90_field_single( 'ad_type', $ads_id ),
					'b_link' => array(
						'url' => th90_field_single( 'ad_url', $ads_id ),
						'is_external' => th90_field_single( 'ad_new_window', $ads_id ),
						'nofollow' => th90_field_single( 'ad_nofollow', $ads_id ),
					),
					'b_image' => array(
						'id' => th90_field_single( 'ad_image', $ads_id ),
					),
					'b_codes' => th90_field_single( 'ad_codes', $ads_id ),
				);
				get_template_part( 'template-parts/banner', '', array(
					'block' => $ads_args,
				) );
			}
		}
	}
}

/* Ads article before */
add_action( 'th90_above_post', function() {
    $ads_article_before = th90_opt( 'ads_article_before' );
    if ( $ads_article_before ) {
		echo '<div class="adv ads-post-before">';
        	th90_render_ads( $ads_article_before );
		echo '</div>';
    }
}, 1 );

/*  Ads article after */
add_action( 'th90_below_post', function() {
	$ads_article_after = th90_opt( 'ads_article_after' );
    if ( $ads_article_after ) {
		echo '<div class="adv ads-post-after">';
        	th90_render_ads( $ads_article_after );
		echo '</div>';
    }
}, 1 );

/*  Ads between article ajax */
add_action( 'th90_between_ajax_post', function() {
	$ads_article_ajax = th90_opt( 'ads_article_ajax' );
    if ( $ads_article_ajax ) {
		echo '<div class="container ads-post-ajax">';
			echo '<div class="section-inner">';
				echo '<div class="adv">';
		        	th90_render_ads( $ads_article_ajax );
				echo '</div>';
			echo '</div>';
		echo '</div>';
    }
}, 1 );

/* Floating Ads */
if ( ! function_exists( 'th90_ads_side_site' ) ) {
	function th90_ads_side_site() {
		if ( ! th90_is_amp() ) {
			$ads_left_site = th90_opt( 'ads_left_site' );
			$ads_right_site = th90_opt( 'ads_right_site' );

		    if ( $ads_left_site || $ads_right_site ) {
				echo '<div class="hook-param"></div>';
			}

			/* Ads Left */
		    if ( $ads_left_site ) {
				echo '<div class="adv hook-left hook-side">';
		        	th90_render_ads( $ads_left_site );
				echo '</div>';
		    }

			/* Ads Right */
		    if ( $ads_right_site ) {
				echo '<div class="adv hook-right hook-side">';
		        	th90_render_ads( $ads_right_site );
				echo '</div>';
		    }
		}
    }
}
add_action( 'wp_footer', 'th90_ads_side_site' );
