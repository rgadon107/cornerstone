<?php
/**
 * Asset loader handler.
 *
 * @package     spiralWebDB\Developers
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        https://knowthecode.io
 * @license     GNU General Public License 2.0+
 */

namespace spiralWebDB\Developers;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
/**
 * Enqueue Scripts and Styles.
 *
 * @since 1.0.2
 *
 * @return void
 */
function enqueue_assets() {

	wp_enqueue_style( CHILD_TEXT_DOMAIN . '-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( CHILD_TEXT_DOMAIN . '-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.1.0/css/all.css' );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( CHILD_TEXT_DOMAIN . '-responsive-menu', CHILD_URL . '/assets/js/responsive-menu.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	$localized_script_args = array(
		'mainMenu' => __( 'Menu', CHILD_TEXT_DOMAIN ),
		'subMenu'  => __( 'Menu', CHILD_TEXT_DOMAIN ),
	);
	wp_localize_script( CHILD_TEXT_DOMAIN . '-responsive-menu', 'developersL10n', $localized_script_args );
}