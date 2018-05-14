<?php
/**
 * Asset Handler.
 *
 * @package    spiralWebDb\FAQ\Asset
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\FAQ\Asset;

use function spiralWebDb\FAQ\_get_plugin_directory;
use function spiralWebDb\FAQ\_get_plugin_url;
use function spiralWebDb\Module\Custom\Shortcode\did_shortcode;

/**
 * Enqueues the script on demand.  If this shortcode is firing for the first time, then
 * the script is enqueued.
 *
 * @since 1.0.0
 *
 * @param string $shortcode_name Name of the shortcode.
 *
 * @return void
 */
function maybe_enqueue_script( $shortcode_name ) {
	$number_of_times_fired = did_shortcode( $shortcode_name );
	if ( false === $number_of_times_fired ) {
		return;
	}

	if ( $number_of_times_fired > 1 ) {
		return;
	}

	enqueue_script_ondemand();
}

/**
 * Enqueue the FAQ script on-demand.
 *
 * @since 1.0.0
 *
 * @return void
 */
function enqueue_script_ondemand() {
	$file = 'assets/js/jquery.plugin.js';
	wp_enqueue_script(
		'faq_script',
		_get_plugin_url() . '/' . $file,
		array( 'jquery' ),
		_get_asset_version( $file ),
		true
	);
}

/**
 * Get's the asset file's version number by using it's modification timestamp.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @param string $relative_path Relative path to the asset file.
 *
 * @return bool|int
 */
function _get_asset_version( $relative_path ) {
	return filemtime( _get_plugin_directory() . '/' . $relative_path );
}