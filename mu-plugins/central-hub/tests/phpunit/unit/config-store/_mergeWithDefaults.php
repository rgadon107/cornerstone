<?php
/**
 *  Tests for _merge_with_defaults
 *
 * @package    spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use function KnowTheCode\ConfigStore\_merge_with_defaults;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_MergeWithDefaults
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_MergeWithDefaults extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/internals.php';
	}

	/**
	 * Test should return empty when empty arrays are given.
	 */
	public function test_should_return_empty_when_empty_arrays_given() {
		$this->assertEmpty( _merge_with_defaults( [], [] ) );
	}

	/**
	 * Test should return config when defaults are empty.
	 */
	public function test_should_return_config_when_defaults_are_empty() {
		$config = [
			'foo' => [
				'post_type'       => 'post',
				'number_of_posts' => 5
			]
		];

		$this->assertSame( $config, _merge_with_defaults( $config, [] ) );
	}

	/**
	 * Test should return defaults when config is empty.
	 */
	public function test_should_return_defaults_when_config_is_empty() {
		$defaults = [
			'foo' => [
				'post_type'       => 'post',
				'number_of_posts' => 5
			]
		];

		$this->assertSame( $defaults, _merge_with_defaults( [], $defaults ) );
	}

	/**
	 *  Test should merge configuration with default array parameters
	 */
	public function test_should_merge_config_with_default_array_parameters() {
		$config = [
			'foo' => [
				'post_type'       => 'cornerstone-members',
				'number_of_posts' => 5
			]
		];

		$defaults = [
			'foo' => [
				'post_type'       => 'post',
				'number_of_posts' => - 1,
				'post_status'     => 'published'
			]
		];

		$actual = _merge_with_defaults( $config, $defaults );

		$expected = [
			'foo' => [
				'post_type'       => 'cornerstone-members',
				'number_of_posts' => 5,
				'post_status'     => 'published'
			]
		];

		$this->assertSame( $expected, $actual );
	}
}

