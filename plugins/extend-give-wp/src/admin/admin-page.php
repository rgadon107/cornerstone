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

add_action( 'admin_init', __NAMESPACE__ . '\initialize_option_settings' );
/*
 * Initialize plugin option settings.
 *
 * @since 1.0.0
 *
 * @return void
 */
function initialize_option_settings() {
	$args = [
		'type'              => 'integer',
		'group'             => 'extend_give_wp_options',
		'description'       => 'The image ID for the donation form featured image.',
		'sanitize_callback' => null, // A callback function that sanitizes the option's value.
		'show_in_rest'      => false,
	];

	register_setting( 'extend_give_wp_options', 'featured_image_id', $args );

	add_settings_section();

	add_settings_field();
}


add_action( 'admin_menu', __NAMESPACE__ . '\add_option_settings_page' );
/*
 * Add an option settings page to the plugin admin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_option_settings_page() {
	$hookname = add_submenu_page( 'options-general.php',
		'Extend GiveWP -- Donation Form Option Settings',
		'Extend GiveWP',
		'manage_options',
		'extend-give-wp-options',
		'spiralWebDB\ExtendGiveWP\Admin\render_option_settings_view'
	);

	add_action( 'load-' . $hookname, __NAMESPACE__ . '\submit_plugin_option_settings' );
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
