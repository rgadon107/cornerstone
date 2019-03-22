<?php
/**
 * Tests for set_custom_columns().
 *
 * @package     spiralWebDb\Recordings\Tests\Unit
 * @since       1.0.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Recordings\Tests\Unit;

use spiralWebDb\Cornerstone\Tests\Unit\Test_Case;
use function spiralWebDb\Recordings\set_custom_columns;

/**
 * Class Tests_SetCustomColumns
 *
 * @package spiralWebDb\Recordings\Tests\Unit
 * @group   recordings
 * @group   admin
 */
class Tests_SetCustomColumns extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once RECORDINGS_ROOT_DIR . '/src/admin/wp-list-table.php';
	}

	/**
	 * Test set_custom_columns() should return array of columns.
	 */
	public function test_should_return_array_of_columns() {
		$expected = [
			'cb'           => '<input type="checkbox"/>',
			'title'        => 'Recording Title',
			'recording_id' => 'Recording ID',
			'menu_order'   => 'Order Number',
		];

		$this->assertSame( $expected, set_custom_columns() );
	}
}
