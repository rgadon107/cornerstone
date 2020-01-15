<?php
/**
 *  Nav menu customizations.
 *
 * @package     spiralWebDB\Developers
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        https://knowthecode.io
 * @license     GNU General Public License 2.0+
 */

namespace spiralWebDB\Developers;

use function spiralWebDB\Developers\get_theme_dir;

add_filter( 'genesis_do_nav', __NAMESPACE__ . '\add_class_attribute_to_nav_menu_item' );
/*
 * Add a class attribute to the first menu list item of the primary navigation.
 *
 * @since 1.0.0.
 * @param string $nav_output    Opening container markup, nav, closing container markup.
 *
 * @return string $nav_output   The filtered navigation HTML.
 */
function add_class_attribute_to_nav_menu_item( $nav_output ) {
	return require_once get_theme_dir() . '/lib/views/primary-nav-menu.php';
}




