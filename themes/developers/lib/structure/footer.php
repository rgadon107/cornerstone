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

add_action( 'genesis_footer', __NAMESPACE__ . '\do_footer_cornerstone_content' );
/**
 * Customize the site footer to render client info.
 *
 * @since 1.0.0
 *
 * @return void
 */
function do_footer_cornerstone_content() {

	$site_url   = esc_url( site_url() );
	$site_title = esc_html( get_bloginfo( 'name' ) );

	require dirname( __DIR__ ) . '/views/site-footer.php';
}
