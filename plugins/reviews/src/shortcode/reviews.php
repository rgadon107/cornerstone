<?php
/**
 * Shortcode processing for a single Review.
 *
 * @package    spiralWebDb\FAQ\Shortcode
 * @since      1.4.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Reviews\Shortcode;

// Not needed
//use function spiralWebDb\Reviews\Asset\maybe_enqueue_script;

/**
 *  Process the FAQ Shortcode to build a list of FAQs
 *
 * @since 1.4.0
 *
 * @param array $config     Array of runtime configuration parameters
 * @param array $attributes Attributes for this shortcode instance.
 *
 *
 * @return string
 */
function process_the_reviews_shortcode( array $config, array $attributes ) {

	$attributes['post_id'] = (int) $attributes['post_id'];
	// Delete '&& ! $attributes['topic']' since no 'topic' shortcode attribute.
	if ( $attributes['post_id'] < 1 && ! $attributes['topic'] ) {
		return '';
	}

// Won't be needed for this shortcode
//	maybe_enqueue_script( $config['shortcode_name'] );

//  Won't be needed for this shortcode.
//	$attributes['show_icon'] = esc_attr( $attributes['show_icon'] );

	// Call the view file, capture it into the output buffer, and then return it.
	ob_start();

	if ( $attributes['post_id'] > 0 ) {
		render_single_review( $attributes, $config );

		// Remove the conditional statement since there will be no 'topic_reviews'.
//	} else {
//		render_topic_faqs( $attributes, $config );
	}

	return ob_get_clean();
}

/**
 * Process a single Review by post_id
 *
 * @since 1.4.0
 *
 * @param array $attributes Default configuration attributes for the single Review shortcode
 * @param array $config     Runtime configuration attributes for the single Review view file.
 *
 * @return void
 */
function render_single_review( array $attributes, array $config ) {
	$review = get_post( $attributes['post_id'] );

	// Render the error message when the review does not exist.
	if ( ! $review ) {
		return render_none_found_message( $attributes );
	}

	$review_id  = (int) $review->ID;
	$post_title = $review->post_title;
	$content    = wpautop( $review->post_content );

	include $config['view']['review'];
}

// The following code can be removed as there will be no looping through Reviews.
///**
// *  Process the topic FAQs by topic attribute
// *
// * @since 1.3.0
// *
// * @param array $attributes Default configuration attributes for the topic FAQ shortcode
// * @param array $config     Runtime configuration attributes for the topic FAQ view file.
// *
// * @return void
// */
//function render_topic_review( array $attributes, array $config ) {
//
//	$config_args = array(
//		'number_of_reviews' => (int) $attributes['number_of_reviews'],
//		'nopaging'       => true,
//		'post_type'      => 'reviews',
//		'tax_query'      => array(
//			array(
//				'taxonomy' => 'review',
//				'field'    => 'slug',
//				'terms'    => $attributes['review'],
//			),
//		),
//		'order'          => 'ASC',
//		'orderby'        => 'menu_order',
//	);
//
//
//	$query = new \WP_Query( $config_args );
//
//	if ( ! $query->have_posts() ) {
//		return render_none_found_message( $attributes, false );
//	}
//
//	$use_term_container = true;
//	$is_calling_source  = 'shortcode-by-topic';
//	$term_slug          = $attributes['topic'];
//
//	include( $config['view']['container_topic'] );
//
//	wp_reset_postdata();
//
//}
//
///**
// *  Loop through the query and render out the FAQs by topic.
// *
// * @since 1.3.0
// *
// * @param \WP_Query $query
// * @param array     $attributes
// * @param array     $config
// *
// * @return void
// */
//function loop_and_render_faqs_by_topic( \WP_Query $query, array $attributes, array $config ) {
//
//	while ( $query->have_posts() ) {
//		$query->the_post();
//
//		$post_title = get_the_title();
//
//		$content = do_shortcode( get_the_content() );
//
//		include( $config['view']['faq'] );
//	}
//}

/**
 *  Render the 'none found message' handler.
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

	$message = $attributes['none_found_single_review'];

	echo "<em>{$message}</em>";

}