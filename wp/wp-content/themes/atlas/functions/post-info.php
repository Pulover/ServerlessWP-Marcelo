<?php
/**
 * Get post meta info functions
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'th90_get_post_info' ) ) {

	function th90_get_post_info( $args = '', $before = false, $after = false ) {

		// For Posts only ----------
		if ( get_post_type() != 'post' ) {
			return;
		}

		// Defaults ----------
		$args = wp_parse_args( $args, array(
			'modern'        => false,
			'first_cat'     => false,
			'cats'          => false,
			'cats_style'    => 'text',
			'author'        => false,
			'date'          => false,
			'views'         => false,
			'comments'      => false,
			'reading_time'  => false,
			'addclass'      => '',
			'avatar'        => false,
			'avatar_size'   => 20,
			'avatar_modern' => 35,
			'edit'          => false,
			'time_format'   => false,
			'icon'          => false,
			'last_update'   => false,
			'shares'        => false,
			'readmore'		=> false,
			'sticky_sign'   => false,
		));

		extract( $args );

		if ( th90_is_amp() ) {
			$avatar = false;
		}

		$classes = array(
		    'entry-meta',
			$icon && 'no' !== $icon ? '' : 'no-icons',
			$addclass,
		);

		$post_meta = $before . '<div class="' . esc_attr( implode( ' ', array_filter( $classes ) ) ) . '">';


		if ( ! empty( $sticky_sign ) && th90_is_sticky_post() ) {
			$post_meta .= '<div class="meta-item meta-sticky">';
			$post_meta .= '<div class="sticky-sign">';
			$post_meta .= th90_get_svg_icon( 'star' );
			$post_meta .= '</div>';
			$post_meta .= '</div>';
		}

		if ( $modern && 'no' !== $modern ) {
			// Modern ----------
			$post_meta .= '<div class="meta-item meta-author meta-modern author vcard meta-color">';
			$post_meta .= '<div class="author-ava" data-author="' . esc_attr( mb_substr( get_the_author(), 0, 1 ) ) . '">';
			$post_meta .= get_avatar( get_the_author_meta( 'ID' ), $avatar_modern );
			$post_meta .= '</div>';
			$post_meta .= '<div class="meta-modern-desc">';
			$post_meta .= '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="info-text author-name url fn" rel="author" title="' . esc_attr( sprintf( __( 'Posts by %s', 'atlas' ), get_the_author() ) ) . '">'  . get_the_author() . '</a>';
			$post_meta .= '<span class="info-text">' . th90_get_time( $time_format ) . '</span>';
			$post_meta .= '</div>';
			$post_meta .= '</div>';
		} else {
			// Author ----------
			if ( ! empty( $author ) ) {
				$post_meta .= '<div class="meta-item meta-author author vcard meta-color">';
				if ( $avatar && 'no' !== $avatar ) {
					$post_meta .= '<div class="author-ava" data-author="' . esc_attr( mb_substr( get_the_author(), 0, 1 ) ) . '">';
					$post_meta .= get_avatar( get_the_author_meta( 'ID' ), $avatar_size );
					$post_meta .= '</div>';
				} else {
					$post_meta .= $icon && 'no' !== $icon ? '<span class="info-icon">' . th90_get_svg_icon( 'person' ) . '</span>' : '';
				}
				$post_meta .= '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="info-text author-name url fn" rel="author" title="' . esc_attr( sprintf( __( 'Posts by %s', 'atlas' ), get_the_author() ) ) . '">'  . get_the_author() . '</a>';
				$post_meta .= '</div>';
			}

			// Date  ----------
			if ( ! empty( $date ) ) {
				$post_meta .= '<div class="meta-item meta-date">';
				$post_meta .= '<a class="meta-color" href="' . get_permalink() . '">';
				$post_meta .= $icon && 'no' !== $icon ? '<span class="info-icon">' . th90_get_svg_icon( 'date' ) . '</span>' : '';
				$post_meta .= '<span class="info-text">' . th90_get_time( $time_format ) . '</span>';
				$post_meta .= '</a>';
				$post_meta .= '</div>';
			}
		}

		// First Category ----------
		if ( ! empty( $first_cat ) ) {
			$post_meta .= '<div class="meta-item meta-firstcat">';
			$post_meta .= th90_get_category( $cats_style, true );
			$post_meta .= '</div>';
		}

		// All Category ----------
		if ( ! empty( $cats ) ) {
			$post_meta .= '<div class="meta-item meta-cat">';
			$post_meta .= th90_get_category( $cats_style );
			$post_meta .= '</div>';
		}

		// Last Update ----------
		$u_time = get_the_time('U');
		$u_modified_time = get_the_modified_time('U');
		if ( ! empty( $last_update ) && $u_modified_time >= $u_time + 86400 ) {
			$post_meta .= '<div class="meta-item meta-last_update">';
			$post_meta .= $icon && 'no' !== $icon ? '<span class="info-icon">' . th90_get_svg_icon( 'date' ) . '</span>' : '';
			$post_meta .= '<span class="info-text">' . sprintf( esc_html__( 'Last Update on %s', 'atlas' ), get_the_modified_time('F j, Y') ) . '</span>';
			$post_meta .= '</div>';
		}

		// Reading Time ----------
		if ( ! empty( $reading_time ) ) {
			$post_meta .= '<div class="meta-item meta-readtime meta-color">';
			$post_meta .= $icon && 'no' !== $icon ? '<span class="info-icon">' . th90_get_svg_icon( 'pulse' ) . '</span>' : '';
			$post_meta .= '<span class="info-text">' . th90_reading_time() . '</span>';
			$post_meta .= '</div>';
		}

		// Number of views ----------
		if ( ! empty( $views ) && TH90_POSTVIEWS_IS_ACTIVE ) {
			$count  = pvc_get_post_views( get_the_ID() );
			$post_meta .= '<div class="meta-item meta-color meta-views">';
			$post_meta .= '<a class="meta-color" href="' . get_permalink() . '">';
			if ( $icon && 'no' !== $icon ) {
				$post_meta .= '<span class="info-icon">' . th90_get_svg_icon( 'view' ) . '</span>';
				$post_meta .= '<span class="info-text">' . th90_number_format_short( $count ) . '</span>';
			} else {
				$post_meta .= '<span class="info-text">' . th90_number_format_short( $count ) . '&nbsp;' . esc_html__( 'Views', 'atlas' ) . '</span>';
			}
			$post_meta .= '</a>';
			$post_meta .= '</div>';
		}

		// Comments ----------
		if ( ! empty( $comments ) && th90_opt( 'post_comment' ) && ( comments_open() || get_comments_number() ) ) {

			$post_meta .= '<div class="meta-item meta-comments">';
			$post_meta .= '<a href="' . get_comments_link() . '" class="meta-color">';
			$comments_number = get_comments_number();
			if ( $icon && 'no' !== $icon ) {
				$post_meta .= '<span class="info-icon">' . th90_get_svg_icon( 'comment' ) . '</span>';
				$post_meta .= '<span class="info-text">' . number_format_i18n( $comments_number ) . '</span>';
			} else {
				if ( $comments_number > 1 ) {
					$post_meta .= '<span class="info-text">' . str_replace( '%', number_format_i18n( $comments_number ), esc_html__( '% Comments', 'atlas' ) ) . '</span>';
				} elseif ( $comments_number == 0 ) {
					$post_meta .= '<span class="info-text">' . esc_html__( '0 Comments', 'atlas' ) . '</span>';
				} else {
					$post_meta .= '<span class="info-text">' . esc_html__( '1 Comment', 'atlas' ) . '</span>';
				}
			}
			$post_meta .= '</a>';
			$post_meta .= '</div>';
		}

		// Shares ----------
		if ( ! empty( $shares ) && ! th90_is_amp() ) {
			$social_shares_args = array(
				'options_sufix' => 'post',
				'style' => th90_opt( 'social_shares_style' ),
			);

			if ( ! empty( th90_social_shares ( $social_shares_args ) ) ) {
				$post_meta .= '<div class="meta-item meta-shares">';
					$post_meta .= '<div class="head-shares">' . esc_html__( 'Shares:', 'atlas' ). '</div>';
					$post_meta .= th90_core_social_shares( $social_shares_args );
				$post_meta .= '</div>';
			}
		}

		// Edit ----------
		if ( ! empty( $edit ) && is_user_logged_in() ) {
			ob_start();
            edit_post_link( esc_html__( 'Edit', 'atlas' ), '<div class="meta-item edit-link meta-color">', '</div>' );
			$post_meta .= ob_get_clean();
		}

		// Readmore ----------
		if ( ! empty( $readmore ) ) {
			$post_meta .= '<div class="meta-item meta-more">';
				$post_meta .= '<a href="' . get_permalink() . '" class="info-text">' . esc_html__( 'Keep Reading', 'atlas' ). '</a>';
			$post_meta .= '</div>';
		}

		$post_meta .= '</div>' . $after;

		if ( ( ! empty( $sticky_sign ) && th90_is_sticky_post() ) || ! empty( $readmore ) || ! empty( $first_cat ) || ( ! empty( $shares ) && ! th90_is_amp() ) || ! empty( $cats ) || ! empty( $author ) || ! empty( $date ) || ( ! empty( $last_update ) && $u_modified_time >= $u_time + 86400 ) || ( ! empty( $views ) && TH90_POSTVIEWS_IS_ACTIVE ) || ! empty( $reading_time ) || ( ! empty( $comments ) && th90_opt( 'post_comment' ) && ( comments_open() || get_comments_number() ) ) || ( ! empty( $edit ) && is_user_logged_in() ) ) {
			return $post_meta;
		}
	}
}

/*
--------------------------------------------------------------------------------
* Print the Post info
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_the_post_info' ) ) {

	function th90_the_post_info( $args = '', $before = false, $after = false ) {
		echo th90_get_post_info( $args, $before, $after );
	}
}

/*
--------------------------------------------------------------------------------
* Get the post time
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_get_time' ) ) {

	function th90_get_time( $format = false ) {

		if ( 'modern' == $format ) {

			// Human Readable Post Dates ----------
			$time_now  = current_time( 'timestamp' );
			$post_time = get_the_time( 'U' );

			$since = sprintf( esc_html__( '%s ago', 'atlas' ), human_time_diff( $post_time, $time_now ) );
		} else {

			// Default date format ----------
			$since = get_the_date();

		}

		return $since;
	}
}


/*
--------------------------------------------------------------------------------
* Get Post reading time
* ------------------------------------------------------------------------------
*/
if( ! function_exists( 'th90_reading_time' )){

	function th90_reading_time( $read_text = false ){

		$content = get_post_field( 'post_content', get_the_ID() );
		$number_of_images = substr_count( strtolower( $content ), '<img ' );

		$content = strip_shortcodes( $content );
		$content = wp_strip_all_tags( $content );
		$word_count = count( preg_split( '/\s+/', $content ) );

		// Calculate additional time added to post by images.
		$additional_time = 0;
		// For the first image add 12 seconds, second image add 11, ..., for image 10+ add 3 seconds.
		for ( $i = 1; $i <= $number_of_images; $i++ ) {
			if ( $i >= 10 ) {
				$additional_time += 3 * (int) 300 / 60;
			} else {
				$additional_time += ( 12 - ( $i - 1 ) ) * (int) 300 / 60;
			}
		}

		$word_count += $additional_time;

		$word_count = apply_filters( 'th90_filter_wordcount', $word_count );

		$reading_time = $word_count / 300;

		if( $reading_time < 1){
			$result = esc_html__( 'Less 1 min', 'atlas' );
		}
		elseif( $reading_time > 60 ){
			$result = sprintf( esc_html__( '%s hours', 'atlas' ), number_format_i18n( floor( $reading_time / 60 ) ) );
		}
		else if ( $reading_time == 1 ){
			$result = esc_html__( '1 min', 'atlas' );
		}
		else {
			$result = sprintf( esc_html__( '%s mins', 'atlas' ), number_format_i18n( $reading_time ) );
		}

		if ( $read_text ) {
			$result .= ' ' . esc_html__( 'read', 'atlas' );
		}

		return $result;
	}
}

/**
 * -----------------------------------------------------------------------------
 * Post Format Icon
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_post_format_icon' ) ) {
	function th90_post_format_icon() {
		if ( has_post_format( 'video' ) ) {
			$video = th90_field_single( 'video_embed' );
			if ( $video && th90_check_youtube_vimeo( $video ) ) {
				$url_iframe = th90_get_url_embed( $video );
				$url_result = false;
				if ( strpos( $url_iframe, 'yout' ) !== false ) {
					$url_result = th90_build_youtube_url( $url_iframe );
				} elseif ( strpos( $url_iframe, 'vim' ) !== false ) {
					$url_result = th90_build_vimeo_url( $url_iframe );
				}
				if ( $url_result ) {
					echo '<a href="' . esc_url( $url_result ) . '" title="' . esc_attr( get_the_title() ) . '" class="f-icon f-video venobox" data-vbtype="video">' . th90_get_svg_icon( 'video' ) . '</a>';
				} else {
					echo '<div class="f-icon f-video">' . th90_get_svg_icon( 'video' ) . '</div>';
				}
		    } else {
		       echo '<div class="f-icon f-video">' . th90_get_svg_icon( 'video' ) . '</div>';
		    }

		} elseif ( has_post_format( 'audio' ) ) {
			echo '<div class="f-icon f-audio">' . th90_get_svg_icon( 'audio' ) . '</div>';
		} elseif ( has_post_format( 'gallery' ) ) {
			echo '<div class="f-icon f-gallery">' . th90_get_svg_icon( 'gallery' ) . '</div>';
		}
	}
}

/*
--------------------------------------------------------------------------------
* The Read More
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_the_readmore' ) ) {

	function th90_the_readmore( $style = 'text', $read_time = 'no' ) {
		?>
		<div class="read-more<?php echo esc_attr( 'yes' == $read_time ? ' have-readtime' : '' ); ?>">
			<a href="<?php the_permalink(); ?>" class="post-more button btn-small btn-<?php echo esc_attr( $style ); ?>">
				<span><?php esc_html_e( 'Keep Reading', 'atlas' ); ?></span>
			</a>
			<?php
			if ( 'yes' == $read_time ) {
				th90_the_post_info( array(
					'reading_time' => true,
					'icon'	=> true,
				) );
			}
			?>
		</div>
		<?php
	}
}

/*
--------------------------------------------------------------------------------
* Sicky Post
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_is_sticky_post' ) ) {

	function th90_is_sticky_post() {
		if ( is_home() && is_sticky() && ! is_paged() ) {
			return true;
		}
		return;
	}
}
