<?php
/**
 *  The runtime configuration parameters for the Role taxonomy.
 *
 * @package    spiralWebDb\Members
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */
namespace spiralWebDb\Members;

return array(

	/**==============================================================
	 *
	 * The Taxonomy name.
	 *
	===============================================================*/
	'taxonomy' => 'role',

	/**==============================================================
	 *
	 * The label configuration for the Taxonomy.
	 *
	===============================================================*/
	'labels'    => array(
		'custom_type'                   => 'role', // The taxonomy from above.
		'singular_label'                => 'Role',
		'plural_label'                  => 'Roles',
		'in_sentance_label'             => 'Roles',
		'text_domain'                   => CORNERSTONE_MEMBERS_PLUGIN_TEXT_DOMAIN,
	),

	/**==============================================================
	 *
	 * The arguments for registering the Taxonomy.
	 *
	===============================================================*/
	'args'     => array(
		'label'             => 'Role',
		'labels'            => '', // automatically generate the labels.
	),

	/**==============================================================
	 *
	 * The post types to which the Taxonomy is bound.
	 *
	 ===============================================================*/
	'post_types'    => array( 'members' ),

);