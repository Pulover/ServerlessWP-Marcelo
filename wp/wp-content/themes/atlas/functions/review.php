<?php
/**
 * Review post functions
 *
 * @package Atlas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * -----------------------------------------------------------------------------
 * Save total score
 * -----------------------------------------------------------------------------
 */
if( ! function_exists( 'th90_total_review' )){
    function th90_total_review( $post_id ){
        $total = $count = 0;

        if ( th90_field_single( 'review_show' ) ) {
            $criterias = th90_field_single('review_criteria');
            if( $criterias ) {
                foreach( $criterias as $criteria ) {
                    $count++;
                    $total = $total + $criteria['review_criteria_score'];
                }
                $value = $total/$count;
                update_post_meta( $post_id, 'th90_review_total_score', $value );
            }
        }
    }
}
add_action( 'save_post', 'th90_total_review' );

/**
 * -----------------------------------------------------------------------------
 * Review box
 * -----------------------------------------------------------------------------
 */
if( ! function_exists( 'th90_boxreview' )){
    function th90_box_review( $post_id ){
        $total_score = get_post_meta( get_the_ID(), 'th90_review_total_score', true );
        if ( th90_field_single( 'review_show' ) && is_singular( 'post' ) && $total_score ) {
            $criterias = th90_field_single('review_criteria');
            if( $criterias ) {
                ?>
                <div class="box-review">
                    <div class="box-review-head">
                        <?php
                        echo '<span class="head-total">' . round( absint( $total_score ) / 10,1 ) . '</span>';
						if ( th90_field_single( 'review_total_text' ) ) {
                            echo '<span class="head-text">' . esc_html( th90_field_single( 'review_total_text' ) ) . '</span>';
                        }
                        ?>
                    </div>
                    <div class="box-review-desc">
                    <?php
                    foreach( $criterias as $criteria ) {
                        ?>
                        <div class="item-review">
							<?php
							echo '<span class="c-name">' . esc_html( $criteria['review_criteria_name'] ) . '</span>';
							?>
                            <div class="item-progress">
                                <span class="progress-val" style="width:<?php echo absint( $criteria['review_criteria_score'] ); ?>%">
                                </span>
                            </div>
							<?php
							echo '<span class="c-val">' . round( absint( $criteria['review_criteria_score'] ) / 10,1 ) . '</span>';
							?>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
                <?php
            }
        }
    }
    add_action( 'th90_below_post', 'th90_box_review', 5 );
}

/**
 * -----------------------------------------------------------------------------
 * Review Meta
 * -----------------------------------------------------------------------------
 */
if( ! function_exists( 'th90_get_meta_review' )) {
    function th90_get_meta_review() {
		$total_score = get_post_meta( get_the_ID(), 'th90_review_total_score', true );
		if ( 50 > $total_score ) {
			$level = 'bad';
		} elseif ( 50 < $total_score && 75 > $total_score ) {
			$level = 'mid';
		} else {
			$level = 'good';
		}
		if ( th90_field_single( 'review_show' ) && $total_score ) {
			return '<div class="p-review ' . esc_attr( $level ) . '">' . round( absint( $total_score ) / 10,1 ) . '</div>';
		}
		return;
	}
}
if( ! function_exists( 'th90_meta_review' )) {
    function th90_meta_review() {
		if ( th90_get_meta_review() ) {
			echo th90_get_meta_review();
		}
	}
}
