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

	// Whoops, It's the posts page! Bail out.
	if ( $query->is_home && $query->is_posts_page ) {
		return;
	}

	// Checks to see if it's either the front or archive page. If no, bail out.
	if ( ! $query->is_home && ! is_post_type_archive( 'events' ) ) {
		return;
	}

	// Set the query vars for the front page.
	if ( $query->is_home && ! $query->is_posts_page ) {
		$query->set( 'post_type', array( 'events' ) );
		$query->set( 'posts_per_page', 20 );
		// Set the query vars for archive page.
	} else {
		$query->set( 'posts_per_archive_page', 20 );
	}
	$query->set( 'order', 'ASC' );
	$query->set( 'orderby', 'menu_order' );
}

/*
 *  Loads the archive template.
 *
 *  @since 1.0.0.
 *
 *  @return void
 */
function load_archive_template() {
	require __DIR__ . '/template/archive-events.php';
}
