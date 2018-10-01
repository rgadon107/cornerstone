<?php
/**
 *  The runtime configuration parameters for a custom post type.
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
	 * The name of the Custom Post Type.
	 *
	 * ===============================================================*/
	'post_type' => '',

	/**==============================================================
	 *
	 * Label configuration for the Custom Post Type.
	 *
	 * ===============================================================*/
	'labels'    => array(
		'custom_type'       => '', // The post type from above.
		'singular_label'    => '',
		'plural_label'      => '',
		'in_sentance_label' => '', // The label used within a sentance.
		'text_domain'       => '',
	),

	/**==============================================================
	 *
	 * Supported features for the Custom Post Type.
	 *
	 * ===============================================================*/
	'features'  => array(
		'base_post_type' => 'post',
		'exclude'        => array(),
		'additional'     => array(),
	),

	/**==============================================================
	 *
	 * The arguments for registering the Custom Post Type.
	 *
	 * ===============================================================*/
	'args'      => array(
		'description' => '', // For informational purposes only.
		'label'       => '',
		'labels'      => '', // automatically generate the labels.
		'public'      => true,
		'menu_icon'   => '',
		'supports'    => '', // automatically generate the support features.
		'has_archive' => false,
	),
);