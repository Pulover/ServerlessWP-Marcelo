<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Atlas
 */

if ( th90_is_have_sidebar() ) {
	$template = th90_display_elementor_content( th90_sidebar_template_id() );
	if ( $template ) {
		?>
		<aside id="secondary" class="site-bar">
			<?php echo apply_filters( 'th90_print_sidebar_template', $template ); ?>
		</aside>
		<?php
	} else {
		if ( is_active_sidebar( 'main-sidebar' ) ) {
			?>
			<aside id="secondary" class="site-bar">
				<?php dynamic_sidebar( 'main-sidebar' ); ?>
			</aside>
			<?php
		} else {
			return;
		}
	}
} else {
	return;
}
