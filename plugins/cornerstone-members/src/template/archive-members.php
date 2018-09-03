<?php
/**
 * Template for the members post type archive.
 *
 * @package     spiralWebDb\Members\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Members\Template;

add_filter( 'post_class', __NAMESPACE__ . '\add_to_post_classes_for_grid_pattern' );
/**
 * Add to the post classes.
 *
 * @since 1.0.0.
 *
 * @param array $classes Post classes.
 *
 * @return array
 */
function add_to_post_classes_for_grid_pattern( array $classes ) {
	static $members_count = 0;

	if ( is_admin() ) {
		return $classes;
	}

	$classes[] = get_members_post_classes( $members_count );

	$members_count++;

	return $classes;
}

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', __NAMESPACE__ . '\render_members_content' );

require dirname( __DIR__ ) . '/template/single-members.php';
