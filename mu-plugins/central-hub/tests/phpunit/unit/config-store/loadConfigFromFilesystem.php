<?php
/**
 *  Tests for external API function loadConfigFromFilesystem()
 *
 * @package    spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use Brain\Monkey;
use function KnowTheCode\ConfigStore\loadConfigFromFilesystem;
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

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/api.php';
	}

	/**
	 * Test loadConfigFromFilesystem() should merge defaults with config
	 *   and return a store key.
	 */
	public function test_should_merge_defaults_and_return_store_key() {
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		$defaults     = [
			'foo' => [
				'aaa' => 37,
				'eee' => 'Coding is fun!'
			]
		];

		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file, $defaults ) );
	}

	/**
	 * Test loadConfigFromFilesystem() should store a config and return the store key.
	 */
	public function test_should_store_a_config_and_return_store_key() {
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		$defaults     = [];

		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file, $defaults ) );
	}

	/**
	 * Test loadConfigFromFilesystem() should return a fatal error when
	 *  $path_to_file is invalid path.
	 */
	public function test_should_return_error_when_argument_is_invalid_path() {
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_load_config_from_filesystem' )
			->once()
			->with( 'path/to/file.php' )
			->andThrow( 'Error' );
		$this->expectException( \Error::class );
		loadConfigFromFilesystem( 'path/to/file.php' );
	}

	/**
	 * Test loadConfigFromFilesystem() should overwrite stored configuration and
	 *   return store key from file configuration.
	 */
	public function test_should_overwrite_store_and_return_store_key_from_file_config() {
		Monkey\Functions\when( '\KnowTheCode\ConfigStore\_the_store' )
			->justReturn( 'baz');
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		loadConfigFromFilesystem( $path_to_file );

		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file ) );
	}

}