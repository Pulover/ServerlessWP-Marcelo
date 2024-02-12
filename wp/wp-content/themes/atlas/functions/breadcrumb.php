<?php
/**
 * Breadcrumbs function
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! function_exists( 'th90_breadcrumbs' ) ) {

	function th90_breadcrumbs( $print = false ){

		# breadcrumbs ----------
		$home_text  = esc_html__( 'Home', 'atlas' );
		$breadcrumbs = array();

        # WooCommerce breadcrumbs ----------
        if ( th90_woo_check_pages() ){

			if ( $print ) {
	            echo woocommerce_breadcrumb( array(
	    			'delimiter'   => '',
	    			'wrap_before' => '<ul id="breadcrumb" class="breadcrumbs">',
	    			'wrap_after'  => '</ul>',
	    			'before'      => '<li>',
	    			'after'       => '</li>',
	    			'home'        => esc_html__( 'Home', 'atlas' ),
	    		) );
			}
        }

		# WordPress breadcrumbs ----------
		elseif ( ! is_home() && ! is_front_page() ){

			$post     = get_post();
			$home_url = esc_url(home_url( '/' ));


			# Home ----------
			$breadcrumbs[] = array(
				'url'   => $home_url,
				'name'  => $home_text,
			);


			# Category ----------
			if ( is_category() ){

				$category = get_query_var( 'cat' );
				$category = get_category( $category );

				if( $category->parent !== 0 ){

					$parent_categories = array_reverse( get_ancestors( $category->cat_ID, 'category' ) );

					foreach ( $parent_categories as $parent_category ) {
						$breadcrumbs[] = array(
							'url'  => get_term_link( $parent_category, 'category' ),
							'name' => get_cat_name( $parent_category ),
						);
					}
				}

				$breadcrumbs[] = array(
					'name' => get_cat_name( $category->cat_ID ),
				);
			}


			# Day ----------
			elseif ( is_day() ){

				$breadcrumbs[] = array(
					'url'  => get_year_link( get_the_time( 'Y' ) ),
					'name' => get_the_time( 'Y' ),
				);

				$breadcrumbs[] = array(
					'url'  => get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ),
					'name' => get_the_time( 'F' ),
				);

				$breadcrumbs[] = array(
					'name' => get_the_time( 'd' ),
				);
			}


			# Month ----------
			elseif ( is_month() ){

				$breadcrumbs[] = array(
					'url'  => get_year_link( get_the_time( 'Y' ) ),
					'name' => get_the_time( 'Y' ),
				);

				$breadcrumbs[] = array(
					'name' => get_the_time( 'F' ),
				);
			}


			# Year ----------
			elseif ( is_year() ){

				$breadcrumbs[] = array(
					'name' => get_the_time( 'Y' ),
				);
			}


			# Tag ----------
			elseif ( is_tag() ){

				$breadcrumbs[] = array(
					'name' => get_the_archive_title(),
				);
			}


			# Author ----------
			elseif ( is_author() ){

				$author = get_query_var( 'author' );
				$author = get_userdata($author);

				$breadcrumbs[] = array(
					'name' => $author->display_name,
				);
			}


			# Search ----------
			elseif ( is_search() ){

				$breadcrumbs[] = array(
					'name' => sprintf( esc_html__( 'Search Results: %s', 'atlas' ),  get_search_query() ),
				);
			}


			# 404 ----------
			elseif ( is_404() ){

				$breadcrumbs[] = array(
					'name' => esc_html__( 'Nothing Found', 'atlas' ),
				);
			}


			# Pages ----------
			elseif ( is_page() ){

				if ( $post->post_parent ){

					$parent_id   = $post->post_parent;
					$page_parents = array();

					while ( $parent_id ){
						$get_page  = get_page( $parent_id );
						$parent_id = $get_page->post_parent;

						$page_parents[] = array(
							'url'  => get_permalink( $get_page->ID ),
							'name' => strip_tags( get_the_title( $get_page->ID ) ),
						);
					}

					$page_parents = array_reverse( $page_parents );

					foreach( $page_parents as $single_page ){

						$breadcrumbs[] = array(
							'url'  => $single_page['url'],
							'name' => $single_page['name'],
						);
					}
				}

				$breadcrumbs[] = array(
					'name' => strip_tags( wp_trim_words( get_the_title(), 3 ) ),
				);
			}


			# Attachment ----------
			elseif ( is_attachment() ){

				if( ! empty( $post->post_parent ) ){
					$parent = get_post( $post->post_parent );

					$breadcrumbs[] = array(
						'url'  => get_permalink( $parent ),
						'name' => $parent->post_title,
					);
				}

				$breadcrumbs[] = array(
					'name' => strip_tags( wp_trim_words( get_the_title(), 3 ) ),
				);
			}


			# Single Posts ----------
			elseif ( is_singular() ){

				# Single Post ----------
				if ( get_post_type() == 'post' ){

					$category = th90_get_primary_category_id();

					if( ! empty( $category ) ){

						$category = get_category( $category );

						if( $category->parent !== 0 ){
							$parent_categories = array_reverse( get_ancestors( $category->term_id, 'category' ) );

							foreach ( $parent_categories as $parent_category ) {
								$breadcrumbs[] = array(
									'url'  => get_term_link( $parent_category, 'category' ),
									'name' => get_cat_name( $parent_category ),
								);
							}
						}

						$breadcrumbs[] = array(
							'url'  => get_term_link( $category->term_id, 'category' ),
							'name' => get_cat_name( $category->term_id ),
						);
					}
				}

				# Custom Post type ----------
				else{

					# Get the main Post type archive link ----------
					if( $archive_link = get_post_type_archive_link( get_post_type() ) ){

						$post_type = get_post_type_object( get_post_type() );

						$breadcrumbs[] = array(
							'url'  => $archive_link,
							'name' => $post_type->labels->singular_name,
						);
					}


					# Get custom Post Types taxonomies ----------
					$taxonomies = get_object_taxonomies( $post, 'objects' );

					if( ! empty( $taxonomies ) && is_array( $taxonomies ) ){
						foreach( $taxonomies as $taxonomy ){
							if( $taxonomy->hierarchical ){
								$taxonomy_name = $taxonomy->name;
								break;
							}
						}
					}

					if( ! empty( $taxonomy_name ) ){
						$custom_terms = get_the_terms( $post, $taxonomy_name );

						if( ! empty( $custom_terms ) && ! is_wp_error( $custom_terms )){

							foreach ( $custom_terms as $term ){

								$breadcrumbs[] = array(
									'url'  => get_term_link( $term ),
									'name' => $term->name,
								);

								break;
							}
						}
					}
				}

				$breadcrumbs[] = array(
					'name' => strip_tags( get_the_title() ),
				);
			}

			# Print the BreadCrumb
			if( ! empty( $breadcrumbs ) ){

				$counter = 0;
				$breadcrumbs_schema = array(
					'@context'        => 'https://schema.org',
					'@type'           => 'BreadcrumbList',
					'@id'             => '#Breadcrumb',
					'itemListElement' => array(),
				);


				if ( $print ) {
					echo '<ul id="breadcrumb" class="breadcrumbs">';

						foreach( $breadcrumbs as $item ) {

							$counter++;

							if( ! empty( $item['url'] )){
								echo '<li><a href="'. esc_url( $item['url'] ) .'">'. $item['name'] .'</a></li>';
							}
							else{
								echo '<li class="current">' . $item['name'] . '</li>';

								global $wp;
								$item['url'] = esc_url( home_url( add_query_arg( array(), $wp->request) ) );
							}

							$breadcrumbs_schema['itemListElement'][] = array(
								'@type'    => 'ListItem',
								'position' => $counter,
								'item'     => array(
									'name' => $item['name'],
									'@id'  => $item['url'],
								)
							);

						}

					echo '</ul>';
				} else {
					foreach( $breadcrumbs as $item ) {

						$counter++;

						if( empty( $item['url'] )){
							global $wp;
							$item['url'] = esc_url( home_url( add_query_arg( array(), $wp->request) ) );
						}

						$breadcrumbs_schema['itemListElement'][] = array(
							'@type'    => 'ListItem',
							'position' => $counter,
							'item'     => array(
								'name' => $item['name'],
								'@id'  => $item['url'],
							)
						);
					}
					echo '<script type="application/ld+json">'. wp_json_encode( $breadcrumbs_schema ) .'</script>';
				}
			}
		}

		wp_reset_postdata();
	}

}
