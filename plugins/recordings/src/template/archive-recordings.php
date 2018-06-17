<?php
/**
 * Template for the events post type archive.
 *
 * @package     spiralWebDb\Recordings\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Recordings\Template;

add_action( 'genesis_before_entry_content', __NAMESPACE__ . '\remove_genesis_entry_content_hook' );
/**
 *  Remove callback from genesis_entry_content hook
 *
 * @since 1.0.0
 *
 * @return void
 */
function remove_genesis_entry_content_hook() {
	remove_action( 'genesis_entry_content', __NAMESPACE__ . '\reveal_recording_song_titles', 12 );
}

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

	if ( is_admin() || is_single() ) {
		return $classes;
	}

	if ( ! is_post_type_archive( 'recordings' ) ) {
		return $classes;
	}

	return get_classes_for_grid_pattern( $classes, 3 );
}

/*
 * Based on the number of columns requested, get the styling classes for the grid
 * pattern.
 *
 * @since 1.0.0
 *
 * @param array $classes            Post classes.
 * @param int   $number_of_columns  Number of columns to set for this grid pattern.
 *
 * @return array
 */
function get_classes_for_grid_pattern( array $classes, $number_of_columns = 2 ) {

	if ( $number_of_columns < 2 || $number_of_columns > 6 ) {
		return $classes;
	}

	global $wp_query;

	/**
	 * The element position within the array lines up with the $number_of_columns.
	 * If $number_of_columns = 3, then the 4th array element is equal to 'one-third'.
	 */
	$column_classes = array(
		'',             // index 0
		'',             // index 1
		'one-half',     // index 2
		'one-third',    // index 3
		'one-fourth',   // index 4
		'one-fifth',    // index 5
		'one-sixth',    // index 6
	);

	// Copy the column class out of the array above, and add it to the end of the $classes array.
	// Limit the addition of column classes to 'recordings' post types only.
	if ( is_post_of_post_type() ) {
		$classes[] = $column_classes[ $number_of_columns ];
	}
	
	if ( $wp_query->$current_post % $number_of_columns == 0 ) {
		$classes[] = 'first';
	}

	return $classes;
}

/**
 * Checks if the current (or specified) post is of the specified post type.
 *
 * @since 1.0.0
 *
 * @param string            $post_type
 * @param int|WP_Post|null  $post_or_post_id  Post ID or post object. When `null`,
 *                                              WordPress uses global $post.
 * @uses  get_post_type()   Retrieve the post type of the current post or of a given post.
 *
 * @return bool
 */
function is_post_of_post_type( $post_type = 'recordings', $post_or_post_id = null ) {
	return get_post_type( $post_or_post_id ) == $post_type;
}

require __DIR__ . '/single-recordings.php';
