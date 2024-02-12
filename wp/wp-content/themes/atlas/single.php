<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Atlas
 */

get_header();
?>

<div id="primary" class="content-area">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$post_prev = get_previous_post();
		if ( th90_opt( 'single_ajax_cat' ) ) {
			$post_prev = get_previous_post( true );
		}

		$atts = array(
			'class'            	=> 'single-inner-ajax',
			'data-previd'      	=> get_the_ID(),
			'data-prevurl'     	=> get_permalink(),
			'data-image'      	=> th90_post_thumbnail_url(),
			'data-desc'        	=> th90_get_excerpt(),
			'data-readtime'     => th90_get_svg_icon( 'pulse' ) . th90_reading_time( true ),
		);

		if ( th90_opt( 'single_ajax_post' ) && ! empty( $post_prev ) && ! th90_is_amp() ) : ?>
			<div id="single-post-ajax" class="single-post-ajax d-flexlist" data-nextid="<?php echo esc_attr( $post_prev->ID) ; ?>" data-nexturl="<?php echo esc_url( get_permalink( $post_prev->ID ) ); ?>">
				<div <?php echo th90_stringify_attributes( $atts ); ?>>
					<?php get_template_part( 'template-parts/article/article', th90_opt_override( 'override_post_layout', 'post_layout' ) ); ?>
				</div>
			</div>
			<div id="single-point-ajax" class="single-point-ajax"></div>
		<?php
		else :
			get_template_part( 'template-parts/article/article', th90_opt_override( 'override_post_layout', 'post_layout' ) );
		endif;
		?>

	<?php endwhile; ?>
</div>

<?php
get_footer();
