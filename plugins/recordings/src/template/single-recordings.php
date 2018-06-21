<?php
/**
 * Template for a single events post type.
 *
 * @package     spiralWebDb\Recordings\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Recordings\Template;

use function spiralWebDb\Recordings\render_recording_image;
use function spiralWebDb\FAQ\Asset\enqueue_script_ondemand;

add_action( 'genesis_entry_header', __NAMESPACE__ . '\render_post_thumbnail_before_title', 6 );
/**
 *  Render the recording thumbnail image before the recording title.
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_post_thumbnail_before_title() {
	$recording_id = (int) get_the_ID();

	render_recording_image( $recording_id );
}

add_filter( 'genesis_attr_entry-title', __NAMESPACE__ . '\genesis_attributes_entry_title' );
/**
 * Add attributes for entry title element.
 *
 * @since 1.0.0
 *
 * @param array $attributes Existing attributes for the entry title element.
 *
 * @return array Amended attributes for the entry title element.
 */
function genesis_attributes_entry_title( $attributes ) {
	$attributes[ 'class' ] .= ' two-thirds';

	return $attributes;
}


remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_filter( 'genesis_attr_entry-content', __NAMESPACE__ . '\genesis_attributes_entry_content' );
/**
 * Add attributes for entry content element.
 *
 * @since 1.0.0
 *
 * @param array $attributes Existing attributes for entry content element.
 *
 * @return array Amended attributes for entry content element.
 */
function genesis_attributes_entry_content( $attributes ) {
	$attributes[ 'class' ] .= ' two-thirds';

	return $attributes;
}

add_action( 'genesis_entry_content', __NAMESPACE__ . '\reveal_recording_song_titles', 12 );
/**
 * Reveal and hide recording song titles.
 *
 * @ since 1.0.0
 *
 * @return void
 */
function reveal_recording_song_titles() {
	$recording_id = (int) get_the_ID();
	$show_icon    = esc_attr( 'dashicons dashicons-arrow-down-alt2' );
	$hide_icon    = esc_attr( 'dashicons dashicons-arrow-up-alt2' );
	$content      = get_the_content();

	enqueue_script_ondemand();

	require dirname( __DIR__ ) . '/views/recording.php';
}

genesis();
