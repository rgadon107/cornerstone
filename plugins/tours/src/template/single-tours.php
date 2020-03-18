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

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

add_filter( 'genesis_post_title_text', __NAMESPACE__ . '\render_post_title_text' );
/*
 * Render the past tour_year and title text (tour theme).
 *
 * @param int $tour_id  The tour ID.
 */
function render_post_title_text( $tour_id ) {
	$post       = get_post();
	$menu_order = $post->menu_order;
	$tour_id    = get_the_ID();
	
	require dirname( __DIR__ ) . '/views/tour-title.php';
}

add_action( 'genesis_before_entry_content', __NAMESPACE__ . '\render_postmeta_before_content' );
/**
 * Render postmeta before entry content.
 *
 * @param int $tour_id Past tour ID.
 */
function render_postmeta_before_content( $tour_id ) {
	$tour_id = get_the_ID();

	require dirname( __DIR__ ) . '/views/tour-postmeta.php';
}

genesis();

