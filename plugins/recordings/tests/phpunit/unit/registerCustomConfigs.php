<?php
/**
 * Tests for register_custom_configs().
 *
 * @package     spiralWebDb\Recordings\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\RECORDINGS\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\Recordings\register_custom_configs;

/**
 * Class Tests_RegisterCustomConfigs
 *
 * @package spiralWebDb\Recordings\Tests\Unit
 * @group   recordings
 * @group   configs
 */
class Tests_RegisterCustomConfigs extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		Functions\when( 'spiralWebDb\Recordings\_get_plugin_directory' )->justReturn( RECORDINGS_ROOT_DIR );
		Functions\when( 'spiralWebDb\Module\Custom\Shortcode\register_shortcode' )->justReturn();
		require_once RECORDINGS_ROOT_DIR . '/src/config-loader.php';
	}

	/**
	 * Test register_custom_configs() should return array containing recordings post type config.
	 */
	public function test_should_return_array_containing_members_post_type_config() {
		Functions\expect( 'current_filter' )->once()->andReturn( 'add_custom_post_type_runtime_config' );

		$actual   = register_custom_configs( [ 'foo' => [] ] );
		$expected = [
			'foo'        => [],
			'recordings' => require RECORDINGS_ROOT_DIR . '/config/post-type.php',
		];
		$this->assertSame( $expected, $actual );
	}
}
