<?php
/**
 *  Custom columns for the Tours post type.
 *
 * @package    spiralWebDb\CornerstoneTours
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours;

add_filter( 'manage_tours_posts_columns', __NAMESPACE__ . '\set_custom_columns' );
/**
 * Add custom columns to the Tours admin page.
 *
 * @since 1.0.0
 * @param array[] $post_columns An associative array of column headings.
 *
 * @return array An array of custom column headings.
 */
function set_custom_columns( $post_columns ) {
	return array(
		'cb'         => '<input type="checkbox"/>',
		'title'      => 'Tour Name',
		'tour_id'    => 'Tour ID',
		'tour_year'  => 'Tour Year',
		'menu_order' => 'Order Number',
	);
}

add_action( 'manage_tours_posts_custom_column', __NAMESPACE__ . '\_render_custom_column_content', 10, 2 );
/**
 *  Display the content for each custom column.
 *
 * @param string $column_name The name of the column to display.
 * @param int    $tour_id     The current tour (post) ID.
 *
 * @since 1.0.0
 *
 */
function _render_custom_column_content( $column_name, $tour_id ) {
	switch ( $column_name ) {
		case 'tour_id':
			echo (int) $tour_id;
			break;
		case 'tour_year':
			$tour_year = (int) get_post_meta( $tour_id, 'tour_year', true );
			echo esc_html( $tour_year );
			break;
		case 'menu_order':
			echo (int) get_post_field( 'menu_order', $tour_id );
			break;
	}
}

add_filter( 'manage_edit-tours_sortable_columns', __NAMESPACE__ . '\_set_sortable_columns' );
/**
 * Set sortable columns on the Tours admin page.
 *
 * @return array New sortable columns.
 * @since 1.0.0
 *
 */
function _set_sortable_columns() {
	return array(
		'tour_id'    => 'Tour ID',
		'tour_year'  => 'Tour Year',
		'menu_order' => 'Order Number',
	);
}