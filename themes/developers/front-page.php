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

namespace spiralWebDB\Developers;

use function spiralWebDB\Events\load_archive_template;

add_action( 'genesis_before_content_sidebar_wrap', __NAMESPACE__ . '\add_widget_areas' );
/**
 * Add widget areas on front-page
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_widget_areas() {

	if ( ! is_front_page() ) {
		return;
	}

	genesis_widget_area( 'welcome_front_page', array(
		'before' => '<div class="welcome"><div class="wrap">',
		'after'  => '</div></div>',
	) );


	genesis_widget_area( 'reviews_front_page', array(
		'before' => '<div class="reviews--front-page"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', __NAMESPACE__ . '\do_custom_loop' );
/*
 *
 */
function do_custom_loop() {
	genesis_custom_loop( [
		'post_type'      => 'events',
		'posts_per_page' => 20,
		'order'          => 'ASC',
		'order_by'       => 'menu_order'
	] );
}

load_archive_template();
