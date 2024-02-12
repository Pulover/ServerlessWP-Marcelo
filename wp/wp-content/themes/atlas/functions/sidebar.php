<?php
/**
 * Sidebar Functions
 *
 * @package Atlas
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
--------------------------------------------------------------------------------
* Sidebar Body classes
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_sidebar_body_class' ) ) {

	function th90_sidebar_body_class( $classes ) {
		global $wp_query;
		$posts_found = $wp_query->found_posts;

		if ( th90_is_amp() ) {
			$classes[] = 'sidebar-full site-amp';
		} else {
			$classes[] = th90_opt( 'sidebar_sticky' ) ? 'sticky-sidebar' : '';

			if ( is_singular( 'page' ) && ! th90_is_builder_page() ) {
				$classes[] = 'sidebar-' . th90_opt_override_blank( 'page_sidebar' );

			} elseif ( ( is_home() || is_archive() ) && ! th90_woo_check() ) {
				$classes[] = 'sidebar-' . th90_opt_override_blank( 'archive_sidebar' );

			} elseif ( is_search() && ! th90_woo_check() ) {
				if ( $posts_found ) {
					$classes[] = 'sidebar-' . th90_opt( 'search_sidebar' );
				} else {
					$classes[] = 'sidebar-full';
				}

			} elseif ( th90_woo_check() ) {
				if( th90_woo_check_page( 'is_product' ) ) {
					$classes[] = 'sidebar-' . th90_opt( 'product_sidebar' );
				} else {
					$classes[] = 'sidebar-' . th90_opt( 'shop_sidebar' );
				}
			}
			$classes[] = th90_is_builder_page() || is_404() ? 'sidebar-full' : '';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'th90_sidebar_body_class' );


/*
--------------------------------------------------------------------------------
* Sidebar Checker
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_is_have_sidebar' ) ) {

	function th90_is_have_sidebar() {
		global $wp_query;
		$posts_found = $wp_query->found_posts;
        $show_sidebar = true;
        if ( is_singular( 'page' ) && ! th90_is_builder_page() ) {
        	if ( 'one_column' == th90_opt_override_blank( 'page_sidebar' ) || 'full' ==  th90_opt_override_blank( 'page_sidebar' ) ) {
        		$show_sidebar = false;
        	}
        } elseif ( ( is_home() || is_archive() ) && ! th90_woo_check() ) {
        	if ( 'one_column' == th90_opt_override_blank( 'archive_sidebar' ) || 'full' ==  th90_opt_override_blank( 'archive_sidebar' ) ) {
        		$show_sidebar = false;
        	}
        } elseif ( is_search() && ! th90_woo_check() ) {
        	if ( ! $posts_found || 'one_column' == th90_opt( 'search_sidebar' ) || 'full' ==  th90_opt( 'search_sidebar' ) ) {
        		$show_sidebar = false;
        	}

        } elseif ( th90_woo_check() ) {
        	if( th90_woo_check_page( 'is_product' ) ) {
        		if ( 'one_column' == th90_opt( 'product_sidebar' ) || 'full' ==  th90_opt( 'product_sidebar' ) ) {
        			$show_sidebar = false;
        		}
        	} else {
        		if ( 'one_column' == th90_opt( 'shop_sidebar' ) || 'full' ==  th90_opt( 'shop_sidebar' ) ) {
        			$show_sidebar = false;
        		}
        	}
        }

        if ( th90_is_builder_page() || is_404() || th90_is_amp() ) {
        	$show_sidebar = false;
        }

        return $show_sidebar;
    }
}

/*
--------------------------------------------------------------------------------
* Sidebar Template ID
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_sidebar_template_id' ) ) {

	function th90_sidebar_template_id() {
		global $wp_query;
		$posts_found = $wp_query->found_posts;
        $template = false;
        if ( is_singular( 'page' ) && ! th90_is_builder_page() ) {
            if ( 'left' == th90_opt_override_blank( 'page_sidebar' ) || 'right' ==  th90_opt_override_blank( 'page_sidebar' ) ) {
                $template = th90_opt_override_blank( 'page_sidebar_template' );
            }

		} elseif ( ( is_home() || is_archive() ) && ! th90_woo_check() ) {
            if ( 'left' == th90_opt_override_blank( 'archive_sidebar' ) || 'right' ==  th90_opt_override_blank( 'archive_sidebar' ) ) {
                $template = th90_opt_override_blank( 'archive_sidebar_template' );
            }

		} elseif ( is_search() && ! th90_woo_check() && $posts_found ) {
            if ( 'left' == th90_opt( 'search_sidebar' ) || 'right' ==  th90_opt( 'search_sidebar' ) ) {
                $template = th90_opt( 'search_sidebar_template' );
            }

		} elseif ( th90_woo_check() ) {
			if( th90_woo_check_page( 'is_product' ) ) {
                if ( 'left' == th90_opt( 'product_sidebar' ) || 'right' ==  th90_opt( 'product_sidebar' ) ) {
                    $template = th90_opt( 'product_sidebar_template' );
                }
			} else {
                if ( 'left' == th90_opt( 'shop_sidebar' ) || 'right' ==  th90_opt( 'shop_sidebar' ) ) {
                    $template = th90_opt( 'shop_sidebar_template' );
                }
			}
		} elseif ( is_singular( 'post' ) ) {
            $template = th90_opt_override( 'override_post_layout', 'post_sidebar_template' );
        }
        return $template;
    }
}
