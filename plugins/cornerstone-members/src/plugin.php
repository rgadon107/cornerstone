<?php
/**
 * Plugin specific tasks.
 *
 * @package     spiralWebDb\Members
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Members;

add_action( 'pre_get_posts', __NAMESPACE__ . '\set_members_taxonomy_archive_order' );
/**
 * Modify the query for the members' taxonomy archive page, i.e. to set the members order.
 *
 * @since 1.0.0
 *
 * @param WP_Query $query Instance of the query.
 */
function set_members_taxonomy_archive_order( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( ! is_archive() && ! is_tax( 'role' ) ) {
		return;
	}

	$query->set( 'post__not_in', array( 609 ) );
	$query->set( 'posts_per_archive_page', 25 );
	$query->set( 'order', 'ASC' );
	$query->set( 'orderby', 'menu_order' );
}
