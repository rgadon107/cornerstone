<?php
/**
 *  The Extend GiveWP option settings page.
 *
 * @package    spiralWebDB\ExtendGiveWP\Admin
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDB\ExtendGiveWP\Admin;

use function spiralWebDB\ExtendGiveWP\_get_plugin_dir;

add_action( 'admin_menu', __NAMESPACE__ . '\add_option_settings_page' );
/*
 * Add an option settings page to the plugin admin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_option_settings_page() {
	add_submenu_page( 'options-general.php',
		'Extend GiveWP -- Option Settings',
		'Extend GiveWP',
		'manage_options',
		'extend-give-wp-options',
		'spiralWebDB\ExtendGiveWP\Admin\render_option_settings_view'
	);
}

/*
 * Render the option settings view file.
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_option_settings_view() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	require _get_plugin_dir() . '/src/admin/view/option_settings.php';
}
