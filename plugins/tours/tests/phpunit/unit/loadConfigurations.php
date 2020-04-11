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

		Monkey\Functions\expect( '_get_plugin_directory' )
			->once()
			->with()
			->andReturn( TOURS_ROOT_DIR );

		require_once TOURS_ROOT_DIR . '/src/config-loader.php';
	}

	/*
	 * Test load_configurations() should load the meta-box configuration from the plugin 'config' directory.
	 */
	public function test_should_load_meta_box_config_from_plugin_config_directory() {
		Monkey\Functions\expect( 'spiralWebDB\Metadata\autoload_configurations' )
			->once()
			->with( [ TOURS_ROOT_DIR . '/config/tours.php' ] )
			->andReturn();

//		$this->assertArrayHasKey( 'meta_box.tours', load_configurations() );
	}
}

