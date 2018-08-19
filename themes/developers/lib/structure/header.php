<?php
/**
 * Header HTML markup structure
 *
 * @package     spiralWebDB\Developers
 * @since       1.0.0
 * @author      Robert A Gadon
 * @link        https://spiralweb.com
 * @license     GNU General Public License 2.0+
 */

namespace spiralWebDB\Developers;

add_action( 'genesis_header', __NAMESPACE__ . '\unregister_header_callbacks' );
/**
 * Unregister header callbacks.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_header_callbacks() {
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
}

add_action( 'genesis_before_header', __NAMESPACE__ . '\register_header_callbacks' );
/*
 * Register header callbacks
 *
 * @singe 1.0.0
 *
 * @return void
 */
function register_header_callbacks() {
	add_action( 'genesis_header', 'genesis_do_nav', 8 );
}
