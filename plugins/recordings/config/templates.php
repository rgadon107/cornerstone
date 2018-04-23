<?php
/**
 * Templates configuration, providing the absolute path to each template
 * in this plugin which the Template Loader will load.
 *
 * @package     spiralWebDb\Recordings\Template
 * @since       1.0.0
 * @author      Robert A. Gadon
 * @link        http://spiralwebdb.com
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Recordings\Template;

return array(
	'single'            => array(
		'recordings' => RECORDINGS_DIR . '/src/template/single-recordings.php',
	),
	'post_type_archive' => array(
		'recordings' => RECORDINGS_DIR . '/src/template/archive-recordings.php',
	),
);