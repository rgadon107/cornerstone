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

