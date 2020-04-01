<?php
/**
 *  Handler for loading the plugin's configurations.
 *
 * @package    spiralWebDb\CornerstoneTours
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours;

use spiralWebDb\Metadata;
use function spiralWebDb\Module\Custom\Shortcode\register_shortcode;

add_filter( 'add_custom_post_type_runtime_config', __NAMESPACE__ . '\register_custom_configs', 7 );
/**
 * Loading in the post type runtime configurations with the Custom module.
 *
 * @since 1.0.0
 *
 * @param array $configurations Array of all of the configurations.
 *
 * @return array Returns configurations with post type configuration.
 */
function register_custom_configs( array $configurations ) {
	$runtime_config = (array) require _get_plugin_directory() . '/config/post-type.php';

	$configurations[ $runtime_config['post_type'] ] = $runtime_config;

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
			_get_plugin_directory() . '/config/tours.php',
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

