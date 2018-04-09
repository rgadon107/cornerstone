<?php
/**
 * Cornerstone Members plugin Archive Template
 *
 * @package     spiralWebDb\Members
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        https://spiralwebdb.com
 * @licence     GNU-2.0+
 */

namespace spiralWebDb\Members;

use spiralWebDB\Module\Template as Template;

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', __NAMESPACE__ . '\do_reviews_archive_loop' );
/**
 * Do the Cornerstone Members Archive loop and render out the HTML.
 *
 * NOTE: The variables are set to call the right HTML
 * markup in the container.php view file.
 *
 * @since 1.0.0
 *
 * @return void
 */
function do_members_archive_loop() {

	$records = Template\get_posts_grouped_by_term( 'members' );

	if ( ! $records ) {
		echo '<p>Sorry, there are no Cornerstone member records to display.</p>';

		return;
	}

	$use_term_container = true;
	$show_term_name     = true;
	$is_calling_source  = 'template';

	foreach ( $records as $record ) {
		$term_slug = $record['term_slug'];

		include CORNERSTONE_MEMBERS_DIR . '/src/views/container.php';
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
function loop_and_render_members( array $members ) {
	$attributes = array(
		'show_icon' => 'dashicons dashicons-arrow-down-alt2',
		'hide_icon' => 'dashicons dashicons-arrow-up-alt2',
	);

	foreach ( $members as $member ) {
		$member_id   = $member['post_id'];
		$member_name = $member['post_title'];
		$description = $member['post_content'];

		include CORNERSTONE_MEMBERS_DIR . '/src/views/review.php';
	}
}

genesis();