<?php
$menu = isset( $args['menu'] ) ? $args['menu'] : '';
$depth = isset( $args['depth'] ) ? absint($args['depth']) : 0;

$classes = array(
    'mobile-menu-wrap',
);

if ( $menu ) {
    echo '<nav class="'. implode( ' ', array_filter( $classes ) ) .'">';
        wp_nav_menu( array(
            'menu' => $menu,
            'container' => false,
            'menu_class' => 'nav-mobile',
            'depth' => $depth,
            'theme_location' => '',
        ) );
    echo '</nav>';
} else {
    if ( has_nav_menu( 'mobile_menu' ) ) {
        echo '<nav class="'. implode( ' ', array_filter( $classes ) ) .'">';
            wp_nav_menu( array(
                'container' => false,
                'theme_location' => 'mobile_menu',
                'menu_class' => 'nav-mobile',
                'depth' => $depth,
            ) );
        echo '</nav>';
    } elseif ( has_nav_menu( 'main_menu' ) ) {
        echo '<nav class="'. implode( ' ', array_filter( $classes ) ) .'">';
            wp_nav_menu( array(
                'container' => false,
                'theme_location' => 'main_menu',
                'menu_class' => 'nav-mobile',
                'depth' => $depth,
            ) );
        echo '</nav>';
    } else {
        echo '<nav class="'. implode( ' ', array_filter( $classes ) ) .'">';
            echo '<ul class="nav-mobile">';
                echo '<li>';
                    printf( '%1$sGo To Menus%2$s', '<a href="' . esc_url( admin_url( 'nav-menus.php?action=locations' ) ) . '">', '</a>' );
                echo '</li>';
            echo '</ul>';
        echo '</nav>';
    }
}
