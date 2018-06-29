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

remove_action( 'genesis_loop', 'genesis_do_loop' );

genesis();
