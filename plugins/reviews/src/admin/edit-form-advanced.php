<?php
/**
 *  Customize the post Admin title area.
 *
 * @package    spiralWebDb\Events
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */
namespace spiralWebDb\Reviews;

add_filter( 'enter_title_here', __NAMESPACE__  . '\change_title_placeholder_text' );
/**
 *  Filter the placeholder text for the post title.
 *
 *  @since 1.0.0
 *
 *  @param string $text Placeholder text. WordPress default 'Enter title here'.
 *
 *  @return string $text
 */
function change_title_placeholder_text( $text ) {
	if ( 'reviews' == get_post_type() ) {
		$text = esc_html('Title of review.');
	}
	return $text;
}

add_action( 'edit_form_before_permalink', __NAMESPACE__ . '\add_description_beneath_post_title' );
/**
 *  Add description beneath post title custom field.
 *
 *  @since 1.0.0
 *
 *  @return void
 */
function add_description_beneath_post_title() {
	if ( 'reviews' == get_post_type() ) {

		echo sprintf( '<span class="description">%s</span>',
			'Enter a title for this review in the field above. Enter the review
			itself in the editor box below. Enter information about the review in the 
			box labeled "Cornerstone Reviews".' );
	}
}