<?php
/**
 * Template for displaying search forms
 *
 * @package Atlas
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<input type="search" id="<?php echo esc_attr( uniqid( 'search-form-' ) ); ?>" placeholder="<?php esc_attr_e( 'Enter keyword...', 'atlas' ); ?>" class="search-input" value="" name="s">

	<button type="submit" class="search-button">
		<?php esc_html_e( 'Search', 'atlas' ); ?>
	</button>

</form>
