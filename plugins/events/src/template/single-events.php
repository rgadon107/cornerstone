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

use function spiralWebDb\Events\_get_plugin_directory;

d( 'Loaded the single-events template' );

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

add_filter( 'genesis_entry_title_wrap', __NAMESPACE__ . '\modify_entry_title_html_wrap', 999 );
/*
 * Modify Event entry-title HTML wrap.
 *
 * @since 1.0.0
 *
 * @param string $wrap The post title HTML wrapping element
 */
function modify_entry_title_html_wrap( $wrap ) {
	return 'h2';
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

add_filter( 'the_title', __NAMESPACE__ . '\prepend_icon_to_post_title' );
/*
 *
 */
function prepend_icon_to_post_title( $title)    {

	return $title;
}

add_filter( 'genesis_post_info', __NAMESPACE__ . '\modify_entry_meta_before_content', 999 );
/*
 * Modify the entry meta before the post content.
 *
 * @since 1.0.0
 *
 * @return void
 */
function modify_entry_meta_before_content() {

//	$metadata = 'Here is some metadata on the performance.';
//
//	echo '<p class="entry-meta" itemprop="performance-date">' . 'Performance Date: ' . $metadata . '</p>';

	require _get_plugin_directory() . '/src/views/event.php';

// Notes: Even though Tonya includes a view file at '/src/views/review.php', she didn't
// call it into her 'single-review.php' file at '/src/templates/single-events.php'
// Instead, she created a '/src/meta.php' file in which she called the plugin metadata.
// Then she created a '/src/review-footer.php' file in which she called the functions
// she created in '/src/meta.php'. _Then_ she hooked into an event in '/genesis/lib/structure/loop.php'
// and called a view from '/src/review-footer.php'. The rest of the markup in
// '/src/views/review.php' was registered to events called by Genesis in
// '/genesis/lib/structure/loop.php'. The value of '/src/views/review.php' is
// that is gives you an overall structure to aim for. But it's not used in it's
// entirety.
}

//add_filter( 'genesis_attr_entry-meta-before-content', __NAMESPACE__ . '\modify_entry_meta_before_content_atts' );
//function modify_entry_meta_before_content_atts( $attributes ) {
//	$attibutes['class']     .= 'entry-meta-before-content';
//	$attributes['itemtype']  = 'performance-date';
//
//	return $attributes;
//}

// From WP_Post, $post->ID so that we can call each metakey linked to it's post_id.
// Image of Event Venue; postmeta: 'events[venue-image]'
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