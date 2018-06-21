<?php
/**
 * Template for a single events post type.
 *
 * @package     spiralWebDb\Events\Template;
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Events\Template;

use function spiralWebDb\Events\render_event_venue_image;
use function spiralWebDb\Events\render_event_map;
use function spiralWebDb\FAQ\Asset\enqueue_script_ondemand;

add_action( 'genesis_entry_header', __NAMESPACE__ . '\render_event_location_before_event_title', 5 );
/**
 * Render the event location (City, State) before the event title
 */
function render_event_location_before_event_title( $event_id ) {

	$event_id = get_the_ID();
	require dirname( __DIR__ ) . '/views/event-community.php';
}

add_action( 'genesis_entry_header', __NAMESPACE__ . '\add_content_wrap_markup_open', 3 );
/*
 * Add content wrap around Event entry_header.
 *
 * @since 1.0.0
 *
 * return void
 */
function add_content_wrap_markup_open() {
	$event_id = (int) get_the_ID();

	printf( '<div %s>', genesis_attr( 'before-entry-header-wrap' ) );

	render_event_venue_image( $event_id );
}

add_filter( 'genesis_attr_entry', __NAMESPACE__ . '\modify_entry_content_attributes', 99 );
/**
 * Modify the Genesis entry-content class attributes and microdata schema.
 *
 * @since 1.0.0
 *
 * @param array $attributes Array of assigned attributes.
 *
 * @return array $attributes Modified attributes.
 */
function modify_entry_content_attributes( $attributes ) {
	$attributes['class']    .= ' event-' . (int) get_the_ID();
	$attributes['itemtype'] = 'https://schema.org/MusicEvent';

	return $attributes;
}

add_filter( 'genesis_attr_entry-title', __NAMESPACE__ . '\modify_entry_title_attributes', 99 );
/*
 * Modify the Genesis entry-title class attributes and microdata schema.
 *
 * @since 1.0.0
 *
 * @param array $attributes Array of assigned attributes.
 * @return array $attributes Modified attributes.
 */
function modify_entry_title_attributes( $attributes ) {
	$attributes['class']    .= ' event-title';
	$attributes['itemprop'] = 'location';
	$attributes['itemtype'] = 'https://schema.org/MusicVenue';

	return $attributes;
}

add_filter( 'genesis_attr_entry-header', __NAMESPACE__ . '\add_entry_header_attributes', 20 );
/*
 *
 */
function add_entry_header_attributes( $attributes ) {
	$attributes['class'] .= ' two-thirds';

	return $attributes;
}

add_filter( 'genesis_post_info', __NAMESPACE__ . '\render_event_meta_before_content', 20 );
/*
 * Render the event entry-meta-before-content
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_event_meta_before_content() {
	$event_id = (int) get_the_ID();
	echo sprintf( '<div %s>', genesis_attr( 'before-entry-content-meta' ) );

	require dirname( __DIR__ ) . '/views/performance-date-time.php';
	render_event_map( $event_id );
	require dirname( __DIR__ ) . '/views/event-admission.php';
}

// Ensure that no content in the editor is accidentally rendered on the front-end.
remove_all_filters( 'genesis_entry_content' );

add_filter( 'genesis_post_meta', __NAMESPACE__ . '\modify_entry_meta_after_content', 999 );
/*
 * Modify the event entry meta after post content.
 *
 * @since 1.0.0
 *
 * @return void
 */
function modify_entry_meta_after_content() {
	$event_id = (int) get_the_ID();

	$show_icon = esc_attr( 'dashicons dashicons-plus' );
	$hide_icon = esc_attr( 'dashicons dashicons-minus' );

	enqueue_script_ondemand();

	require dirname( __DIR__ ) . '/views/event-footer.php';
}

genesis();
