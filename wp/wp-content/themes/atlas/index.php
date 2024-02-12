<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Atlas
 */

get_header();
?>

<div id="primary" class="content-area">
	<div class="container">
		<div class="section-inner">
			<main id="main" class="site-main">
				<div class="main-area<?php echo esc_attr( th90_box() ); ?>">
					<?php get_template_part( 'template-parts/page', 'title' ); ?>
	                <?php
					global $wp_query;
					$posts_found = $wp_query->found_posts;
					if ( is_search() ) {
						$template_search = th90_display_elementor_content( th90_opt( 'search_template' ) );
				        if ( $template_search && $posts_found ) {
				            echo apply_filters( 'th90_print_search_template', $template_search );
				        } else {
					        get_template_part( 'template-parts/default', 'archive' );
						}
					} else {
						$template_archive = th90_display_elementor_content( th90_opt( 'archive_template' ) );
				        if ( $template_archive ) {
				            echo apply_filters( 'th90_print_archive_template', $template_archive );
				        }
					    else {
					        get_template_part( 'template-parts/default', 'archive' );
					    }
					}
					?>
				</div>
			</main>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php
get_footer();
