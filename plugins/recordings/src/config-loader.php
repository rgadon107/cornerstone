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

add_filter( 'add_custom_post_type_runtime_config', __NAMESPACE__ . '\register_reviews_custom_configs', 8 );
add_filter( 'add_custom_taxonomy_runtime_config', __NAMESPACE__ . '\register_reviews_custom_configs', 8 );
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
function register_reviews_custom_configs( array $configurations ) {
	$doing_post_type = current_filter() == 'add_custom_post_type_runtime_config';

	$filename = $doing_post_type
		? 'post-type'
		: 'taxonomy';

	$runtime_config = (array) require RECORDINGS_DIR . '/config/' . $filename . '.php';

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
 * Load the meta-box configurations.
 *
 * @since 1.0.0
 *
 * @return void
 */
function load_configurations() {
	Metadata\autoload_configurations(
		array(
			RECORDINGS_DIR . '/config/recordings.php',
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
	$config = require RECORDINGS_DIR . '/config/templates.php';
	if ( empty( $config ) ) {
		return $templates;
	}

	return array_merge_recursive( $templates, $config );
}