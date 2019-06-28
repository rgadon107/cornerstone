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
	 * Test loadConfigFromFilesystem() should merge defaults with config and return a store key.
	 */
	public function test_should_merge_defaults_and_return_store_key() {
		$path_to_file  = CENTRAL_HUB_ROOT_DIR . '/tests/phpunit/fixtures/test-cpt-config.php';
		$defaults      = [
			'aaa' => 37,
			'eee' => 'Coding is fun!',
		];
		$config        = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];
		$merged_config = [
			'aaa' => 37,
			'ccc' => 'ddd',
			'eee' => 'Coding is fun!',
		];
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_load_config_from_filesystem' )
			->once()
			->with( $path_to_file )
			->andReturn( [ 'foo', $config ] );
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_merge_with_defaults' )
			->once()
			->with( $config, $defaults )
			->andReturn( $merged_config );
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_the_store' )
			->once()
			->with( 'foo', $merged_config )
			->andReturn( true );

		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file, $defaults ) );
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
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_load_config_from_filesystem' )
			->once()
			->with( $path_to_file )
			->andReturn( [ 'foo', $config ] );
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_merge_with_defaults' )->never();
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_the_store' )
			->once()
			->with( 'foo', $config )
			->andReturn( true );

		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file ) );
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
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_load_config_from_filesystem' )
			->twice()
			->with( $path_to_file )
			->andReturn( [ 'foo', $config ] );
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_merge_with_defaults' )->never();
		Monkey\Functions\expect( '\KnowTheCode\ConfigStore\_the_store' )
			->twice()
			->with( 'foo', $config )
			->andReturn( true );

		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file ) );
		$this->assertSame( 'foo', loadConfigFromFilesystem( $path_to_file ) );
	}
}
