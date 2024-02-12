<?php
/**
 * Template Name: Front Page - Atlas
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( th90_is_amp() ) {
    get_template_part( 'index' );
} else {
    get_template_part( 'page' );
}
?>
