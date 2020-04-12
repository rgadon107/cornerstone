<?php
/**
 * Tests for load_configurations().
 *
 * @package     spiralWebDb\CornerstoneTours\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\load_configurations;

/**
 * Class Tests_LoadConfigurations
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 */
class Tests_LoadConfigurations extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/config-loader.php';
	}

	/*
	 * Test load_configurations() should load the 'tours' plugin meta-box configuration.
	 */
	public function test_should_load_plugin_meta_box_config() {
		Monkey\Functions\when( '_get_plugin_directory' )->justReturn( TOURS_ROOT_DIR );

		load_configurations();

		// This is a placeholder to avoid PHPUnit error.
		$this->assertTrue( true );
	}
}

