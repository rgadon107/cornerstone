<?php
/**
 * Template for the recordings post type archive.
 *
 * @package     spiralWebDb\Recordings\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Recordings\Template;

add_action( 'genesis_before_while', __NAMESPACE__ . '\remove_genesis_entry_content_hook' );
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
	static $recording_count = 0;

	if ( is_admin() ) {
		return $classes;
	}

	$classes[] = 'one-third';

	if ( $recording_count % 3 === 0 ) {
		$classes[] = 'first';
	}

	$recording_count++;

	return $classes;
}

require __DIR__ . '/single-recordings.php';
