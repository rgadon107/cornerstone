<?php
/**
 * Tests for _the_store().
 *
 * @package     spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Integration\ConfigStore;

use function KnowTheCode\ConfigStore\_the_store;
use Exception;
use spiralWebDb\centralHub\Tests\Integration\Test_Case;

/**
 * Class Tests_TheStore
 *
 * @package spiralWebDb\centralHub\Tests\Integration\ConfigStore
 * @group   config-store
 */
class Tests_TheStore extends Test_Case {

	/**
	 * Test _the_store() should throw an error when the store key does not exist in the store.
	 */
	public function test_should_throws_error_when_store_key_does_not_exist() {
		$this->assertTrue( _the_store( 'foo', [ 'baz' => 'bar' ] ) );

		$this->setExpectedException(Exception::class);
		$this->expectExceptionMessage( 'Configuration for [invalid_store_key] does not exist in the ConfigStore' );

		_the_store( 'invalid_store_key' );
	}
}
