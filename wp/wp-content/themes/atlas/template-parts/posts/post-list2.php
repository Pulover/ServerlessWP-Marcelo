<?php
/**
 * This template used for post list layout4
 *
 * @package Atlas
*/

get_template_part( 'template-parts/posts/post', 'list1', array(
   'block'     => $args['block'],
   'count'     => $args['count'],
   'add_class' => 'post-list-reverse',
) );
