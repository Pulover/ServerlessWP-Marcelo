<?php
/**
 * Theme functions and definitions.
 */
function atlas_child_enqueue_styles() {
    if ( is_rtl() ) {
        wp_enqueue_style( 'atlas-style' , get_template_directory_uri() . '/style-rtl.css' );
    } else {
        wp_enqueue_style( 'atlas-style' , get_template_directory_uri() . '/style.css' );
    }
    wp_enqueue_style( 'atlas-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'atlas-style' ),
        wp_get_theme()->get('Version')
    );
}

add_action(  'wp_enqueue_scripts', 'atlas_child_enqueue_styles' );
