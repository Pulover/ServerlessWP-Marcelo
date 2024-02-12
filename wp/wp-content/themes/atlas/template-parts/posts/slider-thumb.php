<?php
/**
 * This template used for slider thumbnails
 *
 * @package Atlas
 */

/* Avoid not set block args */

$post_class = array(
    'post-item',
    'cat-' . th90_get_primary_category_id(),
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_filter( $post_class ) ) ); ?>">
    <article class="thumb-item">
	<?php
    th90_post_thumbnail( '1_1', array(
        'before'		=> '<div class="post-small-thumbnail thumbnail-circle"><div class="entry-thumbnail">',
        'after'			=> '</div></div>',
        'thumbnail_type' => 'image',
        'review'            => true,
    ) );
	?>
    <svg class="progressBar" width="72" height="72"><circle r="35" cx="36" cy="36"></circle></svg>
    </artice>
</div>
