<?php
/**
 * Load the Recordings plugin.
 *
 * @package    spiralWebDb\Recordings
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:     Recordings Plugin
 * Plugin URI:      https://gitlab.com/Hamammelis/cornerstone
 * Description:     Recordings Manager to organize all the CD recordings for the Cornerstone Chorale and Brass.
 * Version:         1.0.0
 * Author:          Robert A. Gadon
 * Author URI:      http://spiralwebdb.com
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     recordings
 * Requires WP:     4.9
 * Requires PHP:    5.6
 */

namespace spiralWebDb\Recordings;

use spiralWebDb\Module\Custom as CustomModule;

if ( ! defined( 'ABSPATH' ) ) {
	die( "Oh silly, there's nothing to see here." );
}

define( 'RECORDINGS_DIR', __DIR__ );

/**
 * Autoload the plugin's files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload_files() {
	$files = array(
		'/src/config-loader.php',
	);

	foreach ( $files as $filename ) {
		require RECORDINGS_DIR . $filename;
	}
}

/**
 * Launch the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	autoload_files();

	CustomModule\register_plugin( __FILE__ );

	load_configurations();

}

launch();