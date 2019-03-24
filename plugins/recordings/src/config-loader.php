<?php
/**
 * Handler for loading the plugin's configurations.
 *
 * @package     spiralWebDb\Recordings
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Recordings;

use spiralWebDb\Metadata as Metadata;

use function spiralWebDb\Module\Custom\Shortcode\register_shortcode;

add_filter( 'add_custom_post_type_runtime_config', __NAMESPACE__ . '\register_custom_configs', 8 );
/**
 *  Loading in the post type and taxonomy runtime configurations with
 *  the Custom module.
 *
 * @since 1.0.0
 *
 * @param array $configurations Array of all of the configurations.
 *
 * @return array
 */
function register_custom_configs( array $configurations ) {
	$config = (array) require _get_plugin_directory() . '/config/post-type.php';

	$configurations[ $config['post_type'] ] = $config;

	return $configurations;
}

/**
 * Load the meta-box configurations.
 *
 * @since 1.0.0
 *
 * @return void
 */
function load_configurations() {
	Metadata\autoload_configurations(
		array(
			_get_plugin_directory() . '/config/recordings.php',
		)
	);
}

add_filter( 'register_templates_with_template_loader', __NAMESPACE__ . '\register_the_template_files' );
/**
 * Register this plugin's template files with the Template Loader.
 *
 * @since 1.0.0
 *
 * @param array $templates Array of templates.
 *
 * @return array
 */
function register_the_template_files( array $templates ) {
	$config = require _get_plugin_directory() . '/config/templates.php';
	if ( empty( $config ) ) {
		return $templates;
	}

	return array_merge_recursive( $templates, $config );
}

register_shortcode( _get_plugin_directory() . '/config/shortcode.php' );
