<?php
/**
 * Templates configuration, providing the absolute path to each template
 * in this plugin which the Template Loader will load.
 *
 * @package     spiralWebDb\Events\Templates
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://KnowTheCode.io
 * @license     GNU-2.0+
 */
namespace spiralWebDb\Events\Templates;

return array(
	'single' => array(
		'events' => EVENTS_DIR . '/src/templates/single-events.php',
	),
	'post_type_archive' => array(
		'events' => EVENTS_DIR . '/src/templates/archive-events.php',
	),
	'taxonomy' => array(),
);
