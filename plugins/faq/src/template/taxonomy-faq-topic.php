<?php
/**
 * Template for the FAQ topic taxonomy.
 *
 * @package     spiralWebDb\FAQ\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\FAQ\Template;

use function spiralWebDb\FAQ\_get_plugin_directory;
use spiralWebDb\FAQ\Asset;

Asset\enqueue_script_ondemand();

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', __NAMESPACE__ . '\do_faq_term_loop' );
/**
 * Do the FAQ term loop and render out the HTML.
 *
 * @since 1.0.0
 *
 * @return void
 */
function do_faq_term_loop() {

	if ( ! have_posts() ) {
		echo '<p>Sorry, there are no FAQs.</p>';

		return;
	}

	$show_icon = 'dashicons dashicons-arrow-down-alt2';
	$hide_icon = 'dashicons dashicons-arrow-up-alt2';

	do_action( 'genesis_before_while' );
	while ( have_posts() ) {
		the_post();

		do_action( 'genesis_before_entry' );

		$post_title = get_the_title();
		$content    = get_the_content();

		include _get_plugin_directory() . '/src/views/faq.php';

		do_action( 'genesis_after_entry' );
	}
	do_action( 'genesis_after_endwhile' );
}

genesis();
