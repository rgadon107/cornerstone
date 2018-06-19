<?php
/**
 * Metadata Handler
 *
 * @package    spiralWebDb\Members
 * @since      1.4.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\Members;

/*
 * Render the Cornerstone Member role.
 *
 * @since 1.4.0
 *
 * @param int $member_id The member ID.
 *
 * @return void
 */
function render_the_member_role( $member_id ) {
	$role = (string) get_post_meta( $member_id, 'role', true );

	if ( empty( $role ) ) {
		return;
	}

	echo esc_html( $role );
}

/*
 * Render the Cornerstone Member post thumbnail image.
 *
 * @since 1.4.0
 *
 * @param int $member_id The member ID.
 *
 * @return void
 */
function render_cornerstone_member_image( $member_id ) {

	// If there's no image, bail out.
	if ( ! has_post_thumbnail( $member_id ) ) {
		return;
	}

	echo get_the_post_thumbnail( $member_id, 'thumbnail', [
		'class'    => 'member-thumbnail first one-third',
		'itemprop' => 'member',
		'itemscope' > 'itemscope',
		'itemtype' => 'http://schema.org/musicGroupMember',
	] );
}

/**
 *  Display the Cornerstone member's current residence.
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_the_member_residence( $member_id ) {
	$city  = (string) get_post_meta( $member_id, 'residence_city', true );
	$state = (string) get_post_meta( $member_id, 'residence_state', true );

	if ( empty( $city ) || empty( $state ) ) {
		return;
	}

	echo 'Currently resides in: ' . '<em>' . esc_html( $city ) . ', ' . esc_html( $state ) . '</em>';
}

function render_number_of_cornerstone_tours( $member_id ) {
	$tour_number = (string) get_post_meta( $member_id, 'tour_number', true );

	if ( empty( $tour_number ) ) {
		return;
	}

	echo 'Number of Cornerstone tours: ' . '<em>' . esc_html( $tour_number ) . '</em>';
}
