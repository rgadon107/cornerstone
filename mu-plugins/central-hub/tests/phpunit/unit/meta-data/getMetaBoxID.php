<?php
/**
 * Tests for the function get_meta_box_id().
 *
 * @package     spiralWebDb\centralHub\Tests\Unit\Metadata
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\centralHub\Tests\Unit\Metadata;

use function spiralWebDB\Metadata\get_meta_box_id;
use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;

/**
 * Class Tests_GetMetaBoxID
 *
 * @package spiralWebDb\centralHub\Tests\Unit\Metadata
 * @group   meta-data
 */
class Tests_GetMetaBoxID extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once CENTRAL_HUB_ROOT_DIR . '/src/meta-data/helpers.php';
	}

	// Test get_meta_box_id() should return an InvalidArgumentException when store key is empty.
	public function test_should_throw_exception_when_store_key_is_empty() {
		$this->expectException( \InvalidArgumentException::class );
		$this->expectExceptionMessage(
			'The haystack and needle cannot be empty. Given: haystack [] and needle of [meta_box.].'
		);
		get_meta_box_id( '' );
	}

	/**
	 * Test get_meta_box_id() should return store key when key does not start with 'meta_box.'.
	 */
	public function test_should_return_store_key_when_the_key_does_not_start_with_meta_box() {
		$this->assertSame( 'metabox.reviews', get_meta_box_id( 'metabox.reviews' ) );
		$this->assertSame( 'WordPress.rocks', get_meta_box_id( 'WordPress.rocks' ) );
		$this->assertSame( 'shortcode.qa', get_meta_box_id( 'shortcode.qa' ) );
	}

	/**
	 * Test get_meta_box_id() should return the meta box id when the store key starts with 'meta_box.'.
	 */
	public function test_should_return_meta_box_id_when_key_starts_with_meta_box() {
		$this->assertSame( 'reviews', get_meta_box_id( 'meta_box.reviews' ) );
		$this->assertSame( 'events', get_meta_box_id( 'meta_box.events' ) );
		$this->assertSame( 'members', get_meta_box_id( 'meta_box.members' ) );
	}
}

