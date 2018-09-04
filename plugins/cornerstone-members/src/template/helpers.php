<?php
/**
 * Helper functions for the templates and views.
 *
 * @package     spiralWebDb\Members\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Members\Template;

use function spiralWebDb\Members\render_cornerstone_member_image;

/**
 * Get the article's classes.
 *
 * @since 1.0.0
 *
 * @param int $members_count This member's spot in the grid.
 * @param int $member_id Optional. Member's ID.
 * @param array $classes Optional. Starting classes to add new classes to.
 *
 * @return string
 */
function get_members_post_classes( $members_count, $member_id = 0, array $classes = array() ) {
	$classes[] = "post-{$member_id}";
	$classes[] = 'type-members';
	$classes[] = 'one-half';
	if ( $members_count % 2 === 0 ) {
		$classes[] = 'first';
	}

	return implode( ' ', $classes );
}

/**
 * Renders the member's bio with a character limiter applied.
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_members_content() {
	$number_of_characters = 200;
	the_content_limit( $number_of_characters, genesis_a11y_more_link( '[Continue reading...]' ) );
}

/**
 * Render the Cornerstone member thumbnail image before the recording title.
 *
 * @since 1.0.0
 *
 * @param int $member_id Optional. Member's ID.
 *
 * @return void
 */
function render_post_thumbnail_before_title( $member_id = 0 ) {
	if ( ! $member_id ) {
		$member_id = (int) get_the_ID();
	}

	render_cornerstone_member_image( $member_id );
}

/**
 *  Description
 *
 * @since 1.0.0
 *
 * @param int $member_id Optional. Member's ID.
 *
 * @return void
 */
function render_member_role( $member_id = 0 ) {
	if ( ! $member_id ) {
		$member_id = (int) get_the_ID();
	}

	require dirname( __DIR__ ) . '/views/member-role.php';
}

/**
 * Render the Cornerstone member meta information.
 *
 * @since 1.0.0
 *
 * @param int $member_id Optional. Member's ID.
 *
 * @return void
 */
function render_member_meta( $member_id ) {
	if ( ! $member_id ) {
		$member_id = (int) get_the_ID();
	}

	require dirname( __DIR__ ) . '/views/member-residence.php';
	require dirname( __DIR__ ) . '/views/number-of-tours.php';
}