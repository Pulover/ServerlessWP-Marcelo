<?php
/**
 * Article layout 1
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'd-flexlist article-1 sidebar-' . th90_opt_override( 'override_post_layout', 'post_sidebar_position' ) ); ?>>
	<?php do_action( 'th90_article_top' ); ?>
	<div class="container">
		<div class="section-inner article-section">
            <main id="main" class="site-main" role="main">
				<?php th90_single_featured_image_hero(); ?>
				<?php do_action( 'th90_article_elements_top' ); ?>
				<div class="element-article box-section <?php echo esc_attr( th90_opt_override( 'override_post_layout', 'box_post' ) ) ? 'box-wrap' : 'box-wrap box-disable'; ?>">
	                <?php
					th90_single_media_format();

					get_template_part( 'template-parts/article/article', 'content' );
					?>
				</div>
				<?php do_action( 'th90_article_elements_below' ); ?>
            </main>
			<?php get_sidebar(); ?>
        </div>
    </div>
	<?php do_action( 'th90_article_bottom' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->