<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Atlas
 */

get_header();
?>
<div id="primary" class="content-area">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( th90_is_builder_page() ): ?>

			<?php the_content(); ?>

		<?php else: ?>
			<div class="container">
				<div class="section-inner">
					<main id="main" class="site-main" role="main">
						<div class="main-area<?php echo esc_attr( th90_box() ); ?>">
							<?php get_template_part( 'template-parts/page', 'title' ); ?>

							<div class="page-container">
								<?php
								$classes = array(
							        'page-content',
									'element-page',
							        ! th90_woo_check_pages() ?  'entry-content article-content' : '',
							    );
								?>

								<div class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
									<?php
									th90_single_featured_image();

								    do_action( 'th90_above_pagee' );

								    the_content();

									if ( is_page_template( 'page-contact.php' ) && th90_field_single( 'contact_form_7' ) ) {
										echo do_shortcode( '[contact-form-7  id="' . th90_field_single( 'contact_form_7' ) . '"]' );
									}

								    do_action( 'th90_below_page' );
								    ?>

									<div class="clearfix"></div>

									<?php
									wp_link_pages( array(
										'before'      => '<div class="page-links-wrap"><div class="page-links"><span class="page-links-title screen-reader-text">' . esc_html__( 'Pages:', 'atlas' ) . '</span>',
										'after'       => '</div></div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
										'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'atlas' ) . ' </span>%',
										'separator'   => '',
									) );
									?>
								</div>

								<?php comments_template(); ?>

							</div>
						</div>
					</main>
					<?php get_sidebar(); ?>
				</div>
			</div>
		<?php endif; ?>

	<?php endwhile; ?>
</div><!-- #primary -->

<?php
get_footer();
