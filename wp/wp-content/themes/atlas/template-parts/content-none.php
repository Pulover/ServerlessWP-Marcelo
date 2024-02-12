<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Atlas
 */

?>

<div class="no-results<?php echo esc_attr( th90_box() ); ?>">

	<?php
	if ( is_search() ) :
		?>
		<div class="notfound notfound-search">
			<h2><?php esc_html_e( 'Nothing Found!', 'atlas' ); ?></h2>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Try searching for something else?', 'atlas' ); ?></p>
			<?php get_search_form(); ?>
		</div>
		<?php
	elseif ( is_404() ) :
		?>
		<div class="notfound notfound-404">
			<h1><?php esc_html_e( '404!', 'atlas' ); ?></h1>
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Perhaps searching can help?', 'atlas' ); ?></p>
			<?php get_search_form(); ?>
		</div>
		<?php
	else :
		printf(
			'<p>' . wp_kses(
				/* translators: 1: link to WP admin new post page. */
				__( 'Nothing Found! Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'atlas' ),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			) . '</p>',
			esc_url( admin_url( 'post-new.php' ) )
		);
	endif;
	?>
</div><!-- .no-results -->
