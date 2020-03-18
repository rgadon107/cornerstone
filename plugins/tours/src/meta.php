<?php
/**
 *  Metadata Handler
 *
 * @package    spiralWebDb\CornerstoneTours
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours;

/*
 * Render the year of the past Cornerstone tour.
 *
 * @since 1.0.0
 *
 * @param int $tour_id  The tour ID.
 */
function render_the_tour_year( $tour_id ) {
	$year = (integer) get_post_meta( $tour_id, 'tour_year', true );

	if ( empty( $year ) ) {
		return;
	}

	echo esc_html( $year );
}

/*
 * Render the region(s) visited during the past tour.
 *
 * @since 1.0.0
 *
 * @param int  $tour_id  The tour ID.
 */
function render_the_tour_regions( $tour_id ) {
	$region = (string) get_post_meta( $tour_id, 'tour_region', true );

	if ( empty( $region ) ) {
		return;
	}

	echo esc_html( $region );
}

/*
 * Render notable comments associated with a past tour.
 *
 * @since 1.0.0
 *
 * @param int  $tour_id  The tour ID.
 */
function render_tour_comments( $tour_id ) {
	$comments = (string) get_post_meta( $tour_id, 'tour_comments', true );

	if ( empty( $comments ) ) {
		return;
	}

	echo esc_html( $comments );
}

