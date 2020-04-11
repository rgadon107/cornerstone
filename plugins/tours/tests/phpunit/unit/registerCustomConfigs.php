<?php
/**
 * Tests for register_custom_configs().
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
use function spiralWebDb\CornerstoneTours\register_custom_configs;

/**
 * Class Tests_RegisterCustomConfigs
 *
 * @package spiralWebDb\CornerstoneTours\Tests\Unit
 * @group   tours
 */
class Tests_RegisterCustomConfigs extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once TOURS_ROOT_DIR . '/src/config-loader.php';
	}

	/*
	 * Test register_custom_configs() should add a runtime post_type config to existing configs.
	 */
	public function test_should_add_runtime_post_type_config_to_existing_configs() {
		$configurations = [];
		Monkey\Functions\expect( '_get_plugin_directory' )
			->twice()
			->with()
			->andReturn( TOURS_ROOT_DIR );

		$this->assertArrayHasKey( 'tours', register_custom_configs( (array) $configurations ) );
		$this->assertArraySubset( [ 'tours' => [ 'post_type' => 'tours' ] ], register_custom_configs( (array) $configurations ) );
	}
}

