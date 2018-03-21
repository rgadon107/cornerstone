<?php
/**
 *  Runtime configuration for the FAQ custom post type.
 *
 * @package    spiralWebDb\Module\FAQ
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\FAQ;

return array(

	/**==============================================================
	 *
	 * The name of the Custom Post Type.
	 *
	 * ===============================================================*/
	'post_type' => 'faq',

	/**==============================================================
	 *
	 * Label configuration for the Custom Post Type.
	 *
	 * ===============================================================*/
	'labels'    => array(
		'custom_type'       => 'faq',
		'singular_label'    => 'FAQ',
		'plural_label'      => 'FAQs',
		'in_sentance_label' => 'faqs',
		'text_domain'       => '',
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
		'description' => 'Frequently Asked Question (FAQs)', // For informational purposes only.
		'label'       => 'FAQs',
		'labels'      => '', // automatically generate the labels.
		'public'      => true,
		'menu_icon'   => 'dashicons-editor-help',
		'supports'    => '', // automatically generate the support features.
		'has_archive' => true,
	),
);