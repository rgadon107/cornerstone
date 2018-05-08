<?php
/**
 * Template Loader
 *
 * @package     spiralWebDB\Module\Template
 * @since       1.0.0
 * @author      Robert A Gadon
 * @link        https://spiralwebdb.com
 * @licence     GNU-2.0+
 */

namespace spiralWebDB\Module\Template;

add_filter( 'template_include', __NAMESPACE__ . '\include_custom_plugin_templates' );
/**
 * Pass back the template file to the front-end loader
 *
 * @since 1.0.0
 *
 * @param string $template
 *
 * @return string
 */
function include_custom_plugin_templates( $template ) {

	if ( is_page() ) {
		return $template;
	}

	$plugin_templates = get_plugin_templates();

	if ( empty( $plugin_templates ) ) {
		return $template;
	}

	if ( is_single() ) {
		return locate_single_template( $template, $plugin_templates['single'] );
	}

	if ( is_post_type_archive() ) {
		$post_type = get_post_type_from_archive_query();
		if ( ! empty( $post_type ) ) {
			return locate_post_type_archive_template( $template, $post_type, $plugin_templates['post_type_archive'] );
		}

		return $template;
	}

	if ( is_tax() ) {
		$taxonomy = get_taxonomy_from_archive_query();
		if ( ! empty( $taxonomy ) ) {
			return locate_taxonomy_archive_template( $template, $taxonomy, $plugin_templates['taxonomy'] );
		}
	}

	return $template;
}

/**
 * Attempt to locate the single template either in the theme or one of the add-on plugins.
 *
 * @since 1.0.0
 *
 * @param string $original_template The original template provided by WordPress to the Template Loader.
 * @param array  $plugin_templates  Array of plugin single template locations.
 *
 * @return string
 */
function locate_single_template( $original_template, array $plugin_templates ) {

	// If there are no single plugin templates, then bail out.
	if ( empty( $plugin_templates ) ) {
		return $original_template;
	}

	global $post;
	if ( ! is_object( $post ) ) {
		return $original_template;
	}

	$post_type = get_post_type( $post->ID );
	if ( ! isset( $plugin_templates[ $post_type ] ) ) {
		return $original_template;
	}

	return get_template(
		$original_template,
		"single-{$post_type}.php",
		$plugin_templates[ $post_type ]
	);
}

/**
 * Attempt to locate the custom post type archive template either in the theme or one of the add-on plugins.
 *
 * @since 1.0.0
 *
 * @param string $original_template The original template provided by WordPress to the Template Loader.
 * @param string $post_type         The requested custom post type.
 * @param array  $plugin_templates  Array of plugin post type archive template locations.
 *
 * @return string
 */
function locate_post_type_archive_template( $original_template, $post_type, array $plugin_templates ) {

	if ( empty( $plugin_templates ) ) {
		return $original_template;
	}

	if ( ! isset( $plugin_templates[ $post_type ] ) ) {
		return $original_template;
	}

	return get_template(
		$original_template,
		"archive-{$post_type}.php",
		$plugin_templates[ $post_type ]
	);
}

/**
 * Attempt to locate the taxonomy archive template either in the theme or one of the add-on plugins.
 *
 * @since 1.0.0
 *
 * @param string $original_template The original template provided by WordPress to the Template Loader.
 * @param string $taxonomy          The requested taxonomy.
 * @param array  $plugin_templates  Array of plugin post type archive template locations.
 *
 * @return string
 */
function locate_taxonomy_archive_template( $original_template, $taxonomy, array $plugin_templates ) {

	if ( empty( $plugin_templates ) ) {
		return $original_template;
	}

	if ( ! isset( $plugin_templates[ $taxonomy ] ) ) {
		return $original_template;
	}

	return get_template(
		$original_template,
		"taxonomy-{$taxonomy}.php",
		$plugin_templates[ $taxonomy ]
	);
}

/**
 * Get the post type from the archive query.
 *
 * @since 1.0.0
 *
 * @return bool|string
 */
function get_post_type_from_archive_query() {

	global $wp_query;

	if ( ! is_array( $wp_query->query ) || ! isset( $wp_query->query['post_type'] ) ) {
		return false;
	}

	return $wp_query->query['post_type'];
}

/**
 * Get the taxonomy from the archive query.
 *
 * @since 1.0.0
 *
 * @return bool|string
 */
function get_taxonomy_from_archive_query() {
	global $wp_query;

	if ( ! is_array( $wp_query->query ) ) {
		return false;
	}

	return array_pop( array_keys( $wp_query->query ) );
}

/**
 * Get the template file from the theme or plugin.
 *
 * @since 1.0.0
 *
 * @param string $original        The original template.
 * @param string $template_file   Template file, i.e. it's relative name.
 * @param string $plugin_template Absolute path to the template in the plugin.
 *
 * @return string
 */
function get_template( $original, $template_file, $plugin_template ) {

	// Let the theme override the plugin.
	$theme_template = get_template_from_theme( $template_file );
	if ( ! empty( $theme_template ) ) {
		return $theme_template;
	}

	// If the plugin's template exists, load that one.
	if ( is_readable( $plugin_template ) ) {
		return $plugin_template;
	}

	return $original;
}

/**
 * Get the template from the theme, if it exists.
 *
 * @since 1.0.0
 *
 * @param string $template_name Name of the template to find.
 *
 * @return bool|string
 */
function get_template_from_theme( $template_name ) {
	$theme_file = locate_template( array( $template_name ) );

	if ( empty( $theme_file ) ) {
		return false;
	}

	if ( ! is_readable( $theme_file ) ) {
		return false;
	}

	return $theme_file;
}

/**
 * Get the plugin templates, i.e. the absolute paths to each template file
 * in the plugin.
 *
 * @since 1.0.0
 *
 * @return array|false
 */
function get_plugin_templates() {
	$schema = array(
		'single'            => array(),
		'post_type_archive' => array(),
		'taxonomy'          => array(),
	);

	/**
	 * Register the plugin(s) template files with the Template Loader.
	 *
	 * @since 1.0.0
	 *
	 * @param array Array of absolute paths to each plugin template file.
	 */
	$plugin_templates = (array) apply_filters( 'register_templates_with_template_loader', $schema );

	/**
	 * Merge what is returned with the default schema (i.e. array structure).
	 * Why? One of the plugin might have overwritten the structure. Doing this step protects the
	 * Template Loader from throwing a fatal error for a missing key in the check below.
	 */
	$plugin_templates = array_merge( $schema, $plugin_templates );

	// If there are no plugins registered, bail out.
	if ( empty( $plugin_templates['single'] ) &&
	     empty( $plugin_templates['post_type_archive'] ) &&
	     empty( $plugin_templates['taxonomy'] ) ) {
		return false;
	}

	return $plugin_templates;
}