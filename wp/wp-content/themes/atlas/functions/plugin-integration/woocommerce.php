<?php
/**
 * Plugin woocommerce integration
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	 exit; // Exit if accessed directly
}

if ( TH90_WOOCOMMERCE_IS_ACTIVE ) {
	/* Add new class to product */
	if ( ! function_exists( 'th90_woo_add_class_product' ) ) {
		function th90_woo_add_class_product( $classes, $product ) {

		    $classes[] = 'post-item';

		    return $classes;
		}
		add_filter( 'woocommerce_post_class', 'th90_woo_add_class_product', 10, 2 );
		add_filter( 'product_cat_class', 'th90_woo_add_class_product', 10, 3 );

	}

	/* Icon Fonts */
	if ( ! function_exists( 'th90_woo_icons' ) ) {

		function th90_woo_icons() {
	        ob_start();
			?>
			@font-face {
				font-family: 'woo';
				font-style: normal;
				font-weight: 400;
				font-display: swap;
				src: url(data:application/octet-stream;base64,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);
			}
			<?php
	        return ob_get_clean();
	    }
	}

	/* Enqueue Custom Woo CSS */
	if ( ! function_exists( 'th90_woo_custom_enqueue_style' ) ) {
		function th90_woo_custom_enqueue_style() {
			if ( ! is_admin() ) {
				wp_dequeue_style( 'woocommerce-general' );
				wp_dequeue_style( 'woocommerce-layout' );
				wp_dequeue_style( 'woocommerce-smallscreen' );

				if ( is_rtl() ) {
					wp_enqueue_style( 'th90-woocommerce', get_template_directory_uri() . '/scss/woocommerce/css/woocommerce-rtl.css' );
				} else {
					wp_enqueue_style( 'th90-woocommerce', get_template_directory_uri() . '/scss/woocommerce/css/woocommerce.css' );
				}

				wp_add_inline_style( 'th90-woocommerce', wp_unslash( th90_minify_css( th90_woo_icons() ) ) );
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'th90_woo_custom_enqueue_style' );

	/* Remove Breadcrumb */
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	/* Remove Sidebar */
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	/* Product Per Page */
	if ( ! function_exists( 'th90_loop_shop_per_page' ) ) {
		function th90_loop_shop_per_page( $cols ) {
			if ( th90_opt( 'shop_number' ) ) {
				return absint( th90_opt( 'shop_number' ) );
			}
			return;
		}
	}
	add_filter( 'loop_shop_per_page', 'th90_loop_shop_per_page' );

	/* Shop page title & Desc */
	add_filter( 'woocommerce_show_page_title', function() {  get_template_part( 'template-parts/page', 'title' ); } );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

	/* Products pagination */
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
	add_action( 'woocommerce_after_shop_loop', function() {
		th90_numeric_pagination( false, '<div class="nav-wrap nav-wrap-numeric text-center"><div class="nav-wrap-inner">', '</div></div>' );
	}, 10 );

	/* Wrapper Start */
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	add_action( 'woocommerce_before_main_content', function() {
		?>
		<div id="primary" class="content-area">
			<div class="container">
				<div class="section-inner">
					<main id="main" class="site-main" role="main">
						<div class="main-area<?php echo esc_attr( th90_box() ); ?>">
		<?php
	}, 10 );

	/* Wrapper End */
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	add_action( 'woocommerce_after_main_content', function() {
		?>
						</div>
					</main>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
		<?php
	}, 10 );

	/* Category */
	add_action( 'woocommerce_before_subcategory', function() {
		?>
		<div class="entry-thumbnail">
		<?php
	}, 11 );
	add_action( 'woocommerce_before_subcategory_title', function() {
		?>
		</div>
		<?php
	}, 11 );

	/* Product */
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

	// Product Start
	add_action( 'woocommerce_before_shop_loop_item', function() {
		echo '<div class="woo-product">';
	}, 5 );

	// Product Thumbnail & Add to Cart
	add_action( 'woocommerce_before_shop_loop_item_title', function() {
		?>
		<div class="entry-thumbnail">
		<?php
	}, 5 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 6 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 14 );
	add_action( 'woocommerce_before_shop_loop_item_title', function() {
		?>
		</div>
		<?php
	}, 15 );

	// Product Title
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	add_action( 'woocommerce_shop_loop_item_title', function() {
		?>
		<h3 class="entry-title <?php echo esc_attr( th90_convert_tag( th90_opt( 'product_title_tag') ) ); ?>">
		   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	   </h3>
	   <?php
	}, 10 );

	// Product Rating Stars
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	// Product Desc Start
	add_action( 'woocommerce_before_shop_loop_item_title', function() {
		?>
		<div class="woo-desc post-desc">
			<div class="post-desc-inner">
		<?php
	}, 15 );

	// Product Desc End
	add_action( 'woocommerce_after_shop_loop_item', function() {
		echo '</div></div>';
	}, 15 );

	// Product End
	add_action( 'woocommerce_after_shop_loop_item', function() {
		echo '</div>';
	}, 20 );

	// Product Category Desc Start
	add_action( 'woocommerce_shop_loop_subcategory_title', function() {
		?>
		<div class="woo-desc post-desc">
		<?php
	}, 5 );

	// Product Category Desc End
	add_action( 'woocommerce_shop_loop_subcategory_title', function() {
		echo '</div>';
	}, 15 );

	/* Single Product */
	add_action( 'woocommerce_product_thumbnails', function() {
		?>
		<div class="thumbs-wrap">
			<div class="thumbs-wrap-inner">
		<?php
	}, 10 );
	add_action( 'woocommerce_product_thumbnails', function() {
		?>
			</div>
		</div>
		<?php
	}, 20 );

	add_action( 'woocommerce_before_single_product_summary', function() {
		echo '<div class="summary-wrap">';
			echo '<div class="summary-wrap-inner">';
	}, 5 );
	add_action( 'woocommerce_after_single_product_summary', function() {
		echo '</div>';
			echo '</div>';
	}, 5 );

	// Single Product Title
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary', function() {
		the_title( '<h1 class="page-title"><span class="entry-title">', '</span></h1>' );
	}, 5 );

	// Plus Minus Quantity
	add_action( 'woocommerce_before_quantity_input_field', function() {
		echo '<span class="arrow minus minus-btn is-link">-</span>';
	}, 5 );
	add_action( 'woocommerce_after_quantity_input_field', function() {
		echo '<span class="arrow plus plus-btn is-link">+</span>';
	}, 5 );

	// Remove tabs heading
	add_filter('woocommerce_product_description_heading', '__return_null');
	add_filter('woocommerce_product_additional_information_heading', '__return_null');

	/* Product Images/Gallery */
	add_theme_support( 'wc-product-gallery-zoom' );
	add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
		return array(
			'width' => 300,
			'height' => 300,
			'crop' => 1,
		);
	} );
	add_filter( 'woocommerce_product_thumbnails_columns', function() {
		return absint( th90_opt( 'product_gallery_thumb' ) );
	}, 10, 1 );

	/* Product Shares */
	add_action( 'woocommerce_share', function() {
		$social_shares_args = array(
			'options_sufix' => 'post',
			'style' => 'simple',
		);
		echo '<div class="single-shares_bottom">';
			echo '<div class="head-shares">' . esc_html__( 'Shares:', 'atlas' ). '</div>';
			th90_the_social_shares( $social_shares_args );
		echo '</div>';
	}, 5 );

	/* WooCommerce update Cart counter */
	if( ! function_exists( 'th90_wc_cart_items_number' )){

		add_filter( 'woocommerce_add_to_cart_fragments', 'th90_wc_cart_items_number' );
		function th90_wc_cart_items_number( $fragments ){
			$output = '';
			$output .= '<span class="shopping-cart-counter count-' . WC()->cart->get_cart_contents_count() . '">';
			$output .= WC()->cart->get_cart_contents_count();
			$output .= '</span>';
			$fragments['.shopping-cart-counter '] = $output;
			return $fragments;
		}
	}

	/* Change Sale To Percentage */
	add_filter( 'woocommerce_sale_flash', 'th90_wc_sale_to_percentage', 20, 3 );
	function th90_wc_sale_to_percentage( $html, $post, $product ) {

		if( $product->is_type('variable')){
			$percentages = array();

			// Get all variation prices
			$prices = $product->get_variation_prices();

			// Loop through variation prices
			foreach( $prices['price'] as $key => $price ){
				// Only on sale variations
				if( $prices['regular_price'][$key] !== $price ){
				  	// Calculate and set in the array the percentage for each variation on sale
				  	$percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
				}
			}
			// We keep the highest value
			$percentage = max($percentages) . '%';

		} elseif( $product->is_type('grouped') ){
			$percentages = array();

			// Get all variation prices
			$children_ids = $product->get_children();

			// Loop through variation prices
			foreach( $children_ids as $child_id ){
			  	$child_product = wc_get_product($child_id);

			  	$regular_price = (float) $child_product->get_regular_price();
			  	$sale_price    = (float) $child_product->get_sale_price();

			  	if ( $sale_price != 0 || ! empty($sale_price) ) {
			      	// Calculate and set in the array the percentage for each child on sale
			      	$percentages[] = round(100 - ($sale_price / $regular_price * 100));
			  	}
			}
			// We keep the highest value
			$percentage = max($percentages) . '%';

		} else {
			$regular_price = (float) $product->get_regular_price();
			$sale_price    = (float) $product->get_sale_price();

			if ( $sale_price != 0 || ! empty($sale_price) ) {
		  		$percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
			} else {
		  		return $html;
			}
		}
		return '<span class="meta_btn onsale">' . $percentage . '</span>';
	}
}
