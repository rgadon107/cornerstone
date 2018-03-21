<?php
/**
 *  Customize the post Admin title area.
 *
 * @package    spiralWebDb\Members
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */
namespace spiralWebDb\Members;

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
	if ( 'members' == get_post_type() ) {
		$text = esc_html__( 'Title of tour member record (first, last name).', CORNERSTONE_MEMBERS_PLUGIN_TEXT_DOMAIN);
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
	if ( 'members' == get_post_type() ) {

		return _e( sprintf( '<span class="description">%s</span>',
			'Enter the tour member’s name in the field above. Enter their biographical information below.',
			CORNERSTONE_MEMBERS_PLUGIN_TEXT_DOMAIN ) );
	}
}