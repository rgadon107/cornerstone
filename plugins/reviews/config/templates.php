<?php
/**
 * Templates configuration, providing the absolute path to each template
 * in this plugin that the Template Loader will load.
 *
 * @package    spiralWebDb\Reviews\Templates
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU-2.0+
 */

namespace spiralWebDb\Reviews\Templates;

use function spiralWebDb\Reviews\_get_plugin_directory;

return array(
	'single'            => array(
		'reviews' => _get_plugin_directory() . '/src/template/single-reviews.php',
	),
	'post_type_archive' => array(
		'reviews' => _get_plugin_directory() . '/src/template/archive-reviews.php',
	),
	'taxonomy'          => array(
		'reviews' => _get_plugin_directory() . '/src/template/taxonomy-review-type.php',
	),
);