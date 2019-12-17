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

function _get_plugin_dir() {
	return __DIR__;
}

require_once _get_plugin_dir() . '/src/support/load-assets.php';
