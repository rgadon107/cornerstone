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

define( 'REVIEWS_ROOT_DIR', dirname( dirname( dirname( __DIR__ ) ) ) );

tests_add_filter(
	'muplugins_loaded',
	function() {
		// Launch the Reviews' plugin.
		require_once REVIEWS_ROOT_DIR . '/bootstrap.php';
	}
);
