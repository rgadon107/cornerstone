<?php
/**
 *  The runtime configuration parameters for a taxonomy.
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

return array(

	/**==============================================================
	 *
	 * The Taxonomy name.
	 *
	 * ===============================================================*/
	'taxonomy'   => '',

	/**==============================================================
	 *
	 * The label configuration for the Taxonomy.
	 *
	 * ===============================================================*/
	'labels'     => array(
		'custom_type'       => '', // The taxonomy from above.
		'singular_label'    => '',
		'plural_label'      => '',
		'in_sentance_label' => '',
		'text_domain'       => '',
	),

	/**==============================================================
	 *
	 * The arguments for registering the Taxonomy.
	 *
	 * ===============================================================*/
	'args'       => array(
		'label'  => '',
		'labels' => '', // automatically generate the labels.
	),

	/**==============================================================
	 *
	 * The post types to which the Taxonomy is bound.
	 *
	 * ===============================================================*/
	'post_types' => array( '' ),

);