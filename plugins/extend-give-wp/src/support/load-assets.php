<?php
/**
 * Load the assets
 *
 * @package     spiralWebDB\ExtendGiveWP
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        https://spiralwebdb.com
 * @license     GNU General Public License 2.0+
 */

namespace spiralWebDB\ExtendGiveWP;

add_action( 'give_pre_form', __NAMESPACE__ . '\get_give_donation_form_id', 5 );
/*
 * Return the form ID for the rendered Give donation form.
 *
 * @since 1.0.0.
 *
 * @param   int  $form_id    The post ID for the donation form.
 * @return  int  $form_id    The post ID.
 */
function get_give_donation_form_id( $form_id ) {
	return $form_id;
}

add_action( 'give_pre_form', __NAMESPACE__ . '\render_form_featured_image_and_caption' );
/*
 * Render donation form featured image and caption.
 *
 * @since 1.0.1
 * @param int $form_id            Post ID of the donation form.
 * @param string|array $size      Optional. Image size. Accepts any valid image size, or an array of width
 *                                    and height values in pixels (in that order). Default 'thumbnail'.
 * @return void
 */
function render_form_featured_image_and_caption( $form_id, $size = 'large' ) {
	$form_id = get_give_donation_form_id( $form_id );

	// Get the featured-image ID to render the image and caption on the donation page.
	$options       = get_option( 'extend-give-wp', [] );
	$attachment_id = isset( $options['featured-image-id'] ) ? (int) $options['featured-image-id'] : 0;
	$post          = get_post( $attachment_id );

	require_once _get_plugin_dir() . '/src/views/donation-form/featured-image-view.php';
}

add_action( 'give_pre_form', __NAMESPACE__ . '\render_donation_levels_label', 20 );
/*
 * Render donation levels label.
 *
 * @since 1.0.0
 *
 * @param int $form_id  Post ID of the donation form.
 *
 * @return void
 */
function render_donation_levels_label( $form_id ) {
	$form_id = get_give_donation_form_id( $form_id );

	require _get_plugin_dir() . '/src/views/donation-form/donation-levels-label.php';
}

add_action( 'give_after_donation_levels', __NAMESPACE__ . '\callout_recurring_donation_option', 1 );
/*
 * Call out the recurring donation option.
 *
 * Register callback to priority of 1 to render view before option checkbox.
 *
 * @since 1.0.0
 *
 * @param int $form_id  The form ID number.
 *
 * @return void
 */
function callout_recurring_donation_option( $form_id ) {
	$form_id = get_give_donation_form_id( $form_id );

	require _get_plugin_dir() . '/src/views/donation-form/callout-recurring-donation-option.php';
}

add_action( 'give_payment_mode_before_gateways', __NAMESPACE__ . '\render_payment_method_info_before_options' );
/*
 * Render instructions on the donation form before the payment method options.
 *
 * @since 1.0.0
 *
 * @return void
 */
function render_payment_method_info_before_options() {

	require _get_plugin_dir() . '/src/views/donation-form/payment-info.php';
}

add_action( 'give_donation_form_before_submit', __NAMESPACE__ . '\render_newsletter_signup_callout' );
/*
 * Render newsletter signup callout before donation total.
 *
 * @since 1.0.0
 *
 * @param int $form_id  The donation form ID.
 *
 * @return void
 */
function render_newsletter_signup_callout( $form_id ) {
	$form_id = get_give_donation_form_id( $form_id );

	require _get_plugin_dir() . '/src/views/donation-form/newsletter-callout.php';
}
