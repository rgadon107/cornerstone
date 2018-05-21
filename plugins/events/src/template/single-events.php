<?php
/**
 * Template for a single events post type.
 *
 * @package     spiralWebDb\Events\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Events\Template;

d( 'Loaded the single-events template' );

add_filter( 'genesis_entry_title_wrap', __NAMESPACE__ . '\modify_entry_title_html_wrap', 999 );
/*
 * Modify Event entry-title HTML wrap.
 *
 * @since 1.0.0
 *
 * @param string $wrap The post title HTML wrapping element
 */
function modify_entry_title_html_wrap( $wrap )  {
	return 'h2';
}

add_filter( 'genesis_attr_entry', __NAMESPACE__ . '\modify_entry_content_attributes', 99 );
/**
 * Modify the Genesis entry-content class attributes and microdata schema.
 *
 * @since 1.0.0
 *
 * @param array $attributes Array of assigned attributes.
 * @return array $attributes Modified attributes.
 */
function modify_entry_content_attributes( $attributes ) {

	$attributes['class']    .= ' events-' . (int) get_the_ID();
	$attributes['itemtype']  = 'https://schema.org/MusicEvent';

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
	$attributes['itemprop']  = 'performance-venue';
	$attributes['itemtype']  = 'https://schema.org/MusicVenue';

	return $attributes;
}

add_filter( 'genesis_post_info', __NAMESPACE__ . 'unregister_entry_meta_before_content' );
/*
 * Unregister the entry meta before the post content.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_entry_meta_before_content() {
	return '';
}

// From WP_Post, $post->ID so that we can call each metakey linked to it's post_id.
// Image of Event Venue; postmeta: 'events[event-venue-image]'
// Performance Date (day-of-week; postmeta: 'events[event-day]',
// Performance Date (date (MMDDYYYY); postmeta: 'events[event-date]',
// Performance Time; postmeta: 'events[event-time]',
// Performance Venue - Name; postmeta: 'events[venue-name]',
// Performance Venue -- Address (Street); postmeta: 'events[venue-address]',
// Performance Venue -- Address (City); postmeta: 'events[venue-city]',
// Performance Venue -- Address (State); postmeta: 'events[venue-state]',
// Admission Price; postmeta: 'events[admission]',
// Telephone Number for Event Sponsor; postmeta: 'events[sponsor-tel-number]',
// URL link; Map to Event Venue; postmeta: 'events[event-map-url]',

genesis();