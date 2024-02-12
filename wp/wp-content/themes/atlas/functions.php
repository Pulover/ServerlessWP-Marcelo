<?php
/**
 * Atlas functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Atlas
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TH90_ATLAS_CORE_ACTIVE', function_exists( 'th90_atlas_core_plugin' ) );
define( 'TH90_ACF_IS_ACTIVE', class_exists( 'acf' ) );
define( 'TH90_CF7_IS_ACTIVE', class_exists( 'WPCF7_ContactForm' ) );
define( 'TH90_JETPACK_IS_ACTIVE', class_exists( 'Jetpack' ) );
define( 'TH90_WOOCOMMERCE_IS_ACTIVE', class_exists( 'WooCommerce' ) );
define( 'TH90_POSTVIEWS_IS_ACTIVE', class_exists( 'Post_Views_Counter' ) );

require get_template_directory() . '/functions/plugins/plugins-activation.php';
require get_template_directory() . '/options/theme-options.php';
require get_template_directory() . '/options/default-options.php';
require get_template_directory() . '/options/default-output.php';
require get_template_directory() . '/functions/utilities.php';
require get_template_directory() . '/functions/dynamic-css.php';
require get_template_directory() . '/functions/plugin-functions.php';
require get_template_directory() . '/functions/svg-icons.php';
require get_template_directory() . '/functions/page-title.php';
require get_template_directory() . '/functions/classes.php';
require get_template_directory() . '/functions/sidebar.php';
require get_template_directory() . '/functions/query-loop.php';
require get_template_directory() . '/functions/ajax.php';
require get_template_directory() . '/functions/comment.php';
require get_template_directory() . '/functions/pagination.php';
require get_template_directory() . '/functions/breadcrumb.php';
require get_template_directory() . '/functions/images.php';
require get_template_directory() . '/functions/category.php';
require get_template_directory() . '/functions/post-info.php';
require get_template_directory() . '/functions/elements-article.php';
require get_template_directory() . '/functions/trigger.php';
require get_template_directory() . '/functions/logo.php';
require get_template_directory() . '/functions/widgets.php';
require get_template_directory() . '/functions/actions.php';
require get_template_directory() . '/functions/menu-walker.php';
require get_template_directory() . '/functions/translations.php';
require get_template_directory() . '/functions/review.php';
require get_template_directory() . '/functions/ads.php';
require get_template_directory() . '/functions/plugin-integration/woocommerce.php';
require get_template_directory() . '/functions/plugin-integration/amp.php';
require get_template_directory() . '/functions/plugin-integration/post-views.php';

/*
--------------------------------------------------------------------------------
* Theme Setup
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'atlas_theme_setup' ) ) {
	function atlas_theme_setup() {
		load_theme_textdomain( 'atlas', get_template_directory() . '/languages' );
		if ( ! isset( $GLOBALS['content_width'] ) ) {
			$GLOBALS['content_width'] = 1920;
		}

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video' ) );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

		register_nav_menus( array(
			'main_menu'   => 'Main Menu',
			'mobile_menu'   => 'Mobile Menu',
		) );

		add_theme_support( 'woocommerce' );

		add_theme_support( 'amp' );

		add_theme_support( 'post-thumbnails' );
		add_image_size( 'placeholder-img', 30, 30, true );
		set_post_thumbnail_size( 480, 0 );

		// Adds support for editor color palette.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => 'Accent',
				'slug'  => 'accent',
				'color'	=> get_option( 'th90-color-accent' ),
			),
			array(
				'name'  => 'Dark',
				'slug'  => 'dark',
				'color' => get_option( 'th90-dark-sec-bg-color' ),
			),
			array(
				'name'  => 'Light',
				'slug'  => 'light',
				'color' => get_option( 'th90-light-sec-bg-color' ),
		       ),
		) );
	}
}
add_action( 'after_setup_theme', 'atlas_theme_setup', 1 );


/*
--------------------------------------------------------------------------------
* Add style to editor admin
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_block_scripts' ) ) {
	function th90_block_scripts() {
		if ( ! TH90_ATLAS_CORE_ACTIVE ) {
			wp_enqueue_style( 'th90-font', '//fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap', array(), null );
		}
		wp_enqueue_style( 'th90-editor-root', get_template_directory_uri() . '/scss/editor/editor-root.css' );

		if ( th90_dynamic_css() ) {
			wp_add_inline_style( 'th90-editor-root', wp_unslash( th90_minify_css( th90_dynamic_css() ) ) );
		}
	}
	add_action( 'enqueue_block_editor_assets', 'th90_block_scripts' );
}

/*
--------------------------------------------------------------------------------
* Enqueue styles backend.
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_styles_back' ) ) {
	function th90_styles_back() {
		if ( class_exists( 'Classic_Editor' ) ) {
			add_editor_style( 'scss/editor/editor-classic.css' );
		} else {
			add_editor_style( 'scss/editor/editor.css' );
		}
	}
	add_action( 'init', 'th90_styles_back' );
}

/*
--------------------------------------------------------------------------------
* Enqueue styles fontend.
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_styles_front' ) ) {

	function th90_styles_front() {
		if ( ! TH90_ATLAS_CORE_ACTIVE ) {
			wp_enqueue_style( 'th90-font', '//fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap', array(), null );
		}

		wp_enqueue_style( 'th90-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

		wp_style_add_data( 'th90-style', 'rtl', 'replace' );

		if ( th90_dynamic_css() ) {
			wp_add_inline_style( 'th90-style', wp_unslash( th90_minify_css( th90_dynamic_css() ) ) );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'th90_styles_front' );

/*
--------------------------------------------------------------------------------
* Enqueue Elementor.
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_styles_elementor' ) ) {

	function th90_styles_elementor() {
		if ( ! class_exists( 'Elementor\Plugin' ) || th90_is_amp() ) {
            return;
        }

        if ( class_exists( '\Elementor\Plugin' ) ) {
            $elementor = \Elementor\Plugin::instance();
            $elementor->frontend->enqueue_styles();
        }

        if ( class_exists( '\ElementorPro\Plugin' ) ) {
            $elementor_pro = \ElementorPro\Plugin::instance();
            $elementor_pro->enqueue_styles();
        }

		$template_ids = array_unique( array(
			th90_opt_override_blank( 'header_template' ),
			th90_opt_override_blank( 'topheader_template' ),
			th90_opt_override_blank( 'sticky_template' ),
			th90_opt_override_blank( 'mob_header_template' ),
			th90_opt_override_blank( 'footer_template' ),
			th90_sidebar_template_id(),
			th90_opt( 'offcanvas_template' ),
			is_singular( 'post' ) ? th90_opt( 'related_posts' ) : '',
			is_singular( 'post' ) ? th90_opt( 'hook_article_before' ) : '',
			is_singular( 'post' ) ? th90_opt( 'hook_article_after' ) : '',
			is_archive() ? th90_opt_override_blank( 'archive_template' ) : '',
			is_search() ? th90_opt( 'search_template' ) : '',
        ) );

		if ( ! empty( $template_ids ) ) {
			foreach ( $template_ids as $template_id ) {
	            if( $template_id ) {
	                if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
	                    $css_file = new \Elementor\Core\Files\CSS\Post( $template_id );
	                } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
	                    $css_file = new \Elementor\Post_CSS_File( $template_id );
	                }

	                $css_file->enqueue();
	            }
	        }
		}
	}
}
add_action( 'wp_enqueue_scripts', 'th90_styles_elementor' );

/*
--------------------------------------------------------------------------------
* Enqueue frontend scripts.
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_scripts_front' ) ) {

	function th90_scripts_front() {
		if ( th90_is_amp() ) {
            return;
        }

		wp_register_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), false, true );
		wp_register_script( 'viewportchecker', get_template_directory_uri() . '/js/viewportchecker.min.js', array( 'jquery' ), false, true );
		wp_register_script( 'th90-front', get_template_directory_uri() . '/js/th90-front.js', array( 'jquery', 'elementor-frontend' ), false, true );

		if ( is_singular( 'post' ) ) {
			wp_enqueue_script( 'slick' );
			if ( th90_opt( 'single_ajax_post' ) ) {
				wp_enqueue_script( 'viewportchecker' );
			}
		}

		if ( th90_lazyload_check() ) {
			wp_enqueue_script( 'lazysizes', get_template_directory_uri() . '/js/lazysizes.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'ls.parent-fit', get_template_directory_uri() . '/js/ls.parent-fit.min.js', array( 'jquery', 'lazysizes' ), false, true );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( is_search() || is_archive() ) {
			wp_enqueue_script( 'masonry' );
			wp_enqueue_script( 'imagesloaded' );
		}

		wp_enqueue_script( 'venobox', get_template_directory_uri() . '/js/venobox.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'th90-scripts', get_template_directory_uri() . '/js/th90-scripts.js', array( 'jquery' ), false, true );

		$th90_js_vars = array(
			'is_rtl'                => is_rtl() ? true : false,
			'ajaxurl'               => esc_url( admin_url( 'admin-ajax.php' ) ),
			'lightbox_image'        => true,
			'lightbox_gallery'      => true,
			'no_results'       		=> esc_html__( 'Nothing Found', 'atlas' ),
			'is_singular'           => is_singular(),
			'is_singular_post'      => is_singular('post'),
			'singlePostTitle'       => get_the_title(),
			'nowReadTitle'			=> esc_html__( 'Now Reading:', 'atlas' ),
			'nowReadTime'			=> th90_reading_time( true ),
			'is_sticky_header'      => th90_is_sticky_header() ? true : false,
			'sticky_header_behav'	=> is_singular('post') ? 'sticky-show-both' : 'sticky-show-' . th90_is_sticky_header(),
			'sticky_template'		=> th90_display_elementor_content( th90_opt_override_blank( 'sticky_template' ) ) ? true : false,
			'search_desc_enter'		=> esc_html( 'Please enter at least 3 characters', 'atlas' ),
			'search_desc_result'  	=> esc_html( 'Results for your search', 'atlas' ),
			'svg_loader'          	=> '',
			'elementor_posts_css' 	=> th90_elementor_posts_css(),
			'svg_arrow_left' 		=> th90_get_svg_icon( 'arrow-left' ),
			'svg_arrow_right'		=> th90_get_svg_icon( 'arrow-right' ),
			'svg_pulse'				=> th90_get_svg_icon( 'pulse' ),
			'stickyMarginBottom'	=> th90_opt( 'box_active' ) ? 35 : 40,
		);
		wp_localize_script( 'th90-scripts', 'th90', $th90_js_vars );
	}
}
add_action( 'wp_enqueue_scripts', 'th90_scripts_front' );


/**
 * -----------------------------------------------------------------------------
 * Actions After Switch the Theme
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_after_switch_theme' ) ) {

	function th90_after_switch_theme() {
		update_option( 'thumbnail_size_w', 200 );
		update_option( 'thumbnail_size_h', 0 );
		update_option( 'thumbnail_crop', false );
		update_option( 'medium_size_w', 300 );
		update_option( 'medium_size_h', 0 );
		update_option( 'large_size_w', 1024 );
		update_option( 'large_size_h', 0 );
		update_option( 'elementor_experiment-container', 'active' );
		update_option( 'elementor_experiment-container_grid', 'active' );
		update_option( 'elementor_disable_color_schemes', 'yes' );
		update_option( 'elementor_disable_typography_schemes', 'yes' );
		update_option( 'elementor_cpt_support', array(
		    'post',
		    'page',
			'th90_sidebar',
		    'th90_block',
		) );
	}
	add_action( 'after_switch_theme', 'th90_after_switch_theme' );
}
