<?php
/**
 * Plugin AMP integration
 *
 * @package Atlas Core
 */

if ( ! function_exists( 'th90_amp_installed' ) ) {
	function th90_amp_installed() {
		if ( defined( 'AMP__VERSION' ) ) {
			return true;
		}
		return false;
	}
}

/** is amp request */
if ( ! function_exists( 'th90_is_amp_request' ) ) {
	function th90_is_amp_request() {
		global $_REQUEST;

		if ( th90_amp_installed() && isset( $_REQUEST[ AMP_Theme_Support::SLUG ] ) ) {
			return true;
		}
		return false;
	}
}

/** setup AMP */
if ( ! function_exists( 'th90_support_amp' ) ) {
	function th90_support_amp() {

		add_theme_support( 'amp', array(
			'paired' => true
		) );

		if ( th90_amp_installed() ) {
			add_action( 'wp_loaded', 'th90_amp_config_backend' );
		}
	}
}
add_action( 'after_setup_theme', 'th90_support_amp', 15 );

/** config AMP */
if ( ! function_exists( 'th90_amp_config_backend' ) ) {
	function th90_amp_config_backend() {

		if ( 'transitional' !== AMP_Options_Manager::get_option( 'theme_support' ) ) {
			AMP_Options_Manager::update_option( 'theme_support', 'transitional' );
		} else {
			add_action( 'admin_print_styles', 'th90_amp_remove_mode' );
			add_action( 'admin_footer', 'th90_amp_mode_info' );
		}
	}
}

/** hidden mode selection */
if ( ! function_exists( 'th90_amp_remove_mode' ) ) {
	function th90_amp_remove_mode() {
		?>
		<style type='text/css'> .amp-website-mode fieldset {
				display: none;
			}</style>
	<?php
	}
}

/** amp mode notification */
if ( ! function_exists( 'th90_amp_mode_info' ) ) {
	function th90_amp_mode_info() {
		?>
		<script>
			(function ($) {
				$('.amp-website-mode').find('td').html('<p class="notice notice-success">The theme supported and activated AMP in the Transitional mode.</p>');
				$('#all_templates_supported_fieldset').remove();
			})(jQuery);
		</script>
	<?php
	}
}
