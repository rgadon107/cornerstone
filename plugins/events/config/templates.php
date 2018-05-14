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

use function spiralWebDb\Events\_get_plugin_directory;

return array(
	'single'            => array(
		'events' => _get_plugin_directory() . '/src/template/single-events.php',
	),
	'post_type_archive' => array(
		'events' => _get_plugin_directory() . '/src/template/archive-events.php',
	),
);
