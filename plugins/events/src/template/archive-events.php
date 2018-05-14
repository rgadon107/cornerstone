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

// 1. Remove the default genesis_loop and replace with a custom events loop
// to display all the single events.

// 2. Get all the records for the 'events' post type.
// Question: If I don't have a custom taxonomy term to add to my db query,
// would I use the global $wp_query object instead to get the post_id and post_title?

// 3. If there are no records to display, render a message that there are no records.

// 4. Call the container view file for archive-events.

// 5. Loop through and render the single-events view file to build the archive view.
// Question: Can I customize the loop to render less data than what's presented in the
// single-events.php template?

// Data that I want to render in each single-event within the Events archive:
// Image of Event Venue; postmeta: 'events[event-venue-image]'
// Performance Date (day-of-week; postmeta: 'events[event-day]',
// Performance Date (date (MMDDYYYY); postmeta: 'events[event-date]',
// Performance Time; postmeta: 'events[event-time]',
// Performance Venue -- Address (Street); postmeta: 'events[venue-address]',
// Performance Venue -- Address (City); postmeta: 'events[venue-city]',
// Performance Venue -- Address (State); postmeta: 'events[venue-state]',
// Admission Price; postmeta: 'events[admission]',

genesis();
