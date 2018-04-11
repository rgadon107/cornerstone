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

		$post_type = get_post_type( $post->ID );
		if ( ! isset( $configured_templates['single'][ $post_type ] ) ) {
			return $template;
		}

		return get_template(
			$template,
			"single-{$post_type}.php",
			$configured_templates['single'][ $post_type ]
		);
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
 * Register the absolute path to template files within a custom plugin.
 *
 * @since 1.0.0
 *
 * @return array
 */
function get_configured_templates() {
	/**
	 * Register the plugin(s) template files with the Template Loader.
	 *
	 * @since 1.0.0
	 *
	 * @param array Array of configurations
	 */
	return (array) apply_filters( 'register_templates_with_template_loader', array() );
}
