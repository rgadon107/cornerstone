<?php
/**
 *  Custom module label generator handler.
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

/**
 *  Generate the labels for a Taxonomy or Post Type.
 *
 * @since 1.0.0
 *
 * @param string $config      Array of runtime configuration parameters.
 * @param string $custom_type Parameter set to either 'taxonomy' or 'post type'
 *
 * @return array
 */
function generate_the_custom_labels( array $config, $custom_type = 'post_type' ) {

	$config = array_merge(
		array(
			'custom_type'       => '',
			'singular_label'    => '',
			'plural_label'      => '',
			'in_sentance_label' => '',
			'text_domain'       => '',
			'specific_labels'   => array(),
		),
		$config
	);

	$labels = array(
		'name'              => _x(
			$config['plural_label'],
			$custom_type . ' general name',
			$config['text_domain']
		),
		'singular_name'     => _x(
			$config['singular_label'],
			$custom_type . ' singular name',
			$config['text_domain']
		),
		'menu_name'         => _x( $config['plural_label'], 'admin menu', $config['text_domain'] ),
		'add_new_item'      => __( 'Add New ' . $config['singular_label'], $config['text_domain'] ),
		'edit_item'         => __( 'Edit ' . $config['singular_label'], $config['text_domain'] ),
		'view_item'         => __( 'View ' . $config['singular_label'], $config['text_domain'] ),
		'all_items'         => __( 'All ' . $config['plural_label'], $config['text_domain'] ),
		'search_items'      => __( 'Search ' . $config['plural_label'], $config['text_domain'] ),
		'parent_item_colon' => __( 'Parent ' . $config['singular_label'] . ':', $config['text_domain'] ),
		'not_found'         => __( 'No ' . $config['in_sentance_label'] . ' found.', $config['text_domain'] )

	);

	$custom_type_generator = __NAMESPACE__;
	$custom_type_generator .= $custom_type == 'taxonomy'
		? '\generate_custom_labels_for_taxonomy'
		: '\generate_custom_labels_for_post_type';

	$labels = array_merge(
		$labels,
		$custom_type_generator( $config )
	);

	if ( $config['specific_labels'] ) {
		array_merge(
			$labels,
			$config['specific_labels']
		);

	}

	return $labels;
}

/**
 *  Generate the specific custom labels for the taxonomy.
 *
 * @since 1.0.0
 *
 * @param array $config Array of configuration paramaters.
 *
 * @return array
 */
function generate_custom_labels_for_taxonomy( $config ) {

	return array(
		'popular_items'              => __( 'Popular ' . $config['plural_label'], $config['text_domain'] ),
		'parent_item'                => __( 'Parent ' . $config['singular_label'], $config['text_domain'] ),
		'update_item'                => __( 'Update ' . $config['singular_label'], $config['text_domain'] ),
		'new_item_name'              => __(
			'New ' . $config['in_sentance_label'] . ' name',
			$config['text_domain']
		),
		'separate_items_with_commas' => __(
			'Separate ' . $config['in_sentance_label'] . ' with commas.',
			$config['text_domain']
		),
		'add_or_remove_items'        => __(
			'Add or remove ' . $config['in_sentance_label'] . '.',
			$config['text_domain']
		),
		'choose_from_most_used'      => __(
			'Choose from the most used ' . $config['in_sentance_label'] . '.',
			$config['text_domain']
		),
	);
}


/**
 *  Generate the specific custom labels for the post type.
 *
 * @since 1.0.0
 *
 * @param $config  Array of configuration paramaters.
 *
 * @return array
 */
function generate_custom_labels_for_post_type( $config ) {

	return array(
		'name_admin_bar'        => _x(
			$config['singular_label'],
			'add new on admin bar',
			$config['text_domain']
		),
		'add_new'               => _x( 'Add New', $config['custom_type'], $config['text_domain'] ),
		'new_item'              => __( 'New ' . $config['singular_label'], $config['text_domain'] ),
		'view_items'            => __( 'View ' . $config['plural_label'], $config['text_domain'] ),
		'not_found_in_trash'    => __(
			'No ' . $config['in_sentance_label'] . ' found in Trash.',
			$config['text_domain']
		),
		'archives'              => __( $config['singular_label'] . ' Archives', $config['text_domain'] ),
		'attributes'            => __( $config['singular_label'] . ' Attributes', $config['text_domain'] ),
		'insert_into_item'      => __(
			'Insert into ' . $config['in_sentance_label'] . '.',
			$config['text_domain']
		),
		'uploaded_to_this_item' => __(
			'Uploaded to this ' . $config['singular_label'] . '.',
			$config['text_domain']
		),

	);
}