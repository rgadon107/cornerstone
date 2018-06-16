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

	sprintf( '<div %s>', genesis_attr( 'entry-header' ) );

	render_recording_image( $recording_id );

}

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

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
