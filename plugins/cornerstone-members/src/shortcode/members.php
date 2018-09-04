<?php
/**
 * Members shortcode processing.
 *
 * @package    spiralWebDb\Members\Shortcode
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Members\Shortcode;

use function spiralWebDb\Members\Template\get_members_post_classes;

/**
 * Process the Members [members] shortcode.
 *
 * @since 1.0.0
 *
 * @param array $config     Array of runtime configuration parameters
 * @param array $attributes Attributes for this shortcode instance.
 *
 *
 * @return string
 */
function process_members_shortcode( array $config, array $attributes ) {
	$doing_single = ! empty( $attributes['member_id'] );
	$query        = get_members_query( $config['query_args'], $attributes );

	// None found. Return the appropriate message.
	if ( ! $query->have_posts() ) {
		$message = $doing_single
			? $config['defaults']['none_found_single']
			: $config['defaults']['none_found'];

		return sprintf( '<p>%s</p>', esc_html( $message ) );
	}

	$members_count = 0;

	// Call the view file, capture it into the output buffer, and then return it.
	ob_start();

	while ( $query->have_posts() ) {
		$query->the_post();
		$member_id       = (int) get_the_ID();
		$article_classes = $doing_single
			? "post-{$member_id} type-member"
			: get_members_post_classes( $members_count, $member_id, array( 'grid-list' ) );

		require __DIR__ . '/views/members.php';

		$members_count++;
	}

	$html = ob_get_clean();

	// Reset.
	wp_reset_postdata();

	return $html;
}

/**
 * Get the member's query based on the given attributes and configuration.
 *
 * @since 1.0.0
 *
 * @param array $args Starting query args.
 * @param array $attributes Attributes for this shortcode instance.
 *
 * @return \WP_Query
 */
function get_members_query( array $args, array $attributes ) {
	if ( ! empty( $attributes['member_id'] ) ) {
		$args['p'] = (int) $attributes['member_id'];
	} else {
		$args['posts_per_page'] = (int) $attributes['number_of_members'];
	}

	return new \WP_Query( $args );
}
