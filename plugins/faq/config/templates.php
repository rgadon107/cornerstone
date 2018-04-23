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

return array(
	'single'            => array(
		'faq' => FAQ_DIR . '/src/template/single-faq.php',
	),
	'post_type_archive' => array(
		'faq' => FAQ_DIR . '/src/template/archive-faq.php',
	),
	'taxonomy'          => array(
		'faq' => FAQ_DIR . '/src/template/taxonomy-faq-topic.php',
	)
);