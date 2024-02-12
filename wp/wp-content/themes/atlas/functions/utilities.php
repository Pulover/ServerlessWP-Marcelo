<?php
/**
 * Utilities
 *
 * @package Atlas
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
--------------------------------------------------------------------------------
* Convert Tag
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_convert_tag' ) ) {
	function th90_convert_tag( $tag ) {
		return str_replace( 'h', 'head', $tag );
	}
}

/*
--------------------------------------------------------------------------------
* Check sticky header
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_is_sticky_header' ) ) {
	function th90_is_sticky_header() {
		$sticky = th90_opt( 'sticky_behaviour' );

		if ( ! $sticky || 'disable' == $sticky || 'no' == $sticky || false == $sticky ) {
			return;
		}

		return $sticky;
	}
}
/*
--------------------------------------------------------------------------------
* Elementor Post Builer CSS array
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_elementor_posts_css' ) ) {
	function th90_elementor_posts_css() {
		global $wp_styles;

		$elementor_css = array();
		foreach( $wp_styles->queue as $handle ){
			if ( strpos( $handle, 'elementor-post' ) === 0 ) {
				$elementor_css[] = $handle;
			}
		}

		$out = array();
		foreach ( $elementor_css as $handle ) {
			$src = $wp_styles->registered[$handle]->src;

			if ( empty( $src ) ) {
				continue;
			}

			if ( ! preg_match( '|^(https?:)?//|', $src ) && ! ( $wp_styles->content_url && 0 === strpos( $src, $wp_styles->content_url ) ) ) {
				$src = $wp_styles->base_url . $src;
			}

			$out[] = $src;
		}

		return $out;
	}
}

/*
--------------------------------------------------------------------------------
* Display Elementor Content
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_display_elementor_content' ) ) {
	function th90_display_elementor_content( $post_id ) {
		if ( ! class_exists('Elementor\Plugin') || th90_is_amp() ){
	        return;
	    }

		$pluginElementor = \Elementor\Plugin::instance();
	    $response = $pluginElementor->frontend->get_builder_content_for_display($post_id);

	    return $response;
	}
}

/*
--------------------------------------------------------------------------------
* SVG codes sanitize
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_kses_extended_svg' ) ) {
	function th90_kses_extended_svg() {
	    $kses_defaults = wp_kses_allowed_html( 'post' );

	    $svg_args = array(
	        'svg'   => array(
	            'class'           => true,
	            'aria-hidden'     => true,
	            'aria-labelledby' => true,
	            'role'            => true,
				'fill'            => true,
	            'xmlns'           => true,
	            'width'           => true,
	            'height'          => true,
	            'viewbox'         => true, // <= Must be lower case!
	        ),
	        'g'     => array( 'fill' => true ),
	        'title' => array( 'title' => true ),
	        'path'  => array(
	            'd'    => true,
	            'fill' => true,
	        ),
	    );
	    return array_merge( $kses_defaults, $svg_args );
	}
}
/*
--------------------------------------------------------------------------------
* check AMP
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_is_amp' ) ) {
	function th90_is_amp() {
		return function_exists( 'amp_is_request' ) && amp_is_request();
	}
}

/**
 * -----------------------------------------------------------------------------
 *  Detect Woocommerce archive pages
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_woo_check' ) ) {
	function th90_woo_check() {
		if ( TH90_WOOCOMMERCE_IS_ACTIVE ) {
			if ( is_woocommerce() ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}

/**
 * -----------------------------------------------------------------------------
 *  Detect Woocommerce pages
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_woo_check_pages' ) ) {
	function th90_woo_check_pages() {
		if ( TH90_WOOCOMMERCE_IS_ACTIVE ) {
			if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}

/**
 * -----------------------------------------------------------------------------
 *  Detect Woocommerce page
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_woo_check_page' ) ) {
	function th90_woo_check_page( $is_page = false ) {
		if ( TH90_WOOCOMMERCE_IS_ACTIVE ) {
			$page = false;
			if ( 'is_shop' === $is_page ) {
				$page = is_shop();
			} elseif ( 'is_product' === $is_page ) {
				$page = is_product();
			} elseif ( 'is_product_category' === $is_page ) {
				$page = is_product_category();
			} elseif ( 'is_product_tag' === $is_page ) {
				$page = is_product_tag();
			}
			if ( $page ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}

/*
--------------------------------------------------------------------------------
* check if is elementor builder template
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_is_builder_page' ) ) {
	function th90_is_builder_page() {
		if ( is_page_template( 'page-front.php' ) ) {
			return true;
		}
		return;
	}
}

/*
--------------------------------------------------------------------------------
* Name to ID
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_convert_to_id' ) ) {
	function th90_convert_to_id( $name ) {
		$name = strtolower( strip_tags( $name ) );
		$name = str_replace( ' ', '-', $name );

		return preg_replace( '/[^A-Za-z0-9\-]/', '', $name );
	}
}

/*
--------------------------------------------------------------------------------
* Convert RTL dir
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_rtl_convert' ) ) {
	function th90_rtl_convert( $dir ) {
		if ( is_rtl() ) {
			if ( 'left' == $dir ) {
				return 'right';
			} elseif ( 'right' == $dir ) {
				return 'left';
			}
		}
		return $dir;
	}
}

/*
--------------------------------------------------------------------------------
* Make the attributes array be string
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_stringify_attributes' ) ) {
	function th90_stringify_attributes( $attributes ) {
		$atts = array();
		foreach ( $attributes as $name => $value ) {
			$atts[] = $name . '="' . esc_attr( $value ) . '"';
		}
		return implode( ' ', $atts );
	}
}

/*
--------------------------------------------------------------------------------
* Exclude pages from WordPress Search
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_search_filter' ) ) {
	function th90_search_filter( $query ) {
		$post_types = th90_opt('search_post_types');

		if ( is_array( $post_types ) && ! empty( $post_types ) && ! is_admin() ) {
			if ( isset( $query->query_vars['post_type'] ) && 'product' == $query->query_vars['post_type'] ) {
				return;
			} else {
				if ( $query->is_search ) {
					$query->set( 'post_type', $post_types );
				}
				return $query;
			}
		}

	}
	add_filter( 'pre_get_posts','th90_search_filter', 999 );
}

/*
--------------------------------------------------------------------------------
* Get Data From API's
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_remote_get' ) ) {
    function th90_remote_get( $url, $json = true, $args = array( 'sslverify' => false ) ){

        $get_request = preg_replace( '/\s+/', '', $url );
        $get_request = wp_remote_get( $url, $args );
        $the_request = wp_remote_retrieve_body( $get_request );

        if( $json ){
            $the_request = @json_decode( $the_request, true );
        }

        return $the_request;
    }
}


/*
--------------------------------------------------------------------------------
* SSL | Compatibility
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_ssl' ) ) {
	function th90_ssl( $echo = false ) {
		$ssl = 'http';
		if ( is_ssl() ) {
			$ssl .= 's';
		}
		if ( $echo ) {
			echo esc_attr( $ssl ) . '://';
		}
		return $ssl . '://';
	}
}

/*
--------------------------------------------------------------------------------
* SSL | Attachments
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_ssl_attachments' ) ) {
	function th90_ssl_attachments( $url ) {
		if ( is_ssl() ) {
			return str_replace( 'http://', 'https://', $url );
		}
		return $url;
	}
}
add_filter( 'wp_get_attachment_url', 'th90_ssl_attachments' );

/*
--------------------------------------------------------------------------------
* Function that converts a numeric value into an exact abbreviation
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_number_format_short' ) ) {
    function th90_number_format_short( $n, $precision = 1 ) {
    	if ( $n < 900 ) {
    		// 0 - 900
    		$n_format = number_format_i18n( $n, $precision) ;
    		$suffix = '';
    	} else if ( $n < 900000 ) {
    		// 0.9k-850k
    		$n_format = number_format_i18n( $n / 1000, $precision );
    		$suffix = 'K';
    	} else if ( $n < 900000000 ) {
    		// 0.9m-850m
    		$n_format = number_format_i18n( $n / 1000000, $precision) ;
    		$suffix = 'M';
    	} else if ( $n < 900000000000 ) {
    		// 0.9b-850b
    		$n_format = number_format_i18n( $n / 1000000000, $precision );
    		$suffix = 'B';
    	} else {
    		// 0.9t+
    		$n_format = number_format_i18n( $n / 1000000000000, $precision );
    		$suffix = 'T';
    	}
      // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
      // Intentionally does not affect partials, eg "1.50" -> "1.50"
    	if ( $precision > 0 ) {
    		$dotzero = '.' . str_repeat( '0', $precision );
    		$n_format = str_replace( $dotzero, '', $n_format );
    	}
    	return $n_format . $suffix;
    }
}

/*
--------------------------------------------------------------------------------
* Change The Excerpt Length
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_get_excerpt' ) ) {

	function th90_get_excerpt( $limit = false ) {

		$excerpt   = get_post_field('post_excerpt', get_the_ID());
		$limit     = ! empty( $limit ) ? $limit : 30;

		if ( empty( $limit ) || 0 == $limit ) {
			return;
		}

		if ( '' == trim( $excerpt ) ) {
			$text = get_the_content( '' );
			$text = strip_shortcodes( $text );
			$text = excerpt_remove_blocks( $text );
			$text = apply_filters( 'get_the_content', $text );
			$text = str_replace( ']]>', ']]&gt;', $text );
			$text = wp_trim_words( $text, $limit, '' );
			$text = wp_strip_all_tags( trim( $text ) );
		} else {
			$text = wp_trim_words( $excerpt, $limit, '' );
		}
		return $text;
	}
}

if ( ! function_exists( 'th90_excerpt_max_length' ) ) {

	function th90_excerpt_max_length() {
		return 200;
	}

	add_filter( 'excerpt_length', 'th90_excerpt_max_length', 999 );
}

/*
--------------------------------------------------------------------------------
* Print the modified excerpt
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_the_excerpt' ) ) {

	function th90_the_excerpt( $limit = false ) {
		echo th90_get_excerpt( $limit );
	}
}

/*
--------------------------------------------------------------------------------
* Change The Title Length
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_get_title' ) ) {

	function th90_get_title( $limit = false ) {
		$title = '';

		$title .= get_the_title();

		if ( empty( $limit ) || 0 == $limit || ! $limit ) {
			return $title;
		}

		return wp_trim_words( $title, $limit );
	}
}

/*
--------------------------------------------------------------------------------
* Print the modified title
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_the_title' ) ) {

	function th90_the_title( $limit = false ) {
		echo th90_get_title( $limit );
	}
}

/*
--------------------------------------------------------------------------------
* Read more excerpt html
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'wp_excerpt_more' ) ) {

	add_filter( 'excerpt_more', 'wp_excerpt_more' );
	function wp_excerpt_more( $more ) {
		return ' &hellip;';
	}
}

/*
--------------------------------------------------------------------------------
* Deactive Attachment Page
* ------------------------------------------------------------------------------
*/
if( ! function_exists( 'th90_redirect_attachment_page' ) ) {
	function th90_redirect_attachment_page() {
		if ( is_attachment() ) {
			global $post;
			if ( $post && $post->post_parent ) {
				wp_redirect( esc_url( get_permalink( $post->post_parent ) ), 301 );
				exit;
			} else {
				wp_redirect( esc_url( home_url( '/' ) ), 301 );
				exit;
			}
		}
	}
	add_action( 'template_redirect', 'th90_redirect_attachment_page' );
}

/*
--------------------------------------------------------------------------------
* Modify read more link of content
* ------------------------------------------------------------------------------
*/
if( ! function_exists( 'th90_content_read_more_link' ) ) {
	function th90_content_read_more_link() {
	    return '<div class="more-link"><a href="' . get_permalink() . '">' . esc_html__( 'Read More', 'atlas' ) . '&nbsp;&hellip;</a></div>';
	}
	add_filter( 'the_content_more_link', 'th90_content_read_more_link' );
}

/*
--------------------------------------------------------------------------------
* Modify wp_link_pages
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_link_pages_args_prevnext_add' ) ) {
	function th90_link_pages_args_prevnext_add($args) {
	    global $page, $numpages, $more, $pagenow;

	    if ( !$args['next_or_number'] == 'next_and_number' ) {
			return $args; # exit early
		}
	    $args['next_or_number'] = 'number'; # keep numbering for the main part
	    if ( ! $more ) {
			return $args; # exit early
		}

	    if( $page - 1 ) { # there is a previous page
			$args['before'] .= _wp_link_page( $page-1 ) . '<span class="prev">'. esc_html__( 'Prev', 'atlas' ) . '</span>' . '</a>';
		}

	    if ($page < $numpages) { # there is a next page
			$args['after'] = _wp_link_page( $page+1 ) . '<span class="next">' . esc_html__( 'Next', 'atlas' ) .'</span>' . '</a>' . $args['after'];
		}

	    return $args;
	}

	add_filter( 'wp_link_pages_args', 'th90_link_pages_args_prevnext_add' );
}

/*
--------------------------------------------------------------------------------
* Remove type attribute for Javascript and style
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_clean_javascript_css_tag' ) ) {
	add_action('wp_loaded', 'th90_output_clean_javascript_css_start');
	function th90_output_clean_javascript_css_start() {
		if ( ! is_admin() ) {
			ob_start( "th90_clean_javascript_css_tag" );
		}

	}
	function th90_clean_javascript_css_tag($buffer) {
	    return preg_replace( "%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer );
	}
}

/*
--------------------------------------------------------------------------------
* Add a pingback url auto-discovery header for single posts, pages, or attachments.
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_clean_javascript_css_tag' ) ) {
	function th90_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}
	add_action( 'wp_head', 'th90_pingback_header' );
}

/*
--------------------------------------------------------------------------------
* Minify CSS
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_minify_css' ) ) {
	function th90_minify_css( $css ) {
		if( empty( $css ) ){
			return;
		}

		$css = strip_tags( $css );
		$css = str_replace( ',{', '{', $css );
		$css = str_replace( ', ', ',', $css );
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!',  '', $css );
		$css = str_replace( array( "\r\n", "\r", "\n", "\t" ), '', $css );
		$css = preg_replace( '/\s+/', ' ', $css );

		return trim( $css );
	}
}

/**
 * -----------------------------------------------------------------------------
 * Font size tags
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_set_tag_cloud_font_size' ) ) {

	function th90_set_tag_cloud_font_size($args) {
	    $args['smallest'] = 13;
	    $args['largest'] = 28;
		$args['unit'] = 'px';
	    return $args;
	}

	add_filter('widget_tag_cloud_args','th90_set_tag_cloud_font_size');
}

/**
* -----------------------------------------------------------------------------
* Remove Spaces from string
* -----------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_remove_spaces' ) ) {
	function th90_remove_spaces( $string ){
		return preg_replace( '/\s+/', '', $string );
	}
}

/**
* -----------------------------------------------------------------------------
* Theme notice
* -----------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_notice' ) ) {
	function th90_notice( $message, $echo = true ){
		if( empty( $message) ){
			return;
		}

		echo '<span class="theme-notice">'. $message .'</span>';
	}
}

/*
--------------------------------------------------------------------------------
* Post Number Parse
* ------------------------------------------------------------------------------
*/
if( ! function_exists( 'th90_number_post_parse' )){

	function th90_number_post_parse( $number, $standard = false ) {
		$output = '';
		if ( $number < 10 && 0 != $number && false == $standard ) {
			$output = '0' . $number;
		} else {
			$output = $number;
		}

		return $output;
	}
}

/*
--------------------------------------------------------------------------------
* Default Slider Config
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_slider_config_default' ) ) {

	function th90_slider_config_default( $args = array() ) {
		$args_default = array(
			'rtl' => is_rtl() ? true : false,
			'loop' => false,
			'center' => false,
			'autoHeight' => true,
			'autoplay' => false,
			'nav' => true,
			'dots' => false,
			'speed' => 500,
			'delay' => 3000,
			'fade' => false,
			'view' => 1,
			't_view' => 1,
			'm_view' => 1,
			'ms_view' => 1,
			'asNavFor' => '',
			'vertical' => false,
			'focusOnSelect' => false,
		);

		return array_merge( $args, array_diff_key( $args_default, $args ) );
	}
}

/*
--------------------------------------------------------------------------------
* Change position of form response MC4WP
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_respons_position_mc4wp' ) ) {
	function th90_respons_position_mc4wp() {
		return 'before';
	}
}
add_filter('mc4wp_form_response_position', 'th90_respons_position_mc4wp' );

/**
 * -------------------------------------------------------------------------
 *  Checks if the required plugin is active in network or single site.
 * -------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_plugin_is_active' ) ) {
	function th90_plugin_is_active( $plugin ) {
		$network_active = false;
		if ( is_multisite() ) {
			$plugins = get_site_option( 'active_sitewide_plugins' );
			if ( isset( $plugins[ $plugin ] ) ) {
				$network_active = true;
			}
		}
		return in_array( $plugin, get_option( 'active_plugins' ) ) || $network_active;
	}
}
