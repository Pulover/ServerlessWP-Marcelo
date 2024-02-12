<?php
/**
 * Page Title
 *
 * @package Atlas
 */


 if( is_404() || is_home() || is_front_page() || th90_is_builder_page() || is_single() ) {
     return;
 }


 global $wp_query;
 $post_count = $wp_query->found_posts;
 ?>

 <?php if ( th90_page_title() ): ?>
     <div class="page-title-wrap">
         <div class="widget-heading">
             <h1 class="page-title title head4">
                 <?php th90_page_title( 'span', true ); ?>
             </h1>
         </div>
         <?php if( is_archive() && get_the_archive_description() && ! th90_woo_check_page( 'is_shop' ) ) : ?>
             <?php
             if( is_author() ) {
                 if ( TH90_ATLAS_CORE_ACTIVE && get_the_author_meta( 'description', get_the_author_meta( 'ID' ) ) ) {
                     echo '<div class="page-desc">';
                        th90_author_box( get_the_author_meta( 'ID' ), 72, true );
                    echo '</div>';
                }
            } else {
                echo '<div class="page-desc">';
                    the_archive_description();
                echo '</div>';
            }
            ?>
        <?php endif; ?>

        <?php if ( is_search() && th90_is_amp() ) : ?>
        <?php
        echo '<div class="page-desc">';
            get_search_form();
        echo '</div>';
        ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
