<?php
/**
 *  Loads the Cornerstone Members plugin.
 *
 * @package    spiralWebDb\Members
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:     Cornerstone Members
 * Plugin URI:      https://gitlab.com/Hamammelis/cornerstone
 * Description:     Members is a WordPress plugin that manages public information about Cornerstone Chorale
 *                  and Brass members.
 * Version:         1.0.0
 * Author:          Robert A. Gadon
 * Author URI:      http://spiralwebdb.com
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     cornerstone_members
 * Requires WP:     4.9
 * Requires PHP:    5.6
 */

namespace spiralWebDb\Members;

use spiralWebDb\Module\Custom;

/**
 * Gets this plugin's absolute directory path.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_directory() {
	return __DIR__;
}

/**
 * Autoload the plugin's files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload_files() {
	$files = [
		'/src/plugin.php',
		'/src/meta.php',
		'/src/config-loader.php',
		'/src/admin/edit-form-advanced.php',
		'/src/template/helpers.php',
		'/src/shortcode/members.php',
	];

	foreach ( $files as $filename ) {
		require __DIR__ . $filename;
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

	Custom\register_plugin( __FILE__ );

	load_configurations();
}

launch();