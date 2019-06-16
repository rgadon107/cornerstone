<?php
/**
 *  Tests for _load_config_from_filesystem()
 *
 * @package    spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use Brain\Monkey;
use function KnowTheCode\ConfigStore\_load_config_from_filesystem;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_LoadConfigFromFilesystem
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_LoadConfigFromFilesystem extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/internals.php';
	}

	/**
	 *  Test _load_config_from_filesystem() should return the configuration array when $path_to_file is given.
	 */
	public function test_should_return_array_when_path_to_file_is_given() {
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		$expected     = [
			'aaa' => 'bbb',
			'ccc' => 'ddd'
		];
		$actual       = _load_config_from_filesystem( $path_to_file );

		$this->assertSame( 'foo', $actual[0] );
		$this->assertSame( $expected, $actual[1] );
	}

	/**
	 * Test _load_config_from_filesystem() should throw an Exception when configuration no store key exists.
	 */
	public function test_should_throw_exception_when_no_store_key() {
		// Test when no store key but has configuration parameters.
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/config-with-params-only.php';
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage(
			sprintf( 'No store key exists in the %s configuration file.', $path_to_file )
		);
		_load_config_from_filesystem( $path_to_file );

		// Test when no store key or configuration parameters.
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/empty-config.php';
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage(
			sprintf( 'No store key exists in the [%s] configuration file.', $path_to_file )
		);
		_load_config_from_filesystem( $path_to_file );
	}

	/**
	 * Test _load_config_from_filesystem() should throw an Exception when configuration store key exists and
	 *  parameters are empty.
	 */
	public function test_should_throw_exception_when_config_store_key_exists_and_no_parameters() {
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/config-with-store-key-only.php';
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage(
			sprintf( 'No configuration parameters exist for store key [%s] in the %s configuration file.',
				'foo', $path_to_file ) );
		_load_config_from_filesystem( $path_to_file );
	}
}

