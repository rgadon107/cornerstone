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
	 * Test _the_store() should return an empty array when no storey key is passed in and there are no configurations stored.
	 */
	public function test_should_return_empty_array_when_no_key_or_configs() {
		$expected = [];
		$this->assertSame( $expected, _the_store() );
		$this->assertSame( $expected, _the_store( null ) );
		$this->assertSame( $expected, _the_store( false ) );
		$this->assertSame( $expected, _the_store( '' ) );
	}

}
