<?php
/**
 *  Custom post type handler.
 *
 *  This code handler generates building the custom post type labels, support features,
 *  and arguments, and then registering the post type with WordPress.
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

add_action( 'init', __NAMESPACE__ . '\register_the_custom_post_types' );
/**
 * Register each custom post type.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_the_custom_post_types() {

	/**
	 *  Add custom post type runtime configurations for generating and
	 *  registering each post type with WordPress
	 *
	 * @since 1.0.0
	 *
	 * @param array Array of configurations.
	 */
	$configs = (array) apply_filters( 'add_custom_post_type_runtime_config', array() );

	foreach ( $configs as $post_type => $config ) {

		// loop the configs and do the work
		register_the_custom_post_type( $post_type, $config );

	}
}

/*
 *  Register a single custom post type.
 *
 *  @since 1.0.0
 *
 *  @param string $post_type Post type name to be registered with WordPress.
 *  @param array $config     An array of post type runtime configuration parameters.
 *
 *  @return void
 */
function register_the_custom_post_type( $post_type, array $config ) {

	$args = $config['args'];

	if ( ! $args['supports'] ) {

		$args['supports'] = generate_supported_post_type_features( $config['features'] );

	}

	if ( ! $args['labels'] ) {

		$args['labels'] = generate_the_custom_labels( $config['labels'] ); // Default 2nd parameter $custom_type = 'post type'

	}

	register_post_type( $post_type, $args );

}

/**
 * Get all the post type features for the given post type.
 *
 * @since 1.0.0
 *
 * @param array $config Runtime configuration parameters.
 *
 * @return array
 */
function generate_supported_post_type_features( $config = array() ) {

	$base_post_type_features = get_all_post_type_supports( $config['base_post_type'] );

	$supported_features = exclude_post_type_features( $base_post_type_features, $config['exclude'] );

	$supported_features = merge_post_type_features( $supported_features, $config['additional'] );

	return $supported_features;
}

/*
 *  Excluding features from the given supported post type features.
 *
 *  @since 1.0.0
 *
 * `@param array            $supported_features  Array of supported post type features.
 *  @param array|string     $exclude_features (optional) Array of features to exclude.
 *
 *  @return array
 */
function exclude_post_type_features( array $supported_features, $exclude_features ) {
	if ( ! $exclude_features ) {
		return array_keys( $supported_features );
	}

	$features = array();

	foreach ( $supported_features as $feature => $value ) {
		if ( in_array( $feature, $exclude_features ) ) {
			continue;
		}

		$features[] = $feature;
	}

	return $features;
}

/*
 *  Merge the post type's supported features.
 *
 *  @since 1.0.0
 *
 *  @param array   $supported_features An Array of supported post type features.
 *  @param array   $additional_features (optional) The additional features to merge with our supported features.
 *
 *  @return array
 */
function merge_post_type_features( array $supported_features, $additional_features ) {
	if ( ! $additional_features ) {
		return $supported_features;
	}

	return array_merge( $supported_features, $additional_features );

}