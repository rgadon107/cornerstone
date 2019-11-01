<?php

return [
	'meta_box.events' => [
		'add_meta_box'  => [
			'title'  => 'Event Information',
			'screen' => [ 'events' ],
		],
		'custom_fields' => [
			'event-date'           => [
				'sanitize' => 'strip_tags',
			],
			'event-time'           => [
				'sanitize' => 'strip_tags',
			],
			'venue-name'           => [],
		],
		'view'          => '',
	],
];
