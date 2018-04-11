<?php
/**
 *  Runtime configuration for a custom taxonomy.
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
	 * The Taxonomy name.
	 * ===============================================================*/
	'taxonomy'   => 'review',

	/**==============================================================
	 * The label configuration for the Taxonomy.
	 * ===============================================================*/
	'labels'     => array(
		'custom_type'       => 'review',
		'singular_label'    => 'Review',
		'plural_label'      => 'Reviews',
		'in_sentance_label' => 'reviews',
		'text_domain'       => '',
		'specific_labels'   => array(),
	),

	/**==============================================================
	 *
	 * The arguments for registering the Taxonomy.
	 *
	 * ===============================================================*/
	'args'       => array(
		'label'        => '',
		'labels'       => '', // automatically generate the labels.
		'hierarchical' => true,
	),

	/**==============================================================
	 *
	 * The post types to which the Taxonomy is bound.
	 *
	 * ===============================================================*/
	'post_types' => array( 'reviews' ),
);
