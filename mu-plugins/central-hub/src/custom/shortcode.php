<?php
/**
 *  Custom shortcode handler.
 *
 * @package    spiralWebDb\Module\Custom
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Module\Custom;

use function KnowTheCode\ConfigStore\getConfig;
use function KnowTheCode\ConfigStore\loadConfigFromFilesystem;

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
	$store_key = loadConfigFromFilesystem( $pathto_configuration_file, array(
		'shortcode_name'              => '',
		'do_shortcode_within_content' => true,
		'processing_function'         => null,
		'view'                        => '',
		'defaults'                    => array(),

	) );

	$config = getConfig( $store_key );

	if ( empty( $config ) || empty( $config['shortcode_name'] ) || empty( $config['view'] ) ) {
		return false;
	}

	add_shortcode( $config['shortcode_name'], __NAMESPACE__ . '\process_the_shortcode_callback' );
}

/**
 *  Process and render the HTML for the shortcode.
 *
 * @since 1.0.0
 *
 * @param array|string $user_defined_attributes User defined attributes for this shortcode instance.
 * @param string|null  $content                 Content between the opening and closing shortcode elements.
 * @param string       $shortcode_name          Name of the shortcode.
 *
 * @return string
 * @throws \Exception
 */
function process_the_shortcode_callback( $user_defined_attributes, $content, $shortcode_name ) {
	$config = get_shortcode_config( $shortcode_name );
	if ( false === $config ) {
		return '';
	}

	$attributes = shortcode_atts(
		$config['defaults'],
		$user_defined_attributes,
		$shortcode_name
	);

	if ( $content && $config['do_shortcode_within_content'] ) {
		$content = do_shortcode( $content );
	}

	return render_and_return( $shortcode_name, $config, $attributes, $content );
}

/**
 * Get the shortcode's configuration from ConfigStore.
 *
 * @since 1.0.0
 *
 * @param string $shortcode_name Name of the shortcode.
 *
 * @return bool|array
 * @throws \Exception
 */
function get_shortcode_config( $shortcode_name ) {
	$config = getConfig( "shortcode.{$shortcode_name}" );

	if ( empty( $config ) ) {
		return false;
	}

	return $config;
}

/**
 * Render and return the shortcode's HTML.
 *
 * @since 1.0.0
 *
 * @param string       $shortcode_name Name of the shortcode.
 * @param array        $config         Array of configuration parameters.
 * @param array        $attributes     Array of instance attributes.
 * @param  string|null $content        Content between the opening and closing shortcode elements.
 *
 * @return mixed|string
 */
function render_and_return( $shortcode_name, array $config, array $attributes, $content ) {
	if ( $config['processing_function'] ) {
		return call_processing_function( $shortcode_name, $config, $attributes, $attributes, $content );
	}

	ob_start();
	include $config['view'];
	return ob_get_clean();
}

/**
 * Call the processing function.
 *
 * @since 1.0.0
 *
 * @param string       $shortcode_name Name of the shortcode.
 * @param array        $config         Array of configuration parameters.
 * @param array        $attributes     Array of instance attributes.
 * @param  string|null $content        Content between the opening and closing shortcode elements.
 *
 * @return string
 */
function call_processing_function( $shortcode_name, array $config, array $attributes, $content ) {
	$function_name = $config['processing_function'];

	return $function_name( $config, $attributes, $content, $shortcode_name );
}