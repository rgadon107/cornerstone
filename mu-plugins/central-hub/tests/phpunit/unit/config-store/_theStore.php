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

namespace spiralWebDb\centralHub\Tests\ConfigStore;

use function KnowTheCode\ConfigStore\_the_store;
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
	}

	/**
	 * Test _the_store() should return an empty array when no store key is passed in and there are no configurations stored.
	 */
	public function test_should_return_empty_array_when_no_key_or_configs() {
		$expected = [];

		$this->assertSame( $expected, _the_store() );
		$this->assertSame( $expected, _the_store( null ) );
		$this->assertSame( $expected, _the_store( false ) );
		$this->assertSame( $expected, _the_store( '' ) );
		$this->assertSame( $expected, _the_store( 0 ) );
		$this->assertSame( $expected, _the_store( 0.0 ));
		$this->assertSame( $expected, _the_store( '0'));
	}

	/*
	 * Test _the_store() should return true when a configuration is stored.
	 */
	public function test_should_return_true_when_a_config_is_stored() {

		$store_key       = 'custom-meta-box';
		$config_to_store = [ $store_key ];

		$this->assertTrue( _the_store( $store_key, $config_to_store ) );
	}

	/*
	 * Test that stored configuration has array key $store_key.
	 */
	public function test_should_return_config_store_array_key() {

		$store_key                   = 'custom-meta-box';
		$config_to_store             = [ $store_key ];
		$config_store[ $store_key ]  = $config_to_store;

		$this->assertSame( _the_store( 'custom-meta-box' ), $config_store[ 'custom-meta-box' ] );
		$this->assertArrayHasKey( 'custom-meta-box', $config_store );
	}

	/*
	 * Test should assert $store_key is not in $config_store array. If key does
	 *   not exist in the array, a class \Exception with message will be thrown.
	 */
	public function test_store_key_is_not_in_config_store() {

		$store_key = '';
        $config_store = [];

		$this->assertArrayNotHasKey( $store_key, $config_store );
	}

}
