<?php
/**
 * Tests for the API function getAllKeys().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\ConfigStore;

use function KnowTheCode\ConfigStore\_the_store;
use function KnowTheCode\ConfigStore\loadConfig;
use function KnowTheCode\ConfigStore\getAllKeys;
use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;

/**
 * Class Tests_GetAllKeys
 *
 * @package spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @group   config-store
 */
class Tests_GetAllKeys extends Test_Case {

	/**
	 * Test getAllKeys() should return all store keys.
	 */
	public function test_should_return_all_store_keys() {
		// Intialize _the_store and unset all previously stored data.
		$configs = _the_store();
		if ( empty( $configs ) ) {
			return;
		}
		foreach ( array_keys( $configs ) as $store_key ) {
			_the_store( $store_key, null, true );
		}
		$config_store = [
			'foo' => [
				'aaa' => 37,
				'ccc' => 'Coding is fun!',
				'eee' => 'WordPress rocks!',
			],
			'bar' => [
				'bbb' => 'Hello World',
			],
			'baz' => [
				'ddd' => 'Brain Monkey',
			],
		];
		foreach ( $config_store as $store_key => $config_to_store ) {
			loadConfig( $store_key, $config_to_store );
		}
		$this->assertSame( [ 'foo', 'bar', 'baz' ], getAllKeys() );

		// Clean _the_store in preparation for the next test.
		$configs = _the_store();
		foreach ( $configs as $store_key => $config_to_store ) {
			_the_store( $store_key, null, true );
		}
	}

	/**
	 * Test getAllKeys() should return an empty array when store is empty.
	 */
	public function test_should_return_empty_array_when_store_is_empty() {
		$expected = [];
		$this->assertSame( $expected, getAllKeys() );
	}
}

