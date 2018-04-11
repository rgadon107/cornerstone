<?php
/**
 * Loads the Recordings plugin.
 *
 * @package    spiralWebDb\Reviews
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
 * Text Domain:     cornerstone_reviews
 * Requires WP:     4.9
 * Requires PHP:    5.6
 */

namespace spiralWebDb\Recordings;

use spiralWebDb\Module\Custom as CustomModule;
use spiralWebDb\Metadata as metaData;

define( 'RECORDINGS_DIR', __DIR__ );

add_filter( 'add_custom_post_type_runtime_config', __NAMESPACE__ . '\register_recordings_custom_configs' );
add_filter( 'add_custom_taxonomy_runtime_config', __NAMESPACE__ . '\register_recordings_custom_configs' );
/**
 *  Loading in the post type and taxonomy runtime configurations with
 *  the Custom module.
 *
 * @since 1.0.0
 *
 * @param array $configurations Array of all of the configurations.
 *
 * @return void
 */
function register_recordings_custom_configs( array $configurations ) {

	$doing_post_type = current_filter() == 'add_custom_post_type_runtime_config';

	$filename = $doing_post_type
		? 'post-type'
		: 'taxonomy';

	$runtime_config = (array) require( __DIR__ . '/config/' . $filename . '.php' );

	if ( ! $runtime_config ) {
		return $configurations;
	}

	$key = $doing_post_type
		? $runtime_config['post_type']
		: $runtime_config['taxonomy'];

	$configurations[ $key ] = $runtime_config;

	return $configurations;

}

/**
 * Load the configurations.
 *
 * @since 1.0.0
 *
 * @return void
 */
function load_configurations() {
	metaData\autoload_configurations(
		array(
			__DIR__ . '/config/recordings.php',
		)
	);
}

/**
 * Launch the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	CustomModule\register_plugin( __FILE__ );

	load_configurations();
}

launch();