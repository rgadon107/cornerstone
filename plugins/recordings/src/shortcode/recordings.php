<?php
/**
 * Shortcode processing for the Recording shortcode.
 *
 * @package    spiralWebDb\Recordings\Shortcode
 * @since      1.4.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Recordings\Shortcode;

use function spiralWebDb\FAQ\Asset\enqueue_script_ondemand;

/**
 *  Process the Shortcode to display content about a single recording.
 *
 * @since 1.4.0
 *
 * @param array $config     Array of runtime configuration parameters
 * @param array $attributes Attributes for this shortcode instance.
 *
 *
 * @return string
 */
function process_the_recording_shortcode( array $config, array $attributes ) {
	$attributes['id'] = (int) $attributes['id'];
	if ( $attributes['id'] < 1 ) {
		return '';
	}

	enqueue_script_ondemand();

	// Call the view file, capture it into the output buffer, and then return it.
	ob_start();
	render_single_recording( $attributes, $config );

	return ob_get_clean();
}

/**
 * Process a single Recording by id
 *
 * @since 1.4.0
 *
 * @param array $attributes Default configuration attributes for the single Recording shortcode
 * @param array $config     Runtime configuration attributes for the single Recording view file.
 *
 * @return void
 */
function render_single_recording( array $attributes, array $config ) {
	$recording = get_post( $attributes['id'] );

	// Render error message in event there is no Recording.
	if ( ! $recording ) {
		return render_none_found_message( $attributes );
	}

	$post_title = $recording->post_title;
	$content    = do_shortcode( $recording->post_content );
	$show_icon  = esc_attr( $attributes['show_icon'] );
	$hide_icon  = esc_attr( $attributes['hide_icon'] );

	include $config['view']['recording'];
}

/**
 *  Render the 'none found message' handler.
 *
 * @since 1.4.0
 *
 * @param array $attributes
 *
 * @return void
 *
 */
function render_none_found_message( array $attributes ) {

	if ( ! $attributes['show_none_found_message'] ) {
		return;
	}

	$message = $attributes['none_found_single_recording'];

	printf( '<em>%s</em>', esc_html( $message ) );
}