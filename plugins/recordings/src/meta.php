<?php
/**
 * Metadata Handler
 *
 * @package    spiralWebDb\Recordings
 * @since      1.4.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Recordings;

/*
 * Render the Recording post thumbnail image.
 *
 * @since 1.4.0
 *
 * @param int $recording_id The recording ID.
 *
 * @return void
 */
function render_recording_image( $recording_id ) {

	// If there's no image, bail out.
	if ( ! has_post_thumbnail( $recording_id ) ) {
		return;
	}

	echo get_the_post_thumbnail( $recording_id, 'large', [
		'class'    => 'recording-thumbnail first one-third',
		'itemprop' => 'thumbnail',
		'itemscope' > 'itemscope',
		'itemtype' => 'http://schema.org/MusicRecording',
	] );
}
