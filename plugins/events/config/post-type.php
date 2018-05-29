<?php
/**
 *  Runtime configuration for the Events custom post type.
 *
 * @package    spiralWebDb\Events
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Events;

return array(

	/**==============================================================
	 *
	 * The name of the Custom Post Type.
	 *
	 * ===============================================================*/
	'post_type' => 'events',

	/**==============================================================
	 *
	 * Label configuration for the Custom Post Type.
	 *
	 * ===============================================================*/
	'labels'    => array(
		'custom_type'       => 'event',
		'singular_label'    => 'Event',
		'plural_label'      => 'Events',
		'in_sentance_label' => 'Events',
		'text_domain'       => 'cornerstone_events',
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
//			'custom-fields',
//			'thumbnail',
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
		'description' => 'Performance events of the Cornerstone Chorale & Brass', // For informational purposes only.
		'label'       => 'Events',
		'labels'      => '', // automatically generate the labels.
		'public'      => true,
		'menu_icon'   => 'dashicons-calendar',
		'supports'    => '', // automatically generate the support features.
		'has_archive' => true,
	),
);