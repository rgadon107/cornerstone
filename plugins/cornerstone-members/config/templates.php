<?php
/**
 * Templates configuration that provides the absolute path to each template
 * in this plugin to be loaded by the Template Loader module.
 *
 * @package     spiralWebDb\Members\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Members\Template;
use function spiralWebDb\Members\_get_plugin_directory;

return array(
	'single'            => array(
		'members' => _get_plugin_directory() . '/src/template/single-members.php',
	),
	'post_type_archive' => array(
		'members' => _get_plugin_directory() . '/src/template/archive-members.php',
	),
	'taxonomy'          => array(
		'role' => _get_plugin_directory() . '/src/template/taxonomy-role.php',
	),
);