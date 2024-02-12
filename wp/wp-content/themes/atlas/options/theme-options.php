<?php
/**
 * Defined redux framework & ACF pro options
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	 exit; // Exit if accessed directly
}

/*
 -------------------------------------------------------------------------------
 * Theme options Condition
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_options' ) ) {
	function th90_opt( $option ) {
		global $th90_options;
		$default_options = th90_default_options();

		if ( isset( $th90_options[ $option ] ) ) {
			return $th90_options[ $option ];
		} else {
			if ( isset( $default_options[ $option ] ) ) {
				return $default_options[ $option ];
			}
		}

		return;
	}
}
if ( ! function_exists( 'th90_options_array' ) ) {
	function th90_opt_arr( $option, $arr ) {
		global $th90_options;
		$default_options = th90_default_options();
		if ( isset( $th90_options[ $option ][ $arr ] ) ) {
			return $th90_options[ $option ][ $arr ];
		} else {
			if ( isset( $default_options[ $option ][ $arr ] ) ) {
				return $default_options[ $option ][ $arr ];
			}
		}

		return;
	}
}

/*
 -------------------------------------------------------------------------------
 * Get Post custom option
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_get_postdata' ) ) {

	function th90_get_postdata( $key, $default = false, $post_id = null ) {

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		if ( $value = get_post_meta( $post_id, $key, $single = true ) ) {
			return $value;
		} elseif ( $default ) {
			return $default;
		}

		return false;
	}
}

/*
 -------------------------------------------------------------------------------
 * ACF fields Condition
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_field_single' ) ) {
	function th90_field_single( $param, $post_id = false ) {
		$val = '';
		if ( TH90_ACF_IS_ACTIVE ) {
			$val = get_field( $param, $post_id );
		}
		return $val;
	}
}
if ( ! function_exists( 'th90_field' ) ) {
	function th90_field( $param, $post_id = false ) {
		$val = '';
		if ( TH90_ACF_IS_ACTIVE ) {
			$val = get_field( $param, $post_id );
			if ( th90_woo_check_page( 'is_shop' ) ) {
				$val = get_field( $param, get_option( 'woocommerce_shop_page_id' ) );
			} elseif ( is_archive() ) {
				if ( is_category() || is_tag() || th90_woo_check_page( 'is_product_category' ) || th90_woo_check_page( 'is_product_tag' ) ) {
					$val = get_field( $param, get_queried_object() );
				} else {
					$val = '';
				}
			} elseif ( is_search() || is_home() ) {
				$val = '';
			}
		}
		return $val;
	}
}

if ( ! function_exists( 'th90_field_opt' ) ) {
	function th90_field_opt( $param, $post_id = 'options' ) {
		$val = '';
		if ( TH90_ACF_IS_ACTIVE ) {
			$val = get_field( $param, $post_id );
		}
		return $val;
	}
}

/*
 -------------------------------------------------------------------------------
 * Theme Options & ACF combination
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_opt_override' ) ) {
	function th90_opt_override( $override, $option, $option_vs = false, $reback_val = false ) {
		$output = '';
		if ( th90_field( $override ) && ! th90_woo_check_page( 'is_shop' ) ) {
			if ( false !== $option_vs ) {
				$output = th90_field( $option_vs );
				if ( '' === $output && $reback_val ) {
					$output = th90_opt( $option );
				}
			} else {
				$output = th90_field( $option );
				if ( '' === $output && $reback_val ) {
					$output = th90_opt( $option );
				}
			}
		} else {
			$output = th90_opt( $option );
		}
		return $output;
	}
}

if ( ! function_exists( 'th90_opt_override_blank' ) ) {
	function th90_opt_override_blank( $option ) {
		$output = '';
		if ( th90_field( $option ) && ! th90_woo_check_page( 'is_shop' ) ) {
			$output = th90_field( $option );
		} else {
			$output = th90_opt( $option );
		}
		return $output;
	}
}

/*
 -------------------------------------------------------------------------------
 * Theme Options & ACF combination Array
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'th90_options_array_override' ) ) {
	function th90_opt_arr_override( $override, $option, $option_value, $option_vs = false, $option_value_vs = false, $reback_val = false, $option_vs_array = true ) {
		$output = false;
		if ( th90_field( $override ) ) {
			if ( $option_vs_array ) {
				if ( false !== $option_vs ) {
					$array = th90_field( $option_vs );
				} else {
					$array = th90_field( $option );
				}
				if ( ! empty( $array ) ) {
					if ( false !== $option_value_vs ) {
						if ( isset( $array[ $option_value_vs ] ) ) {
							$output = $array[ $option_value_vs ];
						}
					} else {
						if ( isset( $array[ $option_value ] ) ) {
							$output = $array[ $option_value ];
						}
					}
				} elseif ( empty( $array ) && $reback_val ) {
					$output = th90_opt_arr( $option, $option_value );
				}
			} else {
				if ( false !== $option_vs ) {
					$output = th90_field( $option_vs );
					if ( '' === $output && $reback_val ) {
						$output = th90_opt_arr( $option, $option_value );
					}
				} else {
					$output = th90_field( $option );
					if ( '' === $output && $reback_val ) {
						$output = th90_opt_arr( $option, $option_value );
					}
				}
			}
		} else {
			$output = th90_opt_arr( $option, $option_value );
		}
		return $output;
	}
}
if ( ! function_exists( 'th90_opt_checkbox_override' ) ) {
	function th90_opt_checkbox_override( $override, $option, $option_value ) {
		$output = false;
		if ( th90_field( $override ) ) {
			if ( is_array( th90_field( $option ) ) && in_array( $option_value, th90_field( $option ), true ) ) {
				$output = true;
			}
		} else {
			if ( th90_opt_arr( $option, $option_value ) ) {
				$output = true;
			}
		}
		return $output;
	}
}
if ( ! function_exists( 'th90_opt_check_array' ) ) {
	function th90_opt_check_array( $override, $option ) {
		$output = false;
		if ( th90_field( $override ) ) {
			if ( ! empty( th90_field( $option ) ) ) {
				$output = true;
			}
		} else {
			if ( ! empty( th90_opt( $option ) ) ) {
				$output = true;
			}
		}
		return $output;
	}
}

/*
 -------------------------------------------------------------------------------
 * Multiple checkbox return value
 * -----------------------------------------------------------------------------
 */
function th90_multi_checkbox( $option_array, $option ) {
	if ( ! is_array( $option_array ) && ! empty( $option_array ) ) {
		$option_array = explode( ',', $option_array );
	}
	if ( is_array( $option_array ) && in_array( $option, $option_array, true ) ) {
		return true;
	} else {
		return false;
	}
}
