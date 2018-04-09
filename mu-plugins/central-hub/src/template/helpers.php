<?php
/**
 * Template Helpers
 *
 * @package     spiralWebDB\Module\Template
 * @since       1.0.0
 * @author      Robert A Gadon
 * @link        https://spiralwebdb.com
 * @licence     GNU-2.0+
 */

namespace spiralWebDB\Module\Template;

add_action( 'init', __NAMESPACE__ . '\register_path_to_custom_plugin_template_files');
/**
 * Register the absolute path to template files within a custom plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_path_to_custom_plugin_template_files() {
	/**
	 * Return and process the absolute path to template files within
	 * each custom plugin.
	 *
	 * @since 1.0.0
	 *
	 * @param array Array of configurations
	 */
	$configs = (array) apply_filters( 'add_custom_plugin_path_to_template_files', array() );

	ddd( $configs );
	// Loop the $configs and register the template files for each add-on plugin.
	foreach( $configs as $template => $template_type ) {
		// load each plugin template configuration into memory
	}
}


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

	if ( is_single() ) {
		global $post;
		if ( ! is_object( $post ) ) {
			return $template;
		}

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

	if ( is_post_type_archive( 'members' ) ) {
		return get_template( $template, 'archive-members' );
	}

	if ( is_post_type_archive( 'events' ) ) {
		return get_template( $template, 'archive-events' );
	}

	if ( is_post_type_archive( 'faq' ) ) {
		return get_template( $template, 'archive-faq' );
	}

	if ( is_post_type_archive( 'recordings' ) ) {
		return get_template( $template, 'archive-recordings' );
	}

	if ( is_post_type_archive( 'reviews' ) ) {
		return get_template( $template, 'archive-reviews' );
	}


	return $template;
}

/**
 * Get the template file from the theme or plugin.
 *
 * @since 1.0.0
 *
 * @param string $theme_archive_template      The them archive template.
 * @param string $plugin_archive_templatename The plugin archive template.
 *
 * @return string
 */
function get_template( $theme_archive_template, $plugin_archive_template ) {
	d( $theme_archive_template );
	d( $plugin_archive_template );
	$template_name = $plugin_archive_template .'.php';
	d( $template_name );
	// Let the theme override the plugin.
	$theme_file = locate_template( array( $template_name ) );

	if ( $theme_file && is_readable( $theme_file ) ) {
		return $theme_file;
	}

	// If the plugin has the template, return it.
	$template_file = __DIR__ . '/' . $template_name;
	d( $template_file );
	if ( is_readable( $template_file ) ) {
		return $template_file;
	}

	return $theme_archive_template;
}

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
 * Gets all of the posts grouped by terms for the specified
 * post type and taxonomy.
 *
 * Results are grouped by terms and ordered by the term and post IDs.
 *
 * @since 1.0.0
 *
 * @param string $post_type_name Post type to limit query to
 * @param string $taxonomy_name  Taxonomy to limit query to
 *
 * @return array|false
 */
function get_posts_grouped_by_term( $post_type_name, $taxonomy_name ) {
	$records = get_posts_grouped_by_term_from_db( $post_type_name, $taxonomy_name );

	$groupings = array();
	foreach ( $records as $record ) {
		$term_id = (int) $record->term_id;
		$post_id = (int) $record->post_id;

		if ( ! array_key_exists( $term_id, $groupings ) ) {
			$groupings[ $term_id ] = array(
				'term_id'   => $term_id,
				'term_name' => $record->term_name,
				'term_slug' => $record->term_slug,
				'posts'     => array(),
			);
		}
		$groupings[ $term_id ]['posts'][ $post_id ] = array(
			'post_id'            => $post_id,
			'post_title'         => $record->post_title,
			'post_content'       => $record->post_content,
//			'thumbnail_id'       => $record->thumbnail_id,
//			'thumbnail_url'      => $record->thumbnail_url,
//			'thumbnail_metadata' => maybe_unserialize( $record->thumbnail_metadata ),
			'menu_order'         => $record->menu_order,
		);

	}

	return $groupings;
}

/**
 * Gets all of the posts grouped by terms for the specified
 * post type and taxonomy.
 *
 * Results are grouped by terms and ordered by the term and post IDs.
 *
 * @since 1.0.0
 *
 * @param string $post_type_name Post type to limit query to
 * @param string $taxonomy_name  Taxonomy to limit query to
 *
 * @return array|false
 */
function get_posts_grouped_by_term_from_db( $post_type_name, $taxonomy_name ) {
	global $wpdb;

	$sql_query =
		"SELECT 
		    t.term_id, 
		    t.name AS term_name, 
		    t.slug AS term_slug, 
		    p.ID AS post_id, 
		    p.post_title, 
		    p.post_content, 
		    p.menu_order, 
		    pm.post_id,
//		    thumbnail.guid AS thumbnail_url, 
//		    thumbnail_meta.meta_value AS thumbnail_metadata
		FROM {$wpdb->term_taxonomy} AS tt
		INNER JOIN {$wpdb->terms} AS t ON (tt.term_id = t.term_id)
		INNER JOIN {$wpdb->term_relationships} AS tr ON (tt.term_taxonomy_id = tr.term_taxonomy_id)
		INNER JOIN {$wpdb->posts} AS p ON (tr.object_id = p.ID)
		INNER JOIN {$wpdb->postmeta} AS pm ON (p.ID = pm.post_id)
//		INNER JOIN {$wpdb->posts} AS thumbnail ON (pm.meta_value = thumbnail.ID)
//		INNER JOIN {$wpdb->postmeta} AS thumbnail_meta ON (thumbnail.ID = thumbnail_meta.post_id AND thumbnail_meta.meta_key = '_wp_attachment_metadata')
		WHERE p.post_status = 'publish' AND p.post_type = %s AND tt.taxonomy = %s
		GROUP BY t.term_id, p.ID
		ORDER BY t.term_id, p.menu_order ASC";

	$sql_query = $wpdb->prepare( $sql_query, $post_type_name, $taxonomy_name );
	$results   = $wpdb->get_results( $sql_query );

	if ( ! $results || ! is_array( $results ) ) {
		return array();
	}

	return $results;
}