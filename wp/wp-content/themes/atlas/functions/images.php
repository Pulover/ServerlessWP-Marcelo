<?php
/**
 * Images functions
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * -----------------------------------------------------------------------------
 * Check Lazyload
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_lazyload_check' ) ) {

	function th90_lazyload_check() {
		// Check if we are in an AMP page
		if ( th90_is_amp() ) {
			return;
		}
		return true;
	}
}

/**
 * -----------------------------------------------------------------------------
 * Max scrset image width
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_max_srcset_image_width' ) ) {
	function th90_max_srcset_image_width() {
		return 1920;
	}
}
add_filter( 'max_srcset_image_width', 'th90_max_srcset_image_width', 10 );

/**
 * -----------------------------------------------------------------------------
 * Image Ratio
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_image_ratio' ) ) {

	function th90_image_ratio( $thumb = 'post-thumbnail', $no_image = false ) {
		if ( strpos( $thumb, '1_1' ) !== false ) {
			$img_ratio = '100';
		} elseif ( strpos( $thumb, '16_9' ) !== false ) {
			$img_ratio = '56';
		} elseif ( strpos( $thumb, '3_2' ) !== false ) {
			$img_ratio = '67';
		} elseif ( strpos( $thumb, '4_3' ) !== false ) {
			$img_ratio = '75';
		} elseif ( strpos( $thumb, '2_1' ) !== false ) {
			$img_ratio = '50';
		} elseif ( strpos( $thumb, '4_5' ) !== false ) {
			$img_ratio = '125';
		} elseif ( strpos( $thumb, '2_3' ) !== false ) {
			$img_ratio = '150';
		} elseif ( strpos( $thumb, '3_4' ) !== false ) {
			$img_ratio = '133';
		} elseif ( strpos( $thumb, 'ori' ) !== false ) {
			$img_ratio = 'ori';

			if ( $no_image ) {
				$img_ratio = '100';
			}
		} else {
			$img_ratio = 'custom';

			if ( $no_image ) {
				$img_ratio = '100';
			}
		}

		return $img_ratio;

	}
}

/**
 * -----------------------------------------------------------------------------
 * Post thumbnail URL
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_post_thumbnail_url' ) ) {

	function th90_post_thumbnail_url( $thumb = 'large' ) {
		if ( has_post_thumbnail() && get_the_post_thumbnail() ) {
			return wp_get_attachment_image_src( get_post_thumbnail_id(), $thumb )[0];
		}
	}
}

/**
 * -----------------------------------------------------------------------------
 * Post thumbnail
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_post_thumbnail' ) ) {

	function th90_post_thumbnail( $thumb_ratio = 'ori', $args = array() ) {
		$args_default = array(
			'before'         => '',
			'after'          => '',
			'is_link'        => true,
			'format_icon'    => true,
			'first_cat'      => false,
			'thumbnail_type' => 'image',
			'count'          => '',
			'list_post'      => false,
			'hero'           => false,
			'review'         => false,
		);
		$args = wp_parse_args( $args, $args_default );

		$have_thumb = false;
		if ( 'image' == $args['thumbnail_type'] ) {
			if ( get_the_post_thumbnail() ) {
				$have_thumb = true;
			} else {
				if ( $args['hero'] ) {
					$have_thumb = false;
				}
			}
		} else {
			if ( get_the_post_thumbnail() ) {
				$have_thumb = false;
			}
		}

		if ( ! $have_thumb && 'char' != $args['thumbnail_type'] && ! $args['hero'] ) {
			return;
		}

		echo wp_kses_post( $args['before'] );

		if ( $args['is_link'] ) {
			echo '<a class="src-'. esc_attr( $thumb_ratio ) .'" href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( the_title_attribute( 'echo=0' ) ) . '">';
		}

		$img_char = '<div class="img-char">' . mb_substr( get_the_title(), 0, 1 ) . '</div>';

		if ( $have_thumb ) {
			if ( 'ori' == th90_image_ratio( $thumb_ratio ) ) {
				$image_id = get_post_thumbnail_id();
				$image = wp_get_attachment_image_src( $image_id, 'full' );
				$ratio_value = ( $image[2] / $image[1] ) * 100;
				echo '<div class="thumb-container" style="padding-bottom:' . $ratio_value . '%;">';
			} else {
				echo '<div class="thumb-container thumb-'. esc_attr( th90_image_ratio( $thumb_ratio ) ) .'">';
			}
			echo get_the_post_thumbnail();
			echo '</div>';

		} else {
			echo '<div class="thumb-container thumb-'. esc_attr( th90_image_ratio( $thumb_ratio , true ) ) .'">' . $img_char . '</div>';
		}

		if ( $args['is_link'] ) {
			echo '</a>';
		}

		if ( $args['count'] ) {
			echo '<div class="thumb-count">' . th90_number_post_parse( $args['count'], true ) . '</div>';
		}
		if ( $args['first_cat'] ) {
			echo '<div class="entry-cats">';
				echo th90_get_category( 'btn', true );
			echo '</div>';
		}
		if ( $args['format_icon'] && th90_post_format_icon() ) {
			th90_post_format_icon();
		}

		if ( $args['review'] && th90_get_meta_review() ) {
			th90_meta_review();
		}

		echo wp_kses_post( $args['after'] );
	}
}

/**
 * -----------------------------------------------------------------------------
 * Single Featured Image
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_single_featured_image' ) ) {
	function th90_single_featured_image( $args = array() ) {
		$args_default = array(
			'wrap_before' => '<div class="entry-featured">',
			'wrap_after'  => '</div>',
		);
		$args = wp_parse_args( $args, $args_default );

		if ( is_singular( 'post' ) ) {
			$thumb_ratio = th90_opt_override( 'override_post_layout', 'post_featured_ratio' );
		} else {
			$thumb_ratio = 'ori';
		}

		if ( has_post_format( 'video' ) && th90_field_single( 'video_embed' ) ) {
			echo wp_kses_post( $args['wrap_before'] );
			th90_video_featured();
			echo wp_kses_post( $args['wrap_after'] );
		} elseif ( has_post_format( 'audio' ) && th90_field_single( 'audio_embed' ) ) {
			echo wp_kses_post( $args['wrap_before'] );
			th90_audio_featured();
			echo wp_kses_post( $args['wrap_after'] );
		} elseif ( has_post_format( 'gallery' ) && ! empty( th90_field_single( 'post_gallery' ) ) ) {
			echo wp_kses_post( $args['wrap_before'] );
			th90_gallery();
			echo wp_kses_post( $args['wrap_after'] );
		} else {
			if ( has_post_thumbnail() && get_the_post_thumbnail() ) {
				echo wp_kses_post( $args['wrap_before'] );
				echo '<div class="media-holder">';
					echo '<a class="venobox" href="' . wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0] . '">';
						if ( 'ori' == th90_image_ratio( $thumb_ratio ) ) {
							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
							$ratio_value = ( $image[2] / $image[1] ) * 100;
							echo '<div class="thumb-container" style="padding-bottom:' . $ratio_value . '%;">';
						} else {
							echo '<div class="thumb-container thumb-'. esc_attr( th90_image_ratio( $thumb_ratio ) ) .'">';
						}

						the_post_thumbnail( 'large' );

						echo '</div>';

					echo '</a>';
				echo '</div>';
				echo wp_kses_post( $args['wrap_after'] );
			}
		}
	}
}

/**
 * -----------------------------------------------------------------------------
 * Single Featured Image Hero
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_single_featured_image_hero' ) ) {
	function th90_single_featured_image_hero( $args = array() ) {
		$args_default = array(
			'wrap_before' => '<div class="entry-featured"><div class="featured-hero">',
			'wrap_after'  => '</div></div>',
			'hero_height' => th90_opt_override( 'override_post_layout', 'featured_height' ),
		);
		$args = wp_parse_args( $args, $args_default );

		if ( is_singular( 'post' ) ) {
			$thumb_ratio = th90_opt_override( 'override_post_layout', 'post_featured_ratio' );
		} else {
			$thumb_ratio = 'ori';
		}

		echo wp_kses_post( $args['wrap_before'] );
			if ( has_post_thumbnail() && get_the_post_thumbnail() ) {
				if ( $args['hero_height'] ) {
					echo '<div class="thumb-container" style="padding-bottom:' . $args['hero_height'] . 'px;">';
				} else {
					if ( 'ori' == th90_image_ratio( $thumb_ratio ) ) {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						$ratio_value = ( $image[2] / $image[1] ) * 100;
						echo '<div class="thumb-container" style="padding-bottom:' . $ratio_value . '%;">';
					} else {
						echo '<div class="thumb-container thumb-'. esc_attr( th90_image_ratio( $thumb_ratio ) ) .'">';
					}
				}

				the_post_thumbnail( 'large' );
			} else {
				$img_char = '<div class="img-char">' . mb_substr( get_the_title(), 0, 1 ) . '</div>';
				echo '<div class="thumb-container thumb-50">' . $img_char;
			}
			?>
			</div>

			<div class="post-desc desc-hero bg-dark">
		        <div class="post-desc-inner">
					<?php get_template_part( 'template-parts/article/article', 'title' ); ?>
				</div>
			</div>
		<?php
		echo wp_kses_post( $args['wrap_after'] );
	}
}

/**
 * -----------------------------------------------------------------------------
 * Single Media Format Hero
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_single_media_format' ) ) {
	function th90_single_media_format( $args = array() ) {
		$args_default = array(
			'wrap_before' => '<div class="entry-featured">',
			'wrap_after'  => '</div>',
		);
		$args = wp_parse_args( $args, $args_default );

		if ( has_post_format( 'video' ) && th90_field_single( 'video_embed' ) ) {
			echo wp_kses_post( $args['wrap_before'] );
			th90_video_featured();
			echo wp_kses_post( $args['wrap_after'] );
		} elseif ( has_post_format( 'audio' ) && th90_field_single( 'audio_embed' ) ) {
			echo wp_kses_post( $args['wrap_before'] );
			th90_audio_featured();
			echo wp_kses_post( $args['wrap_after'] );
		} elseif ( has_post_format( 'gallery' ) && ! empty( th90_field_single( 'post_gallery' ) ) ) {
			echo wp_kses_post( $args['wrap_before'] );
			th90_gallery();
			echo wp_kses_post( $args['wrap_after'] );
		}

		return;
	}
}

/**
 * -----------------------------------------------------------------------------
 * Article Gallery
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_gallery' ) ) {

	function th90_gallery() {
		$wrap_before = '<div class="media-holder">';
		$wrap_after = '</div>';

		$gallery = array();
		if ( ! empty( th90_field_single( 'post_gallery' ) ) ) {
			$gallery = th90_field_single( 'post_gallery' );
		}
		$gallery_autoplay = th90_field_single( 'gallery_autoplay' );
		$thumb_ratio = th90_field_single( 'gallery_ratio' );

		if ( th90_is_amp() ) {
			?>
			<amp-carousel loop width="450" height="300" layout="responsive" type="slides" role="region">
			<?php
			foreach ( $gallery as $gallery_image ) {
				if ( 'ori' == th90_image_ratio( $thumb_ratio ) ) {
					$image = wp_get_attachment_image_src( $gallery_image['ID'], 'full' );
					$ratio_value = ( $image[2] / $image[1] ) * 100;
					echo '<div class="thumb-container" style="padding-bottom:' . $ratio_value . '%;">';
				} else {
					echo '<div class="thumb-container thumb-'. esc_attr( th90_image_ratio( $thumb_ratio ) ) .'">';
				}
				wp_get_attachment_image( $gallery_image['ID'], 'large' );
				echo '</div>';
			}
			?>
			</amp-carousel>
			<?php
		} else {
			/* Slider Atts */
			$slider_atts = array(
				'class' => 'th90-slider post-gallery',
				'id' => 'fgallery-' . get_the_ID(),
			);

			if ( ! empty( $gallery ) ) {
				/* Slider Config */
				echo wp_kses_post( $wrap_before );
				?>
				<div class="block-slider nav-top_right">
					<div <?php echo th90_stringify_attributes( $slider_atts ); ?> data-settings='<?php echo esc_attr( wp_json_encode( th90_slider_config_default( array( 'autoplay' => $gallery_autoplay ) ) ) ); ?>'>
						<div class="slider-wrap">
							<div class="slick-slider">
								<?php
								foreach ( $gallery as $gallery_image ) {
									echo '<div class="slider-item">';
										echo '<a class="venobox" data-gall="post-' . get_the_ID() . '" href="'.wp_get_attachment_image_src( $gallery_image['ID'], 'full' )[0].'">';
											if ( 'ori' == th90_image_ratio( $thumb_ratio ) ) {
												$image = wp_get_attachment_image_src( $gallery_image['ID'], 'full' );
												$ratio_value = ( $image[2] / $image[1] ) * 100;
												echo '<div class="thumb-container" style="padding-bottom:' . $ratio_value . '%;">';
											} else {
												echo '<div class="thumb-container thumb-'. esc_attr( th90_image_ratio( $thumb_ratio ) ) .'">';
											}
											th90_the_add_lazyload( wp_get_attachment_image( $gallery_image['ID'], 'large' ), $gallery_image['ID'] );
											echo '</div>';

										echo '</a>';
									echo '</div>';

								}
								?>
							</div>
							<div class="slider-arrow"></div>
						</div>
					</div>
				</div>
				<?php
				echo wp_kses_post( $wrap_after );
			}
		}

	}
}

/**
 * -----------------------------------------------------------------------------
 * Article Audio
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_audio_featured' ) ) {

	function th90_audio_featured() {
		$wrap_before = '<div class="media-holder">';
		$wrap_after = '</div>';
		$embed_code = th90_field_single( 'audio_embed' );
		if ( $embed_code ) {
			echo wp_kses_post( $wrap_before );
				th90_the_add_lazyload_iframe( $embed_code );
			echo wp_kses_post( $wrap_after );
		}
	}
}

/**
 * -----------------------------------------------------------------------------
 * Article Video
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_video_featured' ) ) {

	function th90_video_featured() {
		$wrap_before = '<div class="media-holder">';
		$wrap_after = '</div>';
		$embed_code = th90_field_single( 'video_embed' );

		if ( $embed_code ) {
			echo wp_kses_post( $wrap_before );
				echo '<div class="video-container">';
					th90_the_add_lazyload_iframe( $embed_code );
				echo '</div>';
			echo wp_kses_post( $wrap_after );
		}
	}
}

/**
 * -----------------------------------------------------------------------------
 * Get URL src of embed
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_get_url_embed' ) ) {
	function th90_get_url_embed( $embed ) {
		if ( $embed ) {
			preg_match('/src=(["\'])(.*?)\1/', $embed, $match);
			return $match[2];
		}
		return;
	}
}

/**
 * -----------------------------------------------------------------------------
 * Check iframe is youtube or vimeo
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_check_youtube_vimeo' ) ) {
	function th90_check_youtube_vimeo( $embed ) {
		if ( $embed ) {
			if ( strpos( th90_get_url_embed( $embed ), 'yout' ) !== false || strpos( th90_get_url_embed( $embed ), 'vim' ) !== false ) {
				return true;
			}
		}
		return false;
	}
}

/**
 * -----------------------------------------------------------------------------
 * Build Youtube URL
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_build_youtube_url' ) ) {
	function th90_build_youtube_url( $url, $args = array() ) {
		// Defaults ----------
		$args = wp_parse_args( $args, array(
			'autoplay'       => 1,
			'loop'           => 1,
			'modestbranding' => 0,
			'rel'            => 0,
			'controls'       => 0,
			'showinfo'       => 0,
			'mute'           => 1,
		));
		$matches = array();
		preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);

		if ( ! empty( $matches ) ) {
			return add_query_arg( $args, 'https://www.youtube-nocookie.com/embed/' . $matches[1] );
		}
		return;
	}
}

/**
 * -----------------------------------------------------------------------------
 * Build Vimeo URL
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_build_vimeo_url' ) ) {
	function th90_build_vimeo_url( $url, $args = array() ) {
		// Defaults ----------
		$args = wp_parse_args( $args, array(
			'autoplay'   => 1,
			'loop'       => 1,
			'byline'     => 0,
			'title'      => 0,
			'background' => 1,
			'dnt'        => 1,
			'muted'      => 1,
		));
		$matches = array();
		preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/video_url\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $matches);

		if ( ! empty( $matches ) ) {
			return add_query_arg( $args, 'https://player.vimeo.com/video/' . $matches[3] );
		}
		return;
	}
}

/**
 * -----------------------------------------------------------------------------
 * Cat thumbnail
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_cat_thumbnail' ) ) {

	function th90_cat_thumbnail( $thumb_ratio = 'ori', $image_id = null, $size = 'thumbnail', $term_name = '' ) {

		$img_char = '<div class="img-char">' . mb_substr( $term_name, 0, 1 ) . '</div>';

		if ( $image_id ) {
			$image = wp_get_attachment_image_src( $image_id, 'full' );
			if ( 'ori' == th90_image_ratio( $thumb_ratio ) ) {
				if ( 0 !== absint( $image[1] ) && 0 !== absint( $image[2] ) ) {
					$ratio_value = ( $image[2] / $image[1] ) * 100;
					echo '<div class="thumb-container" style="padding-bottom:' . $ratio_value . '%;">';
				} else {
					echo '<div class="thumb-container thumb-100">';
				}
			} else {
				echo '<div class="thumb-container thumb-'. esc_attr( th90_image_ratio( $thumb_ratio ) ) .'">';
			}

			th90_the_add_lazyload( wp_get_attachment_image( $image_id, $size ), $image_id );

			echo '</div>';
		} else {
			echo '<div class="thumb-container thumb-'. esc_attr( th90_image_ratio( $thumb_ratio , true ) ) .'">' . $img_char . '</div>';
		}
	}
}
