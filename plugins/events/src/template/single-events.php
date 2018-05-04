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

ddd( 'Loaded the single-events template' );

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