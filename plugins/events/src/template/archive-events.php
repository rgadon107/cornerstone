<?php
/**
 * Template for the events post type archive.
 *
 * @package     spiralWebDb\Events\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Events\Template;

ddd( 'Loaded the archive-events template' );

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', __NAMESPACE__ . '\loop_and_render_events' );

/**
 *  Loop through and render out the Events
 *
 * @since 1.0.0
 *
 * @param array $events
 *
 * @return void
 */
function loop_and_render_events( array $events ) {

	foreach ( $events as $event ) {
		$post_title = $faq['post_title'];
		$content    = do_shortcode( $faq['post_content'] );
		$show_icon  = esc_attr( $attributes['show_icon'] );
		$hide_icon  = esc_attr( $attributes['hide_icon'] );

		include _get_plugin_directory() . '/src/views/faq.php';
	}
}

// 1. Remove the default genesis_loop and replace with a custom events loop
// to display all the single events. Review `wp-content/plugins/faq/src/template/archive-faq.php`
// and walk the code. Determine how the faqs get rendered. What will apply in this
// plugin?

// 2. Get all the records for the 'events' post type.
// Question: If I don't have a custom taxonomy term to add to my db query,
// would I use the global $wp_query object instead to get the post_id and post_title?

// 3. If there are no records to display, render a message that there are no records.

// 4. Call the container view file for archive-events.

// 5. Loop through and render the single-events view file to build the archive view.
// Question: Can I customize the loop to render less data than what's presented in the
// single-events.php template?

genesis();
