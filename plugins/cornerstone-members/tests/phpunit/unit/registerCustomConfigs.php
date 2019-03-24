<?php
/**
 * Tests for register_custom_configs().
 *
 * @package     spiralWebDb\Members\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Members\Tests\Unit;

use Brain\Monkey\Functions;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\Members\register_custom_configs;

/**
 * Class Tests_RegisterCustomConfigs
 *
 * @package spiralWebDb\Members\Tests\Unit
 * @group   members
 * @group   configs
 */
class Tests_RegisterCustomConfigs extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		Functions\when( 'spiralWebDb\Members\_get_plugin_directory' )->justReturn( MEMBERS_ROOT_DIR );
		Functions\when( 'spiralWebDb\Module\Custom\Shortcode\register_shortcode' )->justReturn();
		require_once MEMBERS_ROOT_DIR . '/src/config-loader.php';
	}

	/**
	 * Test register_custom_configs() should return array containing members post type config.
	 */
	public function test_should_return_array_containing_members_post_type_config() {
		Functions\expect( 'current_filter' )->once()->andReturn( 'add_custom_post_type_runtime_config' );

		$actual   = register_custom_configs( [ 'foo' => [] ] );
		$expected = [
			'foo'     => [],
			'members' => require MEMBERS_ROOT_DIR . '/config/post-type.php',
		];
		$this->assertSame( $expected, $actual );
		// Check that the taxonomy config was not loaded.
		$this->assertArrayNotHasKey( 'role', $actual );
	}

	/**
	 * Test register_custom_configs() should return array containing members taxonomy config.
	 */
	public function test_should_return_array_containing_members_taxonomy_config() {
		Functions\expect( 'current_filter' )->once()->andReturn( 'add_custom_taxonomy_runtime_config' );

		$actual   = register_custom_configs( [ 'foo' => [] ] );
		$expected = [
			'foo'  => [],
			'role' => require MEMBERS_ROOT_DIR . '/config/taxonomy.php',
		];
		$this->assertSame( $expected, $actual );
		// Check that the post type config was not loaded.
		$this->assertArrayNotHasKey( 'members', $actual );
	}
}
