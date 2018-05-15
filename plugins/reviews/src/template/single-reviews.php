<?php
/**
 * Template for a single events post type.
 *
 * @package     spiralWebDb\Reviews\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Reviews\Template;

remove_all_actions( 'genesis_entry_header' );
remove_filter( 'genesis_attr_entry-content', 'genesis_attributes_entry_content' );
add_filter( 'genesis_attr_entry-content', __NAMESPACE__ . '\change_content_class_attribute' );
/**
 * Changes the class attribute from "entry-content" to "review-content".
 *
 * @since 1.0.0
 *
 * @param array $attributes Existing attributes for entry content element.
 *
 * @return array
 */
function change_content_class_attribute( array $attributes ) {
	$attributes['class'] = 'review-content';

	return $attributes;
}

add_action( 'genesis_before_entry_content', __NAMESPACE__ . '\add_opening_blockquote', 999999 );
/**
 * Change the markup attributes for the review.
 *
 * @since 1.0.0
 *
 * @return string
 */
function add_opening_blockquote() {
	printf( '<blockquote class="review review-%s" itemprop="text">', (int) get_the_ID() );
}

add_action( 'genesis_after_entry_content', __NAMESPACE__ . '\add_review_extra_information', 0 );
/**
 * Add the extra information for the review.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_review_extra_information() {
	$review_id = (int) get_the_ID();

	require dirname( __DIR__ ) . '/views/review-footer.php';
}

add_action( 'genesis_after_entry_content', __NAMESPACE__ . '\add_closing_blockquote', 1 );
/**
 * Change the markup attributes for the review.
 *
 * @since 1.0.0
 *
 * @return string
 */
function add_closing_blockquote() {
	echo '</blockquote>';
}

genesis();