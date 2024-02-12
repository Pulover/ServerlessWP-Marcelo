<?php
/**
 * This template used for term grid
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
    <div class="post-small">
        <?php if ( $term_image ): ?>
        <div class="post-small-thumbnail thumbnail-circle">
            <div class="entry-thumbnail">
                <a href="<?php echo esc_url( get_term_link( $args['block']['term_id'] ) ); ?>" title="<?php echo esc_attr( $term_name ); ?>">
                    <?php th90_cat_thumbnail( '1_1', $term_image, 'thumbnail', $cat_color, $term_name ); ?>
                </a>
             </div>
        </div>
        <?php endif; ?>

        <div class="term-desc post-small-desc">
            <div class="term-title">
                <a href="<?php echo esc_url( get_term_link( $args['block']['term_id'] ) ); ?>" title="<?php echo esc_attr( $term_name ); ?>">
                    <?php echo esc_html( $term_name ); ?>
                </a>
            </div>
            <div class="term-count meta-item">
                <?php echo esc_html( sprintf( __( '%s Posts', 'atlas' ), $term_count ) ); ?>
            </div>

        </div>
    </div>
</div>
