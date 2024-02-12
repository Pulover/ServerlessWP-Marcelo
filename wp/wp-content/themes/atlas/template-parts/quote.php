<?php
/**
 * Quote
 *
 * @package Atlas
 */

if( $args['text'] ): ?>
    <div class="quote-item">
        <span class="quote-text">
            <?php th90_svg_icon( 'quote' ); ?>
            <?php echo do_shortcode( $args['text'] ); ?>
        </span>
        <?php if( $args['author'] ): ?>
            <span class="quote-author"><?php echo esc_html( $args['author'] ); ?></span>
        <?php endif; ?>
    </div>
<?php
endif;
