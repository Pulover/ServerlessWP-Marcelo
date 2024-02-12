<?php
$menu = isset( $args['menu'] ) ? $args['menu'] : '';
$depth = isset( $args['depth'] ) ? absint($args['depth']) : 0;
$div_icon = isset( $args['div_icon'] ) ? $args['div_icon'] : '';
$div_icon_active = isset( $args['div_icon_active'] ) ? $args['div_icon_active'] : '';

$classes = array(
    'navmain-wrap',

);

if ( $menu ) {
    echo '<nav class="'. implode( ' ', array_filter( $classes ) ) .'">';
        wp_nav_menu( array(
            'menu' => $menu,
            'container' => false,
            'menu_class' => 'nav-main',
            'depth' => $depth,
            'theme_location' => '',
            'link_after' => true == $args['menu_parent_indicator'] || 'yes' == $args['menu_parent_indicator'] ? true : false,
            'after' => $div_icon && 'yes' == $div_icon_active ? '<span class="icon-svg">' . $div_icon . '</span>' : '',
        ) );
    echo '</nav>';
} else {
    if ( has_nav_menu( 'main_menu' ) ) {
        echo '<nav class="'. implode( ' ', array_filter( $classes ) ) .'">';
            wp_nav_menu( array(
                'container' => false,
                'theme_location' => 'main_menu',
                'menu_class' => 'nav-main',
                'depth' => $depth,
                'link_after' => true == $args['menu_parent_indicator'] || 'yes' == $args['menu_parent_indicator'] ? true : false,
                'after' => $div_icon && 'yes' == $div_icon_active ? '<span class="icon-svg">' . $div_icon . '</span>' : '',
            ) );
        echo '</nav>';
    } else {
        echo '<nav class="'. implode( ' ', array_filter( $classes ) ) .'">';
            echo '<ul class="nav-main">';
                echo '<li>';
                    printf( '%1$sGo To Menus%2$s', '<a href="' . esc_url( admin_url( 'nav-menus.php?action=locations' ) ) . '">', '</a>' );
                echo '</li>';
            echo '</ul>';
        echo '</nav>';

    }
}
