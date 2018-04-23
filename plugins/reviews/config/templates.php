<?php
/**
 * Templates configuration, providing the absolute path to each template
 * in this plugin which the Template Loader will load.
 *
 * @package    spiralWebDb\Reviews\Templates
 * @since      1.0.0
 * @author     Robert A. Gadon
 * @link       http://spiralwebdb.com
 * @license    GNU-2.0+
 */

namespace spiralWebDb\Reviews\Templates;

return array(
	'single'            => array(
		'reviews' => REVIEWS_DIR . '/src/template/single-reviews.php',
	),
	'post_type_archive' => array(
		'reviews' => REVIEWS_DIR . '/src/template/archive-reviews.php',
	),
	'taxonomy'          => array(
		'review' => REVIEWS_DIR . '/src/template/taxonomy-review-type.php',
	),
);
