<?php
/**
 * Templates configuration, providing the absolute path to each template
 * in this plugin that the Template Loader will load.
 *
 * @package     spiralWebDb\Recordings\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Recordings\Template;

use function spiralWebDb\Recordings\_get_plugin_directory;

return array(
	'single'            => array(
		'recordings' => _get_plugin_directory() . '/src/template/single-recordings.php',
	),
	'post_type_archive' => array(
		'recordings' => _get_plugin_directory() . '/src/template/archive-recordings.php',
	),
);