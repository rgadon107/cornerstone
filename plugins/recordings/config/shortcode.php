<?php
/**
 *  Recordings shortcode runtime configuration parameters.
 *
 * @package    spiralWebDb\Recordings\Shortcode
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Recordings\Shortcode;

use function spiralWebDb\Recordings\_get_plugin_directory;

return array(

	/************************************************************
	 * Configure a unique ID for this shortcode.
	 *
	 * This ID is used for storing and getting the configuration
	 * in/out of the Config Store.
	 ***********************************************************/
	'shortcode.recording' => array(

		/**=================================================
		 *
		 * Shortcode name [recordings]
		 *
		 *==================================================*/
		'shortcode_name'              => 'recording',

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
		'processing_function'         => __NAMESPACE__ . '\process_the_recording_shortcode',

		/**=================================================
		 *
		 * Paths to the shortcode view file(s).
		 *
		 *==================================================*/
		'view'                        => array(
			'recording' => _get_plugin_directory() . '/src/views/recording.php',
		),

		/**=================================================
		 *
		 *  Defined shortcode default attributes. Each is
		 *  overridable by the author.
		 *
		 *==================================================*/
		'defaults'                    => array(
			'show_icon'                   => 'dashicons dashicons-arrow-down-alt2',
			'hide_icon'                   => 'dashicons dashicons-arrow-up-alt2',
			'post_id'                     => 0,
			'show_none_found_message'     => '1',
			'none_found_single_recording' => 'Sorry, there is no information available for this recording.',
		),
	)
);