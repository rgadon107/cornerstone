<?php
/**
 * Members shortcode runtime configuration parameters.
 *
 * @package    spiralWebDb\Members\Shortcode
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Members\Shortcode;

use function spiralWebDb\Members\_get_plugin_directory;

return array(

	/************************************************************
	 * Configure a unique ID for this shortcode.
	 *
	 * This ID is used for storing and getting the configuration
	 * in/out of the Config Store.
	 ***********************************************************/
	'shortcode.members' => array(

		/**=================================================
		 *
		 * Shortcode name [members]
		 *
		 *==================================================*/
		'shortcode_name'              => 'members',

		/**=================================================
		 *
		 * Specify if you want do_shortcode() to run on the
		 * content between the shortcode opening and closing
		 * square brackets. Defaults to 'true'.
		 *
		 *==================================================*/
		'do_shortcode_within_content' => false,

		/**=================================================
		 *
		 * Specify the processing function when you want
		 * your code to handle the output buffer, view, and
		 * processing.
		 *
		 *==================================================*/
		'processing_function'         => __NAMESPACE__ . '\process_members_shortcode',

		/**=================================================
		 *
		 * Paths to the view files.
		 *
		 *==================================================*/
		'view'                        => array(
			'residence' => _get_plugin_directory() . '/src/views/member-residence.php',
			'role'      => _get_plugin_directory() . '/src/views/member-role.php',
			'tours'     => _get_plugin_directory() . '/src/views/member-of-tours.php',
		),

		/**=================================================
		 *
		 *  Defined shortcode default attributes. Each is
		 *  overridable by the author.
		 *
		 *==================================================*/
		'defaults'                    => array(
			'member_id'               => 0,
			'number_of_members'       => 10,
			'show_none_found_message' => '1',
			'none_found'              => 'Sorry, no member profiles were found.',
			'none_found_single'       => 'Sorry, there is no profile available for that member.',
		),

		'query_args' => array(
			'post_type'     => 'members',
			'no_found_rows' => true,
		),
	),
);
