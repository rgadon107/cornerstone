<?php

return [
	'meta_box.members' => [
		'add_meta_box'  => [
			'title'         => 'Tour Member Profile Information',
			'screen'        => [ 'members' ],
			'context'       => 'normal',
			'priority'      => 'default',
			'callback_args' => null,
		],
		'custom_fields' => [
			'residence_city'  => [],
			'residence_state' => [],
			'role'            => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'is_active' => [
				'default'      => 0,
				'delete_state' => 0,
				'sanitize'     => 'int_val',
			]
		],
		// Absolute path to config view file.
		'view'          => '',
	],
];
