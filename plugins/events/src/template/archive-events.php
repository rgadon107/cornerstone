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

ddd( 'Loaded the archive-events template' );

// Thought: I need to get the post_id and the post_title from the WP_Query class object.
// public static get_instance($post_id)->ID  get the post_id
// public static get_instance($post_id)->post_title   get the post_title

// Thought: Do I need to build a loop to loop through each of the single-events.php files?
// Thought: If I do, can I customize the loop to return a subset of data not presented in the
// in the single-events.php template?
// Thought: Aren't I going to have to get the permalink for the single-events post in order
// to open the single template?

// Image of Event Venue; postmeta: 'events[event-venue-image]'
// Performance Date (day-of-week; postmeta: 'events[event-day]',
// Performance Date (date (MMDDYYYY); postmeta: 'events[event-date]',
// Performance Time; postmeta: 'events[event-time]',
// Performance Venue -- Address (Street); postmeta: 'events[venue-address]',
// Performance Venue -- Address (City); postmeta: 'events[venue-city]',
// Performance Venue -- Address (State); postmeta: 'events[venue-state]',
// Admission Price; postmeta: 'events[admission]',

genesis();
