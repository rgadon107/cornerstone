<?php
/**
 *  Central Hub plugin
 *
 * @package     spiralWebDb\centralHub
 * @author  (c) 2017 by Robert A. Gadon
 * @license     GPL-2.0+ (see license text below)
 * @link        https://spiralwebdb.com
 *
 * @wordpress-plugin
 * Plugin Name:     Central Hub Plugin
 * Plugin URI:      https://gitlab.com/Hamammelis/cornerstone
 * Description:     Central Hub provides other plugins a central store to manage the arguments, labeling, and
 * registration of their custom post types, taxonomies, and shortcodes, and regenerate rewrite rules on plugin
 * activation, deactivation, and uninstall. Version:         1.3.0 Author:          Robert A. Gadon Author URI:
 * http://spiralwebdb.com License URI:     https://www.gnu.org/licenses/gpl-2.0.html Text Domain:     central_hub
 * Requires WP:     4.8 Requires PHP:    5.6
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

namespace spiralWebDb\centralHub;

use KnowTheCode\ConfigStore;

if ( ! defined( 'ABSPATH' ) ) {
	die( "Oh silly, there's nothing to see here." );
}

/**
 *  Autoload plugin files.
 *
 * @since 1.3.0
 *
 * @return void
 */
function autoload() {
	$files = array(
		'config-store/module.php',
		'custom/module.php',
		'meta-data/module.php',
		'template/module.php'
	);

	foreach ( $files as $file ) {
		require_once __DIR__ . '/src/' . $file;
	}

	load_configurations();
}

/**
 * Load the site's general configurations into ConfigStore.
 *
 * @since 1.0.0
 *
 * @return void
 * @throws \Exception
 */
function load_configurations() {
	$configurations = array(
		__DIR__ . '/config/states.php',
		__DIR__ . '/config/roles.php',

	);

	foreach ( $configurations as $file ) {
		ConfigStore\loadConfigFromFilesystem( $file );
	}
}

autoload();