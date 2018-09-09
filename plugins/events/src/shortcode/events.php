<?php
/**
 * Events' shortcode processing.
 *
 * @package    spiralWebDb\Events\Shortcode
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Events\Shortcode;

/**
 * Process the [events] shortcode.
 *
 * @since 1.0.0
 *
 * @param array $config     Array of runtime configuration parameters
 * @param array $attributes Attributes for this shortcode instance.
 *
 * @return string $html Empty output buffer
 */
function process_events_shortcode( array $config, array $attributes ) {
	$doing_single = ! empty( $attributes['event_id'] );
	$query        = get_events_query( $config['query_args'], $attributes );

	// None found. Return the appropriate message.
	if ( ! $query->have_posts() ) {
		$message = $doing_single
			? $config['defaults']['none_found_single']
			: $config['defaults']['none_found'];

		return sprintf( '<p>%s</p>', esc_html( $message ) );
	}

	$events_count = 0;

	// Call the view file, capture it into the output buffer, and then return it.
	ob_start();

	while ( $query->have_posts() ) {
		$query->the_post();
		$event_id       = (int) get_the_ID();
		$article_classes = "post-{$event_id} type-event";

		require __DIR__ . '/views/events.php';

		$events_count++;
	}

	$html = ob_get_clean();

	// Reset.
	wp_reset_postdata();

	return $html;
}

/**
 * Get the event's query based on the given attributes and configuration.
 *
 * @since 1.0.0
 *
 * @param array $args Starting query args.
 * @param array $attributes Attributes for this shortcode instance.
 *
 * @return \WP_Query
 */
function get_events_query( array $args, array $attributes ) {
	if ( ! empty( $attributes['event_id'] ) ) {
		$args['p'] = (int) $attributes['event_id'];
	} else {
		$args['posts_per_page'] = (int) $attributes['number_of_events'];
	}

	return new \WP_Query( $args );
}

// DONE Add the events_shorcode_processing function
// DONE Function should call the view file from '/src/shortcode/views'
// TODO Build out the [events] shortcode view file.
/* Note: I had to temporarily reactivate the front-page.php template file in the
 * Developers child theme and call the function 'genesis_custom_loop()'. That
 * renders the archive-events template on the front page. Look at the markup of
 * the archive-event & single-event templates to decide how to build the shortcode
 * view file.
 */

// TODO In the shortcode config file, check & update the key-value pair for $attributes['view'] as needed.
// TODO Add a helpers file to the plugin rel path: '/src/template/helpers.php'.