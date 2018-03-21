<?php
/**
 *  Custom taxonomy handler.
 *
 *  This code handler generates building the labels and arguments, and
 *  then registering the taxonomy with WordPress.
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

add_action( 'init', __NAMESPACE__ . '\register_the_custom_taxonomies' );

/**
 * Register each custom taxonomy.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_the_custom_taxonomies() {

	$configs = array();

	/**
	 *  Add the custom taxonomy runtime configurations for generating and
	 *  registering each with WordPress
	 *
	 * @since 1.0.0
	 *
	 * @param array Array of configurations.
	 */
	$configs = (array) apply_filters( 'add_custom_taxonomy_runtime_config', $configs );

	foreach ( $configs as $taxonomy => $config ) {

		// loop the configs and do the work
		register_the_custom_taxonomy( $taxonomy, $config );

	}
}

/*
 *  Register a single custom taxonomy.
 *
 *  @since 1.0.0
 *
 *  @param string $taxonomy  Taxonomy name to be registered with WordPress.
 *  @param array $config     An array of taxonomy runtime configuration parameters.
 *
 *  @return void
 */
function register_the_custom_taxonomy( $taxonomy, array $config ) {

	$args = $config['args'];

	if ( ! $args['labels'] ) {

		$args['labels'] = generate_the_custom_labels( $config['labels'], 'taxonomy' );

	}

	register_taxonomy( $taxonomy, $config['post_types'], $args );

}