<?php
/**
 *  Runtime configuration to load the Cornerstone-members plugin template files
 *  with the Central Hub plugin.
 *
 * @package    spiralWebDb\Members
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Members;

return array(
	'template' => array(
		'is_single'            => __DIR__ . '/src/template/single-members.php',
		'is_post_type_archive' => __DIR__ . '/src/template/archive-members.php',
		'is_tax'               => __DIR__ . '/src/template/taxonomy-member-role.php',
	)
);