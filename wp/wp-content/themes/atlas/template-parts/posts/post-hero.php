<?php
/**
 * This template used for post hero
 *
 * @package Atlas
 */

$sufix = $class_sufix = '';
if ( isset( $args['sufix'] ) ) {
    $sufix = $args['sufix'];
    $class_sufix = 'post' . $args['sufix'];
}
/* Avoid not set block args */
$args['block'] = th90_post_block_atts_default( $args['block'], $sufix );

$post_class = array(
    'post-item',
    'cat-' . th90_get_primary_category_id(),
    $class_sufix,
);
if ( isset( $args['add_class'] ) ) {
    $post_class[] = $args['add_class'];
}
?>
<div class="<?php echo esc_attr( implode( ' ', array_filter( $post_class ) ) ); ?>">
    <article <?php th90_post_class( $args['block']['article_class'] . ' post-hero' ); ?>>
		<?php
		/* Post Thumbnail */
			th90_post_thumbnail( 'ori', array(
				'before'			=> '<div class="entry-thumbnail">',
				'after'				=> '</div>',
				'first_cat' 		=> ( 'thumbnail' == $args['block']['first_cat_loc' . $sufix] ) ? $args['block']['first_cat' . $sufix] : false,
				'first_cat_loc'     => $args['block']['first_cat_loc' . $sufix],
				'thumbnail_type'    => 'image',
                'hero'              => true,
			) );

		/* Post Desc */
		?>
		<div class="post-desc bg-dark desc-hero<?php echo ( 'yes' == $args['block']['post_center' . $sufix] ) ? ' text-center': ' text-left'; ?>">
            <div class="post-desc-inner">
				<div class="entry-header">
					<?php

                    if ( ( 'top' != $args['block']['info_position' . $sufix] && 'title' == $args['block']['first_cat_loc' . $sufix] && $args['block']['first_cat' . $sufix] && th90_get_category( $args['block']['cat_style' . $sufix], true ) ) ||  ( $args['block']['review' . $sufix] && th90_get_meta_review() ) || th90_is_sticky_post() ) {
                        echo '<div class="entry-cats">';
                            if ( th90_is_sticky_post() ) {
                                echo '<div class="meta-item meta-sticky"> <div class="sticky-sign">' . th90_get_svg_icon( 'star' ) . '</div></div>';
                            }
                            if ( $args['block']['review' . $sufix] && th90_get_meta_review() ) {
                                th90_meta_review();
                            }
                            if ( 'top' != $args['block']['info_position' . $sufix] && 'title' == $args['block']['first_cat_loc' . $sufix] && $args['block']['first_cat' . $sufix] && th90_get_category( $args['block']['cat_style' . $sufix], true ) ) {
                                echo th90_get_category( $args['block']['cat_style' . $sufix], true );
                            }
                        echo '</div>';;
					}

					$info_array = array(
                        'modern'        => $args['block']['meta_modern' . $sufix],
						'author' 		=> $args['block']['author' . $sufix],
						'date' 		 	=> $args['block']['date' . $sufix],
						'views'			=> $args['block']['views' . $sufix],
						'time_format'	=> $args['block']['time_format' . $sufix],
						'avatar'		=> $args['block']['author_avatar' . $sufix],
						'comments'		=> $args['block']['comments' . $sufix],
                        'readmore'      => $args['block']['readmore' . $sufix],
                        'readmore_side' => $args['block']['readmore_side' . $sufix],
						'first_cat' 	=> ( ( 'top' == $args['block']['info_position' . $sufix] && 'title' == $args['block']['first_cat_loc' . $sufix] ) || 'default' == $args['block']['first_cat_loc' . $sufix] ) ? $args['block']['first_cat' . $sufix] : false,
                        'icon'          => $args['block']['info_icon' . $sufix],
					);

					if ( 'top' == $args['block']['info_position' . $sufix] ) {
						th90_the_post_info( $info_array );
					}
					?>

					<h3 class="entry-title <?php echo esc_attr( $args['block']['title_tag' . $sufix] ? th90_convert_tag( $args['block']['title_tag' . $sufix] ) : 'head4' ); ?>">
						<a class="title-text" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php th90_the_title(); ?></a>
					</h3>

					<?php
					if ( 'under' == $args['block']['info_position' . $sufix] ) {
						th90_the_post_info( $info_array );
					}
					?>
				</div>

				<?php
                if ( 'yes' == $args['block']['excerpt' . $sufix] && th90_get_excerpt() ) {
                    ?>
                    <div class="entry-excerpt">
                        <?php th90_the_excerpt(); ?>
                    </div>
                    <?php
                }

				if ( 'bottom' == $args['block']['info_position' . $sufix] ) {
					th90_the_post_info( $info_array );
				}

                if ( isset( $args['slider_thumb_atts'] ) && isset( $args['slider_thumb_config'] ) ) {
                    get_template_part( 'template-parts/posts/slider', 'thumbs2', array(
                        'block'               => $args['block'],
                        'count'               => $args['count'],
                        'slider_thumb_atts'   => $args['slider_thumb_atts'],
                        'slider_thumb_config' => $args['slider_thumb_config'],
                    ) );
                }
				?>
			</div>
		</div>
    </article>
</div>
