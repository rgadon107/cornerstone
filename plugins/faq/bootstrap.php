<?php
/**
 * Loads the FAQ plugin.
 *
 * @package    spiralWebDb\Reviews
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:     FAQ Plugin
 * Plugin URI:      https://gitlab.com/Hamammelis/cornerstone
 * Description:     Frequently Asked Questions (FAQ) feature.
 * Version:         1.0.0
 * Author:          Robert A. Gadon
 * Author URI:      http://spiralwebdb.com
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     cornerstone_reviews
 * Requires WP:     4.9
 * Requires PHP:    5.6
 */

namespace spiralWebDb\FAQ;

if ( ! defined( 'ABSPATH' ) ) {
	die( "Oh silly, there's nothing to see here." );
}

define( 'FAQ_PLUGIN', __FILE__ );
define( 'FAQ_DIR', trailingslashit( __DIR__ ) );

$plugin_url = plugin_dir_url( __FILE__ );

if ( is_ssl() ) {
	$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
}

define( 'FAQ_URL', $plugin_url );

/**
 *  Autoload plugin files.
 *
 * @since 1.0.0
 *
 * @return void
 * @throws \Exception
 */
function autoload() {
	$files = array(
		'plugin.php',
		'module.php',
	);

	foreach ( $files as $file ) {
		require FAQ_DIR . 'src/' . $file;
	}
}

autoload();