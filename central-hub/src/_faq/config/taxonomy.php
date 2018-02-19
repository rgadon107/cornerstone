<?php
/**
 *  Runtime configuration for the Topic taxonomy.
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
namespace spiralWebDb\Module\FAQ;

return array(

	/**==============================================================
	 *
	 * The Taxonomy name.
	 *
	===============================================================*/
	'taxonomy' => 'topic',

	/**==============================================================
	 *
	 * The label configuration for the Taxonomy.
	 *
	===============================================================*/
	'labels'    => array(
		'custom_type'                   => 'topic',
		'singular_label'                => 'Topic',
		'plural_label'                  => 'Topics',
		'in_sentance_label'             => 'topics',
		'text_domain'                   => FAQ_MODULE_TEXT_DOMAIN,
		'specific_labels'               => array(),
	),

	/**==============================================================
	 *
	 * The arguments for registering the Taxonomy.
	 *
	===============================================================*/
	'args'     => array(
		'label'             => __( 'Topics', FAQ_MODULE_TEXT_DOMAIN ),
		'labels'            => '', // automatically generate the labels.
		'hierarchical'      => true,
		'show_admin_column' => true,
		'public'            => false,
		'show_ui'           => true,
	),

	/**==============================================================
	 *
	 * The post types to which the Taxonomy is bound.
	 *
	 ===============================================================*/
	'post_types'    => array( 'faq' ),

);