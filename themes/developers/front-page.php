<?php
/**
 * Front page template
 *
 * @package     spiralWebDB\FrontPage
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDB\FrontPage;

use function spiralWebDB\Events\load_archive_template;

//remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_before_content_sidebar_wrap', __NAMESPACE__ . '\add_widget_areas' );
/**
 *
 */
function add_widget_areas() {

	if ( ! is_front_page() ) {
		return;
	}

	genesis_widget_area( 'welcome_widget', array(
		'before' => '<div class="welcome"><div class="wrap">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'reviews_bar_1', array(
		'before' => '<div class="reviews_1"><div class="wrap">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'events', array(
		'before' => '<div class="events_widget"><div class="wrap">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'reviews_bar_2', array(
		'before' => '<div class="reviews_2"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

load_archive_template();
