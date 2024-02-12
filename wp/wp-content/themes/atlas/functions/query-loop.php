<?php
/**
 * Custom Query
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
--------------------------------------------------------------------------------
* Custom Queries
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_query' ) ) {

	function th90_query( $block = array() ) {
		$args = array();
		$default_query = false;

		$block = wp_parse_args( $block, array(
			'post_type'		=> '',
			'number' 		=> '',
			'tags'			=> '',
			'posts' 		=> '',
			'pages'			=> '',
			'categories' 	=> '',
			'formats' 		=> '',
			'orderby'		=> '',
			'order'			=> '',
			'pagi'			=> '',
			'offset'		=> '',
			'post__not_in'	=> array(),
			'vars_archive'  => array(),
			'vars_related'  => array(),
		));

		$args['post_status'] = 'publish';

		if ( ! empty( $block['vars_archive'] ) ) {
			$args = $block['vars_archive'];
			$default_query = true;

		} elseif ( ! empty( $block['vars_related'] ) ) {
			$args = $block['vars_related'];
			if ( ! empty( $block['number'] ) ) {
				$args['posts_per_page'] = $block['number'];
			}

		} else {
			if ( ! empty( $block['posts'] ) ) {

				// Posts : Post Query ----------
				$selective_posts        = explode( ',', $block['posts'] );
				$selective_posts_number = count( $selective_posts );
				$args['post__in']       = $selective_posts;
				$args['posts_per_page'] = $selective_posts_number;
				$args['ignore_sticky_posts'] = true;
			} elseif ( ! empty( $block['pages'] ) ) {

				// Pages : Post Query ----------
				$selective_pages        = explode( ',', $block['pages'] );
				$selective_pages_number = count( $selective_pages );
				$args['post__in']       = $selective_pages;
				$args['posts_per_page']	= $selective_pages_number;
				$args['post_type']      = 'page';
				$args['ignore_sticky_posts'] = true;
			} else {
				$args['ignore_sticky_posts'] = true;

				// Posts Number ----------
				$block['number'] = ! empty( $block['number'] ) ? $block['number'] : get_query_var( 'posts_per_page' );
				$args['posts_per_page'] = $block['number'];

				// Posts Type ----------
				if ( ! empty( $block['post_type'] ) ) {
					$args['post_type'] = $block['post_type'];
				}

				// Posts Format ----------
				if ( ! empty( $block['formats'] ) ) {
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'post_format',
							'field'    => 'slug',
							'terms'    => explode( ',', $block['formats'] ),
						),
					);
				}

				if ( ! empty( $block['tags'] ) ) {

					// Tags : Post Query ----------
					$args['tag'] = $block['tags'];
				} else {

					// Categories : Post Query ----------
					if ( ! empty( $block['categories'] ) ) {
						$args['category_name'] = $block['categories'];
					}
				}

				$default_query = true;
			}
		}

		if ( $default_query ) {
			// Pagination ----------
			if ( ! empty( $block['pagi'] ) ) {
				$paged = 1;

				if ( ! empty( $block['target_page'] ) ) {
					$paged = intval( $block['target_page'] );
				} elseif ( $block['pagi'] == 'numeric' ) {
					$paged   = intval( get_query_var( 'paged' ) );
					$paged_2 = intval( get_query_var( 'page' ) );

					if ( empty( $paged ) && ! empty( $paged_2 )  ) {
						$paged = intval( get_query_var( 'page' ) );
					}
				}

				$args['paged'] = $paged;
			} else {
				$args['no_found_rows'] = true ;
			}

			// Offset ----------
			if ( ! empty( $block['offset'] ) && 0 != $block['offset'] ) {
				if ( ! empty( $block['pagi'] ) && ! empty( $paged ) ) {
					$args['offset'] = $block['offset'] + ( ($paged -1) * $block['number'] );
				} else {
					$args['offset'] = $block['offset'];
				}
			}

			// Posts Order By ----------
			if ( ! empty( $block['orderby'] ) ) {
				if ( $block['orderby'] == 'rand' ) {
					$args['orderby'] = 'rand';
				}
				elseif( $block['orderby'] == 'views' && TH90_POSTVIEWS_IS_ACTIVE ){
					$args['orderby']  = 'post_views';
				} elseif ( $block['orderby'] == 'best' ) {
					$args['orderby']  = 'meta_value_num';
					$args['meta_key'] = 'th90_review_total_score';
				} elseif ( $block['orderby'] == 'popular' ) {
					$args['orderby'] = 'comment_count';
				} elseif ( $block['orderby'] == 'modified' ) {
					$args['orderby'] = 'modified';
				}
			}

			// Posts Order ----------
			if ( ! empty( $block['order'] ) ) {
				if ( $block['order'] == 'asc' || $block['order'] == 'ASC' ) {
					$args['order'] = 'ASC';
				} elseif ( $block['order'] == 'desc' || $block['order'] == 'DESC' ) {
					$args['order'] = 'DESC';
				} else {
					$args['order'] = 'DESC';
				}
			}

			// Do not duplicate posts ----------
			$not_show_duplicate = false;

			if ( ! empty( $GLOBALS['th90_do_not_duplicate_post'] ) && is_array( $GLOBALS['th90_do_not_duplicate_post'] ) && 'yes' == $block['not_show_duplicate'] ) {
				$not_show_duplicate = true;
			}
			if ( ! empty( $block['post__not_in'] ) ) {
				if ( $not_show_duplicate ) {
					$args['post__not_in'] = array_merge( $GLOBALS['th90_do_not_duplicate_post'], $block['post__not_in'] );
				} else {
					$args['post__not_in'] = $block['post__not_in'];
				}
			} else {
				if ( $not_show_duplicate ) {
					$args['post__not_in'] = $GLOBALS['th90_do_not_duplicate_post'];
				}
			}
		}

		// Run the Query ----------
		$block_query = new WP_Query( $args );

		// Fix the number of pages WordPress Offset bug with pagination ----------
		if ( ! empty( $block['pagi'] ) ) {

			if ( ! empty( $block['offset'] ) ) {

				// Modify the found_posts ----------
				$found_posts = $block_query->found_posts;
				$found_posts = $found_posts - $block['offset'];
				$block_query->set( 'new_found_posts', $found_posts );

				// Modify the max_num_pages ----------
				$block_query->set( 'new_max_num_pages', ceil( $found_posts / $args['posts_per_page'] ) );
			} else {
				$block_query->set( 'new_max_num_pages', $block_query->max_num_pages );
			}
		}

		return $block_query;
	}
}

/*
--------------------------------------------------------------------------------
* Set posts IDs for the do not duplicate posts option
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_do_not_duplicate' ) ) {

	function th90_do_not_duplicate( $post_id = false ) {
		if ( empty( $post_id ) ) {
			return;
		}

		if ( empty( $GLOBALS['th90_do_not_duplicate_post'] ) ) {
			$GLOBALS['th90_do_not_duplicate_post'] = array();
		}

		$GLOBALS['th90_do_not_duplicate_post'][ $post_id ] = $post_id;
	}
}

/*
--------------------------------------------------------------------------------
* Default Block Posts Args
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_post_block_atts_default' ) ) {

	function th90_post_block_atts_default( $args, $prefix = '' ) {
		$args_default = array(
			'meta_modern' . $prefix => false,
			'have_number' . $prefix => '',
			'first_cat' . $prefix => false,
			'first_cat_loc' . $prefix => '',
			'cat_style' . $prefix => 'text',
			'post_center' . $prefix => '',
			'info_position' . $prefix => 'title',
			'info_icon' . $prefix => false,
			'trending' . $prefix => false,
			'format' . $prefix => false,
			'author' . $prefix => false,
			'author_avatar' . $prefix => false,
			'date' . $prefix => false,
			'views' . $prefix => false,
			'comments' . $prefix => false,
			'review' . $prefix => false,
			'time_format' . $prefix => false,
			'title_tag' . $prefix => false,
			'readmore' . $prefix => false,
			'readmore_side' . $prefix => false,
			'excerpt' . $prefix => '',
			'thumbnail_circle' . $prefix => '',
			'thumbnail_disable' . $prefix => false,
			'thumbnail_type' . $prefix => 'image',
			'image_ratio' . $prefix => 'ori',
			'sticky_sign' . $prefix => false,
			'post_vertical_center' . $prefix => false,
			'grid_type' . $prefix => '',
		);

		return array_merge( $args, array_diff_key( $args_default, $args ) );
	}
}

/*
--------------------------------------------------------------------------------
* Parsing query for archive & related posts
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_archive_related_atts' ) ) {
	function th90_archive_related_atts( $atts = array() ) {

		if ( 'archive' == $atts['_query_for'] ) {
			$atts['_filters'] = 'no';
			$atts['sticky_sign'] = true;
			if ( is_home() || is_archive() || is_search() ) {
				global $wp_query;
				$atts['vars_archive'] = array_filter( $wp_query->query_vars );
			}
		}
		if ( 'related' == $atts['_query_for'] ) {
			$atts['_filters'] = $atts['_sort'] = 'no';
			if ( is_singular( 'post' ) ) {
				if ( 'cat' === $atts['_query_related_by'] ) {
					$related_by = get_the_terms( get_the_ID(), 'category' );
					$param = 'category__in';
				} else {
					$related_by = get_the_terms( get_the_ID(), 'post_tag' );
					$param = 'tag__in';
				}
				if ( $related_by ) {
					$related_ids = array();
					foreach ( $related_by as $related_id ) {
						$related_ids[] = $related_id->term_id;
					}
					$atts['vars_related'] = array(
						'post_type' 			=> 'post',
						$param 					=> $related_ids,
						'post__not_in' 			=> array( get_the_ID() ),
						'ignore_sticky_posts'	=> true,
						'orderby'				=> 'rand',
					);
				}
			}
		}

		return $atts;
	}
}
/*
--------------------------------------------------------------------------------
* Corvert Blog Atts
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_blog_atts_convert' ) ) {

	function th90_blog_atts_convert( $atts = array(), $sufix = '' ) {
		/* Post Title Size */
		$atts['title_tag' . $sufix] = 'default' == $atts['title_tag' . $sufix] ? false : $atts['title_tag' . $sufix];

		/* Post Meta */
		foreach ( th90_default_options()['post_infos'] as $key => $value ) {
			$atts[$key . $sufix] = th90_multi_checkbox( $atts['post_info' . $sufix], $key );
		}

		/* Post Style */
		$atts['article_class'] = $atts['post_style'];

		if ( strpos( $atts['post_style'], 'list' ) !== false ) {

			if( isset( $atts['post_vertical_center'] ) && 'yes' == $atts['post_vertical_center'] ) {
		        $atts['article_class'] .=  ' post-vertical-center';
		    }
		}

		return $atts;
	}
}

/*
--------------------------------------------------------------------------------
* Render Posts Template
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_render_posts_template' ) ) {
	function th90_render_posts_template( $atts, $count, $query ) {
		if ( strpos( $atts['post_style'], 'group' ) !== false ) {
			$box_inside = false;
			if ( 'hero' == $atts['group_big'] && 'small1' == $atts['group_small'] ) {
				$box_inside = true;
			}

			if ( ( 1 == $count && 'group5' !== $atts['post_style'] ) || ( 'group2' == $atts['post_style'] && 2 == $count ) || ( 'group3' == $atts['post_style'] && 2 == $count ) || ( 'group3' == $atts['post_style'] && 3 == $count ) || ( 'group5' == $atts['post_style'] && $count%3 == 0 ) ) {
				get_template_part( 'template-parts/posts/post', $atts['group_big'], array(
					'block' => $atts,
					'count' => $count,
					'sufix' => '_b',
				) );

			} else {
				if ( ( $box_inside && ( 'group1' == $atts['post_style'] || 'group4' == $atts['post_style'] ) && 2 == $count ) || ( $box_inside && 'group2' == $atts['post_style'] && 3 == $count ) || ( $box_inside && 'group3' == $atts['post_style'] && 4 == $count ) ) {
					echo '<div class="' . esc_attr( implode( ' ', array_filter( th90_box_class( $atts ) ) ) ) . '"><div class="post-list-childs">';
				}
				if ( ! $box_inside && 'group4' == $atts['post_style'] && 2 == $count ) {
					echo '<div class="post-list-childs">';
				}

				get_template_part( 'template-parts/posts/post', $atts['group_small'], array(
					'block'     => $atts,
					'count'     => $count,
					'sufix'	=> '_s',
				) );

				if ( ( $box_inside && ( 'group1' == $atts['post_style'] || 'group4' == $atts['post_style'] ) && $query->post_count == $count ) || ( $box_inside && 'group2' == $atts['post_style'] && $query->post_count == $count ) || ( $box_inside && 'group3' == $atts['post_style'] && $query->post_count == $count ) ) {
					echo '</div></div>';
				}

				if ( ! $box_inside && 'group4' == $atts['post_style'] && $query->post_count == $count ) {
					echo '</div>';
				}

			}
		} else {
			if ( $count == $atts['post_ads_pos'] && 'yes' == $atts['post_ads'] ) {
				if ( 'yes' == $atts['b_ads_custom'] ) {
					get_template_part( 'template-parts/banner', '', array(
						'block' => $atts,
					) );
				} else {
					th90_render_ads( $atts['b_ads'] );
				}
			}

			get_template_part( 'template-parts/posts/post', $atts['post_style'], array(
				'block'     => $atts,
				'count'     => $count,
			) );
		}
	}
}

/*
--------------------------------------------------------------------------------
* Redux Posts Loop
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_render_posts_loop' ) ) {

	function th90_render_posts_loop( $query, $atts = array(), $is_main_query = false ) {
		?>
		<div class="posts-container">
			<?php
			$count = 0;
			if ( $query->have_posts() ) {
				$posts_list_classes = array(
					'posts-list',
					( strpos( $atts['post_style'], 'group' ) !== false ) || ( isset( $atts['is_grid'] ) && $atts['is_grid'] )  ? 'post-list-grids' : 'post-list-columns',
				);
				echo '<div class="' . esc_attr( implode( ' ', array_filter( $posts_list_classes ) ) ) . '">';
					while ( $query->have_posts() ) :
						$query->the_post();
						$count++;

						th90_render_posts_template( $atts, $count, $query );

						// Do not duplicate posts ----------
						if ( isset( $atts['not_show_duplicate'] ) && 'yes' == $atts['not_show_duplicate'] ) {
							th90_do_not_duplicate( get_the_ID() );
						}
					endwhile;
					if ( ! $is_main_query ) {
						wp_reset_postdata();
					}
				echo '</div>';
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
			?>
		</div>
		<?php
	}
}

/*
--------------------------------------------------------------------------------
* Render Pagination
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_render_pagination' ) ) {

	function th90_render_pagination( $query, $atts = array() ) {
		if ( ! empty( $atts['pagi'] ) && 'infinite' != $atts['pagi'] && $query->max_num_pages > 1 ) {
			?>
			<div class="box-disable nav-wrap nav-wrap-<?php echo( esc_attr( $atts['pagi'] ) ); ?> text-<?php echo( esc_attr( $atts['_pagi_align'] ) ); ?>">
				<div class="nav-wrap-inner">
					<?php
					$btn_classes = array(
						'button',
						'module-pagi',
						'btn-pagi',
						'show-more',
						'btn-' . $atts['pagi_style'],
					);
					if ( $atts['pagi'] == 'numeric' ) {
						th90_numeric_pagination( $query );
					} elseif ( $atts['pagi'] == 'show-more' ) {
						?>
						<div class="<?php echo esc_attr( implode( ' ', array_filter( $btn_classes ) ) ); ?> next-posts" data-text="<?php echo esc_attr( $atts['_pagi_show_text'] ); ?>">
							<span class="more-text text-btn"><?php echo esc_html( $atts['_pagi_show_text'] ); ?></span>
						</div>
						<?php
					} elseif ( $atts['pagi'] == 'load-more' ) {
						?>
						<div class="<?php echo esc_attr( implode( ' ', array_filter( $btn_classes ) ) ); ?> load-more next-posts" data-text="<?php echo esc_html( $atts['_pagi_load_text'] ); ?>">
							<span class="more-text text-btn"><?php echo esc_html( $atts['_pagi_load_text'] ); ?></span>
						</div>
						<?php
					} else {
						?>
						<div class="<?php echo esc_attr( implode( ' ', array_filter( $btn_classes ) ) ); ?> nextprev-more prev-posts btn-disabled" data-text="<?php echo esc_attr( $atts['_pagi_prev_text'] ); ?>">
							<span class="more-text text-btn"><?php echo esc_attr( $atts['_pagi_prev_text'] ); ?></span>
						</div>
						<div class="<?php echo esc_attr( implode( ' ', array_filter( $btn_classes ) ) ); ?> nextprev-more next-posts" data-text="<?php echo esc_attr( $atts['_pagi_next_text'] ); ?>">
							<span class="more-text text-btn"><?php echo esc_attr( $atts['_pagi_next_text'] ); ?></span>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}

		if ( 'infinite' == $atts['pagi'] ) {
			?>
			<div class="nav-wrap nav-wrap-infinite text-center">
				<div class="nav-wrap-inner">
					<div class="module-infinite show-more load-more next-posts">
					</div>
				</div>
			</div>
			<?php
		}
	}
}

/*
--------------------------------------------------------------------------------
* Render ajax JSON Pagination
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_json_pagination' ) ) {

	function th90_json_pagination( $block_id, $atts = array() ) {
		$js_block = array();
		foreach ( $atts as $key => $value ) {
			if( '_' != substr($key, 0, 1) ) {
				$js_block[$key] = $value;
			}
		}
		?>
		<script>var js_th90_block_<?php echo esc_js( $block_id ); ?> = <?php echo wp_json_encode( $js_block ); ?></script>
		<?php
	}
}
