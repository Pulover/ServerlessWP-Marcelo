<?php
/**
 * Article Elements functions
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * -----------------------------------------------------------------------------
 * Box Author Article
 * -----------------------------------------------------------------------------
 */
if( ! function_exists( 'th90_author_box_article' ) ) {

	function th90_author_box_article() {
		if ( TH90_ATLAS_CORE_ACTIVE && th90_opt( 'post_author' ) ) {
			if ( get_the_author_meta( 'description', get_the_author_meta( 'ID' ) ) ) {
				echo '<div class="element-article box-wrap article-author">';
					th90_author_box_single( get_the_author_meta( 'ID' ), 42, true );
				echo '</div>';
			}
		}
    }

    add_action( 'th90_article_elements_below', 'th90_author_box_article', 15 );
}

/**
 * -----------------------------------------------------------------------------
 * Prev Next Article Simple
 * -----------------------------------------------------------------------------
 */
if( ! function_exists( 'th90_prev_next_article' ) ) {

	function th90_prev_next_article() {

        if ( th90_opt( 'post_nav' ) ) {
            if ( get_adjacent_post() || get_adjacent_post( false, '', false ) ) {
				?>
				<div class="element-article article-nav<?php echo esc_attr( th90_box() ); ?>">
	                <nav class="entry-navigation">
						<?php
						echo '<div class="entry-navigation-left">';
						if ( get_adjacent_post() ) {
							$title = '<h6>%title</h6>';

							$prevthumbnail = '';
							if ( has_post_thumbnail( get_previous_post()->ID ) && get_the_post_thumbnail( get_previous_post()->ID ) ) {
								$prevthumbnail = '<div class="nav-thumbnail"><div class="thumb-container thumb-100">' . get_the_post_thumbnail( get_previous_post()->ID ) . '</div></div>';
							}

							$previcon = th90_get_svg_icon( is_rtl() ? 'arrow-right' : 'arrow-left' );
							$prevpointer = '<div class="nav-point meta-item">' . esc_html__( 'Previous Post', 'atlas' ) . '</div>';

							previous_post_link( '%link', "<div class='nav-post'>$prevthumbnail<div class='nav-desc'>$prevpointer$title</div></div>" );
						}
						echo '</div>';

						echo '<div class="entry-navigation-right">';
						if ( get_adjacent_post( false, '', false ) ) {

							$title = '<h6>%title</h6>';

							$nextthumbnail = '';
							if ( has_post_thumbnail( get_next_post()->ID ) && get_the_post_thumbnail( get_next_post()->ID ) ) {
								$nextthumbnail = '<div class="nav-thumbnail"><div class="thumb-container thumb-100">' . get_the_post_thumbnail( get_next_post()->ID ) . '</div></div>';
							}

							$nexticon = th90_get_svg_icon( is_rtl() ? 'arrow-left' : 'arrow-right' );
							$nextpointer = '<div class="nav-point meta-item">' . esc_html__( 'Next Post', 'atlas' ) . '</div>';

							next_post_link( '%link', "<div class='nav-post'>$nextthumbnail<div class='nav-desc'>$nextpointer$title</div></div>" );
						}
						echo '</div>';

						?>
	                </nav>
				</div>
            <?php
            }
        }
    }

    add_action( 'th90_article_elements_below', 'th90_prev_next_article', 20 );
}

/**
 * -----------------------------------------------------------------------------
 * Related Posts
 * -----------------------------------------------------------------------------
*/
if( ! function_exists( 'th90_related_posts_template' ) ) {
	function th90_related_posts_template() {
		$template = th90_display_elementor_content( th90_opt( 'related_posts' ) );
		if ( $template ) {
			?>
			<div class="element-article article-related">
				<?php echo apply_filters( 'th90_print_related_posts_template', $template ); ?>
			</div>
			<?php
		}
	}
	add_action( 'th90_article_elements_below', 'th90_related_posts_template', 25 );
}

/**
 * -----------------------------------------------------------------------------
 * Comments Article
 * -----------------------------------------------------------------------------
 */
if( ! function_exists( 'th90_comments_article' ) ) {

	function th90_comments_article() {

        comments_template();
    }

    add_action( 'th90_article_elements_below', 'th90_comments_article', 30 );
}

/**
 * -----------------------------------------------------------------------------
 * Hook article before
 * -----------------------------------------------------------------------------
 */
add_action( 'th90_article_elements_top', function() {
    $hook_article_before = th90_display_elementor_content( th90_opt( 'hook_article_before' ) );
    if ( $hook_article_before ) {
        echo apply_filters( 'th90_hook_article_before_template', $hook_article_before );
    }
}, 10 );

/**
 * -----------------------------------------------------------------------------
 * Hook article after
 * -----------------------------------------------------------------------------
 */
add_action( 'th90_article_elements_below', function() {
    $hook_article_after = th90_display_elementor_content( th90_opt( 'hook_article_after' ) );
    if ( $hook_article_after ) {
        echo apply_filters( 'th90_hook_article_after_template', $hook_article_after );
    }
}, 10 );
