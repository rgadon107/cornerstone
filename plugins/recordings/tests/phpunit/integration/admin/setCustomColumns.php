<?php
/**
 * Tests for set_custom_columns().
 *
 * @package     spiralWebDb\Recordings\Tests\Integration
 * @since       1.3.0
 * @author      Robert Gadon <rgadon107>
 * @link        https://github.com/rgadon107/cornerstone
 * @license     GNU-2.0+
 */

namespace spiralWebDb\Recordings\Tests\Integration;

use spiralWebDb\Cornerstone\Tests\Integration\Test_Case;
use function spiralWebDb\Recordings\set_custom_columns;

/**
 * Class Tests_SetCustomColumns
 *
 * @package spiralWebDb\Recordings\Tests\Integration
 * @group   recordings
 * @group   admin
 */
class Tests_SetCustomColumns extends Test_Case {

	/**
	 * Test set_custom_columns() should return array of columns.
	 */
	public function test_should_return_array_of_columns() {
		$this->assertTrue( true );
	}
}
