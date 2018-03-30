<?php
/**
 * Reviews plugin Archive Template
 *
 * @package     spiralWebDb\reviews
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        https://spiralwebdb.com
 * @licence     GNU-2.0+
 */

namespace spiralWebDb\reviews;

use spiralWebDB\Module\Template as Template;

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', __NAMESPACE__ . '\do_reviews_archive_loop' );
/**
 * Do the Reviews Archive loop and render out the HTML.
 *
 * NOTE: The variables are set to call the right HTML
 * markup in the container.php view file.
 *
 * @since 1.0.0
 *
 * @return void
 */
function do_reviews_archive_loop() {
	$records = Template\get_posts_grouped_by_term( 'reviews' );

	if ( ! $records ) {
		echo '<p>Sorry, there are no Reviews to display.</p>';

		return;
	}

	$use_term_container = true;
	$show_term_name     = true;
	$is_calling_source  = 'template';

	foreach ( $records as $record ) {
		$term_slug = $record['term_slug'];

		include REVIEWS_DIR . '/src/views/container.php';
	}
}

/**
 * Loop through and render out each Review.
 *
 * @since 1.0.0
 *
 * @param array $reviews
 *
 * @return void
 */
function loop_and_render_reviews( array $reviews ) {
	foreach ( $reviews as $review ) {
		$review_id   = $review['post_id'];
		$review_name = $review['post_title'];
		$description = $review['post_content'];

		include REVIEWS_DIR . 'src/views/review.php';
	}
}

genesis();