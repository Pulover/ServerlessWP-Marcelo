<?php
/**
 * Sidebar
 *
 * @package Atlas
 */

/*
--------------------------------------------------------------------------------
* Register Default Widgets
* ------------------------------------------------------------------------------
*/
if ( ! function_exists( 'th90_default_widget_areas' ) ) {
    /**
     * Register default widget area.
     */
    function th90_default_widget_areas() {
        $box = '';
        if ( th90_opt( 'box_active' ) ) {
            $box = ' box-wrap';
        }
        /* Default */
        register_sidebar( array(
            'name'          => 'Main Sidebar',
            'id'            => 'main-sidebar',
            'description'   => esc_html__( 'This is default widgets area.', 'atlas' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="widget-heading"><h4 class="title">',
            'after_title'   => '</h4></div>',
        ) );
    }
}
add_action( 'widgets_init', 'th90_default_widget_areas', 1000 );

add_filter('dynamic_sidebar_params', function($params){
    $params[0]['before_widget'] = '<div id="%1$s" class="widget %2$s clearfix' . th90_box(false). '">';
    return $params;
});
