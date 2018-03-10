<?php
/**
 *  Runtime configuration for the Recordings custom post type.
 *
 * @package    spiralWebDb\Recordings
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */
namespace spiralWebDb\Recordings;

return array(

	/**==============================================================
	 *
	 * The name of the Custom Post Type.
	 *
	===============================================================*/
	'post_type' => 'recordings',

	/**==============================================================
	 *
	 * Label configuration for the Custom Post Type.
	 *
	===============================================================*/
	'labels'    => array(
		'custom_type'                   =>  'recordings',
		'singular_label'                =>  'Recording',
		'plural_label'                  =>  'Recordings',
		'in_sentance_label'             =>  'Recordings',
		'text_domain'                   => 'cornerstone_recordings',
		'specific_labels'               => array(),
	),

	/**==============================================================
	 *
	 * Supported features for the Custom Post Type.
	 *
	===============================================================*/
	'features'  => array(
		'base_post_type'    => 'post',
		'exclude'           => array(
			'excerpt',
			'comments',
			'trackbacks',
//			'custom-fields',
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
	===============================================================*/
	'args'      => array(
		'description'   => 'Cornerstone Chorale & Brass CD Recordings', // For informational purposes only.
		'label'         => 'Recordings',
		'labels'        => '', // automatically generate the labels.
		'public'        => true,
		'menu_icon'     => 'dashicons-album',
		'supports'      => '', // automatically generate the support features.
		'has_archive'   => true,
	),
);
