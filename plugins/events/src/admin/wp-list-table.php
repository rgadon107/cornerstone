<?php
/**
 *  Custom columns for the Events post type.
 *
 * @package    spiralWebDb\Events
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Events;

add_filter( 'manage_events_posts_columns', __NAMESPACE__ . '\set_custom_columns' );
/**
 * Add custom columns to Events Admin.
 *
 * @since 1.0.0
 *
 * @return array Array of columns.
 */
function set_custom_columns() {
	return array(
		'cb'               => '<input type="checkbox"/>',
		'title'            => 'Name of Venue',
		'event_id'         => 'Event ID',
		'performance_date' => 'Performance Date',
		'menu_order'       => 'Order Number',
	);
}