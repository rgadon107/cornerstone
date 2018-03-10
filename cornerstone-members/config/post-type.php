<?php
/**
 *  The runtime configuration parameters for the Cornerstone Members Custom Post Type.
 *
 * @package    spiralWebDb\Members
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Members;

return array(

	/**==============================================================
	 *
	 * The name of the Custom Post Type.
	 *
	 * ===============================================================*/
	'post_type' => 'members',

	/**==============================================================
	 *
	 * Label configuration for the Custom Post Type.
	 *
	 * ===============================================================*/
	'labels'    => array(
		'custom_type'       => 'Members', // The post type from above.
		'singular_label'    => 'Member',
		'plural_label'      => 'Members',
		'in_sentance_label' => 'Members', // The label used within a sentence.
		'text_domain'       => 'cornerstone_members',
	),

	/**==============================================================
	 *
	 * Supported features for the Custom Post Type.
	 *
	 * ===============================================================*/
	'features'  => array(
		'base_post_type' => 'post',
		'exclude'        => array(
			'excerpt',
			'comments',
			'trackbacks',
			'custom-fields',
			'thumbnail',
			'author',
			'post-formats',
			'genesis-seo',
			'genesis-scripts',
			'genesis-layouts',
			'genesis-rel-author',
		),
		'additional'     => array(
			'page-attributes',
		),
	),

	/**==============================================================
	 *
	 * The arguments for registering the Custom Post Type.
	 *
	 * ===============================================================*/
	'args'      => array(
		'description' => 'Members of the Cornerstone Chorale & Brass', // For informational purposes only.
		'label'       => 'Members',
		'labels'      => '', // automatically generate the labels.
		'public'      => true,
		'menu_icon'   => 'dashicons-groups',
		'supports'    => '', // automatically generate the support features.
		'has_archive' => true,
	),
);