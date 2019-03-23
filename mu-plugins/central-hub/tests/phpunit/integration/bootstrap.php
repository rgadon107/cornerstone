<?php
/**
 * Bootstraps the Integration Tests.
 *
 * @package     spiralWebDb\centralHub\Tests\Integration
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration;

define( 'CENTRAL_HUB_ROOT_DIR', dirname( dirname( dirname( __DIR__ ) ) ) );

tests_add_filter(
	'muplugins_loaded',
	function() {
		// Launch the Central Hub plugin.
		require_once CENTRAL_HUB_ROOT_DIR . '/bootstrap.php';
	}
);
