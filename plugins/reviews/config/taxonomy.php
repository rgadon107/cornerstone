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
	'taxonomy'   => 'review_type',

	/**==============================================================
	 * The label configuration for the Taxonomy.
	 * ===============================================================*/
	'labels'     => array(
		'custom_type'       => 'review type',
		'singular_label'    => 'Review Type',
		'plural_label'      => 'Review Types',
		'in_sentance_label' => 'review type',
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
		'public'       => true,
	),

	/**==============================================================
	 *
	 * The post types to which the Taxonomy is bound.
	 *
	 * ===============================================================*/
	'post_types' => array( 'reviews' ),
);
