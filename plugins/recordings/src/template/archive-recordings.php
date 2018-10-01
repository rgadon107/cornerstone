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

add_action( 'genesis_before_entry', __NAMESPACE__ . '\remove_archive_post_thumbnail' );
/**
 * Remove the post thumbnail from the archive page before we register it.
 *
 * @since 1.0.0
 *
 * @return void
 */
function remove_archive_post_thumbnail() {
	remove_action( 'genesis_entry_header', __NAMESPACE__ . '\render_post_thumbnail_before_title', 6 );
}

add_action( 'genesis_entry_header', __NAMESPACE__ . '\display_post_thumbnail_before_title', 9 );
/**
 *  Render the recording thumbnail image before the recording title.
 *
 * @since 1.0.0
 *
 * @return void
 */
function display_post_thumbnail_before_title() {
	$recording_id = (int) get_the_ID();

	echo get_the_post_thumbnail( $recording_id, 'large', [
		'class'    => 'recording-thumbnail',
		'itemprop' => 'thumbnail',
		'itemscope' > 'itemscope',
		'itemtype' => 'http://schema.org/MusicRecording',
	] );
}

add_action( 'genesis_before_entry', __NAMESPACE__ . '\remove_added_attributes_to_entry_title' );
/**
 * Remove added class attributes to entry-title
 *
 * @since 1.0.0
 *
 * @return void
 */
function remove_added_attributes_to_entry_title() {
	remove_filter( 'genesis_attr_entry-title', __NAMESPACE__ . '\genesis_attributes_entry_title' );
}

add_action( 'genesis_before_while', __NAMESPACE__ . '\remove_genesis_entry_content_hook' );
/**
 *  Remove show/hide feature that displays song titles.
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

	$recording_count ++;

	return $classes;
}

add_action( 'genesis_before_footer', __NAMESPACE__ . '\render_archive_recordings_widget_area' );
/*
 *  Render archive-recordings widget area.
 *
 *  @since 1.0.0
 *
 *  @return void
 */
function render_archive_recordings_widget_area() {
	genesis_widget_area( 'archive_recordings_widget_area', array(
		'before' => '<div class="archive-recordings--widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

require __DIR__ . '/single-recordings.php';
