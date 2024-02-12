<?php
/**
 * Menu Walker
 *
 * @package Atlas
 */

/*
--------------------------------------------------------------------------------
* Menu Walker
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_menu_walker_filters' ) ) {

	function th90_menu_walker_filters( $item_output, $item, $depth, $args ) {
		$attributes = $item_output = $th90_menu_template = $th90_posts_cat = $th90_posts_cat_style = $submobile_pointer = $parent_pointer = $subparent_pointer = $note = '';
		$have_template = $have_posts = false;

		$th90_menu_note = get_post_meta( $item->ID, 'menu-item-th90_menu_note', true );
		$th90_menu_note_bg = get_post_meta( $item->ID, 'menu-item-th90_menu_note_bg', true );
		$th90_menu_note_color = get_post_meta( $item->ID, 'menu-item-th90_menu_note_color', true );

		if ( 0 === $depth ) {
			$th90_menu_template = get_post_meta( $item->ID, 'menu-item-th90_menu_template', true );

			if ( 'category' == $item->object ) {
				$th90_posts_cat = get_post_meta( $item->ID, 'menu-item-th90_posts_cat', true );
				$th90_posts_cat_style = get_post_meta( $item->ID, 'menu-item-th90_posts_cat_style', true );
			}
		}

		if ( 1 != $args->depth && 'nav-main' == $args->menu_class && $th90_menu_template && th90_display_elementor_content( $th90_menu_template ) && ! in_array( 'menu-item-has-children', $item->classes ) ) {
            $have_template = true;
        }

		if ( 1 != $args->depth && 'nav-main' == $args->menu_class && $th90_posts_cat && ! in_array( 'menu-item-has-children', $item->classes ) ) {
            $have_posts = true;
        }

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )  ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';

		if ( $have_template ) {
            $attributes .= ' class="have-megamenu"';
        } elseif ( $have_posts ) {
            $attributes .= ' class="have-megamenu megacat"';
			$attributes .= ' data-id="' . esc_attr( $item->object_id ) .'"';
			$attributes .= ' data-style="'   . esc_attr( $th90_posts_cat_style ) .'"';
        }

		// Mobile Menu Child Indicator
		if ( 'nav-mobile' == $args->menu_class && in_array( 'menu-item-has-children', $item->classes ) ) {
			$submobile_pointer = '<span class="sub-pointer"></span>';
		}

		// Menu Item Child Indicator
		if ( 0 === $depth ) {
			if ( $args->link_after && 'nav-main' == $args->menu_class && ( in_array( 'menu-item-has-children', $item->classes ) || $have_template || $have_posts ) ) {
				$parent_pointer = '<span class="parent-pointer"></span>';
			}
		} else {
			if ( 'nav-main' == $args->menu_class && in_array( 'menu-item-has-children', $item->classes ) ) {
				$subparent_pointer = '<span class="subparent-pointer"></span>';
			}
		}

		if ( 0 === $depth && $args->before ) {
			$item_output .= $args->before;
		}

		// Menu Note
		if ( $th90_menu_note && 'nav-main' == $args->menu_class ) {
			$note_atts_style = array();
			if ( $th90_menu_note_bg ) {
				$note_atts_style['background-color'] = 'background-color:' . $th90_menu_note_bg . ';';
			}
			if ( $th90_menu_note_color ) {
				$note_atts_style['color'] = 'color:' . $th90_menu_note_color . ';';
			}
			$note_atts = array(
				'class' => 'menu-note',
				'style' => implode( ' ', array_filter( $note_atts_style ) ),
			);

			$note .= '<span ' . th90_stringify_attributes( $note_atts ) . '>';
			$note .= $th90_menu_note;
			$note .= '</span>';
		}

		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before;
        $item_output .= '<span class="menu-text">';
		$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $note;
		$item_output .= $parent_pointer;
		$item_output .= '</span>';
		$item_output .= $subparent_pointer;
		$item_output .= $submobile_pointer;
		$item_output .= '</a>';

		// Menu Item Space
		if ( 0 === $depth ) {
			$item_output .= '<span class="menu-item-space">' . $args->after . '</span>';
		}

		// Menu Elementor Template
		if ( $have_template ) {
			$item_output .= '<span class="mega-indicator"></span>';
			$item_output .= '<ul class="sub-menu mega-template">';
				$item_output .= '<li>';
					$item_output .= th90_display_elementor_content( $th90_menu_template );
				$item_output .= '</li>';
			$item_output .= '</ul>';
		} elseif ( $have_posts ) {
			$item_output .= '<span class="mega-indicator"></span>';
			$item_output .= '<ul class="sub-menu mega-template megacat-' . esc_attr( $th90_posts_cat_style ) . '">';
				$item_output .= '<li>';
					$item_output .= '<div class="posts-container"><div class="posts-list post-list-grids"></div></div>';
				$item_output .= '</li>';
			$item_output .= '</ul>';
		}

		return $item_output;
	}
}
add_filter( 'walker_nav_menu_start_el', 'th90_menu_walker_filters', 10, 4 );
