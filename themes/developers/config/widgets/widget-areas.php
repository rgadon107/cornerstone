<?php
/**
 * Sidebars and widget area runtime configuration
 *
 * @package     spiralWebDB\Developers\Widgets
 * @since       1.0.0
 * @author      Robert A Gadon
 * @link        https://spiralWebDb
 * @license     GPL-2.0+
 */

namespace spiralWebDB\Developers;

return array(
	'unregister_widget_areas' => array(
		'sidebar-alt',
		'sidebar',
		'header-right',
	),
	'register_widget_areas' => array(
		array(
			'id'          => 'welcome_widget',
			'name'        => 'Welcome Widget',
			'description' => 'This is the front page welcome area below the site navigation.',
		),
		array(
			'id'          => 'reviews_bar_1',
			'name'        => 'Reviews Widget 1',
			'description' => 'This is the first reviews section on the front page.',
		),
		array(
			'id'          => 'events',
			'name'        => 'Events',
			'description' => 'This is the front page events section to display scheduled events.',
		),
		array(
			'id'          => 'reviews_bar_2',
			'name'        => 'Reviews Widget 2',
			'description' => 'This is the second reviews section on the front page.',
		),
	)
);
