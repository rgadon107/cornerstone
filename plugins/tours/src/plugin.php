<?php
/**
 *  Plugin specific tasks.
 *
 * @package    spiralWebDb\CornerstoneTours
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours;

add_action( 'pre_get_posts', __NAMESPACE__ . '\set_past_tours_by_order_number' );
/*
 * Modify the WP_Query object and order tours on the admin & post archive pages.
 *
 * @since 1.0.0
 *
 * @param WP_Query $query Instance of the query.
 */
function set_past_tours_by_order_number( $query ) {
	if ( ! is_post_type_archive( 'tours' ) ) {
		return $query;
	}

	$query->set( 'orderby', 'menu_order' );
	$query->set( 'order', 'DESC' );
}

