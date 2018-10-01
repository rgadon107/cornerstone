<?php
/**
 *  Runtime configuration for the Portfolio custom post type.
 *
 * @package    spiralWebDb\Reviews
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Reviews;

return array(

	/**==============================================================
	 *
	 * The name of the Custom Post Type.
	 *
	 * ===============================================================*/
	'post_type' => 'reviews',

	/**==============================================================
	 *
	 * Label configuration for the Custom Post Type.
	 *
	 * ===============================================================*/
	'labels'    => array(
		'custom_type'       => 'review',
		'singular_label'    => 'Review',
		'plural_label'      => 'Reviews',
		'in_sentance_label' => 'Reviews',
		'text_domain'       => 'cornerstone_reviews',
		'specific_labels'   => array(),
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
		'description' => 'Reviews of the Cornerstone Chorale & Brass', // For informational purposes only.
		'label'       => 'Reviews',
		'labels'      => '', // automatically generate the labels.
		'public'      => true,
		'menu_icon'   => 'dashicons-testimonial',
		'supports'    => '', // automatically generate the support features.
		'has_archive' => true,
	),
);