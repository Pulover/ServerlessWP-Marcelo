<?php
/**
 * Comment
 *
 * @package Atlas
 */

echo '<div class="post-item">';
    echo '<div class="rcomment">';
        echo '<div class="rcomment-thumb">';
            echo '<span class="noava">' . mb_substr( get_comment_author( $args['comment']->comment_ID ), 0, 1 ) . '</span>';
        echo '</div>';
        echo '<div class="rcomment-desc entry-meta no-icons">';
            // Human Readable Post Dates ----------
            $time_now  = current_time( 'timestamp' );
            $post_time = get_comment_date( 'U', $args['comment']->comment_ID );
            $since = sprintf( esc_html__( '%s ago', 'atlas' ), human_time_diff( $post_time, $time_now ) );

            echo '<div class="meta-item meta-author"><a href="' . esc_url( get_permalink( $args['comment']->comment_post_ID ) ) . '">' . get_comment_author( $args['comment']->comment_ID ) . '</a></div>';

            echo '<div class="meta-item meta-date">' . $since . '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';
