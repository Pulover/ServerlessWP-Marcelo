<?php
/**
 * This template used for term hero
 *
 * @package Atlas
 */

$cat_color = th90_field_single( 'category_color', 'term_' . $args['block']['term_id'] );
$term_image = th90_field_single( 'term_image', 'term_' . $args['block']['term_id'] );
$term_name = $args['block']['term_name'];
$term_count = $args['block']['term_count'];

$post_class = array(
    'term-item',
    'term-' . $args['block']['term_id'],
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_filter( $post_class ) ) ); ?>">
    <div class="post-hero">

		<?php th90_cat_thumbnail( 'ori', $term_image, 'thumbnail', $cat_color, $term_name ); ?>

        <div class="post-desc bg-dark desc-hero">
            <a class="hero-link" href="<?php echo esc_url( get_term_link( $args['block']['term_id'] ) ); ?>" title="<?php echo esc_attr( $term_name ); ?>"></a>
            <div class="term-desc">
                <div class="term-title">
                    <?php echo esc_html( $term_name ); ?>
                </div>
                <div class="term-count">
                    <?php echo esc_html( $term_count ); ?>
                </div>

            </div>
		</div>
    </div>
</div>
