<?php
/**
 * Extend GiveWP
 *
 * @package     spiralWebDB\ExtendGiveWP
 * @author      Robert A. Gadon
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Extend GiveWP
 * Plugin URI:  https://github.com/rgadon107/cornerstone/plugins/extend-give-wp/
 * Description: This plugin extends the Give donation plugin by registering custom functions to it's hooks.
 * Version:     1.0.0
 * Author:      Robert A. Gadon
 * Author URI:  https://spiralwebdb.com
 * Text Domain: extend-give
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace spiralWebDB\ExtendGiveWP;

defined( 'ABSPATH' ) || exit;

/**
 * Get the absolute path to the plugin's root directory.
 *
 * @since  1.0.0
 *
 * @return string Absolute path to the plugin's root directory.
 * @ignore
 * @access private
 *
 */
function _get_plugin_dir() {
	return __DIR__;
}

/**
 * Autoload the plugin's files.
 *
 * @since 1.0.0
 * @return void
 */
function autoload_files() {
	$files = [
		'/src/admin/admin-page.php',
		'/src/support/load-assets.php',
	];

	foreach ( $files as $filename ) {
		require _get_plugin_dir() . $filename;
	}
}

autoload_files();
