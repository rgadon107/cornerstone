<?php
/**
 *  Custom columns for the Reviews post type.
 *
 * @package    spiralWebDb\Reviews
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Reviews;

add_filter( 'manage_reviews_posts_columns', __NAMESPACE__ . '\set_custom_columns' );
/**
 * Add custom columns to Reviews Admin.
 *
 * @since 1.0.0
 *
 * @return array Array of columns.
 */
function set_custom_columns() {
	return array(
		'cb'         => '<input type="checkbox"/>',
		'title'      => 'Review Title',
		'review_id'  => 'Review ID',
		'menu_order' => 'Order Number',
	);
}

add_action( 'manage_reviews_posts_custom_column', __NAMESPACE__ . '\_render_custom_column_content', 10, 2 );
/**
 *  Display the content for each custom column.
 *
 * @since 1.0.0
 *
 * @param string $column_name The name of the column to display.
 * @param int    $review_id   The current member (post) ID.
 */
function _render_custom_column_content( $column_name, $review_id ) {
	switch ( $column_name ) {
		case 'review_id':
			echo (int) $review_id;
			break;
		case 'menu_order':
			echo (int) get_post_field( 'menu_order', $review_id );
			break;
	}
}

add_filter( 'manage_edit-reviews_sortable_columns', __NAMESPACE__ . '\_set_sortable_columns' );
/**
 * Set sortable columns on Reviews Admin page.
 *
 * @since 1.0.0
 *
 * @return array New sortable columns.
 */
function _set_sortable_columns() {
	return array(
		'event_id'         => 'Review ID',
		'menu_order'       => 'Order Number',
	);
}
