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
	'register_widget_areas'   => array(
		array(
			'id'          => 'footer_widget_area',
			'name'        => 'Footer Widget--Call to Action',
			'description' => 'Add a donation appeal & contact info in the site footer.',
		),
		array(
			'id'            => 'archive_recordings_widget_area',
			'name'          => 'Recordings Archive Page Widget',
			'description'   => 'Add widgets to the Recordings archive page before the site footer.'
		)
	)
);
