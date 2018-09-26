<?php
/**
 * Custom columns for the Members post type.
 *
 * @package    spiralWebDb\Members
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Members;

add_filter( 'manage_members_posts_columns', __NAMESPACE__ . '\set_custom_columns' );
/**
 * Add custom columns to Members Admin.
 *
 * @since 1.0.0
 *
 * @param array $columns An array of column names.
 *
 * @return array $columns
 */
function set_custom_columns( array $columns ) {
	return array(
		'cb'         => '<input type="checkbox"/>',
		'title'      => 'Member',
		'member_id'  => 'Member ID',
		'menu_order' => 'Order Number',
	);
}

add_action( 'manage_members_posts_custom_column', __NAMESPACE__ . '\render_custom_column_content' );
/**
 *  Display the content for each custom column.
 *
 * @param string $column_name The name of the column to display.
 */
function render_custom_column_content( $column_name ) {

	if ( ! is_admin() && ! post_type_exists( 'members' ) ) {
		return;
	}

	$post = get_the_post();

	$member_id  = sanitize_field( $post->ID );
	$menu_order = sanitize_field( $post->menu_order );

	if ( 'member_id' == $column_name ) {
		echo get_the_member_ID( $member_id );
	}

	if ( 'menu_order' == $column_name ) {
		echo apply_filters( 'menu_order', $menu_order );
	}
}

function get_the_member_ID( $member_id ) {
	return get_the_ID();
}


//add_filter( 'manage_members sortable_columns', __NAMESPACE__ . '\set_sortable_columns' );
///**
// * Set sortable columns on Members Admin page.
// *
// * @since 1.0.0
// *
// * @param string $column_name The name of the column to display.
// * @param int    $member_id   The current post ID.
// */
//function set_sortable_columns( array $column_name ) {
//	return array(
//		'title'      => 'Member',
//		'member_id'  => 'Member ID',
//		'menu_order' => 'Order Number',
//	);
//}
