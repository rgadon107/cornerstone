<?php
/**
 * Templates configuration, providing the absolute path to each template
 * in this plugin which the Template Loader will load.
 *
 * @package     spiralWebDb\Members\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Members\Template;

return array(
	'single'            => array(
		'members' => CORNERSTONE_MEMBERS_DIR . '/src/template/single-members.php',
	),
	'post_type_archive' => array(
		'members' => CORNERSTONE_MEMBERS_DIR . '/src/template/archive-members.php',
	),
	'taxonomy'          => array(
		'role' => CORNERSTONE_MEMBERS_DIR . '/src/template/taxonomy-role.php',
	),
);