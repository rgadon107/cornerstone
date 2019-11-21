<?php
/**
 * Footer HTML markup structure
 *
 * @package     spiralWebDB\Developers
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        https://knowthecode.io
 * @license     GNU General Public License 2.0+
 */

namespace spiralWebDB\Developers;

add_action( 'genesis_before_footer', __NAMESPACE__ . '\unregister_footer_callbacks' );
/**
 * Unregister footer callbacks.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_footer_callbacks() {
	remove_action( 'genesis_footer', 'genesis_do_footer' );
}

add_action( 'genesis_footer', __NAMESPACE__ . '\add_site_footer_widget_area' );
/*
 *  Add a site footer widget area
 *
 *  @since 1.0.0
 *
 *  @return void
 */
function add_site_footer_widget_area()  {
	genesis_widget_area( 'footer_widget_area', array(
		'before' => '<div class="site-footer--widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}
