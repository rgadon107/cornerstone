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

/*
 * Render the Event sponsor's post thumbnail image.
 *
 * @since 1.4.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_event_venue_image( $event_id ) {

	// If there's no image, bail out.
	if ( ! has_post_thumbnail( $event_id ) ) {
		return;
	}

	echo get_the_post_thumbnail( $event_id, 'full', [
		'class'    => 'first one-third event-thumbnail',
		'itemprop' => 'thumbnail',
		'itemscope' > 'itemscope',
		'itemtype' => 'http://schema.org/ImageObject',
	] );
}

/**
 * Render the Event performance date and time.
 *
 * @since 1.4.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_performance_date_and_time( $event_id ) {
	$event_date = (string) get_post_meta( $event_id, 'event-date', true );
	$event_time = (string) get_post_meta( $event_id, 'event-time', true );

	$event_date     = strtotime( $event_date );
	$formatted_date = date( 'l, F j, Y', $event_date );

	$event_time     = strtotime( $event_time );
	$formatted_time = date( 'g:i A', $event_time );

	if ( $event_date && $event_time ) {
		echo esc_html( $formatted_date ) . ' at ' . esc_html( $formatted_time );
	} else {
		echo esc_html( $formatted_date );
	}
}

/**
 *  Render the performance community (City, State)
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_the_performance_community( $event_id ) {
	$event_city  = (string) get_post_meta( $event_id, 'venue-city', true );
	$event_state = (string) get_post_meta( $event_id, 'venue-state', true );

	if ( empty( $event_city ) && empty( $event_state ) ) {
		return;
	}

	echo '<strong>' . 'Performing in: ' . '</strong>' . '<em>' . esc_html( $event_city ) . ', ' . esc_html( $event_state ) . '</em>';
}

/*
 * Render the Event performance address.
 *
 * @since 1.4.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_performance_address( $event_id ) {
	$event_address = (string) get_post_meta( $event_id, 'venue-address', true );
	$event_city    = (string) get_post_meta( $event_id, 'venue-city', true );
	$event_state   = (string) get_post_meta( $event_id, 'venue-state', true );

	$message = 'The performance address is not yet confirmed. Check back soon for updated information.';

	if ( $event_address && $event_city && $event_state ) {
		echo esc_html( $event_address ) . ', ' . esc_html( $event_city ) . ', ' . esc_html( $event_state );
	} elseif ( $event_city && $event_state ) {
		echo esc_html( $event_city ) . ', ' . esc_html( $event_state );
	} else {
		echo $message;
	}
}

/*
 * Render the Event Google Map link.
 *
 * @since 1.4.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_event_map( $event_id ) {
	$event_map_url = (string) get_post_meta( $event_id, 'event-map-url', true );

	require __DIR__ . '/views/event-map.php';
}

/*
 * Render the Event admission information
 *
 * @since 1.5.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_admission_information( $event_id ) {
	$admission_text_field = (string) get_post_meta( $event_id, 'admission-text-field', true );

	if ( empty( $admission_text_field ) ) {
		return;
	}

	echo esc_html( $admission_text_field );

}

/*
 * Render the Event sponsor's telephone number.
 *
 * @since 1.4.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_event_tel_number( $event_id ) {
	$tel_number = (string) get_post_meta( $event_id, 'sponsor-tel-number', true );

	if ( empty( $tel_number ) ) {
		return;
	}

	require _get_plugin_directory() . '/src/views/tel-number.php';
}

/*
 * Render the link to the Event sponsor's website.
 *
 * @since 1.4.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_event_url( $event_id ) {
	$domain = (string) get_post_meta( $event_id, 'sponsor-domain-name', true );

	if ( empty( $domain ) ) {
		return;
	}

	require _get_plugin_directory() . '/src/views/sponsor-url.php';
}

/*
 * Render the link to the Event sponsor's Facebook page.
 *
 * @since 1.4.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_event_facebook_link( $event_id ) {
	$facebook = (string) get_post_meta( $event_id, 'sponsor-facebook', true );

	if ( empty( $facebook ) ) {
		return;
	}

	require _get_plugin_directory() . '/src/views/facebook.php';
}

/*
 * Render the link to the Event sponsor's Twitter page.
 *
 * @since 1.4.0
 *
 * @param int $event_id The event ID.
 *
 * @return void
 */
function render_event_twitter_link( $event_id ) {
	$twitter = (string) get_post_meta( $event_id, 'sponsor-twitter', true );

	if ( empty( $twitter ) ) {
		return;
	}

	require _get_plugin_directory() . '/src/views/twitter.php';
}