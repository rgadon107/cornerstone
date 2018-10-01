<?php
/**
 * Description
 *
 * @package     spiralWebDB\Developers
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        https://knowthecode.io
 * @license     GNU General Public License 2.0+
 */

namespace spiralWebDB\Developers;

/**
 * Unregister post callbacks.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_post_callbacks() {

}

add_filter( 'genesis_post_title_text', __NAMESPACE__ . '\remove_front_page_title' );
/**
 * Remove title on the front page.
 *
 * @since 1.0.0
 *
 * @param string $title The post title.
 * @return string $title
 */
function remove_front_page_title( $title ) {

	if ( is_front_page() ) {
		return '';
	}

	return $title;
}

add_filter( 'genesis_author_box_gravatar_size', __NAMESPACE__ . '\setup_author_box_gravatar_size' );
/**
 * Modify size of the Gravatar in the author box.
 *
 * @since 1.0.0
 *
 * @param $size
 *
 * @return int
 */
function setup_author_box_gravatar_size( $size ) {

	return 90;
}
