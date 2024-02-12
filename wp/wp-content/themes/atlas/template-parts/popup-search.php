<?php
/**
 * Popup Search
 *
 * @package Atlas
 */

 $classes = array(
     'search-popup',
     'bg-transparent',
     'is-skin',
     'bg-' . th90_opt_override_blank( 'site_skin' ),
 );
 ?>
<div class="<?php echo esc_attr( implode( ' ', array_filter( $classes ) ) ); ?>">
    <div class="search-popup-wrap">
        <div class="search-popup-form">
            <?php get_search_form(); ?>
        </div>
        <div class="search-result"><div class="posts-container"><div class="posts-list post-list-columns"></div></div></div>
    </div>
    <div class="search-popup-close">
        <?php th90_svg_icon( 'close' ); ?>
    </div>
    <div class="search-overlay"></div>
</div>
