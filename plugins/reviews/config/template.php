<?php
/**
 *  Runtime configuration to load the Reviews plugin template files
 *  with the Central Hub plugin.
 *
 * @package    spiralWebDb\Reviews
 *
 * @since      1.0.0
 *
 * @author     Robert A. Gadon
 *
 * @link       http://spiralwebdb.com
 *
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\Reviews;

return array(
	'template' => array(
		'is_single'            => REVIEWS_DIR . '/src/template/single-reviews.php',
		'is_post_type_archive' => REVIEWS_DIR . '/src/template/archive-reviews.php',
		'is_tax'               => REVIEWS_DIR . '/src/template/taxonomy-review-type.php',
	)
);