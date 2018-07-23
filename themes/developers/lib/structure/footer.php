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
 * Customize the site footer with client info
 *
 * @since 1.0.0
 *
 * @return void
 */
function do_footer_cornerstone_content() {

	$site_url  = esc_url( site_url() );
	$title     = esc_html( get_bloginfo( 'name' ) );
	$address_1 = '<strong>' . 'P.O. Box 249, ' . '</strong>';
	$address_2 = '<strong>' . 'Florissant, MO 63032' . '</strong>';
	$telephone = '<strong>' . 'Telephone: 1-314-838-4383' . '</strong>';

	echo wpautop( sprintf( '<h4>' . '<a href="' . $site_url . '">' . $title . '</a></h4 >' ) );
	echo wpautop( sprintf( $address_1 . ' &#8194' . $address_2 ) );
	echo wpautop( sprintf( $telephone ) );
}
