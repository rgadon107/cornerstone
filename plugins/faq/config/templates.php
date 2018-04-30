<?php
/**
 * Templates configuration, providing the absolute path to each template
 * in this plugin which the Template Loader will load.
 *
 * @package     spiralWebDb\FAQ\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\FAQ\Template;

use function spiralWebDb\FAQ\_get_plugin_directory;

$plugin_directory = _get_plugin_directory();

return array(
	'single'            => array(
		'faq' => $plugin_directory . '/src/template/single-faq.php',
	),
	'post_type_archive' => array(
		'faq' => $plugin_directory . '/src/template/archive-faq.php',
	),
	'taxonomy'          => array(
		'faq' => $plugin_directory . '/src/template/taxonomy-faq-topic.php',
	)
);