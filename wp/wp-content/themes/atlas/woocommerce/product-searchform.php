<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'atlas' ); ?></label>

	<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" placeholder="<?php esc_attr_e( 'Search products&hellip;', 'atlas' ); ?>" class="search-input" value="<?php echo get_search_query(); ?>" name="s">

	<button type="submit" class="search-button">
		<?php esc_html_e( 'Search', 'atlas' ); ?>
	</button>

	<input type="hidden" name="post_type" value="product" />

</form>
