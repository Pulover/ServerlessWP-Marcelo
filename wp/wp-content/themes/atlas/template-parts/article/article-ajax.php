<?php
/**
 * Article ajax
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_prev = get_previous_post();
if ( th90_opt( 'single_ajax_cat' ) ) {
	$post_prev = get_previous_post( true );
}

if ( have_posts() ) :
	while ( have_posts() ) {
		the_post();
		$atts = array(
			'class'            	=> 'single-inner-ajax',
			'data-previd'      	=> get_the_ID(),
			'data-nextid'      	=> ! empty( $post_prev ) ? $post_prev->ID: '',
			'data-prevurl'     	=> get_permalink(),
			'data-nexturl'     	=> ! empty( $post_prev ) ? get_permalink( $post_prev->ID ): '',
			'data-image'      	=> th90_post_thumbnail_url(),
			'data-desc'        	=> th90_get_excerpt(),
			'data-readtime'     => th90_get_svg_icon( 'pulse' ) . th90_reading_time( true ),
			'data-sidebar'		=> '',
		);

		if ( class_exists( 'Elementor\Plugin' ) ) {
			$template_id = false;

			if ( th90_field_single( 'override_post_layout', get_the_ID() ) && th90_field_single( 'post_sidebar_template', get_the_ID() ) ) {
				$template_id = th90_field_single( 'post_sidebar_template', get_the_ID() );

			} elseif ( ! th90_field_single( 'override_post_layout', get_the_ID() ) && th90_opt( 'post_sidebar_template' ) ) {
				$template_id = th90_opt( 'post_sidebar_template' );

			}

			if ( $template_id ) {
				if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
					$css_file = new \Elementor\Core\Files\CSS\Post( $template_id );
				} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
					$css_file = new \Elementor\Post_CSS_File( $template_id );
				}
				$atts['data-sidebar'] = $css_file->get_url();
			}
        }

		do_action( 'th90_between_ajax_post' );
		?>
		<div <?php echo th90_stringify_attributes( $atts ); ?>>
			<?php get_template_part( 'template-parts/article/article', th90_opt_override( 'override_post_layout', 'post_layout' ) ); ?>
		</div>
		<?php
		wp_reset_postdata();
	}
endif;

/** exits */
die();
