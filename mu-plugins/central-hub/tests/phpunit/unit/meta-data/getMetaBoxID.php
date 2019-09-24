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

	/**
	 * Test get_meta_box_id() should return the meta box id when the store key starts with 'meta_box.'.
	 */
	public function test_should_return_meta_box_id_when_key_starts_with_meta_box() {
		$this->assertSame( 'reviews', get_meta_box_id( 'meta_box.reviews' ) );
		$this->assertSame( 'events', get_meta_box_id( 'meta_box.events' ) );
		$this->assertSame( 'members', get_meta_box_id( 'meta_box.members' ) );
	}
}
