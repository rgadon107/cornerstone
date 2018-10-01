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

add_action( 'manage_events_posts_custom_column', __NAMESPACE__ . '\_render_custom_column_content', 10, 2 );
/**
 *  Display the content for each custom column.
 *
 * @since 1.0.0
 *
 * @param string $column_name The name of the column to display.
 * @param int    $event_id    The current event (post) ID.
 */
function _render_custom_column_content( $column_name, $event_id ) {
	switch ( $column_name ) {
		case 'event_id':
			echo (int) $event_id;
			break;
		case 'performance_date':
			$event_date     = (string) get_post_meta( $event_id, 'event-date', true );
			$event_date     = strtotime( $event_date );
			$formatted_date = date( 'M d, Y', $event_date );
			echo esc_html( $formatted_date );
			break;
		case 'menu_order':
			echo (int) get_post_field( 'menu_order', $event_id );
			break;
	}
}

add_filter( 'manage_edit-events_sortable_columns', __NAMESPACE__ . '\_set_sortable_columns' );
/**
 * Set sortable columns on Events Admin page.
 *
 * @since 1.0.0
 *
 * @return array New sortable columns.
 */
function _set_sortable_columns() {
	return array(
		'event_id'         => 'Event ID',
		'performance_date' => 'Performance Date',
		'menu_order'       => 'Order Number',
	);
}
