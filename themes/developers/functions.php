<?php
/**
 * Developer's Theme
 *
 * @package     spiralWebDB\Developers
 * @since       2.0.0
 * @author      Robert A. Gadon
 * @link        https://spiralwebdb.com
 * @license     GNU General Public License 2.0+
 */
namespace spiralWebDB\Developers;

/**
 * Get the absolute path to the root directory of the child theme.
 *
 * @since 2.0.0
 *
 * @return string returns the directory path.
 */
function get_theme_dir() {
	return __DIR__;
}

/**
 * Get the URL to the root of the child theme.
 *
 * @since 2.0.0
 *
 * @return string returns the URL to the root of the child theme.
 */
function get_theme_url() {
	static $url = '';

	if ( empty( $url ) ) {
		$url = get_stylesheet_directory_uri();
	}

	return $url;
}

/**
 * Get the theme's version.
 *
 * @since 2.0.0
 *
 * @return string returns the theme's version.
 */
function get_theme_version() {
	static $version = null;

	if ( null !== $version ) {
		return $version;
	}

	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		$version = filemtime( __DIR__ . '/style.min.css' );
	} else {
		$version = wp_get_theme()->get( 'Version' );
	}

	return $version;
}

/**
 * Checks if in a debug/dev environment.
 *
 * @since 2.0.0
 *
 * @return bool
 */
function is_in_debug() {
	return defined( 'WP_DEBUG' ) && WP_DEBUG;
}

include_once 'lib/init.php';

include_once 'lib/functions/autoload.php';
