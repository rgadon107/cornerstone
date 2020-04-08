<?php
/**
 *  Customize the post Admin title area.
 *
 * @package    spiralWebDb\CornerstoneTours
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GPL-2.0+
 */

namespace spiralWebDb\CornerstoneTours;

add_filter( 'enter_title_here', __NAMESPACE__ . '\change_title_placeholder_text', 10, 2 );
/**
 *  Filter the placeholder text for the post title.
 *
 * @since 1.0.0
 *
 * @param string $text Placeholder text. WordPress default 'Add title'.
 * @param WP_Post $post Post object.
 *
 * @return string $text
 */
function change_title_placeholder_text( $text, $post ) {
	if ( 'tours' !== get_post_type( $post ) ) {
		return $text;
	}

	return '<em>' . "Theme of this Cornerstone tour." . '</em>';
}

add_action( 'edit_form_before_permalink', __NAMESPACE__ . '\add_description_beneath_post_title' );
/**
 *  Add description beneath post title custom field.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_description_beneath_post_title() {
	if ( 'tours' !== get_post_type() ) {
		return;
	}

	include __DIR__ . '/views/description.php';
}