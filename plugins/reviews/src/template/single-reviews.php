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

add_action( 'genesis_before_entry_content', __NAMESPACE__ . '\add_opening_blockquote', 999999 );
/**
 * Change the markup attributes for the review.
 *
 * @since 1.0.0
 *
 * @return string
 */
function add_opening_blockquote() {
	printf ('<blockquote class="review review-%s" itemprop="text">', (int) get_the_ID() );
}

add_action( 'genesis_after_entry_content', __NAMESPACE__ . '\add_closing_blockquote', 0 );
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