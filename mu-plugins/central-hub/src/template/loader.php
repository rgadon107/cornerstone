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
	$configured_templates = get_configured_templates();

	if ( empty( $configured_templates ) ) {
		return $template;
	}

	if ( is_page() ) {
		return $template;
	}

	if ( is_single() ) {
		global $post;
		if ( ! is_object( $post ) ) {
			return $template;
		}

// Question: Since the structure of the conditional check is the same, can this
// be refactored to accept an array of inputs?
		if ( 'members' === get_post_type( $post->ID ) ) {
			return get_template( $template, 'single-members' );
		}

		if ( 'events' === get_post_type( $post->ID ) ) {
			return get_template( $template, 'single-events' );
		}

		if ( 'recordings' === get_post_type( $post->ID ) ) {
			return get_template( $template, 'single-recordings' );
		}

		if ( 'reviews' === get_post_type( $post->ID ) ) {
			return get_template( $template, 'single-reviews' );
		}

		return $template;
	}

// Question: Since the structure of the conditional check is the same, can this
// be refactored to accept an array of inputs?
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

// Does the $original parameter refer to the template returned by WordPress?
// The name of the parameter is vague.

/**
 * Get the template file from the theme or plugin.
 *
 * @since 1.0.0
 *
 * @param string $original      The original template.
 * @param string $template_name The name of the template.
 *
 * @return string
 */
function get_template( $original, $template_name ) {

	$template_name .= '.php';

	// Let the theme override the plugin.
	$theme_file = locate_template( array( $template_name ) );

	if ( $theme_file && is_readable( $theme_file ) ) {
		return $theme_file;
	}

	// If the plugin has the template, return it.
	$template_file = __DIR__ . '/config/' . $template_name;

	if ( is_readable( $template_file ) ) {
		return $template_file;
	}

	return $original;
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
 * Register the absolute path to template files within a custom plugin.
 *
 * @since 1.0.0
 *
 * @return array
 */
function get_configured_templates() {
	/**
	 * Load and store the add-on plugin template files from
	 * each custom plugin for processing by the template handler.
	 *
	 * @since 1.0.0
	 *
	 * @param array Array of configurations
	 */
	return (array) apply_filters( 'add_custom_plugin_path_to_template_files', array() );
}
