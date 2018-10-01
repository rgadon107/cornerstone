<?php
/**
 *  Custom columns for the Recordings post type.
 *
 * @package    spiralWebDb\Recordings
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Recordings;

add_filter( 'manage_recordings_posts_columns', __NAMESPACE__ . '\set_custom_columns' );
/**
 * Add custom columns to Recordings Admin.
 *
 * @since 1.0.0
 *
 * @return array Array of columns.
 */
function set_custom_columns() {
	return array(
		'cb'           => '<input type="checkbox"/>',
		'title'        => 'Recording Title',
		'recording_id' => 'Recording ID',
		'menu_order'   => 'Order Number',
	);
}

add_action( 'manage_recordings_posts_custom_column', __NAMESPACE__ . '\_render_custom_column_content', 10, 2 );
/**
 *  Display the content for each custom column.
 *
 * @since 1.0.0
 *
 * @param string $column_name  The name of the column to display.
 * @param int    $recording_id The current recording (post) ID.
 */
function _render_custom_column_content( $column_name, $recording_id ) {
	switch ( $column_name ) {
		case 'recording_id':
			echo (int) $recording_id;
			break;
		case 'menu_order':
			echo (int) get_post_field( 'menu_order', $recording_id );
			break;
	}
}

add_filter( 'manage_edit-recordings_sortable_columns', __NAMESPACE__ . '\_set_sortable_columns' );
/**
 * Set sortable columns on Recordings Admin page.
 *
 * @since 1.0.0
 *
 * @return array New sortable columns.
 */
function _set_sortable_columns() {
	return array(
		'recording_id' => 'Recording ID',
		'menu_order'       => 'Order Number',
	);
}
