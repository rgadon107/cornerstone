<?php
/**
 * Tests for _the_store().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\ConfigStore;

use function KnowTheCode\ConfigStore\_the_store;
use function KnowTheCode\ConfigStore\getConfig;
use function KnowTheCode\ConfigStore\loadConfig;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_TheStore
 *
 * @package spiralWebDb\centralHub\Tests\Unit\ConfigStore
 * @group   config-store
 */
class Tests_TheStore extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/internals.php';
		require_once CENTRAL_HUB_ROOT_DIR . '/src/config-store/api.php';

		self::empty_the_store();
	}

	/**
	 * Test _the_store() should return an empty array when no store key is passed in and there are no configurations
	 * stored.
	 */
	public function test_should_return_empty_array_when_no_key_or_configs() {
		$expected = [];

		$this->assertSame( $expected, _the_store() );
		$this->assertSame( $expected, _the_store( null ) );
		$this->assertSame( $expected, _the_store( false ) );
		$this->assertSame( $expected, _the_store( '' ) );
		$this->assertSame( $expected, _the_store( 0 ) );
		$this->assertSame( $expected, _the_store( 0.0 ) );
		$this->assertSame( $expected, _the_store( '0' ) );
	}

	/**
	 * Test _the_store() should return all stored configs when no store key or configuration is provided.
	 */
	public function test_should_return_all_stored_configs_when_no_key_or_configs() {
		// Store some configurations.
		$configs = [
			'foo' => [
				'aaa' => 37,
			],
			'bar' => [
				'bbb' => 'Hello World',
			],
			'baz' => [
				'ccc' => 'Testing the store.',
			],
		];
		foreach ( $configs as $store_key => $config ) {
			loadConfig( $store_key, $config );
		}

		// Should return the all stored configs.
		$this->assertSame( $configs, _the_store() );

		self::empty_the_store_by_keys( [ 'foo', 'bar', 'baz' ] );
	}

	/*
	 * Test _the_store() should return true when a configuration is stored.
	 */
	public function test_should_return_true_when_a_config_is_stored() {
		$config = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];

		$this->assertTrue( _the_store( __METHOD__, $config ) );

		self::empty_the_store_by_keys( [ __METHOD__ ] );
	}

	/**
	 * Test _the_store() should remove the config when the store key exists.
	 */
	public function test_should_remove_config_when_store_key_exists() {
		// Set up by adding a configuration into the store.
		$config = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];
		$this->assertTrue( _the_store( __METHOD__, $config ) );

		// Remove it. Check true is returned.
		$this->assertTrue( _the_store( __METHOD__, null, true ) );

		// Check that __METHOD__ store key no longer exists in the store.
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( sprintf( 'Configuration for [%s] does not exist in the ConfigStore', __METHOD__ ) );
		_the_store( __METHOD__ );

		// Empty the store from previous tests.  We waited to clean up here to ensure all functionality works.
		self::empty_the_store_by_keys( [ __METHOD__ ] );
	}

	/**
	 * Test _the_store() should throw an error when no store key is given with a config to store.
	 */
	public function test_should_throw_error_when_no_store_key_given_with_config_to_store() {
		$config  = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];
		$message = sprintf(
			'Unable to store as no store key was given with the configuration to store: %s',
			print_r( $config, true )
		);
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( $message );
		_the_store( '', $config );
	}

	/**
	 * Test _the_store() should throw an error when the store key does not exist in the store.
	 */
	public function test_should_throw_error_when_store_key_does_not_exist() {
		$this->expectException( \Exception::class );
		$this->expectExceptionMessage( 'Configuration for [invalid_store_key] does not exist in the ConfigStore' );
		_the_store( 'invalid_store_key' );
	}

	/*
	 * Test _the_store() should return the stored configuration when given a valid store key.
	 */
	public function test_should_return_stored_config_when_given_valid_store_key() {
		$config = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];

		// Store the config first.
		_the_store( __METHOD__, $config );

		// Test that the config is returned.
		$this->assertSame( $config, _the_store( __METHOD__ ) );

		// Clean up.
		self::empty_the_store_by_keys( [ __METHOD__] );
	}

	/**
	 *  Test _the_store() should overwrite a stored config using the same key.
	 */
	public function test_should_overwrite_a_stored_config_using_same_key() {
		$config = [
			'aaa' => 'bbb',
			'ccc' => 'ddd',
		];

		$this->assertTrue( _the_store( __METHOD__, $config ) );
		$this->assertSame( $config, getConfig( __METHOD__ ) );

		$new_config = [
			'aaa' => 37,
			'ccc' => 'Coding is fun!',
			'eee' => 'WordPress rocks!',
		];

		$this->assertTrue( _the_store( __METHOD__, $new_config ) );
		$this->assertSame( $new_config, getConfig( __METHOD__ ) );

		// Clean up.
		self::empty_the_store_by_keys( [ __METHOD__] );
	}

	/******************************************************************************
	 * Helper functions to clean and reset `_the_store` before and after each test.
	 ******************************************************************************/

	/**
	 * Empty all of the configs from the store.
	 *
	 * @param array $configs Optional. Array of configs stored in the store.
	 *
	 * @return void
	 * @throws \Exception
	 * @since 1.0.0
	 *
	 */
	protected static function empty_the_store( $configs = [] ) {
		// If no store keys or configs were given, grab the all configs from the store.
		if ( empty( $configs ) ) {
			$configs = _the_store();
			if ( empty( $configs ) ) {
				return;
			}
		}

		self::empty_the_store_by_keys( array_keys( $configs ) );
	}

	/**
	 * Empty all of the configs from the store for the given keys.
	 *
	 * @param array $store_keys Array of store keys to remove from store.
	 *
	 * @return void
	 * @throws \Exception
	 * @since 1.0.0
	 *
	 */
	protected static function empty_the_store_by_keys( $store_keys ) {
		foreach ( $store_keys as $store_key ) {
			self::remove_from_store( $store_key );
		}
	}

	/**
	 * Remove the config from the store by the given store key.
	 *
	 * @param array $store_key Key for the config to remove from store.
	 *
	 * @return void
	 * @throws \Exception
	 * @since 1.0.0
	 *
	 */
	protected static function remove_from_store( $store_key ) {
		_the_store( $store_key, null, true );
	}
}
