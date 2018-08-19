<?php
/**
 * Plugin specific tasks.
 *
 * @package     spiralWebDb\Reviews
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Reviews;

add_action( 'pre_get_posts', __NAMESPACE__ . '\set_reviews_archive_order' );
/**
 * Modify the query for the reviews' archive page, i.e. to set the reviews order.
 *
 * @since 1.0.0
 *
 * @param WP_Query $query Instance of the query.
 */
function set_reviews_archive_order( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( ! is_post_type_archive( 'reviews' ) ) {
		return;
	}

	$query->set( 'tax_query', array(
			array(
				'taxonomy' => 'review_type',
				'field'    => 'slug',
				'terms'    => 'critic-review',
			)
		)
	);
	$query->set( 'order', 'ASC' );
	$query->set( 'order_by', 'menu_order' );
}
