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
			'residence_city'  => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'residence_state' => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
			'role'            => [
				'is_single'    => true,
				'default'      => '',
				'delete_state' => '',
				'sanitize'     => 'sanitize_text_field',
			],
		],
		// Absolute path to config view file.
		'view'          => '',
	],
];