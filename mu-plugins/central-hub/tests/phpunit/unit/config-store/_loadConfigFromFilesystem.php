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
	 * Test _load_config_from_filesystem() should throw an Exception when configuration store key is empty
	 *  and parameters exist.
	 */
	public function test_should_throw_exception_when_no_store_key() {
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage(
			sprintf( 'No store key exists in the [path_to_file] configuration file.', 'path_to_file' )
		);
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/config-with-params-only.php';
		_load_config_from_filesystem( $path_to_file );
	}


	/**
	 * Test _load_config_from_filesystem() should throw an Exception when configuration store key exists and
	 *  parameters are empty.
	 */
//	public function test_should_throw_an_exception_when_config_store_key_exists_and_parameters_are_empty() {
//		$this->expectException( \Exception::class );
//		$this->expectExceptionMessage(
//			sprintf( 'No configuration parameters exist for store key [store_key] in the [path_to_file] configuration file.',
//				'store_key', 'path_to_file' ) );
//	}

	/**
	 * Test _load_config_from_filesystem() should throw an Exception when the configuration store key and
	 *  parameters are both empty.
	 */

}

