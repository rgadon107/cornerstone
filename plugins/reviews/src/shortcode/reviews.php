<?php
/**
 * Shortcode processing for a single Review.
 *
 * @package    spiralWebDb\Reviews\Shortcode
 * @since      1.4.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Reviews\Shortcode;

use function spiralWebDb\FAQ\Asset\enqueue_script_ondemand;

/**
 *  Process the FAQ Shortcode to build a list of FAQs
 *
 * @since 1.4.0
 *
 * @param array $config     Array of runtime configuration parameters
 * @param array $attributes Attributes for this shortcode instance.
 *
 * @return string
 */
function process_the_reviews_shortcode( array $config, array $attributes ) {

	$attributes['post_id'] = (int) $attributes['review_id'];
	if ( $attributes['review_id'] < 1 ) {
		return '';
	}

	enqueue_script_ondemand();

	// Call the view file, capture it into the output buffer, and then return it.
	ob_start();
	render_single_review( $attributes, $config );
	return ob_get_clean();
}

/**
 * Process a single review.
 *
 * @since 1.4.0
 *
 * @param array $attributes Default configuration attributes for the single Review shortcode
 * @param array $config     Runtime configuration attributes for the single Review view file.
 *
 * @return void
 */
function render_single_review( array $attributes, array $config ) {
	$review = get_post( $attributes['review_id'] );

	// Render the error message when the review does not exist.
	if ( ! $review ) {
		return render_none_found_message( $attributes );
	}

	$review_id  = (int) $review->ID;
	$post_title = $review->post_title;
	$content    = wpautop( $review->post_content );

	include $config['view']['review'];
}

/**
 * Render the 'none found message' handler.
 *
 * @since 1.4.0
 *
 * @param array $attributes
 *
 * @return void
 *
 */
function render_none_found_message( array $attributes ) {

	if ( ! $attributes['show_none_found_message'] ) {
		return;
	}

	$message = esc_html( $attributes['none_found_single_review'] );

	echo "<em>{$message}</em>";

}