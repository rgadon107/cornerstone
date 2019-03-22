<?php
/**
 * Bootstraps the Integration Tests.
 *
 * @package     spiralWebDb\Members\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Members\Tests\Integration;

define( 'MEMBERS_ROOT_DIR', dirname( dirname( dirname( __DIR__ ) ) ) );

tests_add_filter(
	'muplugins_loaded',
	function() {
		// Launch the Members' plugin.
		require_once MEMBERS_ROOT_DIR . '/bootstrap.php';
	}
);
