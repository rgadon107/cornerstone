<?php
/**
 * Bootstraps the Integration Tests.
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Integration;

tests_add_filter(
	'muplugins_loaded',
	function() {
		// Launch the Tours plugin.
		require_once dirname( dirname( dirname( __DIR__ ) ) ) . '/bootstrap.php';
	},
	11
);
