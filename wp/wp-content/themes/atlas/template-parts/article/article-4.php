<?php
/**
 * Article layout 5
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'd-flexlist article-3 sidebar-full' ); ?>>
	<?php do_action( 'th90_article_top' ); ?>
	<div class="container">
		<?php th90_single_featured_image_hero( array(
			'wrap_before'         => '<div class="section-inner featured-section article-section"><div class="entry-featured"><div class="featured-hero">',
			'wrap_after'          => '</div></div></div>',
		) ); ?>

		<div class="section-inner article-section">
            <main id="main" class="site-main" role="main">
				<?php do_action( 'th90_article_elements_top' ); ?>
				<div class="element-article box-section <?php echo esc_attr( th90_opt_override( 'override_post_layout', 'box_post' ) ) ? 'box-wrap' : 'box-wrap box-disable'; ?>">
	                <?php
					get_template_part( 'template-parts/article/article', 'content' );
	                ?>
				</div>
				<?php do_action( 'th90_article_elements_below' ); ?>
            </main>
        </div>
    </div>
	<?php do_action( 'th90_article_bottom' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
