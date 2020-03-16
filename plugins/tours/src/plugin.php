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

add_action( 'pre_get_posts', __NAMESPACE__ . '\set_past_tours_order_number' );
/*
 * Modify the WP_Query object to order the past tours on the admin page.
 *
 * @since 1.0.0
 *
 * @param WP_Query $query Instance of the query.
 */
function set_past_tours_order_number( $query ) {

	if ( ! is_admin() ) {
		return;
	}

	$query->set( 'order', 'DESC' );
	$query->set( 'orderby', 'menu_order' );
}