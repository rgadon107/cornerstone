<?php
/**
 * Events shortcode runtime configuration parameters.
 *
 * @package    spiralWebDb\Events\Shortcode
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Events\Shortcode;

use function spiralWebDb\Events\_get_plugin_directory;

return array(

	/************************************************************
	 * Configure a unique ID for this shortcode.
	 *
	 * This ID is used for storing and getting the configuration
	 * in/out of the Config Store.
	 ***********************************************************/
	'shortcode.events' => array(

		/**=================================================
		 *
		 * Shortcode name [events]
		 *
		 *==================================================*/
		'shortcode_name'              => 'events',

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
		'processing_function'         => __NAMESPACE__ . '\process_events_shortcode',

		/**=================================================
		 *
		 * Path(s) to the view file(s).
		 *
		 *==================================================*/
		'view'                        => array(
			'location'  => _get_plugin_directory() . '/src/views/event-community.php',
			'sponsor'   => _get_plugin_directory() . '/src/views/event-title.php',
			'date_time' => _get_plugin_directory() . '/src/views/performance-date-time.php',
		),

		/**=================================================
		 *
		 *  Defined shortcode default attributes. Each is
		 *  overridable by the author.
		 *
		 *==================================================*/
		'defaults'                    => array(
			'event_id'                => 0,
			'number_of_events'        => -1, // Events archive.
			'show_none_found_message' => '1',
			'none_found'              => 'Sorry, no performance events were found.',
			'none_found_single'       => 'Sorry, there is no information available for that event.',
		),
		/**=================================================
		 *
		 *  Arguments to pass to the custom $query object in
		 *  the shortcode processing function.
		 *
		 *==================================================*/
		'query_args'                  => array(
			'post_type'     => 'events',
			'no_found_rows' => true,
		),
	),
);
