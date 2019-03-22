<?php
/**
 * Bootstraps the Integration Tests.
 *
 * @package     spiralWebDb\FAQ\Tests\Integration
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\FAQ\Tests\Integration;

define( 'FAQ_ROOT_DIR', dirname( dirname( dirname( __DIR__ ) ) ) );

tests_add_filter(
	'muplugins_loaded',
	function() {
		// Launch the Events' plugin.
		require_once FAQ_ROOT_DIR . '/bootstrap.php';
	}
);
