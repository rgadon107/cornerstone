<?php
/**
 * Tests for register_events_custom_configs().
 *
 * @package     spiralWebDb\Events\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Events\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\Events\register_events_custom_configs;

/**
 * Class Tests_RegisterEventsCustomConfigs
 *
 * @package spiralWebDb\Events\Tests\Unit
 * @group   events
 * @group   configs
 */
class Tests_RegisterEventsCustomConfigs extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		Functions\when( 'spiralWebDb\Events\_get_plugin_directory' )->justReturn( EVENTS_ROOT_DIR );
		Functions\when( 'spiralWebDb\Module\Custom\Shortcode\register_shortcode' )->justReturn();
		require_once EVENTS_ROOT_DIR . '/src/config-loader.php';
	}

	/**
	 * Test register_events_custom_configs() should return array containing events post type config.
	 */
	public function test_should_return_array_containing_events_post_type_config() {
		Functions\expect( 'current_filter' )->once()->andReturn( 'add_custom_post_type_runtime_config' );

		$expected = [
			'foo' => [],
			'events' => require EVENTS_ROOT_DIR . '/config/post-type.php',
		];
		$this->assertSame( $expected, register_events_custom_configs( [ 'foo' => [] ] ) );
	}
}
