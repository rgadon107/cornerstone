<?php
/**
 *  Runtime configuration for the Tours custom post type.
 *
 * @package    spiralWebDb\Events
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDB\CornerstoneTours;

return [

	/**==============================================================
	 *
	 * The name of the Custom Post Type.
	 *
	 * ===============================================================*/
	'post_type' => 'tours',

	/**==============================================================
	 *
	 * Label configuration for the Custom Post Type.
	 *
	 * ===============================================================*/
	'labels'    => array(
		'custom_type'       => 'Tours', // The post type from above.
		'singular_label'    => 'Tour',
		'plural_label'      => 'Tours',
		'in_sentance_label' => 'Tour', // The label used within a sentance.
		'text_domain'       => 'cornerstone-tours',
	),

	/**==============================================================
	 *
	 * Supported features for the Custom Post Type.
	 *
	 * ===============================================================*/
	'features'  => array(
		'base_post_type' => 'post',
		'exclude'        => [
			'excerpt',
			'comments',
			'trackbacks',
//			'custom-fields',
			'thumbnail', // also known as the 'featured image'.
			'author',
			'post-formats',
			'genesis-seo',
			'genesis-scripts',
			'genesis-layouts',
			'genesis-rel-author',
		],
		'additional'     => [
			'page-attributes',
		],
	),

	/**==============================================================
	 *
	 * The arguments for registering the Custom Post Type.
	 *
	 * ===============================================================*/
	'args'      => array(
		'description'  => '', // For informational purposes only.
		'label'        => '',
		'labels'       => '', // automatically generate the labels.
		'public'       => true,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-admin-site',
		'supports'     => '', // automatically generate the support features.
		'has_archive'  => false,
	),
];

