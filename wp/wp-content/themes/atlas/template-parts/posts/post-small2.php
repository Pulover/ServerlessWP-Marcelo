<?php
/**
 * This template used for post small layout4
 *
 * @package Atlas
*/

get_template_part( 'template-parts/posts/post', 'small1', array(
   'block'     => $args['block'],
   'count'     => $args['count'],
   'add_class' => 'post-small-reverse',
) );
