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
			'id'          => 'donate_call_to_action',
			'name'        => 'Donate -- Footer Widget',
			'description' => 'This is donation appeal in the site footer.',
		),
		array(
			'id'            => 'archive_recordings_widget_area',
			'name'          => 'Recordings Archive Page Widget',
			'description'   => 'Add widgets to the Recordings archive page before the site footer.'
		)
	)
);
