<?php
/**
 * Plugin specific tasks.
 *
 * @package     spiralWebDb\Events
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Events;

add_action( 'pre_get_posts', __NAMESPACE__ . '\set_events_archive_order' );
/**
 * Modify the query for the events' archive page, i.e. to set the events order.
 *
 * @since 1.0.0
 *
 * @param WP_Query $query Instance of the query.
 */
function set_events_archive_order( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( ! is_post_type_archive( 'events' ) ) {
		return;
	}

	$query->set( 'order', 'ASC' );
	$query->set( 'orderby', 'menu_order' );
}
