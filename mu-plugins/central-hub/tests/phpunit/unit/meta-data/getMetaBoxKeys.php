<?php
/**
 * Tests for the function get_meta_box_keys().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use Brain\Monkey;
use function spiralWebDB\Metadata\get_meta_box_keys;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_GetMetaBoxKeys
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
 * @group   meta-data
 */
class Tests_GetMetaBoxKeys extends Test_Case {

	/**
	 * Prepare the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/helpers.php';
	}

	/**
	 * Test get_meta_box_keys() returns empty array when store key is empty or does not start with 'meta_box.'
	 */
	public function test_returns_empty_array_when_store_key_is_empty_or_does_not_begin_with_meta_box() {
		$expected = [];
		get_meta_box_keys();

		$this->assertArrayNotHasKey( 'meta_box.', get_meta_box_keys() );
		$this->assertSame( $expected, get_meta_box_keys() );
	}

	/**
	 * Test get_meta_box_keys() returns all array keys that start with `meta_box.`
	 */
	public function test_returns_all_array_keys_that_start_with_meta_box() {
		Monkey\Functions\expect( 'KnowTheCode\ConfigStore\getAllKeysStartingWith' )
			->once()
			->with( 'meta_box.' )
			->andReturn( [ 'meta_box.events', 'meta_box.members' ] );

		$this->assertSame( [ 'meta_box.events', 'meta_box.members' ], get_meta_box_keys() );
	}
}

