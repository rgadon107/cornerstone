<?php
/**
 * Bootstraps the Integration Tests.
 *
 * @package     spiralWebDb\Reviews\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Reviews\Tests\Integration;

tests_add_filter(
	'muplugins_loaded',
	function() {
		// Launch the Reviews' plugin.
		require_once dirname( dirname( dirname( __DIR__ ) ) ) . '/bootstrap.php';
	},
	11
);
