<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Atlas
 */
?>
    </div><!-- #content -->

    <?php do_action( 'th90_hook_footer_before_template' );  ?>

    <footer id="colophon">
        <?php get_template_part( 'template-parts/footer/footer' ); ?>
    </footer>

    <?php do_action( 'th90_hook_footer_after_template' );  ?>

    <?php do_action( 'th90_site_footer' ); ?>
</div> <!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
