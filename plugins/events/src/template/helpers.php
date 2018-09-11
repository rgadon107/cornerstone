<?php
/**
 * Helper functions for the templates and views.
 *
 * @package     spiralWebDb\Events\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Events\Template;

use function spiralWebDb\Events\render_the_performance_community;
use function spiralWebDb\Events\render_performance_date_and_time;

// See '/cornerstone-members/src/template/helpers.php' on how to render grid classes.

/**
 * Render the event performance community (City, State)
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_the_performance_community( $event_id = 0 ) {
	if ( ! $event_id ) {
		$event_id = get_the_ID( $event_id );
	}

	require dirname( __DIR__ ) . '/views/event-community.php';
}

/**
 * Render the event post title.
 *
 * @since 1.0.0
 *
 * @param int $event_id Optional. Event ID.
 *
 * @return void
 */
function render_event_title( $event_id = 0 ) {
	if ( ! $event_id ) {
		$event_id = (int) get_the_ID();
	}

	require dirname( __DIR__ ) . '/views/event-title.php';
}

/**
 * Render the event performance date and time.
 *
 * @since 1.4.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_performance_date_and_time( $event_id ) {
	if ( ! $event_id ) {
		$event_id = (int) get_the_ID();
	}

	require dirname( __DIR__ ) .'/views/performance-date-time.php';
}
