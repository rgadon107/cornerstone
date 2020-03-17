<?php
/**
 * Templates configuration, providing the absolute path to each template
 * in this plugin which the Template Loader will load.
 *
 * @package    spiralWebDb\CornerstoneTours\Template
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\CornerstoneTours\Template;

use function spiralWebDb\CornerstoneTours\_get_plugin_directory;

return [
	'single' => [
		'tours' => _get_plugin_directory() . '/src/template/single-tours.php',
	],
	'post_type_archive' => [
		'tours' => _get_plugin_directory() . '/src/template/archive-tours.php',
	],
];

