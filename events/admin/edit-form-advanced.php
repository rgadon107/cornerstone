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
namespace spiralWebDb\Events;

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
	if ( 'events' == get_post_type() ) {
		$text = esc_html__( 'Title of performance event.', CORNERSTONE_MEMBERS_PLUGIN_TEXT_DOMAIN);
	}
	return $text;
}

add_action( 'edit_form_before_permalink', __NAMESPACE__ . '\add_description_beneath_post_title' );
/**
 *  Add description beneath post title custom field.
 *
 *  @since 1.0.0
 *
 *  @param WP_Post $post Post object.
 *
 *  @return WP_Post $post
 */
function add_description_beneath_post_title( $post ) {
	if ( 'events' == get_post_type() ) {

		return _e( sprintf( '<span class="description">%s</span>',
			'Enter a title in the field above for this performance event.',
			CORNERSTONE_MEMBERS_PLUGIN_TEXT_DOMAIN ) );
	}
}