<?php
/**
 * Front page template
 *
 * @package     spiralWebDB\FrontPage
 * @since       1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU-2.0+
 */
namespace spiralWebDB\FrontPage;

remove_all_actions( 'genesis_entry_header' );
remove_all_actions( 'genesis_entry_footer' );
add_action( 'genesis_header', 'genesis_header_markup_open', 5 );
add_action( 'genesis_header', 'genesis_do_header' );
add_action( 'genesis_header', 'genesis_header_markup_close', 15 );

genesis();
