<?php
/**
 *  Plugin handler.
 *
 * @package    spiralWebDb\Cornerstone
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Cornerstone;

use spiralWebDb\Module\Custom as CustomModule;
use KnowTheCode\ConfigStore as configStore;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
/**
 *  Enqueue the plugin assets (scripts and styles)
 *
 * @since 1.0.0
 *
 * @return void
 */
function enqueue_assets() {
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script(
		'central-hub-plugin-script',
		CENTRAL_HUB_URL . 'assets/dist/js/jquery.project.min.js', // Note: including '/jquery.project.min.js' to the string returns 404 error in my local Console.
		array( 'jquery' ),
		'1.0.0',
		true
	);

	$script_parameters = array(
		'showIcon' => 'dashicons dashicons-arrow-down-alt2',
		'hideIcon' => 'dashicons dashicons-arrow-up-alt2',
	);

}

add_action( 'plugins_loaded', __NAMESPACE__ . '\setup_plugin' );
/**
 *  Setup the QA and Teaser shortcode configuration file for the plugin shortcodes.
 *
 * @since 1.3.0
 *
 * @return void
 */
function setup_plugin() {

	foreach ( array( 'qa', 'teaser' ) as $shortcode ) {
		$config_file = sprintf( '%s/config/shortcode/%s.php', CORNERSTONE_DIR, $shortcode );
		CustomModule\register_shortcode( $config_file );
	}
}
