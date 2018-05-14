<?php
/**
 *  Reviews shortcode runtime configuration parameters.
 *
 * @package    spiralWebDb\Reviews\Shortcode
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Reviews\Shortcode;

use function spiralWebDb\Reviews\_get_plugin_directory;

return array(

	/************************************************************
	 * Configure a unique ID for this shortcode.
	 *
	 * This ID is used for storing and getting the configuration
	 * in/out of the Config Store.
	 ***********************************************************/
	'shortcode.reviews' => array(

		/**=================================================
		 *
		 * Shortcode name [reviews]
		 *
		 *==================================================*/
		'shortcode_name'              => 'reviews',

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
		'processing_function'         => __NAMESPACE__ . '\process_the_reviews_shortcode',

		/**=================================================
		 *
		 * Paths to the view files.
		 *
		 *==================================================*/
		// Review this for accuracy.
		'view'                        => array(
			'review' => _get_plugin_directory() . '/src/views/review.php',
		),

		/**=================================================
		 *
		 *  Defined shortcode default attributes. Each is
		 *  overridable by the author.
		 *
		 *==================================================*/
		'defaults'                    => array(
			'review_id'                => 0,
			'show_none_found_message'  => '1',
			'none_found_single_review' => 'Sorry, there is no Review available for that review ID.',
		),
	),
);