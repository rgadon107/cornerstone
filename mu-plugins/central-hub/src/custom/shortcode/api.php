<?php
/**
 *  Shortcode API.
 *
 * @package    spiralWebDb\Module\Custom\Shortcode
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Module\Custom\Shortcode;

/**
 * Get the shortcode handler.
 *
 * @since 1.0.0
 *
 * @return Handler
 */
function get_handler() {
	return Handler::get_instance();
}

/**
 *  Register your shortcode with the Custom Module.
 *
 * @since 1.0.0
 *
 * @param string $pathto_configuration_file Absolute path to the configuration file's location.
 *
 * @return false|void
 * @throws \Exception
 */
function register_shortcode( $pathto_configuration_file ) {
	return get_handler()->register( $pathto_configuration_file );
}

/**
 * Checks if the shortcode has been processed yet or not.
 *
 * @since 1.0.0
 *
 * @param string $shortcode_name Name of the shortcode.
 *
 * @return int|false
 */
function did_shortcode( $shortcode_name ) {
	return get_handler()->did_shortcode( $shortcode_name );
}
