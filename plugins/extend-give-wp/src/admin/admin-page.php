<?php
/**
 *  The Extend GiveWP plugin option settings page.
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
use function spiralWebDB\ExtendGiveWP\plugin_slug_name;

add_action( 'admin_menu', __NAMESPACE__ . '\add_option_settings_page' );
/*
 * Add an option settings page to the plugin admin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_option_settings_page() {
	$hookname = add_submenu_page(
		'options-general.php',
		'Extend GiveWP -- Donation Form Option Settings',
		'Extend GiveWP',
		'manage_options',
		'extend-give-wp-options',
		__NAMESPACE__ . '\render_option_page_template'
	);

	/* Should $hookname be used to build a hook 'load-{$hookname}' that fires
	 * before the custom callback above is called ( paramater #6 ) and register
	 * a callback? If so, the callback should do the following:
	 *
	 * (1) Check that the form is being submitted ('POST' === $_SERVER['REQUEST_METHOD']).
	 * (2) Perform CSRF verification ( CSRF = Cross Site Request Forgery )
	 * (3) Validation
	 * (4) Sanitization
	 *
	 * Each of the 4 items listed above are referenced in the WP Plugin handbook at
	 * https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#processing-the-form
	 */
}

/*
 * Render the option page template view file.
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_option_page_template() {

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	require_once _get_plugin_dir() . '/src/admin/views/option-page-template.php';
}

add_action( 'admin_init', __NAMESPACE__ . '\initialize_option_settings' );
/*
 * Initialize settings on the option settings admin page.
 *
 * @since 1.0.0
 *
 * @return void
 */
function initialize_option_settings() {
	$args = [
		'type'              => 'integer',
		'group'             => plugin_slug_name() . '_options',
		'description'       => 'The image ID for the donation form featured image.',
		'sanitize_callback' => 'sanitize_option',
		'show_in_rest'      => false,
		'default'           => 0,
	];

	// Register the setting.
	register_setting( plugin_slug_name() . '_options', plugin_slug_name() . '_featured_image_id', $args );

	/* === Settings Sections === */

	// Add settings sections.
	add_settings_section(
		'featured-image',
		'Featured Image',
		__NAMESPACE__ . '\render_featured_image_section_label',
		'extend-give-wp-options'
	);

	/* === Settings Fields === */

	// Featured image fields.
	add_settings_field(
		'featured-image-id',
		'Featured Image ID',
		__NAMESPACE__ . '\render_featured_image_id_field',
		'extend-give-wp-options',
		'featured-image',
		[
			'label_for' => 'featured_image_id',
			'class'     => 'featured-image-id',
		]
	);
}

/*
 * Callback to render featured image section label.
 *
 * @since 1.0.0.
 *
 * @return void
 */
function render_featured_image_section_label() {
	require_once _get_plugin_dir() . '/src/admin/views/featured_image_section_label.php';
}

/*
 * Callback to process the featured image id field.
 *
 * @since 1.0.0.
 *
 * @return void
 */
function render_featured_image_id_field() {
	require_once _get_plugin_dir() . '/src/admin/views/featured_image_id_field.php';
}

