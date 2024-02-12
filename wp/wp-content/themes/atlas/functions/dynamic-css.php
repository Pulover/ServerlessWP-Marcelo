<?php
/**
 * Dynamic CSS
 *
 * @package Atlas
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * -----------------------------------------------------------------------------
 *  Dynamic CSS of general elements
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_dynamic_css' ) ) {

	function th90_dynamic_css() {
        $out = '';

		if ( ! empty( th90_opt( 'primary_text') ) || ! empty( th90_opt( 'second_text') ) || ! empty( th90_opt( 'font_heading') ) ) {
			$out .= ':root{';
				if ( ! empty( th90_opt( 'primary_text') ) ) {
					if ( stripos( th90_opt_arr( 'primary_text', 'font-family' ), ',') !== false && stripos( th90_opt_arr( 'primary_text', 'font-family' ), "'") !== false ) {
						$out .= '
							--primary_text-font-family: ' . th90_opt_arr( 'primary_text', 'font-family' ) . ';
						';
					} else {
						$out .= '
							--primary_text-font-family: "' . th90_opt_arr( 'primary_text', 'font-family' ) . '";
						';
					}
					$out .= '
						--primary_text-font-weight: ' . th90_opt_arr( 'primary_text', 'font-weight' ) . ';
						--primary_text-font-style: ' . th90_opt_arr( 'primary_text', 'font-style' ) . ';
						--primary_text-font-size: ' . th90_opt_arr( 'primary_text', 'font-size' ) . ';
						--primary_text-letter-spacing: ' . th90_opt_arr( 'primary_text', 'letter-spacing' ) . ';
						--primary_text-line-height: ' . th90_opt_arr( 'primary_text', 'line-height' ) . ';
					';
				}

				if ( ! empty( th90_opt( 'second_text') ) ) {
					if ( stripos( th90_opt_arr( 'second_text', 'font-family' ), ',') !== false && stripos( th90_opt_arr( 'second_text', 'font-family' ), "'") !== false ) {
						$out .= '
							--second_text-font-family: ' . th90_opt_arr( 'second_text', 'font-family' ) . ';
						';
					} else {
						$out .= '
							--second_text-font-family: "' . th90_opt_arr( 'second_text', 'font-family' ) . '";
						';
					}
					$out .= '
						--second_text-font-weight: ' . th90_opt_arr( 'second_text', 'font-weight' ) . ';
						--second_text-font-style: ' . th90_opt_arr( 'second_text', 'font-style' ) . ';
						--second_text-text-transform: ' . th90_opt_arr( 'second_text', 'text-transform' ) . ';
						--second_text-font-size: ' . th90_opt_arr( 'second_text', 'font-size' ) . ';
						--second_text-letter-spacing: ' . th90_opt_arr( 'second_text', 'letter-spacing' ) . ';
						--second_text-line-height: ' . th90_opt_arr( 'second_text', 'line-height' ) . ';
					';
				}

				if ( ! empty( th90_opt( 'font_heading') ) ) {
					if ( stripos( th90_opt_arr( 'font_heading', 'font-family' ), ',') !== false || stripos( th90_opt_arr( 'font_heading', 'font-family' ), "'") !== false ) {
						$out .= '
							--font_heading-font-family: ' . th90_opt_arr( 'font_heading', 'font-family' ) . ';
						';
					} else {
						$out .= '
							--font_heading-font-family: "' . th90_opt_arr( 'font_heading', 'font-family' ) . '";
						';
					}
					$out .= '
						--font_heading-font-weight: ' . th90_opt_arr( 'font_heading', 'font-weight' ) . ';
						--font_heading-font-style: ' . th90_opt_arr( 'font_heading', 'font-style' ) . ';
						--font_heading-text-transform: ' . th90_opt_arr( 'font_heading', 'text-transform' ) . ';
						--font_heading-line-height: ' . th90_opt_arr( 'font_heading', 'line-height' ) . ';
						--font_heading-letter-spacing: ' . th90_opt_arr( 'font_heading', 'letter-spacing' ) . ';
					';
				}
			$out .= '}';
		}

		foreach ( get_posts() as $single ) {
			if ( th90_field_single( 'review_show' ) && th90_field_single( 'review_color', $single->ID ) ) {
				$out .= '.post-' . $single->ID . ' .box-review {
				    background-image: linear-gradient(to top left, ' . th90_field_single( 'review_color' ) . ' -2500%,#0000 300%);
				}
				.post-' . $single->ID . ' .progress-val {
					background-color: ' . th90_field_single( 'review_color' ) . ';
				}';
    		}
		}
		if ( th90_opt( 'cat_colors' ) ) {
	        foreach ( get_categories() as $cat ) {
	            $cat_color = th90_field_single( 'category_color', 'term_' . $cat->term_id );

	            if ( $cat_color ) {
					$out .= '.cat-' . $cat->term_id . ' .thumb-container .img-char,
					.cat-' . $cat->term_id . ' .cat-btn,
					.term-' . $cat->term_id . ' .thumb-container .img-char,
					.term-' . $cat->term_id . ' .term-box-bg,
					.entry-cats a.cat-btn.post-cat-' . $cat->term_id . ' {
						background-color: ' . $cat_color . ';
					}

					.entry-cats a.cat-text.post-cat-' . $cat->term_id . ' {
						color: ' . $cat_color . ';
					}';
	            }
	        }
		}

        return $out;
    }
}
