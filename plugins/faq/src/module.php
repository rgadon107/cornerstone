<?php
/**
 *  FAQ Module Handler
 *
 * @package    spiralWebDb\Module\FAQ
 *
 * @since      1.3.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\FAQ\Shortcode;

use spiralWebDb\Module\Custom as CustomModule;

add_filter( 'add_custom_post_type_runtime_config', __NAMESPACE__ . '\register_faq_custom_configs' );
add_filter( 'add_custom_taxonomy_runtime_config', __NAMESPACE__ . '\register_faq_custom_configs' );
/**
 *  Loading in the post type and taxonomy runtime configurations with
 *  the Custom module.
 *
 * @since 1.3.0
 *
 * @param array $configurations Array of all of the configurations.
 *
 * @return void
 */
function register_faq_custom_configs( array $configurations ) {

	$doing_post_type = current_filter() == 'add_custom_post_type_runtime_config';

	$filename = $doing_post_type
		? 'post-type'
		: 'taxonomy';

	$runtime_config = (array) require( FAQ_DIR . 'config/' . $filename . '.php' );

	if ( ! $runtime_config ) {
		return $configurations;
	}

	$key = $doing_post_type
		? $runtime_config['post_type']
		: $runtime_config['taxonomy'];

	$configurations[ $key ] = $runtime_config;

	return $configurations;

}

/**
 *  Autoload plugin files.
 *
 * @since 1.3.0
 *
 * @return array $files Array of files to autoload.
 */
function autoload() {
	$files = array(

		'shortcode/shortcode.php',
		'template/helpers.php',
	);

	foreach ( $files as $file ) {

		include( FAQ_DIR . 'src/' . $file );
	}
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\setup_module' );
/**
 *  Setup the FAQ shortcode configuration file in the module.
 *
 * @since 1.3.0
 *
 * @return void
 */
function setup_module() {
	CustomModule\register_shortcode( FAQ_DIR . 'config/shortcode.php' );

}

autoload();