<?php
/**
 * Metadata Handler
 *
 * @package    spiralWebDb\Reviews
 * @since      1.4.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Reviews;

/**
 * Render the event's venue.
 *
 * @since 1.4.0
 *
 * @param int $review_id The review's ID.
 *
 * @return void
 */
function render_the_venue( $review_id ) {
	$venue = (string) get_post_meta( $review_id, 'event_venue', true );
	if ( $venue ) {
		echo 'Venue: '. esc_html( $venue );
	}

	$city  = (string) get_post_meta( $review_id, 'review_location_city', true );
	$state  = (string) get_post_meta( $review_id, 'review_location_state', true );

	if ( $city || $state ) {
		echo '<br>Location: ';
	}

	if ( $city ) {
		echo esc_html( $city );
	}

	if ( $city && $state ) {
		echo ', ';
	}

	if ( $state ) {
		echo esc_html( $state );
	}
}

/**
 * Render the reviewer.
 *
 * @since 1.4.0
 *
 * @param int $review_id The review's ID.
 *
 * @return void
 */
function render_the_reviewer( $review_id ) {
	$name = (string) get_post_meta( $review_id, 'reviewer_name', true );
	if ( ! $name ) {
		return;
	}

	echo 'By: '. esc_html( $name );

	$org = (string) get_post_meta( $review_id, 'reviewer_org', true );
	if ( $org ) {
		echo ' of ' . esc_html( $org );
	}
}
