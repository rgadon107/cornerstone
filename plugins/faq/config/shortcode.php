<?php
/**
 *  FAQ shortcode's runtime configuration parameters
 *
 * @package    spiralWebDb\FAQ\Shortcode
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\FAQ\Shortcode;

return array(

	/************************************************************
	 * Configure a unique ID for this shortcode.
	 *
	 * This ID is used for storing and getting the configuration
	 * in/out of the Config Store.
	 ***********************************************************/
	'shortcode.faq' => array(

		/**=================================================
		 *
		 * Shortcode name [faq]
		 *
		 *==================================================*/
		'shortcode_name'              => 'faq',

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
		'processing_function'         => __NAMESPACE__ . '\process_the_faq_shortcode',

		/**=================================================
		 *
		 * Paths to the view files.
		 *
		 *==================================================*/
		'view'                        => array(
			'container_single' => FAQ_DIR . '/src/views/container.php',
			'container_topic'  => FAQ_DIR . '/src/views/container.php',
			'faq'              => FAQ_DIR . '/src/views/faq.php',
		),

		/**=================================================
		 *
		 *  Defined shortcode default attributes. Each is
		 *  overridable by the author.
		 *
		 *==================================================*/
		'defaults'                    => array(
			'show_icon'               => 'dashicons dashicons-arrow-down-alt2',
			'hide_icon'               => 'dashicons dashicons-arrow-up-alt2',
			'post_id'                 => 0,
			'topic'                   => '',
			'number_of_faqs'          => - 1,
			'show_none_found_message' => '1',
			'none_found_by_topic'     => 'Sorry, no FAQs were found for that topic.',
			'none_found_single_faq'   => 'Sorry, there is no FAQ available for that post_id.',
		),
	),
);
