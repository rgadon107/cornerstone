<?php
/**
 *  Tests for external API function loadConfigFromFilesystem()
 *
 * @package    spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @since      1.3.0
 * @author     Robert A. Gadon
 * @link       https://github.com/rgadon107/cornerstone
 * @license    GNU General Public License 2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\ConfigStore;

use Brain\Monkey;
use function KnowTheCode\ConfigStore\_the_store;
use function KnowTheCode\ConfigStore\loadConfigFromFilesystem;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;


/**
 * Class Tests_LoadConfigFromFilesystem
 *
 * @package spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @group   config-store
 */
class Tests_LoadConfigFromFilesystem extends Test_Case {

	/**
	 * Test loadConfigFromFilesystem() should merge defaults with config and return a store key.
	 */
	public function test_should_merge_defaults_and_return_store_key() {
		$path_to_file  = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		$defaults      = [
			'aaa' => 37,
			'eee' => 'Coding is fun!',
		];
		$merged_config = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
			'eee' => 'Coding is fun!',
		];

		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file, $defaults ) );
		$this->assertEquals( $merged_config, _the_store( 'foo' ) );
	}

	/**
	 * Test loadConfigFromFilesystem() should store a config and return the store key.
	 */
	public function test_should_store_a_config_and_return_store_key() {
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		$config       = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];

		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file ) );
		$this->assertSame( $config, _the_store( 'foo' ) );
	}

	/**
	 * Test loadConfigFromFilesystem() should overwrite stored configuration and return store key from
	 * file configuration.
	 */
	public function test_should_overwrite_store_and_return_store_key_from_file_config() {
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		$config       = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];

		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file ) );
		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file ) );
		$this->assertSame( $config, _the_store( 'foo' ) );
	}

	/**
	 * Test loadConfigFromFilesystem() should overwrite stored configuration and return store key from
	 * file configuration.
	 */
	public function test_should_throw_exception_when_no_store_key() {
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/config-with-params-only.php';
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage(
			sprintf( 'No store key exists in the %s configuration file.', $path_to_file )
		);
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_merge_with_defaults' )->never();
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_the_store' )->never();

		loadConfigFromFilesystem( $path_to_file );
	}

	/**
	 * Test loadConfigFromFilesystem() should throw an Exception when the configuration parameters are empty.
	 */
	public function test_should_throw_exception_when_config_params_empty() {
		$path_to_file = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/config-with-store-key-only.php';
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage(
			sprintf(
				'No configuration parameters exist for store key [foo] in the %s configuration file.',
				$path_to_file
			)
		);
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_merge_with_defaults' )->never();
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_the_store' )->never();

		loadConfigFromFilesystem( $path_to_file );
	}
}
