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
 * @param array $posts_columns An array of column names.
 *
 * @return array $columns
 */
function set_custom_columns( $posts_columns = array() ) {
	return $posts_columns = array(
		'cb'         => '<input type="checkbox"/>',
		'title'      => 'Member',
		'member_id'  => 'Member ID',
		'menu_order' => 'Order Number',
	);
}

add_action( 'manage_members_posts_custom_column', __NAMESPACE__ . '\_render_custom_column_content' );
/**
 *  Display the content for each custom column.
 *
 * @param string $column_name The name of the column to display.
 * @param int    $post_id     The current post ID.
 * @param array  $config      Optional. Array of custom columns.
 */
function _render_custom_column_content( $column_name, $post_id, $config = array() ) {

	if ( ! is_admin() && ! is_post_type_archive( 'members' ) ) {
		return;
	}

	if ( get_post_type( $post_id ) == 'members' ) {
		$post = get_post();
	}

	$config = set_custom_columns( $posts_columns );

	$member_id  = sanitize_post( $post->ID );
	$menu_order = sanitize_post( $post->menu_order );

	foreach ( $config as $custom_columns => $column_name ) {

		echo $config['member_id']  = $member_id;
		echo $config['menu_order'] = $menu_order;
	}

	return $column_name;
}

add_filter( 'manage_edit-members_sortable_columns', __NAMESPACE__ . '\_set_sortable_columns' );
/**
 * Set sortable columns on Members Admin page.
 *
 * @since 1.0.0
 *
 * @param string $column_name The name of the column to display.
 * @param int    $member_id   The current post ID.
 */
function _set_sortable_columns( array $column_name ) {
	return array(
		'title'      => 'Member',
		'member_id'  => 'Member ID',
		'menu_order' => 'Order Number',
	);
}
