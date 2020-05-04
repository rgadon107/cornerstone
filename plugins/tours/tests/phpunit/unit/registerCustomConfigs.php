<?php
/**
 * Tests for register_custom_configs().
 *
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @package     spiralWebDb\CornerstoneTours\Tests\Integration
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\CornerstoneTours\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\CornerstoneTours\register_custom_configs;

/**
 * @covers ::\spiralWebDb\CornerstoneTours\register_custom_configs
 *
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

	/**
	 * @dataProvider addTestData
	 */
	public function test_should_add_runtime_post_type_config_to_existing_configs( array $existing ) {
		Functions\expect( '_get_plugin_directory' )
			->times( 1 )
			->with()
			->andReturn( TOURS_ROOT_DIR );

		$this->assertArrayHasKey( 'tours', register_custom_configs( (array) $existing ) );
	}

	public function addTestData() {
		return [
			'testShouldIncludeToursConfig'            => [
				'existing_configs' => [],
			],
		];
	}
}

