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
		'options-general.php',  // parent slug
		'Extend GiveWP -- Donation Form Option Settings', // page title
		'Extend GiveWP', // menu title
		'manage_categories', // capability
		'extend-give-wp-options', // menu slug
		__NAMESPACE__ . '\render_option_page_template' // callback to output page content.
	);

	add_action( "load-{$hookname}", __NAMESPACE__ . '\sanitize_options' );
}

/*
 * Render the option page template view file.
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_option_page_template() {

	if ( ! current_user_can( 'manage_categories' ) ) {
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
		'group'             => 'extend-give-wp-options',
		'description'       => 'The image ID for the donation form featured image.',
		'sanitize_callback' => __NAMESPACE__ . '\sanitize_options',
		'show_in_rest'      => false,
	];

	// Register the setting.
	register_setting(
		'extend-give-wp-options',   // option group
		'extend-give-wp-options',   // option name
		$args );

	/* === Settings Sections === */

	// Add settings sections.
	add_settings_section(
		'featured-image',           // settings_section ID
		'Featured Image',           // settings_section Title
		__NAMESPACE__ . '\render_featured_image_section_label', // settings_section custom callback
		'extend-give-wp-options'    // page name. Matches 'menu slug' on 'add_submenu_page'.
	);

	/* === Settings Fields === */

	// Featured image fields.
	add_settings_field(
		'featured-image-id',           // settings_field ID
		'Featured Image ID',           // settings_field Title
		__NAMESPACE__ . '\render_featured_image_id_field',  // settings_field custom callback
		'extend-give-wp-options',      // The menu page on which to display field. Matches 'menu-slug' from 'add_submenu_page'.
		'featured-image',              // section_setting field is assigned to.
		[
			'label_for' => 'featured-image-id',
			'class'     => 'featured-image-id',
		]
	);
}

/*
 * Sanitization callback declared in $args parameter of register_setting()
 *
 * @since 1.0.0.
 * @param integer $attachment_id    Option input.
 *
 * @return integer $attachment_id   Filtered option.
 */
function sanitize_options( $attachment_id ) {
	if ( 0 >= $attachment_id ) {
		return $attachment_id;
	}

	return filter_var( $attachment_id, FILTER_VALIDATE_INT, $option = [ 'min_range' => 1 ] );
}

/*
 * Callback to render the settings section label.
 *
 * @since 1.0.0.
 *
 * @return void
 */
function render_featured_image_section_label() {
	require_once _get_plugin_dir() . '/src/admin/views/featured_image_section_label.php';
}

/*
 * Callback to render the settings field markup.
 *
 * @since 1.0.0.
 *
 * @return void
 */
function render_featured_image_id_field() {
	$options = get_option( 'extend-give-wp-options' );

	$attachment_id = isset( $options['featured-image-id'] ) ? (int) $options['featured-image-id'] : 0;

	require_once _get_plugin_dir() . '/src/admin/views/featured_image_id_field.php';

	sanitize_options( $attachment_id );
}

