<?php
/**
 * Metadata Handler
 *
 * @package    spiralWebDb\Events
 * @since      1.4.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Events;

/**
 * Render the Event metadata
 *
 * @since 1.4.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_the_event_meta( $event_id ) {
	$event_date = (string) esc_html( get_post_meta( $event_id, 'event-date', true ) );
	$event_time = (string) esc_html( get_post_meta( $event_id, 'event-time', true ) );

	$event_date     = strtotime( $event_date );
	$formatted_date = date( 'l, F j, Y', $event_date );

	$event_time     = strtotime( $event_time );
	$formatted_time = date( 'g:i A', $event_time );

	if ( $event_date && $event_time ) {
		echo 'Scheduled Performance:  ' . $formatted_date . ' at ' . $formatted_time;
	} else {
		echo 'Scheduled Performance:  ' . $formatted_date;
	}
}

//	$event_date     = (string) get_post_meta( $event_id, 'event_date', true );
//	$event_time     = (string) get_post_meta( $event_id, 'event_time', true );
//	$event_map_link = (string) get_post_meta( $event_id, 'event_map_url', true );
//	if ( $day ) {
//		echo 'Venue: ' . esc_html( $venue );
//	}
//
//	$city  = (string) get_post_meta( $review_id, 'review_location_city', true );
//	$state = (string) get_post_meta( $review_id, 'review_location_state', true );
//
//	if ( $city || $state ) {
//		echo '<br>Location: ';
//	}
//
//	if ( $city ) {
//		echo esc_html( $city );
//	}
//
//	if ( $city && $state ) {
//		echo ', ';
//	}
//
//	if ( $state ) {
//		echo esc_html( $state );
//	}
