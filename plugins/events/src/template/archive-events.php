<?php
/**
 * Template for the events post type archive.
 *
 * @package     spiralWebDb\Events\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Events\Template;

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

add_action( 'genesis_entry_header', __NAMESPACE__ . '\render_event_archive_performance_data' );
/*
 * Render event archive performance meta data
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_event_archive_performance_data() {
	$event_id = (int) get_the_ID();
	echo sprintf( '<div %s>', genesis_attr( 'before-entry-content-meta' ) );

	require dirname( __DIR__ ) . '/views/performance-date-time.php';
	render_event_map( $event_id );
}

remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

require __DIR__ . '/single-events.php';
