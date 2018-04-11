<?php
/**
 * Templates configuration, providing the absolute path to each template
 * in this plugin which the Template Loader will load.
 *
 * @package     spiralWebDb\Events\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Events\Template;

return array(
	'single'            => array(
		'events' => EVENTS_DIR . '/src/template/single-events.php',
	),
	'post_type_archive' => array(
		'events' => EVENTS_DIR . '/src/template/archive-events.php',
	),
);
