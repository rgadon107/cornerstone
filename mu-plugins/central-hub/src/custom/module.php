<?php
/**
 *  Custom Module Handler - bootstrap file for the module.
 *
 * @package    spiralWebDb\Module\Custom
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Module\Custom;

define( 'CUSTOM_MODULE_DIR', trailingslashit( __DIR__ ) );

/**
 *  Autoload plugin files.
 *
 * @since 1.0.0
 *
 * @return array $files Array of files to autoload.
 */
function autoload() {
	$files = array(
		'label-generator.php',
		'post-type.php',
		'taxonomy.php',
		'shortcode/class-handler.php',
		'shortcode/api.php',
	);

	foreach ( $files as $file ) {

		include( CUSTOM_MODULE_DIR . $file );
	}
}

autoload();

/*
 *  Register a plugin with the Custom Module
 *
 *  @since 1.0.0
 *
 *  @param string $plugin_file
 *
 *  @return void
 */
function register_plugin( $plugin_file ) {

	register_activation_hook( $plugin_file, __NAMESPACE__ . '\delete_rewrite_rules_on_plugin_status_change' );
	register_deactivation_hook( $plugin_file, __NAMESPACE__ . '\delete_rewrite_rules_on_plugin_status_change' );
	register_uninstall_hook( $plugin_file, __NAMESPACE__ . '\delete_rewrite_rules_on_plugin_status_change' );
}

/**
 * Delete the rewrite rules on plugin status change, i.e. activation, deactivation, or uninstall.
 *
 * @since 1.0.0
 *
 * @return void
 */
function delete_rewrite_rules_on_plugin_status_change() {
	delete_option( 'rewrite_rules' );
}