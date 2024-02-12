<?php
/**
 * Defined redux framework default options
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	 exit; // Exit if accessed directly
}
/*
 -------------------------------------------------------------------------------
 * Default theme options output
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_default_output' ) ) {
	function th90_default_output() {
		return array(
			/* General */
			'primary_text' => array(
				'body.s-front',
				'.editor-styles-wrapper',
			),
			'second_text' => array(
				'.s-front input[type="checkbox"] + *',
				'.s-front input[type="radio"] + *',
				'.blocks-gallery-caption',
				'.gallery-caption',
				'.wp-caption-text',
				'figcaption',
				'.entry-cats',
				'ul.breadcrumbs',
				'.comment-reply-link',
				'.meta-item',
				'.thumb-count',
				'.ads-heading',
				'.shopping-cart-counter',
				'.woocommerce .onsale',
				'div.product .stock',
				'.woocommerce-result-count',
				'.woocommerce-ordering',
				'#reviews #comments ol.commentlist li .meta .woocommerce-review__published-date',
				'.wp-block-freeform.block-library-rich-text__tinymce dl.wp-caption .wp-caption-dd',
			),
			'font_heading' => array(

			),

			'widget_head_typo' => array(
				'.widget-heading .title',
			),
			'wheading_bg' => array(
				'background-color' => '.wheading-bg .widget-heading .title',
			),
			'wheading_color' => array(
				'color' => '.wheading-bg .widget-heading .title',
			),

			/* Mobile Menu */
			'mobile_menu_typo' => array(
				'ul.nav-mobile',
			),

			/* Post/Article */
			'post_heading_typo' => array(
				'.entry-header-article h1.entry-title',
			),
			'post_excerpt_typo' => array(
				'.single-excerpt',
			),
			'post_content_typo' => array(
				'.comment-form-comment',
				'.article-content',
			),

		);
	}
}
