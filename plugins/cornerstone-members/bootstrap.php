<?php
/**
 *  Cornerstone Members plugin
 *
 * @package     spiralWebDb\Members
 * @author  (c) 2017 by Robert A. Gadon
 * @license     GPL-2.0+ (see license text below)
 * @link        https://spiralwebdb.com
 *
 * @wordpress-plugin
 * Plugin Name:     Cornerstone Members
 * Plugin URI:      https://gitlab.com/Hamammelis/cornerstone
 * Description:     Members is a WordPress plugin that manages public information about Cornerstone Chorale and Brass
 * members.
 * Author:          Robert A. Gadon Author
 * URI:      http://spiralwebdb.com License URI:
 * https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     cornerstone_members Requires WP:     4.8
 * Requires PHP: 5.5
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

namespace spiralWebDb\Members;

use spiralWebDb\Module\Custom as CustomModule;
use spiralWebDb\Metadata as metaData;

define( 'CORNERSTONE_MEMBERS_DIR', __DIR__ );

add_filter( 'add_custom_post_type_runtime_config', __NAMESPACE__ . '\register_members_custom_configs', 9 );
add_filter( 'add_custom_taxonomy_runtime_config', __NAMESPACE__ . '\register_members_custom_configs', 9 );
/**
 *  Loading in the post type and taxonomy runtime configurations with
 *  the Custom module.
 *
 * @since 1.0.0
 *
 * @param array $configurations Array of all of the configurations.
 *
 * @return array $configurations
 */
function register_members_custom_configs( array $configurations ) {
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

add_filter( 'add_custom_plugin_path_to_template_files', __NAMESPACE__ . '\path_to_plugin_template_files', 7 );
/**
 * Return configuration of absolute paths to plugin template files.
 *
 * @since 1.0.0
 *
 * @param array $configuration Array of paths to plugin template files
 */
function path_to_plugin_template_files( array $configuration ) {
	$configuration = require __DIR__ . '/config/template.php';
	return $configuration;
}

/**
 * Autoload the plugin's files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload_files() {
	$files = array(
		'/src/admin/edit-form-advanced.php',
	);

	foreach ( $files as $filename ) {
		require __DIR__ . $filename;
	}
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
			__DIR__ . '/config/members.php',
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
	autoload_files();

	CustomModule\register_plugin( __FILE__ );

	load_configurations();
}

launch();
