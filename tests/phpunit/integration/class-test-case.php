<?php
/**
 * Test Case for all of the Integration Test Suites
 *
 * @package     spiralWebDb\Cornerstone\Tests\Integration
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Cornerstone\Tests\Integration;

use Brain\Monkey;
use function KnowTheCode\ConfigStore\_the_store;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use spiralWebDb\Cornerstone\Tests\Test_Case_Trait;
use WP_UnitTestCase;

/**
 * Abstract Class Test_Case
 *
 * @package spiralWebDb\Cornerstone\Tests\Integration
 */
abstract class Test_Case extends WP_UnitTestCase {
	use MockeryPHPUnitIntegration;
	use Test_Case_Trait;

	/**
	 * Set up the test before we run the test setups.
	 */
	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();

		set_current_screen( 'front' );
	}

	/**
	 * Prepares the test environment before each test.
	 */
	public function setUp() {
		parent::setUp();
		Monkey\setUp();
	}

	/**
	 * Cleans up the test environment after each test.
	 */
	public function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * Empty all of the configs from the store.
	 *
	 * @since 1.0.0
	 *
	 * @param array $configs Optional. Array of configs stored in the store.
	 *
	 * @return void
	 * @throws \Exception
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
	 * @since 1.0.0
	 *
	 * @param array $store_keys Array of store keys to remove from store.
	 *
	 * @return void
	 * @throws \Exception
	 */
	protected static function empty_the_store_by_keys( $store_keys ) {
		foreach ( $store_keys as $store_key ) {
			self::remove_from_store( $store_key );
		}
	}

	/**
	 * Remove the config from the store by the given store key.
	 *
	 * @since 1.0.0
	 *
	 * @param array $store_key Key for the config to remove from store.
	 *
	 * @return void
	 * @throws \Exception
	 */
	protected static function remove_from_store( $store_key ) {
		_the_store( $store_key, null, true );
	}
}
