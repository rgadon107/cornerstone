<?php
/**
 * Template for a single members post type.
 *
 * @package     spiralWebDb\Members\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Members\Template;

add_action( 'genesis_entry_header', __NAMESPACE__ . '\render_post_thumbnail_before_title', 6 );

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

add_action( 'genesis_entry_header', __NAMESPACE__ . '\render_the_member_role', 8 );
/**
 *
 */
function render_the_member_role( $member_id ) {
	$member_id = get_the_ID();

	require dirname( __DIR__ ) . '/views/member-role.php';
}

add_filter( 'genesis_attr_entry-title', __NAMESPACE__ . '\genesis_attributes_entry_title' );
/**
 * Add attributes for entry title element.
 *
 * @since 1.0.0
 *
 * @param array $attributes Existing attributes for the entry title element.
 *
 * @return array Amended attributes for the entry title element.
 */
function genesis_attributes_entry_title( $attributes ) {
	$attributes[ 'class' ] = 'entry-title two-thirds';

	return $attributes;
}

add_filter( 'genesis_attr_entry-content', __NAMESPACE__ . '\genesis_attributes_entry_content' );
/**
 * Add attributes for entry content element.
 *
 * @since 1.0.0
 *
 * @param array $attributes Existing attributes for entry content element.
 *
 * @return array Amended attributes for entry content element.
 */
function genesis_attributes_entry_content( $attributes ) {
	$attributes['class'] = 'entry-content two-thirds';

	return $attributes;
}

add_action( 'genesis_entry_content', __NAMESPACE__ . '\render_member_meta', 15 );

genesis();
