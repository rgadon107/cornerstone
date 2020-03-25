<?php
/**
 *  Template for a single 'tours' post_type.
 *
 * @package    spiralWebDb\CornerstoneTours\Template
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours\Template;

use function spiralWebDb\FAQ\Asset\enqueue_script_ondemand;

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

add_filter( 'genesis_post_title_text', __NAMESPACE__ . '\render_post_title_text' );
/*
 * Render the past tour_year and title text (tour theme).
 *
 * @param int $tour_id  The tour ID.
 */
function render_post_title_text( $tour_id ) {
	$post       = get_post();
	$menu_order = (int) $post->menu_order;
	$tour_id    = (int) get_the_ID();

	require dirname( __DIR__ ) . '/views/tour-title.php';
}

add_action( 'genesis_before_entry_content', __NAMESPACE__ . '\render_postmeta_before_content' );
/**
 * Render postmeta before entry content.
 *
 * @param int $tour_id Past tour ID.
 */
function render_postmeta_before_content( $tour_id ) {
	$tour_id = (int) get_the_ID();

	require dirname( __DIR__ ) . '/views/tour-postmeta.php';
}

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', __NAMESPACE__ . '\render_tours_entry_content' );
/*
 * Modify display of past tours entry content.
 */
function render_tours_entry_content() {
	if ( '' === get_the_content() && 'tours' == get_post_type() ) {
		return;
	}

	$tour_id = (int) get_the_ID();

	$show_icon = esc_attr( 'dashicons dashicons-arrow-down' );
	$hide_icon = esc_attr( 'dashicons dashicons-arrow-up' );

	enqueue_script_ondemand();

	require dirname( __DIR__ ) . '/views/tour-content.php';
}

genesis();

