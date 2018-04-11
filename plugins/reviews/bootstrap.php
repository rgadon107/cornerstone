<?php
/**
 *  Reviews plugin
 *
 * @package     spiralWebDb\Reviews
 * @author  (c) 2017 by Robert A. Gadon
 * @license     GPL-2.0+ (see license text below)
 * @link        https://spiralwebdb.com
 *
 * @wordpress-plugin
 * Plugin Name:     Reviews Plugin
 * Plugin URI:      https://gitlab.com/Hamammelis/cornerstone
 * Description:     Reviews is a WordPress plugin that manages all the reviews for the Cornerstone Chorale and Brass.
 * Author:          Robert A. Gadon
 * Author URI:      http://spiralwebdb.com
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     cornerstone_reviews
 * Requires WP:     4.8
 * Requires PHP:    5.5
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

namespace spiralWebDb\Reviews;

use spiralWebDb\Module\Custom;

define( 'REVIEWS_DIR', __DIR__ );

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
		'/src/admin/edit-form-advanced.php',
	);

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
