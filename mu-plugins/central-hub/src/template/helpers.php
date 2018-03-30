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

		if ( 'accommodation' === get_post_type( $post->ID ) ) {
			return get_template( $template, 'single-accommodation' );
		}

		return $template;
	}

	if ( is_post_type_archive( 'accommodation' ) ) {
		return get_template( $template, 'archive-accommodation' );
	}

	if ( is_tax( 'accommodation-type' ) ) {
		return get_template( $template, 'taxonomy-accommodation-type' );
	}

	return $template;
}

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
	$template_file = __DIR__ . '/' . $template_name;
	if ( is_readable( $template_file ) ) {
		return $template_file;
	}

	return $original;
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

	return $template_slug . '-accommodation.php';
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
			'thumbnail_id'       => $record->thumbnail_id,
			'thumbnail_url'      => $record->thumbnail_url,
			'thumbnail_metadata' => maybe_unserialize( $record->thumbnail_metadata ),
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
		    pm.meta_value AS thumbnail_id, 
		    thumbnail.guid AS thumbnail_url, 
		    thumbnail_meta.meta_value AS thumbnail_metadata
		FROM {$wpdb->term_taxonomy} AS tt
		INNER JOIN {$wpdb->terms} AS t ON (tt.term_id = t.term_id)
		INNER JOIN {$wpdb->term_relationships} AS tr ON (tt.term_taxonomy_id = tr.term_taxonomy_id)
		INNER JOIN {$wpdb->posts} AS p ON (tr.object_id = p.ID)
		INNER JOIN {$wpdb->postmeta} AS pm ON (p.ID = pm.post_id AND pm.meta_key = '_thumbnail_id')
		INNER JOIN {$wpdb->posts} AS thumbnail ON (pm.meta_value = thumbnail.ID)
		INNER JOIN {$wpdb->postmeta} AS thumbnail_meta ON (thumbnail.ID = thumbnail_meta.post_id AND thumbnail_meta.meta_key = '_wp_attachment_metadata')
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

/**
 * Render the accommodation's image.
 *
 * @since 1.0.0
 *
 * @param null|int $accommodation_id Optional. The given accommodation's ID. Default is null.
 *
 * @return void
 */
function render_accommodation_image( $accommodation_id = null ) {
	$img = genesis_get_image( array(
		'post_id' => $accommodation_id,
		'format'  => 'html',
		'size'    => genesis_get_option( 'image_size' ),
		'context' => 'archive',
		'attr'    => array(
			'class'    => 'alignnone post-image entry-image',
			'alt'      => get_the_title( $accommodation_id ),
			'itemprop' => 'image',
		),
	) );
	if ( empty( $img ) ) {
		return;
	}

	genesis_markup( array(
		'content' => wp_make_content_images_responsive( $img ),
	) );
}