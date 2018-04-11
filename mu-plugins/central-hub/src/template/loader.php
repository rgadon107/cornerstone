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

// Load the template file configuration from each add-on plugin into memory
// Provide a function to get each configuration from memory
// Use conditional checks to check which template type is called for.
// Get the correct 'template-slug' to build the template file. Determine whether template
//      is provided by the theme or plugin. Give the theme precedence over the plugin.
// Build the absolute path to whichever template file is called.

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
		return locate_single_template( $template, $plugin_templates );
	}

	if ( is_post_type_archive( 'members' ) ) {
		return get_template( $template, 'archive-members' );
	}

	if ( is_post_type_archive( 'events' ) ) {
		return get_template( $template, 'archive-events' );
	}

	if ( is_post_type_archive( 'recordings' ) ) {
		return get_template( $template, 'archive-recordings' );
	}

	if ( is_post_type_archive( 'reviews' ) ) {
		return get_template( $template, 'archive-reviews' );
	}

	if ( is_tax( 'review-type' ) ) {
		return get_template( $template, 'taxonomy-review-type' );
	}

	if ( is_tax( 'review-type' ) ) {
		return get_template( $template, 'taxonomy-member-role' );
	}

	if ( is_tax( 'event-type' ) ) {
		return get_template( $template, 'taxonomy-event-type' );
	}

	return $template;
}

/**
 * Attempt to locate the single template either in the theme or one of the add-on plugins.
 *
 * @since 1.0.0
 *
 * @param string $original_template The original template provided by WordPress to the Template Loader.
 * @param array  $plugin_templates  Array of plugin templates.
 *
 * @return string
 */
function locate_single_template( $original_template, array $plugin_templates ) {
	// If there are no single templates in any of the plugins, then bail out.
	if ( empty( $plugin_templates['single'] ) ) {
		return $original_template;
	}

	global $post;
	if ( ! is_object( $post ) ) {
		return $original_template;
	}

	$post_type = get_post_type( $post->ID );
	if ( ! isset( $plugin_templates['single'][ $post_type ] ) ) {
		return $original_template;
	}

	return get_template(
		$original_template,
		"single-{$post_type}.php",
		$plugin_templates['single'][ $post_type ]
	);
}

// Question: Does the $original parameter refer to the template returned by WordPress?
// Answer: Yes.

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

// Does the output of all the conditional checks from
// 'include_custom_plugin_templates' get passed to $template_slug?
/**
 * Build the templates full path and filename
 *
 * @since 1.0.0
 *
 * @param string $template_slug
 *
 * @return string
 */
function build_template_file_path_and_name( $template_slug ) {
	return $template_slug . '-reviews.php';
}

/**
 * Extract template's slug from the fullpath
 *
 * @since 1.0.0
 *
 * @param string $template_fullpath
 *
 * @return string
 */
function extract_template_slug_from_fullpath( $template_fullpath ) {
	$parts    = explode( '/', $template_fullpath );
	$template = array_pop( $parts );

	return rtrim( $template, '.php' );
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
